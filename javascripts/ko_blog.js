ko.bindingHandlers.length = {
    update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
        var currentLength = valueAccessor().attribute().length;
        var maxLength = valueAccessor().maxLength;
        $(element).text(currentLength + '/' + maxLength);
    }
};

var BlogViewModel = function(data) {
    var self = this;
    self.title = ko.observable(data.title);
    self.description = ko.observable(data.description);
    self.draftTitleValue = ko.observable(data.title);
    self.draftDescriptionValue = ko.observable(data.description);
    self.draftTitle = ko.observable(data.title);
    self.draftDescription = ko. observable(data.description);
    self.photo = ko.observable(data.photo === null ? null : new Photo(data.photo));
    self.draftPhoto = ko.observable(data.photo === null ? null : new Photo(data.photo));
    self.currentRubricId = data.currentRubricId;
    self.rubrics = ko.observableArray(ko.utils.arrayMap(data.rubrics, function(rubric) {
        return new Rubric(rubric, self);
    }));

    self.descriptionToShow = ko.computed(function() {
        return self.description().replace(/\n/g, '<br />');
    });

    self.draftDescriptionToShow = ko.computed(function() {
        return self.draftDescription().replace(/\n/g, '<br />');
    });

    self.setTitle = function() {
        self.draftTitle(self.draftTitleValue());
    }

    self.setDescription = function() {
        self.draftDescription(self.draftDescriptionValue());
    }

    self.titleHandler = function(data, event) {
        if (event.which == 13)
            self.setTitle()
        else
            return true;
    }

    self.save = function() {
        $.post(data.updateUrl, { blog_title : self.draftTitle(), blog_description : self.draftDescription(), blog_photo_id : self.draftPhoto().id(), blog_photo_position : position }, function(response) {
            self.title(self.draftTitle());
            self.description(self.draftDescription());
            self.photo().thumbSrc(response.thumbSrc);
            $.fancybox.close();
        }, 'json');
    }

    self.addRubric = function() {
        self.rubrics.push(new Rubric({ id : null, title : '', beingEdited : true }, self));
    }
}

var Photo = function(data) {
    var self = this;
    self.id = ko.observable(data.id);
    self.originalSrc = ko.observable(data.originalSrc);
    self.thumbSrc = ko.observable(data.thumbSrc);
    self.width = ko.observable(data.width);
    self.height = ko.observable(data.height);
    self.position = ko.observable(data.position);
}

var Rubric = function(data, parent) {
    var self = this;
    self.id = ko.observable(data.id);
    self.title = ko.observable(data.title);
    self.url = ko.observable(data.url);
    self.editedTitle = ko.observable(data.title);
    self.beingEdited = ko.observable((typeof data.beingEdited === 'undefinded') ? false : data.beingEdited);

    self.titleHandler = function(data, event) {
        if (event.which == 13)
            self.save();
        else
            return true;
    }

    self.edit = function() {
        self.beingEdited(true);
    }

    self.save = function() {
        self.id() === null ? self.create() : self.update();
    }

    self.create = function() {
        $.post('/blog/settings/rubricCreate/', { title : self.editedTitle() }, function(response) {
            if (response.success) {
                self.id(response.id);
                self.title(self.editedTitle());
                self.beingEdited(false);
            }
        }, 'json');
    }

    self.update = function() {
        if (self.title() == self.editedTitle())
            self.beingEdited(false);
        else
            $.post('/blog/settings/rubricEdit/', { id : self.id(), title : self.editedTitle() }, function(response) {
                if (response.success) {
                    self.title(self.editedTitle());
                    self.beingEdited(false);
                }
            }, 'json');
    }

    self.remove = function() {
        $.post('/blog/settings/rubricRemove/', { id : self.id() }, function(response) {
            if (response.success)
                parent.rubrics.remove(self);
        }, 'json');
    }
}

/**
 * Настройки записи в блог
 */
function BlogRecordSettings(data) {
    var self = this;
    ko.mapping.fromJS(data, {}, self);
    self.displayOptions = ko.observable(false);
    self.displayPrivacy = ko.observable(false);
    self.removed = ko.observable(false);

    self.attach = function(){
        $.post('/newblog/attachBlog/', {id: self.id()}, function (response) {
            if (response.status) {
                self.attached(!self.attached());
            }
        }, 'json');
        self.displayOptions(false);
    };
    self.show = function(){
        self.displayOptions(!self.displayOptions());
    };
    self.showPrivacy = function(){
        self.displayPrivacy(!self.displayPrivacy());
    };
    self.privacyClass = ko.computed(function () {
        if (self.privacy() == 0)
            return 'ico-users__all';
        else return 'ico-users__friend';
    });
    self.setPrivacy = function(privacy){
        $.post('/newblog/updatePrivacy/', {id: self.id(), privacy:privacy}, function (response) {
            if (response.status) {
                self.privacy(privacy);
                self.displayPrivacy(false);
            }
        }, 'json');

    };
    self.remove = function() {
        $.post('/newblog/remove/', { id : self.id() }, function(response) {
            if (response.success)
                self.removed(true);
        }, 'json');
    }
    self.restore = function() {
        $.post('/newblog/restore/', { id : self.id() }, function(response) {
            if (response.success)
                self.removed(false);
        }, 'json');
    }
}

ko.bindingHandlers.slideVisible = {
    init: function(element, valueAccessor) {
        var value = valueAccessor();
        $(element).toggle(ko.utils.unwrapObservable(value));
    },
    update: function(element, valueAccessor) {
        var value = valueAccessor();
        if (value && !$(element).is(':visible') || !value && $(element).is(':visible'))
            $(element).slideToggle(300);
    }
};

ko.bindingHandlers.toggleVisible = {
    init: function(element, valueAccessor) {
        var value = valueAccessor();
        $(element).toggle(ko.utils.unwrapObservable(value));
    },
    update: function(element, valueAccessor) {
        var value = valueAccessor();
        if (value && !$(element).is(':visible') || !value && $(element).is(':visible'))
            $(element).toggle(200);
    }
};


function BlogSubscription(subscriptionData) {
    var self = this;

    self.subscribed = ko.observable(subscriptionData['subscribed']);
    self.count = ko.observable(subscriptionData['count']);
    self.user_id = ko.observable(subscriptionData['user_id']);

    self.toggleSubscription = function () {
        $.post('/newblog/subscribeToggle/', {user_id: self.user_id()}, function (response) {
            if (response.status) {
                if (self.subscribed()) {
                    self.subscribed(false);
                    self.count(self.count() - 1);
                } else {
                    self.subscribed(true);
                    self.count(self.count() + 1);
                }
            }
        }, 'json');
    };
    self.isSubscribed = ko.computed(function () {
        return self.subscribed();
    });
}


//блок поиска в блоге
$(function() {
    BlogSearch.init();
});

var BlogSearch = {
    init:function(){
        if ($('#blog-search').val() != '')
            $('#blog-search-btn').addClass('active');
    },
    keyUp: function(el){
        if ($(el).val() != '')
            $('#blog-search-btn').addClass('active');
        else
            $('#blog-search-btn').removeClass('active');
    },
    click:function(){
        if ($('#blog-search').val() != ''){
            $('#blog-search').val('');
            $('#blog-search-btn').removeClass('active');
            return false;
        }
        return true;
    }
}