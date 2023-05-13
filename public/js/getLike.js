window.addEventListener("load", function () {
    var nick = document.getElementById('inputNick').value;
    $('.btn-like').unbind('click').on("click", function (event) {
        $temp = $(this);
        event.preventDefault();
        $.ajax({
            url: "/" + nick + '/liked/' + $(this).data('id'),
            type: 'GET',
            success: function (response) {
                if (response[0] == 1) {
                    $temp.addClass("like");
                    $('.innerLikes').remove();
                    $('.likes').append("<p class='innerLikes'>" + response[1] + " likes</p>");
                } else {
                    $temp.removeClass("like");
                    $('.innerLikes').remove();
                    $('.likes').append("<p class='innerLikes'>" + response[1] + " likes</p>");
                }
            },
        });
    })
})