ko.bindingHandlers.tooltip = {
    init: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
        $(element).data('powertip', valueAccessor());
    },
    update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
        $(element).data('powertip', valueAccessor());
        $(element).powerTip({
            placement: 'n',
            smartPlacement: true,
            popupId: 'tooltipsy-im',
            offset: 8
        });
    }
};

function FavouriteWidget(data) {
    var self = this;

    self.entity = data.entity;
    self.entity_id = data.entityId;
    self.count = ko.observable(data.count);
    self.active = ko.observable(data.active);
    self.adding = ko.observable(null);

    self.clickHandler = function() {
        if (! self.active()) {
            $.get('/favourites/default/getEntityData/', { entity : self.entity, entity_id : self.entity_id}, function(response) {
                self.adding(new Entity(response, self));
            }, 'json');
        } else {
            self.remove();
        }
    }

    self.add = function() {
        var data = {
            'Favourite[entity]' : self.entity,
            'Favourite[entity_id]' : self.entity_id,
            'Favourite[note]' : self.adding().note(),
            'Favourite[tags]' : self.adding().tags()
        }
        $.post('/favourites/favourites/create/', data, function(response) {
            if (response.success) {
                self.adding(null);
                self.active(true);
            }
        }, 'json');
    }

    self.remove = function() {
        var data = {
            entity : self.entity,
            entity_id : self.entity_id
        }
        $.post('/favourites/favourites/delete/', data, function(response) {
            if (response.success)
                self.active(false);
        }, 'json');
    }

    self.cancel = function() {
        self.adding(null);
    }

    self.active.subscribe(function(val) {
        val ? self.count(self.count() + 1) : self.count(self.count() - 1);
    });
}

function Entity(data, parent) {
    var self = this;

    self.image = data.image;
    self.title = data.title;
    self.tags = ko.observableArray(data.tags);
    self.note = ko.observable('');
    self.tagsFormVisible = ko.observable(self.tags().length == 0);
    self.tagsInputValue = ko.observable('');

    self.removeTag = function(tag) {
        self.tags.remove(tag);
    }

    self.showTagsForm = function() {
        self.tagsFormVisible(true);
    }

    self.tagHandler = function(data, event) {
        if (event.keyCode == 13 || event.keyCode == 44) {
            self.tags.push(self.tagsInputValue());
            self.tagsInputValue('');
        } else
            return true;
    }
}