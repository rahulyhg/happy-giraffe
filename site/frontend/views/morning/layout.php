<?php $this->beginContent('//layouts/main'); ?>

<!-- <div id="morning" class="clearfix">

    <div class="main-right morning-main"> -->
<div id="morning" class="content-cols clearfix">
    <div class="col-23-middle morning-main">
        <?=$content ?>

    </div>

    <?php if ($this->time !== null) $this->renderPartial('_sidebar'); ?>

</div>

<?php $this->endContent(); ?>