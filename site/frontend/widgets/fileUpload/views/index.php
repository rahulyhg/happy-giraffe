<?php echo CHtml::form('', 'post', array('id' => 'upload-form', 'enctype' => 'multipart/form-data')); ?>
<div class="profile-form-in">
    <p><?php echo CHtml::fileField('file', '', array('id' => $this->id, 'id' => 'upload-input', 'multiple' => 'multiple')); ?></p>
    <div class="row-btn-left">
        <button class="btn btn-orange"><span><span>Загрузить</span></span>
    </div>
</div>
<?php echo CHtml::endForm(); ?>