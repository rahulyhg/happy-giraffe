/* 
 * Библиотека добалвяет события показа/скрытия элементов
 */
(function() {
	// стэк, наполняется элементами при прокрутке скриптами, в случае, когда окно не активно
	// когда окно получает фокус, то события из стека триггерятся, а стек очищается
	var stack = new Array();
	
	function log() {
		if(window.debugScroll) {
			console.log.apply(console, arguments);
		}
	}
	/**
	 * Функция проверки входит ли один прямоугольник в другой.
	 * 
	 * (x1,y1) - координаты левой верхней точки;
	 * (x2,y2) - координаты правой нижней точки.
	 * 
	 * @param {[x1,y1,x2,y2]} rect1 прямоугольник, проверямый на вхождение
	 * @param {[x1,y1,x2,y2]} rect2 прямоугольник, для которого производится проверка
	 * @return bool true - если входит, иначе - false
	 */
	function checkIn(rect1, rect2) {
		return rect2[0] <= rect1[0] && rect2[1] <= rect1[1] && rect2[2] >= rect1[2] && rect2[3] >= rect1[3];
	}
	
	/**
	 * Функция обработчика события прокрутки элемента, и связанных с ним.
	 * 
	 * Данная функция стриггерит события show и hide для элементов, попавших, и не попавших в область видимости,
	 * или отправит их в стек.
	 * 
	 * @param {jQuery} self JQuery объект, соответствующий DOM-элементу, на котором сработало событие
	 * @returns {undefined}
	 */
	function eventCallback(self) {
		// Расчитываем видимую область
		/** @todo если в self попадёт window, то нужно применить другие методы */
		if(self.length > 0) {
			log('Проверка вхождений в элемент', self);
			var offset = self.offset();
			offset.bottom = offset.top + self.innerHeight();
			offset.right = offset.left + self.innerWidth();
			// Бежим по элементам
			// Ограничим уровень вложенности, что бы не обсчитывались лишние элементы
			self.find('>*:visible, >*>*:visible').each(function() {
				var element = $(this);
				log('------------------------------------------------------');
				log('Проверка элемента', $(this));
				var elementOffset = element.offset();
				elementOffset.bottom = elementOffset.top + element.outerHeight();
				elementOffset.right = elementOffset.left + element.outerWidth();
				// Условие попадания хотя бы части элемента в область видимости
				if(
					// Входит хоть один угол
					checkIn([elementOffset.left,elementOffset.top,elementOffset.left,elementOffset.top], [offset.left,offset.top,offset.right,offset.bottom]) ||
					checkIn([elementOffset.right,elementOffset.top,elementOffset.right,elementOffset.top], [offset.left,offset.top,offset.right,offset.bottom]) ||
					checkIn([elementOffset.right,elementOffset.bottom,elementOffset.right,elementOffset.bottom], [offset.left,offset.top,offset.right,offset.bottom]) ||
					checkIn([elementOffset.left,elementOffset.bottom,elementOffset.left,elementOffset.bottom], [offset.left,offset.top,offset.right,offset.bottom]) ||
					// Пересекается хоть одна сторона
					checkIn([offset.left,offset.top,offset.left,offset.top], [elementOffset.left,elementOffset.top,elementOffset.right,elementOffset.bottom]) ||
					checkIn([offset.right,offset.top,offset.right,offset.top], [elementOffset.left,elementOffset.top,elementOffset.right,elementOffset.bottom]) ||
					checkIn([offset.right,offset.bottom,offset.right,offset.bottom], [elementOffset.left,elementOffset.top,elementOffset.right,elementOffset.bottom]) ||
					checkIn([offset.left,offset.bottom,offset.left,offset.bottom], [elementOffset.left,elementOffset.top,elementOffset.right,elementOffset.bottom])
				) {
					var mid = [(elementOffset.left + elementOffset.right)/2, (elementOffset.top + elementOffset.bottom)/2];
					// Условие полного попадания
					//if(checkIn([elementOffset.left,elementOffset.top,elementOffset.right,elementOffset.bottom], [offset.left,offset.top,offset.right,offset.bottom])) {
					// Условие попадания центра
					if(checkIn([mid[0],mid[1],mid[0],mid[1]], [offset.left,offset.top,offset.right,offset.bottom])) {
						log('Полное попадание');
						if(windowActive) {
							$(this).trigger('show');
						} else {
							if($.inArray(this,stack)) {
								stack.push(this);
							}
						}
					} else {
						log('Частичное попадание');
					}
				} else {
					log('За областью видимости');
					// Для остальных элементов триггерим событие скрытия
					if(windowActive) {
						$(this).trigger('hide');
					}
					// и убираем их из стека, если они там есть
					var index = $.inArray(this,stack);
					if(index !== -1) {
						stack.splice(index, 1);
					}
				}
				log('------------------------------------------------------');
			});
		}
	}
	
	// Реализуем задержку для событий,
	// т.к. события scroll и resize срабатывает
	// слишком часто.
	var timer = false;
	var delay = 500;
	/**
	 * @todo Если прокрутить два разных элемента с промежутком времени меньшим, чем delay,
	 * то событие отработает только на первом, т.е. события прокрутки и ресайза могут работать
	 * только в один поток для одного элемента, но т.к. задержка слишком мала, то это не критично.
	 */
	// Активность окна
	var windowActive = false;
	log('Окно не активно');
	$(window).blur(function() {
		log('Окно не активно');
		windowActive = false;
	}).focus(function() {
		log('Окно активно');
		windowActive = true;
		while(stack.length > 0) {
			var e = $(stack.shift()).trigger('show');
			log('Событие из стека: показ элемента', e);
		}
	});
	$(window).scroll(function(e) {
		var self = $(e.target);
		self.scrollEventPos = self.scrollEventPos ? [0,0] : self.scrollEventPos;
		if(!timer) {
			// тут задержка.
			timer = setTimeout(function() {
				eventCallback(self);
				self.scrollEventPos = [self.scrollLeft(), self.scrollTop()];
				clearTimeout(timer);
				timer = false;
			}, delay);
		}
	});
	// Временная мера: вешаем обработчик только на элементы с классом scroll_scroller,
	// т.к. пока только они являются прокручиваемыми.
	//$(document).load(function() {
		// обновление элементов нокаутом
		$(document).on('koUpdate', '.scroll_scroller', function(event) {
			var self = $(this);
			if(self.hasClass('scroll_scroller')) {
				$(this).trigger('scroll');
			}
		});
		// изменение размеров в результате ресайза
		$(window).on('resize', function(event) {
			var self = $('.scroll_scroller', event.target);
			if(!timer) {
				// тут задержка.
				timer = setTimeout(function() {
    				$(this).trigger('scroll');
					clearTimeout(timer);
					timer = false;
				}, delay);
			}
		});
	//});
})();
