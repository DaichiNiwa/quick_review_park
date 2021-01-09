<?php

class ReviewStoreService
{
    public function execute($db, $review_text, $shop_id, $user_id)
    {
        try {
            $db->beginTransaction();

            $analyzed_result = $this->analyze_sentiment($review_text);

            Review::store($db, $shop_id, $user_id);
            $review_id = $db->lastInsertId();

            $this->store_sentences($db, $review_id, $analyzed_result->sentences);

            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
            return false;
        }
        return $review_id;
    }

    private function analyze_sentiment($review)
    {
        $post_data = [
            'document' => [
                'type' => 'PLAIN_TEXT',
                'language' => 'ja',
                'content' => $review,
            ],
            'encodingType' => 'UTF8',
        ];

        $post_data = json_encode($post_data);
        $url = 'https://language.googleapis.com/v1beta2/documents:analyzeSentiment?key=' . API_KEY;
        $handle = curl_init($url);

        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLINFO_HEADER_OUT, true);
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt(
            $handle,
            CURLOPT_HTTPHEADER,
            [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($post_data),
            ]
        );

        $result = curl_exec($handle);
        curl_close($handle);
        dd($result);
        return json_decode($result);
    }

    private function store_sentences($db, $review_id, $sentences)
    {
        $order_number = 1;
        foreach ($sentences as $sentence) {
            Sentence::store(
                $db,
                $review_id,
                $sentence->text->content,
                $order_number,
                $sentence->sentiment->score
            );
            $order_number++;
        }
    }
}



