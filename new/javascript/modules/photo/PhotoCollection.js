define('photo/PhotoCollection', ['knockout', 'photo/PhotoAttach'], function(ko, PhotoAttach) {
    // Основная модель коллекции
    function PhotoCollection(data) {
        var self = this;
        self.id = ko.observable(data.id);
        self.attachesCount = ko.observable(data.attachesCount);
        self.attaches = ko.observableArray(ko.utils.arrayMap(data.attaches, function(attach) {
            return new PhotoAttach(attach);
        }));
        self.cover = ko.observable(data.cover === null ? null : new PhotoAttach(data.cover));
    }

    return PhotoCollection;
});