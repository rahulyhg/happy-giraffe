<?php
/**
 * @var \site\frontend\modules\posts\modules\forums\widgets\onlineUsers\OnlineUsersWidget $this
 * @var \User[] $users
 */
?>

<section class="now-online now-online_margin">
    <div class="title text-center">Сейчас онлайн</div>
    <ul class="now-online__list">
        <?php foreach ($users as $user): ?>
        <li class="now-online__item">
            <a href="<?=$user->getUrl()?>" class="now-online__link"><img src="<?=$user->getAvatarUrl(40)?>" alt="" class="now-online__img"></a>
        </li>
        <?php endforeach; ?>
    </ul>
</section>
