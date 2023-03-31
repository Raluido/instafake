var nick = document.getElementById("inputNick").value;
var intervalId = setInterval(function () {
    $.ajax({
        type: 'GET',
        url: "/" + nick + "/check",
        data: {},
        datatype: "json",
        success: function (data) {
            console.log(data);
            if (data != "") {
                var element = document.getElementById("messageIcon");
                element.classList.add("msgIcon");
            }
        }
    })
}, 5000);