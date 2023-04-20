function getLike() {
    var nick = document.getElementById('inputNick').value;
    var imageId = document.getElementById('imageId').value;
    var userId = document.getElementById('userId').value;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '/' + nick + '/getLike/' + imageId + '/' + userId,
    });
    $ajax({
        data: {},
        success: function (data) {
        },
    });
}