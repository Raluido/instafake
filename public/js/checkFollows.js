$('#formId').on('submit', function (event) {
    var element = $(this);
    var userId = element.children("followingId").value;
    var nick = element.children("nickName").value;
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