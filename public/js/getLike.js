window.addEventListener("load", function () {
    var nick = document.getElementById('inputNick').value;
    $('.btn-like').click(function () {
        $.ajax({
            url: '/' + nick + '/liked/' + $(this).data('id'),
            type: 'GET',
            datatype: "json",
            success: function (response) {
                console.log(response);
                // if (response.like = true) {
                //     document.$(this).addClass("like");
                // } else {
                //     document.$(this).removeClass("like");
                // }
            },
        });
    })
})