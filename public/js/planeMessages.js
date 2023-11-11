var nick = document.getElementById("nick").value;
$.ajax({
    type: 'GET',
    url: "/" + nick + "/messages/check",
    data: {},
    datatype: "json",
    success: function (data) {
        if (data != 0) {
            document.getElementById('innerCountMsg').innerHTML = data;
        }
    }
})
