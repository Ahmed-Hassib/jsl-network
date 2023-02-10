
// self invoke function
$(document).ready(function() {
    // call show notification method
    showNotification();

    setInterval(() => {
        // call show notification method
        showNotification();
    }, 60000);

});

// show notification function
function showNotification() {
    // check if browser not support web notification or not
    if (!Notification) {
        document.getElementById('notif').textContent = 'Your browser not support notification system';
    }

    // check if user accepted web notification or not
    if (Notification.permission !== "granted") {
        Notification.requestPermission();
    } else {
        $.ajax({
            url: '../includes/functions/notifications.php',
            type: 'POST',
            success: function(data, textStatus, jqXHR) {
                var data = jQuery.parseJSON(data);   // convert data to array
                // check status
                if (textStatus == "success") {
                    // loop on data
                    for (let i = 0; i < data.length; i++) {
                        const element = data[i];
                        // create a notification object
                        var notif = new Notification(element['mal_id'], {
                            icon: 'new malfunction', 
                            body: 'manager: ' + element['mng'] + ' added a malfunction of client: ' + element['client'] + ' for you'});
                        
                        notif.onclick = function () {
                            notif.close();
                        }
                        
                        setTimeout(function() {
                            notif.close();
                        }, 2000);
                    }
                    // console.log(data)
                }
            }
        })
    }

}