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
                    $('.countLikes').remove();
                    $('.likes').append("<p class='countLikes'>" + response[1] + " likes</p>");
                } else {
                    $temp.removeClass("like");
                    $('.countLikes').remove();
                    $('.likes').append("<p class='countLikes'>" + response[1] + " likes</p>");
                }
            },
        });
    })

    $('.btn-likeComment').unbind('click').on("click", function (event) {
        $temp = $(this);
        event.preventDefault();
        $.ajax({
            url: "/" + nick + '/likedComment/' + $(this).data('id'),
            type: 'GET',
            success: function (response) {
                if (response[0] == 1) {
                    $temp.addClass("likeComment");
                    $('.countLikesComments').remove();
                    $('.innerLikesComments').append("<p class='countLikesComments'>" + response[1] + " likes</p>");
                } else {
                    $temp.removeClass("likeComment");
                    $('.countLikesComments').remove();
                    $('.innerLikesComments').append("<p class='countLikesComments'>" + response[1] + " likes</p>");
                }
            },
        });
    })
})