function callAjax() {
    var nick = document.getElementById('nickId').value;
    var receiverId = $('.links').data('receiverid');
    var imageId = $('.links').data('imageid');
    $.ajax({
        type: 'GET',
        url: '/' + nick + '/messages/sendLinks/' + receiverId + '/' + imageId,
        data: {},
        success: function (data) {
            if (data == 1) {
                window.location.href = "http://instafake.com.devel/" + nick + "/messages/show/" + receiverId;
            } else {

            }
        }
    })
}