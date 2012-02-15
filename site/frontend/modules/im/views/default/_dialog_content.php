<?php
$pal = Im::model()->GetDialogUser($id);
?>
<div class="user-details">

    <div class="actions">
        <a href="#" class="add"><i class="icon"></i><br/>Добавить<br/>в друзья</a>
        <a href="#" class="block"><i class="icon"></i><br/>В черный<br/>список</a>
    </div>

    <?php $this->widget('AvatarWidget', array('user'=>$pal))?>

    <div class="text">
        <p><span class="status-<?php echo ($pal->online)?'online':'offline' ?>"></span>
            <span><?php echo $pal->first_name ?></span><br/>
            <?php echo $pal->getFlag(); ?><?php echo $pal->getPublicLocation(); ?></p>

        <a href="#">Больше...</a>
        &nbsp;&nbsp;&nbsp;
        <a href="#" class="yellow">Анкета</a>

    </div>

</div>

<div class="list-actions">
    <a class="remove-dialog" href=""><i class="icon-remove"></i>Удалить диалог</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="#">Распечатать</a>
</div>

<div class="dialog-list scroll" id="messages">

    <?php $this->renderPartial('_messages', array(
        'messages' => $messages
    )); ?>

</div>