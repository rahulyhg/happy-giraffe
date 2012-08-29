var Messages = {
    editor: null
}

Messages.open = function(interlocutor_id) {
    interlocutor_id = (typeof interlocutor_id === "undefined") ? null : interlocutor_id;

    $.get('/im/', function(data) {
        $('body').append(data);
        $('body').css('overflow', 'hidden');
        $('body').append('<div id="body-overlay"></div>');
        $('body').addClass('nav-fixed');
        Messages.setList(0, interlocutor_id);
        comet.addEvent(3, 'updateStatus');
        comet.addEvent(1, 'receiveMessage');
        $(window).on('resize', function() {
            Messages.setHeight();
        })
    });
}

Messages.close = function() {
    $('#user-dialogs').remove();
    $('body').css('overflow', '');
    $('#body-overlay').remove();
    $('body').removeClass('nav-fixed');
    if (CKEDITOR.instances['Message[text]']) {
        CKEDITOR.instances['Message[text]'].destroy(true);
    }
    comet.delEvent(3, 'updateStatus');
    comet.delEvent(1, 'receiveMessage');
    $(window).off('resize', function() {
        Messages.setHeight();
    })
}

Messages.toggle = function() {
    ($('#user-dialogs').length > 0) ? Messages.close() : Messages.open();
}

Messages.setHeight  = function() {
    var box = $('#user-dialogs');

    var windowH = $(window).height();
    var headerH = 90;
    var textareaH = box.find('.dialog-input').hasClass('wysiwyg-input') ? 150 : 100;
    var userH = 110;
    var marginH = 30;

    var wannaChatH = box.find('.wannachat').size() > 0 ? 150 : 0;

    var generalH = windowH - marginH*2 - headerH;
    if (generalH < 400) generalH = 400;

    box.find('.contacts').height(generalH);
    box.find('.dialog').height(generalH);

    box.find('.contacts .list').height(generalH - wannaChatH);
    box.find('.dialog .dialog-messages').height(generalH - textareaH - userH);
}

Messages.setList = function(type, interlocutor_id) {
    interlocutor_id = (typeof interlocutor_id === "undefined") ? null : interlocutor_id;

    $.get('/im/contacts/', {type: type}, function(data) {
        $('#user-dialogs-contacts').html(data);
        $('#user-dialogs-nav li.active').removeClass('active');
        $('#user-dialogs-nav li:eq(' + type + ')').addClass('active');

        var openDialog = (interlocutor_id === null) ? $('#user-dialogs-contacts > li:first').data('userid') : interlocutor_id;

        Messages.setDialog(openDialog);
    });
}

Messages.setDialog = function(interlocutor_id) {
    $.get('/im/dialog/', {interlocutor_id: interlocutor_id}, function(data) {
        if ($('#user-dialogs-contacts li[data-userid="' + interlocutor_id + '"]').length == 0) {
            $('#user-dialogs-contacts').prepend(data.contactHtml);
        }

        $('#user-dialogs-dialog').html(data.html);
        $('#user-dialogs-dialog').data('dialogid', data.dialogid);
        $('#user-dialogs-dialog').data('interlocutorid', interlocutor_id);
        $('#user-dialogs-contacts li.active').removeClass('active');
        $('#user-dialogs-contacts li[data-userid="' + interlocutor_id + '"]').addClass('active');
        Messages.setHeight();
        Messages.scrollDown();
    }, 'json');
}

Messages.sendMessage = function() {
    var form = $('#user-dialogs-form');

    $.post(form.attr('action'), {
        interlocutor_id: $('#user-dialogs-dialog').data('interlocutorid'),
        text: Messages.editor.getData()
    }, function(data) {
        if (data.status == 1) {
            Messages.editor.setData('');
            Messages.editor.focus();
            $('.dialog-messages > ul').append(data.html);
            if ($('.dialog-messages > .empty:visible').length > 0)
                $('.dialog-messages > .empty').hide();
            Messages.scrollDown();
        }
    }, 'json');
}

Messages.updateCounter = function(selector, diff) {
    var newValue = parseInt($(selector).text()) + diff;
    $(selector).text(newValue);
    if (newValue == 0) {
        $(selector).parents('li').addClass('disabled');
    } else {
        if ($(selector).parents('li').hasClass('disabled'))
            $(selector).parents('li').removeClass('disabled');
    }
}

Messages.filterList = function(filter) {
    if (filter) {
        $('#user-dialogs-contacts').find("span.username:not(:Contains(" + filter + "))").parents('li').slideUp();
        $('#user-dialogs-contacts').find("span.username:Contains(" + filter + ")").parents('li').slideDown();
    } else {
        $('#user-dialogs-contacts > li').slideDown();
    }
}

Messages.scrollDown = function() {
    $(".dialog-messages").prop('scrollTop', $(".dialog-messages").prop("scrollHeight"));
}

Messages.showInput = function() {
    $('.dialog-input').addClass('wysiwyg-input');
    setMessagesHeight();
    Messages.editor = CKEDITOR.instances['Message[text]'];
    Messages.editor.focus();
    Messages.editor.focus();
    Messages.editor.focus();
    Messages.editor.on('key', function (e) {
        if (e.data.keyCode == 1114125) {
            Messages.sendMessage();
        }
    });
}

Comet.prototype.updateStatus = function (result, id) {
    var indicators = $('[data-userid=' + result.user_id +'] .icon-status');
    if (result.online == 1) {
        indicators.removeClass('status-offline').addClass('status-online');
        Messages.updateCounter('#user-dialogs-onlineCount', 1);
        if (result.is_friend)
            Messages.updateCounter('#user-dialogs-friendsCount', 1);
    } else {
        indicators.removeClass('status-online').addClass('status-offline');
        Messages.updateCounter('#user-dialogs-onlineCount', -1);
        if (result.is_friend)
            Messages.updateCounter('#user-dialogs-friendsCount', -1);
    }
}

Comet.prototype.receiveMessage = function (result, id) {
    if (result.from == $('#user-dialogs-dialog').data('interlocutorid')) {
        $('.dialog-messages > ul').append(result.html);
        Messages.scrollDown();
    }
}

function removeA(arr){
    var what, a= arguments, L= a.length, ax;
    while(L> 1 && arr.length){
        what= a[--L];
        while((ax= arr.indexOf(what))!= -1){
            arr.splice(ax, 1);
        }
    }
    return arr;
}