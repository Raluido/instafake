function searchUsersLinks() {
    var nick = document.getElementById("nickId").value;
    var imageId = document.getElementById("imageId").value;
    var inputSearch = document.getElementById("searchId").value;
    $.ajax({
        type: 'GET',
        url: '/' + nick + '/messages/sendLinks/' + inputSearch,
        data: {},
        datatype: "json",
        success: function (data) {
            if (typeof data[0] === 'string') {
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
                                "<div class='links' onclick='callAjax()' data-receiverId=" + element.id + " data-imageId=" + imageId + " style='display:block; margin-bottom:.5em;'>" + element.nick + "</div>"
                        });
                        document.getElementById("resultsId").classList.remove("d-none");
                        document.getElementById("resultsId").classList.add("d-block");
                    }
                }
            }
        }
    })
}