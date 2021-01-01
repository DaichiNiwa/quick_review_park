<?php foreach (get_errors() as $error) { ?>
  <p class="alert alert-danger"><span><?=$error; ?></span></p>
<?php } ?>
<?php foreach (get_messages() as $message) { ?>
  <p class="alert alert-success"><span><?=$message; ?></span></p>
<?php } ?>