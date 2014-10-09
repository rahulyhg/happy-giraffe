define(['jquery', 'knockout', 'text!md-redactor/md-redactor.html', 'extensions/epiceditor/marked', 'extensions/epiceditor/epiceditor', "user-config" ,'ko_photoUpload', 'ko_library'], function mdRedactorViewHandler($, ko, template, marked, EpicEditor, userConfig) {
    function MdRedactorView(params) {
        this.editor = {};
        this.idElement = ko.observable(params.id);
        this.textareaId = params.textareaId;
        this.htmlId = params.htmlId;
        this.photo = ko.observable(null);
        this.collectionId = ko.observable();
        this.careThrough = {};

        this.loadPhotoComponent = function (data, event) {
            ko.applyBindings({}, $('photo-uploader-form')[0]);
        };

        /**
         * Начинаем h-тэги с h2
         * @param text
         * @param level
         * @returns {string}
         */
        this.rendererHeadingIncrement = function rendererHeadingIncrement(text, level) {
            level++;
            return '<h' + level + '>' + text + '</h' + level + '>';
        };
        /**
         * Генерируем новый объект Render из marked.js
         * @param markedInstance
         * @returns {marked.Renderer}
         */
        this.newRenderer = function newRenderer(markedInstance) {
            var renderer = new markedInstance.Renderer();
            renderer.heading = this.rendererHeadingIncrement;
            return renderer;
        };
        this.generateSimpleImg = function generateSimpleImg(url, title) {
            return "\n![" + title + "](" + url + " " + title + ")\n";
        };
        this.appendToText = function appendToText(text) {
            var content = this.editor.exportFile('epiceditor');
            this.editor.importFile('epiceditor', content + text);
        };
        this.photo.subscribe(function (img) {
            this.appendToText(this.generateSimpleImg(img.getGeneratedPreset('myPhotosAlbumCover'), img.title()));
        }, this);

        /**
         * Установка опций для парсера
         */
        marked.setOptions({
            renderer: this.newRenderer(marked)
        });


        /**
         * Генератор опций для редактора
         * @param id
         * @param textareaId
         * @param htmlId
         * @returns {{container: *, textarea: *, html: *, basePath: string, clientSideStorage: boolean, localStorageName: *, useNativeFullscreen: boolean, parser: *, file: {name: string, defaultContent: string, autoSave: number}, theme: {base: string, preview: string, editor: string}, button: {preview: boolean, fullscreen: boolean, bar: string}, focusOnLoad: boolean, shortcut: {modifier: number, fullscreen: number, preview: number}, string: {togglePreview: string, toggleEdit: string, toggleFullscreen: string}, autogrow: boolean}}
         */
        this.generateNewOpts = function (id, textareaId, htmlId) {
            var opts = {
                container: id,
                textarea: textareaId,
                html: htmlId,
                basePath: '/new/javascript/modules/extensions/epiceditor/themes/',
                clientSideStorage: true,
                localStorageName: id,
                useNativeFullscreen: true,
                parser: marked,
                file: {
                    name: 'epiceditor',
                    defaultContent: '',
                    autoSave: 100
                },
                theme: {
                    base: 'epiceditor.css',
                    preview: 'github.css',
                    editor: 'epic-light.css'
                },
                button: {
                    preview: true,
                    fullscreen: true,
                    bar: "auto"
                },
                focusOnLoad: false,
                shortcut: {
                    modifier: 18,
                    fullscreen: 70,
                    preview: 80
                },
                string: {
                    togglePreview: 'Включить превью',
                    toggleEdit: 'Включить редактирование',
                    toggleFullscreen: 'Полный экран'
                },
                autogrow: false
            };
            return opts;
        };


        /**
         * Загрузка редактора после рендера шаблона
         */
        this.loadEditor = function loadEditor() {
            var that = this;
            $.post('/api/photo/albums/getByUser/', JSON.stringify({"userId": userConfig.userId})).done(function getUserAlbums(data) {
                if (data.data.albums.length > 0) {
                    that.collectionId(data.data.albums[0]);
                    that.editor = new EpicEditor(that.generateNewOpts(that.idElement(), that.textareaId, that.htmlId)).load();
                } else {
                    $.post('/api/photo/albums/create/', JSON.stringify({"attributes": {"title" : "markup"}})).done(function createUserAlbum(response) {
                        if (response.success) {
                            that.collectionId(response.data.id);
                            that.editor = new EpicEditor(that.generateNewOpts(that.idElement(), that.textareaId, that.htmlId)).load();
                        }
                    });
                }
            });
        };
    }
    return {
        viewModel: MdRedactorView,
        template: template
    };
});