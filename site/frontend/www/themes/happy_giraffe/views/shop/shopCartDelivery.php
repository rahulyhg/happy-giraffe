<div class="clearfix" id="cart">

	<div class="cart-title">Моя корзина</div>

	<div class="steps">
		<ul>
			<li><a>Мой заказ</a></li>
			<li><a>Информация</a></li>
			<li class="active"><a>Оплата</a></li>
			<li><a>Успешно</a></li>
		</ul>
	</div>

	<div class="subtitle">Ваш заказ</div>

	<div class="highlight payment-details">
		<ul>
			<li>
				<span class="a-right"><?php echo Y::user()->first_name, " ", Y::user()->last_name; ?></span>
				Получатель:
			</li>
			<li>
				<span class="a-right"><?php echo Y::user()->email, ', ', Y::user()->phone; ?></span>
				Контактные данные:
			</li>
			<li>
				<span class="a-right">
					<?php echo $adress['adress_index'], ', ', $adress['region_name']; ?>,<br>
					<?php
					$var = array();
					$var[] = 'г. '.$adress['city_name'];
					$var[] = 'ул. '. $adress['adress_street'];
					$var[] = 'д. '. $adress['adress_house'];
					if($adress['adress_corps'])
						$var[] = 'корп. '. $adress['adress_corps'];
					if($adress['adress_room'])
						$var[] = 'кв. '. $adress['adress_room'];
					
					echo implode(', ', $var); ?>
					
					<?php if($adress['adress_porch'] || $adress['adress_floor']): ?>
					<span>
						<?php
						$var = array();
						if($adress['adress_porch'])
							$var[] = $adress['adress_porch'].' подъезд';
						if($adress['adress_floor'])
							$var[] = $adress['adress_floor'].' этаж';
						
						echo implode(', ', $var); ?>
					</span>
					<?php endif; ?>
				</span>
				Адрес доставки:
			</li>
			<li>
				<span class="a-right"><?php echo $delivery['method']; ?></span>
				Способ доставки:
			</li>
			<li>
				<span class="a-right">
					<?php echo CHtml::link('<span><span><img src="/images/arrow_l.png"><b>Изменить данные</b></span></span>', Y::request()->getUrlReferrer(), array(
						'class'=>'btn btn-gray-medium btn-arrow-left',
					)); ?>
				</span>

			</li>						
		</ul>
	</div>

	<div class="total a-right">
		<div class="total-price">
			<dl>
				<dd>Предварительный итог:</dd>
				<dt><span><b><?php echo $order['order_price_total']; ?></b></span> руб. (включая НДС)</dt>
				<dd>Доставка и обработка:</dd>
				<dt><span><b><?php echo $order['order_price_delivery']; ?></b></span> руб.</dt>
			</dl>
		</div>
		<div class="note">
			<dl>
				<dd><span><b>Итого:</b></span></dd>
				<dt><span><b><?php echo $order['order_price_total'] + $order['order_price_delivery']; ?></b></span> руб.</dt>
			</dl>
		</div>
	</div>

	<div class="clear"></div>

	<div class="subtitle">Оплата</div>

	<?php echo CHtml::beginForm(array('billing/invoice/create/')); ?>
	<?php echo CHtml::hiddenField('BillingInvoice[invoice_order_id]', $order['order_id']); ?>
	<?php echo CHtml::hiddenField('BillingInvoice[invoice_amount]', $order['order_price_total'] + $delivery['cost']); ?>
	<?php echo CHtml::hiddenField('BillingInvoice[invoice_currency]', 'RUR'); ?>
	<?php echo CHtml::hiddenField('BillingInvoice[invoice_description]', $order['order_description'] ? $order['order_description'] : "Order #{$order['order_id']}"); ?>
	<?php echo CHtml::hiddenField('BillingInvoice[invoice_payer_id]', Y::userId()); ?>
	
	
	<div class="payment-ways">
		<div class="block-title">Выберите способ<br>оплаты</div>
		<ul>
			<?php echo CHtml::radioButtonList('BillingPayment[payment_system_id]', '', CHtml::listData($ps, 'system_id', 'system_title'), array(
				'template'=>'<li>{input}{label}</li>',
				'separator'=>'',
			)); ?>
		</ul>
	</div>

	<?php echo CHtml::linkButton('<span><span>Оплатить<img src="/images/arrow_r.png"></span></span>', array(
		'class'=>'btn btn-green-medium btn-arrow-right a-right',
	)); ?>
	
	<?php echo CHtml::endForm(); ?>

	<div class="bonus">
		<img src="../static/images/product_bonus_03.png">
		<p>Гарантия безопасности Ваших покупок!<br>
			<a href="">Узнать больше</a></p>
	</div>

</div>

<?php
//echo CHtml::link('Pay', array(
//	'/billing/invoice/create/',
////	'id'=>$order_id,
//	'invoice_order_id' => $order['order_id'],
//	'invoice_amount' => $order['order_price_total'] + $delivery['cost'],
//	'invoice_currency' => 'RUR',
//	'invoice_description' => $order['order_description'] ? $order['order_description'] : "Order #{$order['order_id']}",
//	'invoice_payer_id' => Y::userId(),
////	'invoice_payer_name'
////	'invoice_payer_email'
////	'invoice_payer_gsm'
//));
?>