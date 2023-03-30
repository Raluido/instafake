var intervalId = setInterval(function () {
    $.ajax({
        type: get,
        url: "/check",
        data: '',
        success: function (data) {
        }
    })
}, 5000);

function colorIcon() {
    var element = document.getElementById("messageIcon");
    element.classList.add("msgIcon");
}