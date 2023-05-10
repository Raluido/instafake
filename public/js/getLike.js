function getLike() {
    var nick = document.getElementById('inputNick').value;
    var imageId = document.getElementById('imageId').value;
    var userId = document.getElementById('userId').value;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '/' + nick + '/liked',
    });
    $.ajax({
        data: {
            'imageId': imageId,
            'userId': userId
        },
        success: function (data) {
            if (data == true) {
                document.getElementById(imageId).style.color = "red";
            } else {
                document.getElementById(imageId).classList.remove("like");
            }
        },
    });
}