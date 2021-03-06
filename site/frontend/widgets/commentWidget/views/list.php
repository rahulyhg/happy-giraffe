<?php
/**
 * @var CActiveDataProvider $dataProvider
 * @var $this CommentWidget
 */

$form = $this->render('add_comment', array('comment_model' => $comment_model), true);

$template = '
<div class="default-comments" id="comment_list">
    <div class="comments-meta clearfix">
        <div class="clearfix">
            <div class="title">' . $this->title . '</div>
            <div class="count">' . $dataProvider->totalItemCount . '</div>
        </div>
        <p class="margin-5">'.$this->notice.'</p>
    </div>' . $form . '{items}
</div>
<div class="pagination pagination-center clearfix">
    {pager}
</div>
';


$this->widget('HCommentListView', array(
    'cssFile'=>false,
    'dataProvider' => $dataProvider,
    'itemView' => '_comment',
    'itemsTagName' => 'ul',
    'summaryText' => 'показано: {start} - {end} из {count}',
    'afterAjaxUpdate' => $this->objectName.'.goTop();',
    'pager' => array(
        'class' => 'MyLinkPager',
        'header' => '',
    ),
    'id' => 'comment_list_' . $this->objectName,
    'template' => $template,
    'viewData' => array(
        'currentPage' => $dataProvider->pagination->currentPage,
        'dp' => $dataProvider,
    ),
    'popUp' => $this->popUp,
));
