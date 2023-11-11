window.addEventListener("load", function () {
    let nick = document.getElementById('nick').value;
    $('.btn-like').on("click", function (event) {
        event.preventDefault();
        let temp = $(this);
        let tempId = $(this).data('id');
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
})