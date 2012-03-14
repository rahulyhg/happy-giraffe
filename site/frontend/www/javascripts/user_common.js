$(function() {
    $.ajax({
        dataType: 'json',
        url: '/notification/getLast/',
        success: function(response) {
            updateNotifications(response.notifications.count, response.notifications.data);
            updateFriends(response.friends.count, response.friends.data);
            //updateFriends(response.im.count, response.im.data);
        }
    });
});

function updateNotifications(count, data)
{
    $('#user-nav-notifications span.count').text(count).toggle(count != 0);
    $('#user-nav-notifications div.actions ul li:first-child a span').text(count);
    $('#user-nav-notifications ul.list').html($('#notificationTmpl').tmpl(data));
}

function updateFriends(count, data)
{
    $('#user-nav-friends span.count').text(count).toggle(count != 0);
    $('#user-nav-friends ul.list').html($('#friendNotificationTmpl').tmpl(data));
}

function updateIm(count, data)
{
    $('#user-nav-messages span.count').text(count).toggle(count != 0);
    $('#user-nav-messages ul.list').html($('#imNotificationTmpl').tmpl(data));
}

Comet.prototype.updateNotifications = function(result, id) {
    updateNotifications(result.count, result.data);
}

Comet.prototype.updateFriends = function(result, id) {
    updateFriends(result.count, result.data);
}

comet.addEvent(100, 'updateNotifications');
comet.addEvent(101, 'updateFriends');