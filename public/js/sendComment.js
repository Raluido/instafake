window.onload = () => {
    let innerBottomContainer = document.querySelector('.innerBottom');
    if (innerBottomContainer.childElementCount > 0) {
        let input = document.getElementById("textarea");
        let nick = document.getElementById("nick");
        let imageId = document.getElementById("imageId").value;
        let userId = document.getElementById("userId").value;

        input.addEventListener("keypress", function (event) {
            if (event.key === "Enter") {
                $ajax({
                    type: 'get',
                    url: '/' + nick + '/comments/store',
                    data: {
                        'imageId': imageId,
                        'commentator': userId,
                        'content': input.value,
                    },
                    success: function (data) {
                        this.parentNode.previousElementSibling.children[0].innerHTML = data['countComments'];
                    }
                })
            }
        });
    }
}