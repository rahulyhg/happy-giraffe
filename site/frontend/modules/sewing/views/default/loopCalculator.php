<?php Yii::app()->clientScript->registerScript('LoopCalculation',
    "function StartCalc() {
        var c1 = parseInt($('#LoopCalculationForm_sample_width_sm').val());
        var c2 = parseInt($('#LoopCalculationForm_sample_height_sm').val());
        var p1 = parseInt($('#LoopCalculationForm_sample_width_p').val());
        var p2 = parseInt($('#LoopCalculationForm_sample_height_p').val());

        var c3 = parseInt($('#LoopCalculationForm_width').val());
        var c4 = parseInt($('#LoopCalculationForm_height').val());

        var p3 = Math.round(p1 * (c3 / c1));
        var p4 = Math.round(p2 * (c4 / c2));

        $('#result').html('<div class=\"form_block pink clearfix\">' +
            '<p><span>' + p3 + '</span> петель</p>' +
            '<p><span>' + p4 + '</span> рядов</p>' +
            '</div>');

        return false;
    }");

$model = new LoopCalculationForm();
?>
<div class="right_block">
    <div class="calculator_loops">
        <h1>Калькулятор петель</h1>

        <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'loop-calculator-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => false,
            'validateOnType' => false,
            'validationUrl' => $this->createUrl('/sewing/default/LoopCalculator'),
            'afterValidate' => "js:function(form, data, hasError) {
                                    if (!hasError)
                                        StartCalc();
                                    else{
                                        $('#result').html('');
                                    }
                                    return false;
                                  }",
        )));?>

        <div class="form_block green">
            <p class="form_header">Размер образца</p>

            <p>Введите размер образца и количество рядов и петель в нем:</p>

            <div class="left_column">
                <p>Ширина</p>

                <div class="row">
                    <?php echo $form->textField($model, 'sample_width_sm') ?>
                    <?php echo $form->error($model, 'sample_width_sm'); ?><label>см</label>
                </div>
                <div class="row">
                    <?php echo $form->textField($model, 'sample_width_p') ?>
                    <?php echo $form->error($model, 'sample_width_p'); ?><label>петель</label>
                </div>
            </div>
            <div class="right_column">
                <p>Длина</p>

                <div class="row">
                    <?php echo $form->textField($model, 'sample_height_sm') ?>
                    <?php echo $form->error($model, 'sample_height_sm'); ?><label>см</label>
                </div>
                <div class="row">
                    <?php echo $form->textField($model, 'sample_height_p') ?>
                    <?php echo $form->error($model, 'sample_height_p'); ?><label>рядов</label>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="form_block blue">
            <p class="form_header">Размер изделия</p>

            <p>Введите размер изделия</p>

            <div class="left_column">
                <p>Ширина</p>

                <div class="row">
                    <?php echo $form->textField($model, 'width') ?>
                    <?php echo $form->error($model, 'width'); ?><label>см</label>
                </div>
            </div>
            <div class="right_column">
                <p>Длина</p>

                <div class="row">
                    <?php echo $form->textField($model, 'height') ?>
                    <?php echo $form->error($model, 'height'); ?><label>см</label>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <input type="submit" value="Рассчитать"/>

        <div id="result">
        </div>

        <?php echo $form->errorSummary($model) ?>

        <div class="clear"></div>

        <?php $this->endWidget(); ?>
    </div>
</div>

<div class="seo-text">
    <h1 class="summary-title">Калькулятор петель</h1>

    <p>Начинаете вязать себе носок, делаете несколько рядов и понимаете, что он будет мал даже младшей дочке.
        Распускаете. Прибавляете несколько петель на каждой спице и начинаете заново. Через полчаса понимаете, что носок
        будет велик даже дедушке. Бывало у вас так?</p>

    <div class="brushed">
        <p>Чтобы подобной ситуации не возникало – создан наш сервис. Пользоваться им просто.</p>

        <p>Сначала нужно связать образец из выбранной пряжи в виде квадрата со сторонами примерно 12 сантиметров. Его
            нужно намочить, высушить, не растягивая, и чуть-чуть отпарить. Берём линейку – отмеряем, слегка отступив от
            края, 10 сантиметров в ширину и считаем, сколько в них поместилось петель. Потом измеряем длину и считаем,
            сколько в ней поместилось рядов. Если у вас получился образец меньшего размера – ничего страшного.
            Посчитайте, сколько петель и рядов помещается в 8 сантиметрах или даже в 5.</p>

        <p>Теперь всё просто.</p>
        <ul>
            <li>Вводим полученные данные в соответствующие поля специальной формы,</li>
            <li>Вводим желаемые длину и ширину изделия в специальные поля формы.</li>
        </ul>
        <p>Получаем результат: сколько нужно набрать петель, чтобы получилась необходимая ширина изделия, и сколько
            нужно провязать рядов, чтобы достичь нужной длины изделия.</p>
    </div>
    <p>Теперь нужный размер любого изделия, даже намного более сложного, чем носок, получится с первого раза. А это так
        приятно!</p>
</div>