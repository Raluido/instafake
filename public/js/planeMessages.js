var nick = document.getElementById("inputNick").value;
$.ajax({
    type: 'GET',
    url: "/" + nick + "/check",
    data: {},
    datatype: "json",
    success: function (data) {
        if (data == 0) {
            var element = document.getElementById("messageIcon");
            element.classList.add("msgIcon");
        }
    }
})
var intervalId = setInterval(function () {
    $.ajax({
        type: 'GET',
        url: "/" + nick + "/check",
        data: {},
        datatype: "json",
        success: function (data) {
            if (data == 0) {
                var element = document.getElementById("messageIcon");
                element.classList.add("msgIcon");
            }
        }
    })
}, 5000);