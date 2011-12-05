﻿/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the Georgian
 *		language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['ka'] =
{
	/**
	 * The language reading direction. Possible values are "rtl" for
	 * Right-To-Left languages (like Arabic) and "ltr" for Left-To-Right
	 * languages (like English).
	 * @default 'ltr'
	 */
	dir : 'ltr',

	/*
	 * Screenreader titles. Please note that screenreaders are not always capable
	 * of reading non-English words. So be careful while translating it.
	 */
	editorTitle : 'ტექსტის რედაქტორი, %1, დააჭირეთ ALT 0-ს დახმარების მისაღებად.',

	// ARIA descriptions.
	toolbars	: 'Editor toolbars', // MISSING
	editor		: 'ტექსტის რედაქტორი',

	// Toolbar buttons without dialogs.
	source			: 'კოდები',
	newPage			: 'ახალი გვერდი',
	save			: 'ჩაწერა',
	preview			: 'გადახედვა',
	cut				: 'ამოჭრა',
	copy			: 'ასლი',
	paste			: 'ჩასმა',
	print			: 'ბეჭდვა',
	underline		: 'გახაზული',
	bold			: 'მსხვილი',
	italic			: 'დახრილი',
	selectAll		: 'ყველაფრის მონიშნვა',
	removeFormat	: 'ფორმატირების მოხსნა',
	strike			: 'გადახაზული',
	subscript		: 'ინდექსი',
	superscript		: 'ხარისხი',
	horizontalrule	: 'ჰორიზონტალური ხაზის ჩასმა',
	pagebreak		: 'გვერდის წყვეტა ბეჭდვისთვის',
	pagebreakAlt		: 'გვერდის წყვეტა',
	unlink			: 'ბმულის მოხსნა',
	undo			: 'გაუქმება',
	redo			: 'გამეორება',

	// Common messages and labels.
	common :
	{
		browseServer	: 'სერვერზე დათვალიერება',
		url				: 'URL',
		protocol		: 'პროტოკოლი',
		upload			: 'ატვირთვა',
		uploadSubmit	: 'სერვერზე გაგზავნა',
		image			: 'სურათი',
		flash			: 'Flash',
		form			: 'ფორმა',
		checkbox		: 'მონიშვნის ღილაკი',
		radio			: 'ამორჩევის ღილაკი',
		textField		: 'ტექსტური ველი',
		textarea		: 'ტექსტური არე',
		hiddenField		: 'მალული ველი',
		button			: 'ღილაკი',
		select			: 'არჩევის ველი',
		imageButton		: 'სურათიანი ღილაკი',
		notSet			: '<არაფერი>',
		id				: 'Id',
		name			: 'სახელი',
		langDir			: 'ენის მიმართულება',
		langDirLtr		: 'მარცხნიდან მარჯვნივ (LTR)',
		langDirRtl		: 'მარჯვნიდან მარცხნივ (RTL)',
		langCode		: 'ენის კოდი',
		longDescr		: 'დიდი აღწერის URL',
		cssClass		: 'CSS კლასი',
		advisoryTitle	: 'სათაური',
		cssStyle		: 'CSS სტილი',
		ok				: 'დიახ',
		cancel			: 'გაუქმება',
		close			: 'დახურვა',
		preview			: 'გადახედვა',
		generalTab		: 'ინფორმაცია',
		advancedTab		: 'გაფართოებული',
		validateNumberFailed : 'ეს მნიშვნელობა არაა რიცხვი.',
		confirmNewPage	: 'ამ დოკუმენტში ყველა ჩაუწერელი ცვლილება დაიკარგება. დარწმუნებული ხართ რომ ახალი გვერდის ჩატვირთვა გინდათ?',
		confirmCancel	: 'ზოგიერთი პარამეტრი შეცვლილია, დარწმუნებულილ ხართ რომ ფანჯრის დახურვა გსურთ?',
		options			: 'პარამეტრები',
		target			: 'გახსნის ადგილი',
		targetNew		: 'ახალი ფანჯარა (_blank)',
		targetTop		: 'ზედა ფანჯარა (_top)',
		targetSelf		: 'იგივე ფანჯარა (_self)',
		targetParent	: 'მშობელი ფანჯარა (_parent)',
		langDirLTR		: 'მარცხნიდან მარჯვნივ (LTR)',
		langDirRTL		: 'მარჯვნიდან მარცხნივ (RTL)',
		styles			: 'სტილი',
		cssClasses		: 'CSS კლასი',
		width			: 'სიგანე',
		height			: 'სიმაღლე',
		align			: 'სწორება',
		alignLeft		: 'მარცხენა',
		alignRight		: 'მარჯვენა',
		alignCenter		: 'შუა',
		alignTop		: 'ზემოთა',
		alignMiddle		: 'შუა',
		alignBottom		: 'ქვემოთა',
		invalidHeight	: 'სიმაღლე რიცხვით უნდა იყოს წარმოდგენილი.',
		invalidWidth	: 'სიგანე რიცხვით უნდა იყოს წარმოდგენილი.',
		invalidCssLength	: 'Value specified for the "%1" field must be a positive number with or without a valid CSS measurement unit (px, %, in, cm, mm, em, ex, pt, or pc).', // MISSING
		invalidHtmlLength	: 'Value specified for the "%1" field must be a positive number with or without a valid HTML measurement unit (px or %).', // MISSING
		invalidInlineStyle	: 'Value specified for the inline style must consist of one or more tuples with the format of "name : value", separated by semi-colons.', // MISSING
		cssLengthTooltip	: 'Enter a number for a value in pixels or a number with a valid CSS unit (px, %, in, cm, mm, em, ex, pt, or pc).', // MISSING

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, მიუწვდომელია</span>'
	},

	contextmenu :
	{
		options : 'კონტექსტური მენიუს პარამეტრები'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'სპეციალური სიმბოლოს ჩასმა',
		title		: 'სპეციალური სიმბოლოს არჩევა',
		options : 'სპეციალური სიმბოლოს პარამეტრები'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'ბმული',
		other 		: '<სხვა>',
		menu		: 'ბმულის რედაქტირება',
		title		: 'ბმული',
		info		: 'ბმულის ინფორმაცია',
		target		: 'გახსნის ადგილი',
		upload		: 'აქაჩვა',
		advanced	: 'დაწვრილებით',
		type		: 'ბმულის ტიპი',
		toUrl		: 'URL',
		toAnchor	: 'ბმული ტექსტში ღუზაზე',
		toEmail		: 'ელფოსტა',
		targetFrame		: '<frame>',
		targetPopup		: '<popup ფანჯარა>',
		targetFrameName	: 'Frame-ის სახელი',
		targetPopupName	: 'Popup ფანჯრის სახელი',
		popupFeatures	: 'Popup ფანჯრის პარამეტრები',
		popupResizable	: 'ცვალებადი ზომით',
		popupStatusBar	: 'სტატუსის ზოლი',
		popupLocationBar: 'ნავიგაციის ზოლი',
		popupToolbar	: 'ხელსაწყოთა ზოლი',
		popupMenuBar	: 'მენიუს ზოლი',
		popupFullScreen	: 'მთელი ეკრანი (IE)',
		popupScrollBars	: 'გადახვევის ზოლები',
		popupDependent	: 'დამოკიდებული (Netscape)',
		popupLeft		: 'მარცხენა პოზიცია',
		popupTop		: 'ზედა პოზიცია',
		id				: 'Id',
		langDir			: 'ენის მიმართულება',
		langDirLTR		: 'მარცხნიდან მარჯვნივ (LTR)',
		langDirRTL		: 'მარჯვნიდან მარცხნივ (RTL)',
		acccessKey		: 'წვდომის ღილაკი',
		name			: 'სახელი',
		langCode			: 'ენის კოდი',
		tabIndex			: 'Tab-ის ინდექსი',
		advisoryTitle		: 'სათაური',
		advisoryContentType	: 'შიგთავსის ტიპი',
		cssClasses		: 'CSS კლასი',
		charset			: 'კოდირება',
		styles			: 'CSS სტილი',
		rel			: 'კავშირი',
		selectAnchor		: 'აირჩიეთ ღუზა',
		anchorName		: 'ღუზის სახელით',
		anchorId			: 'ელემენტის Id-თ',
		emailAddress		: 'ელფოსტის მისამართები',
		emailSubject		: 'წერილის სათაური',
		emailBody		: 'წერილის ტექსტი',
		noAnchors		: '(ამ დოკუმენტში ღუზა არაა)',
		noUrl			: 'აკრიფეთ ბმულის URL',
		noEmail			: 'აკრიფეთ ელფოსტის მისამართი'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'ღუზა',
		menu		: 'ღუზის რედაქტირება',
		title		: 'ღუზის პარამეტრები',
		name		: 'ღუზუს სახელი',
		errorName	: 'აკრიფეთ ღუზის სახელი',
		remove		: 'Remove Anchor' // MISSING
	},

	// List style dialog
	list:
	{
		numberedTitle		: 'გადანომრილი სიის პარამეტრები',
		bulletedTitle		: 'ღილებიანი სიის პარამეტრები',
		type				: 'ტიპი',
		start				: 'საწყისი',
		validateStartNumber				:'სიის საწყისი მთელი რიცხვი უნდა იყოს.',
		circle				: 'წრეწირი',
		disc				: 'წრე',
		square				: 'კვადრატი',
		none				: 'არაფერი',
		notset				: '<არაფერი>',
		armenian			: 'სომხური გადანომრვა',
		georgian			: 'ქართული გადანომრვა (ან, ბან, გან, ..)',
		lowerRoman			: 'რომაული გადანომრვცა პატარა ციფრებით (i, ii, iii, iv, v, ..)',
		upperRoman			: 'რომაული გადანომრვა დიდი ციფრებით (I, II, III, IV, V, etc.)',
		lowerAlpha			: 'პატარა ლათინური ასოებით (a, b, c, d, e, ..)',
		upperAlpha			: 'დიდი ლათინური ასოებით (A, B, C, D, E, ..)',
		lowerGreek			: 'პატარა ბერძნული ასოებით (ალფა, ბეტა, გამა, ..)',
		decimal				: 'რიცხვებით (1, 2, 3, ..)',
		decimalLeadingZero	: 'ნულით დაწყებული რიცხვებით (01, 02, 03, ..)'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'ძებნა და შეცვლა',
		find				: 'ძებნა',
		replace				: 'შეცვლა',
		findWhat			: 'საძიებელი ტექსტი:',
		replaceWith			: 'შეცვლის ტექსტი:',
		notFoundMsg			: 'მითითებული ტექსტი არ მოიძებნა.',
		findOptions			: 'Find Options', // MISSING
		matchCase			: 'დიდი და პატარა ასოების დამთხვევა',
		matchWord			: 'მთელი სიტყვის დამთხვევა',
		matchCyclic			: 'დოკუმენტის ბოლოში გასვლის მერე თავიდან დაწყება',
		replaceAll			: 'ყველას შეცვლა',
		replaceSuccessMsg	: '%1 მოძებნილი შეიცვალა.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'ცხრილი',
		title		: 'ცხრილის პარამეტრები',
		menu		: 'ცხრილის პარამეტრები',
		deleteTable	: 'ცხრილის წაშლა',
		rows		: 'სტრიქონი',
		columns		: 'სვეტი',
		border		: 'ჩარჩოს ზომა',
		widthPx		: 'წერტილი',
		widthPc		: 'პროცენტი',
		widthUnit	: 'საზომი ერთეული',
		cellSpace	: 'უჯრის სივრცე (spacing)',
		cellPad		: 'უჯრის კიდე (padding)',
		caption		: 'სათაური',
		summary		: 'შეჯამება',
		headers		: 'სათაურები',
		headersNone		: 'არაფერი',
		headersColumn	: 'პირველი სვეტი',
		headersRow		: 'პირველი სტრიქონი',
		headersBoth		: 'ორივე',
		invalidRows		: 'სტრიქონების რაოდენობა დადებითი რიცხვი უნდა იყოს.',
		invalidCols		: 'სვეტების რაოდენობა დადებითი რიცხვი უნდა იყოს.',
		invalidBorder	: 'ჩარჩოს ზომა რიცხვით უდნა იყოს წარმოდგენილი.',
		invalidWidth	: 'ცხრილის სიგანე რიცხვით უნდა იყოს წარმოდგენილი.',
		invalidHeight	: 'ცხრილის სიმაღლე რიცხვით უნდა იყოს წარმოდგენილი.',
		invalidCellSpacing	: 'უჯრის სივრცე (spacing) რიცხვით უნდა იყოს წარმოდგენილი.',
		invalidCellPadding	: 'უჯრის კიდე (padding) რიცხვით უნდა იყოს წარმოდგენილი.',

		cell :
		{
			menu			: 'უჯრა',
			insertBefore	: 'უჯრის ჩასმა მანამდე',
			insertAfter		: 'უჯრის ჩასმა მერე',
			deleteCell		: 'უჯრების წაშლა',
			merge			: 'უჯრების შეერთება',
			mergeRight		: 'შეერთება მარჯვენასთან',
			mergeDown		: 'შეერთება ქვემოთასთან',
			splitHorizontal	: 'გაყოფა ჰორიზონტალურად',
			splitVertical	: 'გაყოფა ვერტიკალურად',
			title			: 'უჯრის პარამეტრები',
			cellType		: 'უჯრის ტიპი',
			rowSpan			: 'სტრიქონების ოდენობა',
			colSpan			: 'სვეტების ოდენობა',
			wordWrap		: 'სტრიქონის გადატანა (Word Wrap)',
			hAlign			: 'ჰორიზონტალური სწორება',
			vAlign			: 'ვერტიკალური სწორება',
			alignBaseline	: 'ძირითადი ხაზის გასწვრივ',
			bgColor			: 'ფონის ფერი',
			borderColor		: 'ჩარჩოს ფერი',
			data			: 'მონაცემები',
			header			: 'სათაური',
			yes				: 'დიახ',
			no				: 'არა',
			invalidWidth	: 'უჯრის სიგანე რიცხვით უნდა იყოს წარმოდგენილი.',
			invalidHeight	: 'უჯრის სიმაღლე რიცხვით უნდა იყოს წარმოდგენილი.',
			invalidRowSpan	: 'სტრიქონების რაოდენობა მთელი რიცხვი უნდა იყოს.',
			invalidColSpan	: 'სვეტების რაოდენობა მთელი რიცხვი უნდა იყოს.',
			chooseColor		: 'არჩევა'
		},

		row :
		{
			menu			: 'სტრიქონი',
			insertBefore	: 'სტრიქონის ჩამატება წინ',
			insertAfter		: 'სტრიქონის ჩამატება მერე',
			deleteRow		: 'სტრიქონების წაშლა'
		},

		column :
		{
			menu			: 'სვეტი',
			insertBefore	: 'სვეტის ჩამატება წინ',
			insertAfter		: 'სვეტის ჩამატება მერე',
			deleteColumn	: 'სვეტების წაშლა'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'ღილაკის პარამეტრები',
		text		: 'ტექსტი',
		type		: 'ტიპი',
		typeBtn		: 'ღილაკი',
		typeSbm		: 'გაგზავნა',
		typeRst		: 'გასუფთავება'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'მონიშვნის ღილაკის (Checkbox) პარამეტრები',
		radioTitle	: 'ასარჩევი ღილაკის (Radio) პარამეტრები',
		value		: 'ტექსტი',
		selected	: 'არჩეული'
	},

	// Form Dialog.
	form :
	{
		title		: 'ფორმის პარამეტრები',
		menu		: 'ფორმის პარამეტრები',
		action		: 'ქმედება',
		method		: 'მეთოდი',
		encoding	: 'კოდირება'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'არჩევის ველის პარამეტრები',
		selectInfo	: 'ინფორმაცია',
		opAvail		: 'შესაძლებელი ვარიანტები',
		value		: 'მნიშვნელობა',
		size		: 'ზომა',
		lines		: 'ხაზები',
		chkMulti	: 'მრავლობითი არჩევანის საშუალება',
		opText		: 'ტექსტი',
		opValue		: 'მნიშვნელობა',
		btnAdd		: 'დამატება',
		btnModify	: 'შეცვლა',
		btnUp		: 'ზემოთ',
		btnDown		: 'ქვემოთ',
		btnSetValue : 'ამორჩეულ მნიშვნელოვნად დაყენება',
		btnDelete	: 'წაშლა'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'ტექსტური არის პარამეტრები',
		cols		: 'სვეტები',
		rows		: 'სტრიქონები'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'ტექსტური ველის პარამეტრები',
		name		: 'სახელი',
		value		: 'მნიშვნელობა',
		charWidth	: 'სიმბოლოს ზომა',
		maxChars	: 'ასოების მაქსიმალური ოდენობა',
		type		: 'ტიპი',
		typeText	: 'ტექსტი',
		typePass	: 'პაროლი'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'მალული ველის პარამეტრები',
		name	: 'სახელი',
		value	: 'მნიშვნელობა'
	},

	// Image Dialog.
	image :
	{
		title		: 'სურათის პარამეტრები',
		titleButton	: 'სურათიანი ღილაკის პარამეტრები',
		menu		: 'სურათის პარამეტრები',
		infoTab		: 'სურათის ინფორმცია',
		btnUpload	: 'სერვერისთვის გაგზავნა',
		upload		: 'ატვირთვა',
		alt			: 'სანაცვლო ტექსტი',
		lockRatio	: 'პროპორციის შენარჩუნება',
		resetSize	: 'ზომის დაბრუნება',
		border		: 'ჩარჩო',
		hSpace		: 'ჰორიზონტალური სივრცე',
		vSpace		: 'ვერტიკალური სივრცე',
		alertUrl	: 'აკრიფეთ სურათის URL',
		linkTab		: 'ბმული',
		button2Img	: 'გსურთ არჩეული სურათიანი ღილაკის გადაქცევა ჩვეულებრივ ღილაკად?',
		img2Button	: 'გსურთ არჩეული ჩვეულებრივი ღილაკის გადაქცევა სურათიან ღილაკად?',
		urlMissing	: 'სურათის URL არაა შევსებული.',
		validateBorder	: 'ჩარჩო მთელი რიცხვი უნდა იყოს.',
		validateHSpace	: 'ჰორიზონტალური სივრცე მთელი რიცხვი უნდა იყოს.',
		validateVSpace	: 'ვერტიკალური სივრცე მთელი რიცხვი უნდა იყოს.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Flash-ის პარამეტრები',
		propertiesTab	: 'პარამეტრები',
		title			: 'Flash-ის პარამეტრები',
		chkPlay			: 'ავტო გაშვება',
		chkLoop			: 'ჩაციკლვა',
		chkMenu			: 'Flash-ის მენიუს დაშვება',
		chkFull			: 'მთელი ეკრანის დაშვება',
 		scale			: 'მასშტაბირება',
		scaleAll		: 'ყველაფრის ჩვენება',
		scaleNoBorder	: 'ჩარჩოს გარეშე',
		scaleFit		: 'ზუსტი ჩასმა',
		access			: 'სკრიპტის წვდომა',
		accessAlways	: 'ყოველთვის',
		accessSameDomain: 'იგივე დომენი',
		accessNever		: 'არასდროს',
		alignAbsBottom	: 'ჩარჩოს ქვემოთა ნაწილის სწორება ტექსტისთვის',
		alignAbsMiddle	: 'ჩარჩოს შუა ნაწილის სწორება ტექსტისთვის',
		alignBaseline	: 'საბაზისო ხაზის სწორება',
		alignTextTop	: 'ტექსტი ზემოდან',
		quality			: 'ხარისხი',
		qualityBest		: 'საუკეთესო',
		qualityHigh		: 'მაღალი',
		qualityAutoHigh	: 'მაღალი (ავტომატური)',
		qualityMedium	: 'საშუალო',
		qualityAutoLow	: 'ძალიან დაბალი',
		qualityLow		: 'დაბალი',
		windowModeWindow: 'ფანჯარა',
		windowModeOpaque: 'გაუმჭვირვალე',
		windowModeTransparent : 'გამჭვირვალე',
		windowMode		: 'ფანჯრის რეჟიმი',
		flashvars		: 'ცვლადები Flash-ისთვის',
		bgcolor			: 'ფონის ფერი',
		hSpace			: 'ჰორიზ. სივრცე',
		vSpace			: 'ვერტ. სივრცე',
		validateSrc		: 'URL არ უნდა იყოს ცარიელი.',
		validateHSpace	: 'ჰორიზონტალური სივრცე არ უნდა იყოს ცარიელი.',
		validateVSpace	: 'ვერტიკალური სივრცე არ უნდა იყოს ცარიელი.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'მართლწერა',
		title			: 'მართლწერა',
		notAvailable	: 'უკაცრავად, ეს სერვისი ამჟამად მიუწვდომელია.',
		errorLoading	: 'სერვისის გამოძახების შეცდომა: %s.',
		notInDic		: 'არაა ლექსიკონში',
		changeTo		: 'შეცვლელი',
		btnIgnore		: 'უგულებელყოფა',
		btnIgnoreAll	: 'ყველას უგულებელყოფა',
		btnReplace		: 'შეცვლა',
		btnReplaceAll	: 'ყველას შეცვლა',
		btnUndo			: 'გაუქმება',
		noSuggestions	: '- არაა შემოთავაზება -',
		progress		: 'მიმდინარეობს მართლწერის შემოწმება...',
		noMispell		: 'მართლწერის შემოწმება: შეცდომა არ მოიძებნა',
		noChanges		: 'მართლწერის შემოწმება: არაფერი შეცვლილა',
		oneChange		: 'მართლწერის შემოწმება: ერთი სიტყვა შეიცვალა',
		manyChanges		: 'მართლწერის შემოწმება: %1 სიტყვა შეიცვალა',
		ieSpellDownload	: 'მართლწერის შემოწმება არაა დაინსტალირებული. ჩამოვქაჩოთ ინტერნეტიდან?'
	},

	smiley :
	{
		toolbar	: 'სიცილაკები',
		title	: 'სიცილაკის ჩასმა',
		options : 'სიცილაკის პარამეტრები'
	},

	elementsPath :
	{
		eleLabel : 'ელემეტის გზა',
		eleTitle : '%1 ელემენტი'
	},

	numberedlist	: 'გადანომრილი სია',
	bulletedlist	: 'ღილიანი სია',
	indent			: 'მეტად შეწევა',
	outdent			: 'ნაკლებად შეწევა',

	justify :
	{
		left	: 'მარცხნივ სწორება',
		center	: 'შუაში სწორება',
		right	: 'მარჯვნივ სწორება',
		block	: 'გადასწორება'
	},

	blockquote : 'ციტატა',

	clipboard :
	{
		title		: 'ჩასმა',
		cutError	: 'თქვენი ბროუზერის უსაფრთხოების პარამეტრები არ იძლევა ამოჭრის ოპერაციის ავტომატურად განხორციელების საშუალებას. გამოიყენეთ კლავიატურა ამისთვის (Ctrl/Cmd+X).',
		copyError	: 'თქვენი ბროუზერის უსაფრთხოების პარამეტრები არ იძლევა ასლის ოპერაციის ავტომატურად განხორციელების საშუალებას. გამოიყენეთ კლავიატურა ამისთვის (Ctrl/Cmd+C).',
		pasteMsg	: 'ჩასვით ამ არის შიგნით კლავიატურის გამოყენებით (<strong>Ctrl/Cmd+V</strong>) და დააჭირეთ OK-ს',
		securityMsg	: 'თქვენი ბროუზერის უსაფრთხოების პარამეტრები არ იძლევა clipboard-ის მონაცემების წვდომის უფლებას. კიდევ უნდა ჩასვათ ტექსტი ამ ფანჯარაში.',
		pasteArea	: 'ჩასმის არე'
	},

	pastefromword :
	{
		confirmCleanup	: 'ჩასასმელი ტექსტი ვორდიდან გადმოტანილს გავს - გინდათ მისი წინასწარ გაწმენდა?',
		toolbar			: 'ვორდიდან ჩასმა',
		title			: 'ვორდიდან ჩასმა',
		error			: 'შიდა შეცდომის გამო ვერ მოხერხდა ტექსტის გაწმენდა'
	},

	pasteText :
	{
		button	: 'მხოლოდ ტექსტის ჩასმა',
		title	: 'მხოლოდ ტექსტის ჩასმა'
	},

	templates :
	{
		button			: 'თარგები',
		title			: 'თარგები',
		options : 'თარგების პარამეტრები',
		insertOption	: 'მიმდინარე შეგთავსის შეცვლა',
		selectPromptMsg	: 'აირჩიეთ თარგი რედაქტორისთვის',
		emptyListMsg	: '(თარგი არაა განსაზღვრული)'
	},

	showBlocks : 'არეების ჩვენება',

	stylesCombo :
	{
		label		: 'სტილები',
		panelTitle	: 'ფორმატირების სტილები',
		panelTitle1	: 'არის სტილები',
		panelTitle2	: 'თანდართული სტილები',
		panelTitle3	: 'ობიექტის სტილები'
	},

	format :
	{
		label		: 'ფიორმატირება',
		panelTitle	: 'ფორმატირება',

		tag_p		: 'ჩვეულებრივი',
		tag_pre		: 'ფორმატირებული',
		tag_address	: 'მისამართი',
		tag_h1		: 'სათაური 1',
		tag_h2		: 'სათაური 2',
		tag_h3		: 'სათაური 3',
		tag_h4		: 'სათაური 4',
		tag_h5		: 'სათაური 5',
		tag_h6		: 'სათაური 6',
		tag_div		: 'ჩვეულებრივი (DIV)'
	},

	div :
	{
		title				: 'Div კონტეინერის შექმნა',
		toolbar				: 'Div კონტეინერის შექმნა',
		cssClassInputLabel	: 'CSS კლასები',
		styleSelectLabel	: 'სტილი',
		IdInputLabel		: 'Id',
		languageCodeInputLabel	: 'ენის კოდი',
		inlineStyleInputLabel	: 'თანდართული სტილი',
		advisoryTitleInputLabel	: 'სათაური',
		langDirLabel		: 'ენის მინართულება',
		langDirLTRLabel		: 'მარცხნიდან მარჯვნიც (LTR)',
		langDirRTLLabel		: 'მარჯვნიდან მარცხნივ (RTL)',
		edit				: 'Div-ის რედაქტირება',
		remove				: 'Div-ის წაშლა'
  	},

	iframe :
	{
		title		: 'IFrame-ის პარამეტრები',
		toolbar		: 'IFrame',
		noUrl		: 'აკრიფეთ iframe-ის URL',
		scrolling	: 'გადახვევის ზოლების დაშვება',
		border		: 'ჩარჩოს გამოჩენა'
	},

	font :
	{
		label		: 'ფონტი',
		voiceLabel	: 'ფონტი',
		panelTitle	: 'ფონტის სახელი'
	},

	fontSize :
	{
		label		: 'ზომა',
		voiceLabel	: 'ტექსტის ზომა',
		panelTitle	: 'ტექსტის ზომა'
	},

	colorButton :
	{
		textColorTitle	: 'ტექსტის ფერი',
		bgColorTitle	: 'ფონის ფერი',
		panelTitle		: 'ფერები',
		auto			: 'ავტომატური',
		more			: 'მეტი ფერი...'
	},

	colors :
	{
		'000' : 'შავი',
		'800000' : 'მუქი შინდისფერი',
		'8B4513' : 'ყავისფერი',
		'2F4F4F' : 'მოლურჯო ნაცრისფერი',
		'008080' : 'ჩამქრალი ლურჯი',
		'000080' : 'მუქი ლურჯი',
		'4B0082' : 'იასამნისფერი',
		'696969' : 'მუქი ნაცრისფერი',
		'B22222' : 'აგურისფერი',
		'A52A2A' : 'მუქი ყავისფერი',
		'DAA520' : 'მოყვითალო',
		'006400' : 'მუქი მწვანე',
		'40E0D0' : 'ცისფერი',
		'0000CD' : 'ზომიერად ლურჯი',
		'800080' : 'იისფერი',
		'808080' : 'ნაცრისფერი',
		'F00' : 'წითელი',
		'FF8C00' : 'მუქი სტაფილოსფერი',
		'FFD700' : 'ოქროსფერი',
		'008000' : 'მწვანე',
		'0FF' : 'ღია ცისფერი',
		'00F' : 'ლურჯი',
		'EE82EE' : 'იისფერი',
		'A9A9A9' : 'ბაცი ნაცრისფერი',
		'FFA07A' : 'ჩამქრალი ვარდისფერი',
		'FFA500' : 'სტაფილოსფერი',
		'FFFF00' : 'ყვითელი',
		'00FF00' : 'ლურჯი',
		'AFEEEE' : 'ცისფერი',
		'ADD8E6' : 'ღია ლურჯი',
		'DDA0DD' : 'ღია იისფერი',
		'D3D3D3' : 'ღია ნაცრისფერი',
		'FFF0F5' : 'ღია ვარდისფერი',
		'FAEBD7' : 'ღია ყავისფერი',
		'FFFFE0' : 'ნათელი ყვითელი',
		'F0FFF0' : 'ღია მწვანე',
		'F0FFFF' : 'ღია ცისფერი 2',
		'F0F8FF' : 'ღია ცისფერი 3',
		'E6E6FA' : 'ღია იისფერი 2',
		'FFF' : 'თეთრი'
	},

	scayt :
	{
		title			: 'მართლწერის შემოწმება კრეფისას',
		opera_title		: 'არაა მხარდაჭერილი Opera-ს მიერ',
		enable			: 'SCAYT-ის ჩართვა',
		disable			: 'SCAYT-ის გამორთვა',
		about			: 'SCAYT-ის შესახებ',
		toggle			: 'SCAYT-ის გადართვა',
		options			: 'პარამეტრები',
		langs			: 'ენები',
		moreSuggestions	: 'მეტი შემოთავაზება',
		ignore			: 'უგულებელყოფა',
		ignoreAll		: 'ყველას უგულებელყოფა',
		addWord			: 'სიტყვის დამატება',
		emptyDic		: 'ლექსიკონის სიტყვა არ უნდა იყოს ცარიელი.',

		optionsTab		: 'პარამეტრები',
		allCaps			: 'დიდი ასოებით დაწერილი სიტყვების უგულებელყოფა',
		ignoreDomainNames : 'დომენური სახელების უგულებელყოფა',
		mixedCase		: 'შერეული ასოებანი სიტყვების უგულებელყოფა',
		mixedWithDigits	: 'ციფრებიანი სიტყვების უგულებელყოფა',

		languagesTab	: 'ენები',

		dictionariesTab	: 'ლექსიკონები',
		dic_field_name	: 'ლექსიკონის სახელი',
		dic_create		: 'შექმნა',
		dic_restore		: 'დაბრუნება',
		dic_delete		: 'წაშლა',
		dic_rename		: 'გადარქმევა',
		dic_info		: 'თავდაპირველად მომხმარებლის ლექსიკონი ინახება Cookie-ში. თუმცა Cookie შეზღუდულია ზომაში. როცა ლექსიკონის ზომა გაიზრდება საკმაოდ ის შეიძლება შევინახოთ ჩვენს სერვერზე. ჩვენს სერვერზე ლექსიკონს შესანახად უნდა მიუთითოთ მისი სახელი. თუ უკე გაქვთ ლექსიკონი, აკრიფეთ მისი სახელი და დააჭირეთ "დაბრუნების" ღილაკს.',

		aboutTab		: 'ინფორმაცია'
	},

	about :
	{
		title		: 'CKEditor-ის შესახებ',
		dlgTitle	: 'CKEditor-ის შესახებ',
		help	: 'დახმარებისთვის იხილეთ $1.',
		userGuide : 'CKEditor-ის მომხმარებლის სახელმძღვანელო',
		moreInfo	: 'ლიცენზიის ინფორმაციისთვის ეწვიეთ ჩვენს საიტს:',
		copy		: 'Copyright &copy; $1. ყველა უფლება დაცულია.'
	},

	maximize : 'გადიდება',
	minimize : 'დაპატარავება',

	fakeobjects :
	{
		anchor		: 'ღუზა',
		flash		: 'Flash ანიმაცია',
		iframe		: 'IFrame',
		hiddenfield	: 'მალული ველი',
		unknown		: 'უცნობი ობიექტი'
	},

	resize : 'გაწიე ზომის შესაცვლელად',

	colordialog :
	{
		title		: 'ფერის შეცვლა',
		options	:	'ფერის პარამეტრები',
		highlight	: 'ჩვენება',
		selected	: 'არჩეული ფერი',
		clear		: 'გასუფთავება'
	},

	toolbarCollapse	: 'ხელსაწყოთა ზოლის შეწევა',
	toolbarExpand	: 'ხელსაწყოთა ზოლის გამოწევა',

	toolbarGroups :
	{
		document : 'დოკუმენტი',
		clipboard : 'Clipboard/გაუქმება',
		editing : 'რედაქტირება',
		forms : 'ფორმები',
		basicstyles : 'ძირითადი სტილები',
		paragraph : 'აბზაცი',
		links : 'ბმულები',
		insert : 'ჩასმა',
		styles : 'სტილები',
		colors : 'ფერები',
		tools : 'ხელსაწყოები'
	},

	bidi :
	{
		ltr : 'ტექსტის მიმართულება მარცხნიდან მარჯვნივ',
		rtl : 'ტექსტის მიმართულება მარჯვნიდან მარცხნივ'
	},

	docprops :
	{
		label : 'დოკუმენტის პარამეტრები',
		title : 'დოკუმენტის პარამეტრები',
		design : 'დიზაინი',
		meta : 'მეტაTag-ები',
		chooseColor : 'არჩევა',
		other : 'სხვა...',
		docTitle :	'გვერდის სათაური',
		charset : 	'კოდირება',
		charsetOther : 'სხვა კოდირებები',
		charsetASCII : 'ამერიკული (ASCII)',
		charsetCE : 'ცენტრალურ ევროპული',
		charsetCT : 'ტრადიციული ჩინური (Big5)',
		charsetCR : 'კირილური',
		charsetGR : 'ბერძნული',
		charsetJP : 'იაპონური',
		charsetKR : 'კორეული',
		charsetTR : 'თურქული',
		charsetUN : 'უნიკოდი (UTF-8)',
		charsetWE : 'დასავლეთ ევროპული',
		docType : 'დოკუმენტის ტიპი',
		docTypeOther : 'სხვა ტიპის დოკუმენტი',
		xhtmlDec : 'XHTML დეკლარაციების ჩართვა',
		bgColor : 'ფონის ფერი',
		bgImage : 'ფონური სურათის URL',
		bgFixed : 'უმოძრაო (ფიქსირებული) ფონი',
		txtColor : 'ტექსტის ფერი',
		margin : 'გვერდის კიდეები',
		marginTop : 'ზედა',
		marginLeft : 'მარცხენა',
		marginRight : 'მარჯვენა',
		marginBottom : 'ქვედა',
		metaKeywords : 'დოკუმენტის საკვანძო სიტყვები (მძიმით გამოყოფილი)',
		metaDescription : 'დოკუმენტის აღწერა',
		metaAuthor : 'ავტორი',
		metaCopyright : 'Copyright',
		previewHtml : '<p>ეს არის <strong>საცდელი ტექსტი</strong>. თქვენ <a href="javascript:void(0)">CKEditor</a>-ით სარგებლობთ.</p>'
	}
};
