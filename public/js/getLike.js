window.addEventListener("load", function () {
    var nick = document.getElementById('inputNick').value;
    $('.btn-like').unbind('click').on("click", function (event) {
        var temp = $(this);
        var tempId = $(this).data('id');
        event.preventDefault();
        $.ajax({
            url: "/" + nick + '/images/liked/' + tempId,
            type: 'GET',
            success: function (response) {
                if (response[0] == 1) {
                    temp.addClass("like");
                    $(".countLikes[data-id|=" + tempId + "]").remove();
                    $(".likes[data-id|=" + tempId + "]").append("<p class='countLikes' data-id=" + tempId + ">" + response[1] + " Me gusta</p>");
                } else {
                    temp.removeClass("like");
                    $(".countLikes[data-id|=" + tempId + "]").remove();
                    $(".likes[data-id|=" + tempId + "]").append("<p class='countLikes' data-id=" + tempId + ">" + response[1] + " Me gusta</p>");
                }
            },
        });
    })

    $('.btn-likeComment').unbind('click').on("click", function (event) {
        var temp = $(this);
        var tempId = $(this).data('id');
        event.preventDefault();
        $.ajax({
            url: "/" + nick + '/comments/liked/' + $(this).data('id'),
            type: 'GET',
            success: function (response) {
                if (response[0] == 1) {
                    temp.addClass("likeComment");
                    $(".countLikesComments[data-id|=" + tempId + "]").remove();
                    $(".innerLikesComments[data-id|=" + tempId + "]").append("<p class='countLikesComments' data-id=" + tempId + ">" + response[1] + "</p>");
                } else {
                    temp.removeClass("likeComment");
                    $(".countLikesComments[data-id|=" + tempId + "]").remove();
                    $(".innerLikesComments[data-id|=" + tempId + "]").append("<p class='countLikesComments' data-id=" + tempId + ">" + response[1] + "</p>");
                }
            },
        });
    })
})