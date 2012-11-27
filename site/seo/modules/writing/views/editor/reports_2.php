<div class="seo-table table-report tabs">
    <div class="table-title">Список заданий</div>

    <div class="table-nav nav">
        <?php $this->renderPartial('reports_menu', array('criteria' => $criteria, 'status'=>$status)); ?>
    </div>


    <div class="tabs-container">
        <div class="table-box tab-box tab-box-2">
            <table>
                <colgroup>
                    <col width="400">
                    <col>
                    <col>
                    <col>
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <th class="al">Ключевые слова и фразы</th>
                    <th class="al">Название статьи</th>
                    <th>Исполнитель</th>
                    <th>Статус</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($models as $task)
                    $this->renderPartial('_correcting_task',compact('task'));
                ?>
                </tbody>
            </table>
        </div>

    </div>

    <?php if ($pages->pageCount > 1): ?>
    <div class="pagination pagination-center clearfix">
        <?php $this->widget('MyLinkPager', array(
        'header'=>false,
        'pages' => $pages,
    )); ?>
    </div>
    <?php endif; ?>

</div>