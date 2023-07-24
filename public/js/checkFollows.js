window.addEventListener("load", function () {
    var userId = document.getElementById("followingId").value;
    var nick = document.getElementById("nickName").value;
    $.ajax({
        url: '/' + nick + '/user/checkFollows/' + userId,
        type: 'GET',
        success: function (data) {
            if (data == 1) {
                $('.follow').addClass('d-none');
            } else {
                $('.unFollow').addClass('d-none');
            }
        }
    })
})