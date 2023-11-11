window.addEventListener("load", function () {
    let nick = document.getElementById('nick').value;
    $('.btn-likeComment').on("click", function () {
        let temp = $(this);
        let tempId = $(this).data('id');
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