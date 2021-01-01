<header>
    <nav class="navbar navbar-expand-sm navbar-light bg-light mb-2">
        <a class="navbar-brand mx-4" href="<?=h(MYPAGE);?>">
            <i class="fas fa-comment-dots fa-lg"></i> Quick Review Park
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#headerNav" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="ナビゲーションの切替">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="headerNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link">ログイン中：<?= h($user->name);?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= h(SHOPS);?>">店舗一覧</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= h(LOGOUT);?>">ログアウト</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
