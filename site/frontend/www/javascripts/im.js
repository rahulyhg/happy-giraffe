/**
 * User: alexk984
 * Date: 14.03.12
 */

var im = new Im;
Comet.prototype.NewMessage = function(result, id) {
    if(window.ShowNewMessage){
        ShowNewMessage(result);
        if (result.dialog_id != dialog){
            im.ShowMiniMessage(result);
        }
    }
    else {
        im.ShowMiniMessage(result);
    }
}
Comet.prototype.ShowChangeStatus = function(result, id) {
    if(window.StatusChanged)
        StatusChanged(result);
    im.ShowChangeStatus(result);
}

comet.addEvent(1, 'NewMessage');
comet.addEvent(3, 'ShowChangeStatus');


function Im() {
    this.GetLastUrl = '';
}

Im.prototype.ShowMiniMessage = function(result) {
    im.ShowNewMessagesCount(result.unread_count);

    $.ajax({
        url: this.GetLastUrl,
        type: 'POST',
        dataType:'JSON',
        success: function(response) {
            $('#user-nav-messages ul.list').html($('#imNotificationTmpl').tmpl(response.data));
        },
        context: $(this)
    });
}
Im.prototype.ShowNewMessagesCount = function(id){
    if (id > 0){
        $("#dialogs .header .count").show();
        $("#user-nav-messages > a > span.count").show();
    }
    else{
        $("#dialogs .header .count").hide();
        $("#user-nav-messages > a > span.count").show();
    }
    $("#dialogs .header .count").html(id);
    $("#user-nav-messages > a > span.count").html(id);
    $("#user-nav-messages .drp .actions a.count").html(id);
}
Im.prototype.ShowChangeStatus = function(result) {
    console.log('ShowChangeStatus');
    var comment_count = $('#user-nav-messages .drp .actions li:last span').text();
    console.log(comment_count);
    var current_count = parseInt(comment_count);

    if (result.online == 1) {
        current_count += 1;
    } else {
        current_count -= 1;
    }
    $('#user-nav-messages .drp .actions li:last span').text(current_count);
}
