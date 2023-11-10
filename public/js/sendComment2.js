window.onload = () => {
    let input = document.getElementById("textarea");
    let nick = document.getElementById("nick");
    let imageId = document.getElementById("imageId").value;
    let userId = document.getElementById("userId").value;
    let contentContainer = document.querySelector('.content');
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
                    let innerLikesCommentsContainer = document.createElement('div');
                    innerLikesCommentsContainer.setAttribute('data-id', data['commentId']);
                    let anchorInnerLikesCommentsContainer = document.createElement('a');
                    let iconInnerLikesCommentsContainer = document.createElement('i');
                    iconInnerLikesCommentsContainer.setAttribute('data-id', data['commentId']);
                    iconInnerLikesCommentsContainer.setAttribute('class', 'fa-regular fa-heart btn-likeComment');
                    let paragraphInnerLikesCommentsContainer = document.createElement('p');
                    paragraphInnerLikesCommentsContainer.setAttribute('data-id', data['commentId']);
                    paragraphInnerLikesCommentsContainer.innerHTML = data['content'];
                    innerLikesCommentsContainer.appendChild(anchorInnerLikesCommentsContainer);
                    anchorInnerLikesCommentsContainer.appendChild(iconInnerLikesCommentsContainer);
                    innerLikesCommentsContainer.appendChild(paragraphInnerLikesCommentsContainer);
                }
            })
        }
    });
}