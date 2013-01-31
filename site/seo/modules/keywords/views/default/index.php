<?php
Yii::app()->clientScript->registerScriptFile('/js/knockout-2.2.1.js');

$folders

?>
<div class="search clearfix">

    <div class="input">
        <label>Введите слово или фразу</label>
        <input name="keyword" id="keyword" type="text">
        <button class="btn btn-green-small"
                onclick="KeyOk.term = $(this).prev().val();KeyOk.searchKeywords();return false;">
            <span><span>Поиск</span></span></button>
    </div>

    <div class="result">

    </div>

</div>

<div class="clearfix">
    <div style="float: left;width:250px;">
        <?php $this->renderPartial('_sidebar'); ?>
    </div>

    <div class="seo-table table-result" style="float: left;width: 700px;">
        <div class="table-box">
            <table>
                <thead>
                <tr>
                    <th class="col-1" style="width:350px;">Ключевое слово или фраза</th>
                    <th><i class="icon-freq"></i></th>
                    <th>Частота показов</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody data-bind="foreach: keywords">
                    <tr>
                        <td data-bind="text: text"></td>
                        <td data-bind="text: wordstat"></td>
                        <td data-bind="text: folder"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(function () {
        $('#keyword').keypress(function (e) {
            if (e.which == 13) {
                KeyOk.term = $(this).val();
                KeyOk.searchKeywords();
            }
        });

        $('body').delegate('.yiiPager li.page a', 'click', function (e) {
            var myRe = /.\/(\d+)\//ig;

            var page = myRe.exec($(this).attr('href'));
            page = page[1];
            KeyOk.page = page - 1;
            KeyOk.searchKeywords();

            return false;
        });
    });
</script>