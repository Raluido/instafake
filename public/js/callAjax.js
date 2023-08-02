function callAjax() {
    var nick = document.getElementById('nickId').value;
    var url = document.getElementById('url').value;
    console.log(url);
    var receiverId = $('.links').data('receiverid');
    var imageId = $('.links').data('imageid');
    $.ajax({
        type: 'GET',
        url: '/' + nick + '/messages/sendLinks/' + receiverId + '/' + imageId,
        data: {},
        success: function (data) {
            if (data == 1) {
                window.location.href = url + '/' + nick + "/messages/show/" + receiverId;
            } else {

            }
        }
    })
}