<div class="user-interests">
    <ul class="interests-list">
        <?php foreach ($data->interests as $i): ?>
            <li><span class="interest"><?=$i->title?></span></li>
        <?php endforeach; ?>
    </ul>
</div>