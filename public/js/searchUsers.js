var nick = document.getElementById("inputNick").value;
function searchUsers() {
    var inputSearch = document.getElementById("inputSearch").value;
    $.ajax({
        type: 'GET',
        url: "/" + nick + "/messages/" + inputSearch,
        data: {},
        datatype: "json",
        success: function (data) {
            console.log(data);
        }
    })
}