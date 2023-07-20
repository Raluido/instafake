function searchUsersMsj() {
    var nick = document.getElementById("nickId").value;
    var inputSearch = document.getElementById("searchId").value;
    $.ajax({
        type: 'GET',
        url: "/" + nick + "/messages/" + inputSearch,
        data: {},
        datatype: "json",
        success: function (data) {
            if (typeof data === 'string') {
                document.getElementById("resultsId").classList.remove("d-block");
                document.getElementById("resultsId").classList.add("d-none");
            } else {
                if (data[0] === undefined) {
                    document.getElementById("resultsId").innerHTML = "<p style='display:block;'>No results</p>";
                    document.getElementById("resultsId").classList.remove("d-none");
                    document.getElementById("resultsId").classList.add("d-block");
                } else if (data[0] !== undefined) {
                    $(".resultsClass").empty();
                    if (data[0].nick !== "") {
                        data.forEach(element => {
                            document.getElementById("resultsId").innerHTML +=
                                "<a href='/" + nick + "/messages/show/" + element.following + "' style='display:block; margin-bottom:.5em;'>" + element.nick + "</a>"
                        });
                        document.getElementById("resultsId").classList.remove("d-none");
                        document.getElementById("resultsId").classList.add("d-block");
                    }
                }
            }
        }
    })
}