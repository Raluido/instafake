window.addEventListener("load", function () {
    var nick = document.getElementById('inputNick').value;
    $('.btn-like').click(function () {
        $.ajax({
            type: 'GET',
            url: '/' + nick + '/' + $(this).data('id') + '/liked',
            data: {},
            datatype: "json",
            success: function (response) {
                console.log(response);
                // console.log(response);
                // if (response.like = true) {
                //     document.$(this).addClass("like");
                // } else {
                //     document.$(this).removeClass("like");
                // }
            },
        });
    })
})