window.onload = () => {

    // autoexpand textarea
    function onExpandableTextareaInput({ target: elm }) {
        if (!elm.classList.contains('autoExpand') || !elm.nodeName == 'TEXTAREA') return

        let minRows = elm.getAttribute('data-min-rows') | 0, rows;
        !elm._baseScrollHeight && getScrollHeight(elm) // this mean to be a quick way to check that elm._baseScrollHeight is not null 

        elm.rows = minRows
        rows = Math.ceil((elm.scrollHeight - elm._baseScrollHeight) / 16)
        elm.rows = minRows + rows
    }

    function getScrollHeight(elm) {
        let savedValue = elm.value
        elm.value = ''
        elm._baseScrollHeight = elm.scrollHeight
        elm.value = savedValue
    }
    document.addEventListener('input', onExpandableTextareaInput);

    // sending through ajax
    let input = document.getElementById("textarea");
    let nick = document.getElementById("nick").value;
    let imageId = document.getElementById("imageId").value;
    let userId = document.getElementById("userId").value;
    let contentContainer = document.querySelector('.innerComments');
    let url = document.getElementById('url').value;
    let avatar = document.getElementById('avatar').value;
    input.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            $.ajax({
                type: 'get',
                url: '/' + nick + '/comments/store',
                data: {
                    'imageId': imageId,
                    'commentator': userId,
                    'content': input.value,
                },
                success: function (data) {
                    let avatarContainer = document.createElement('div');
                    avatarContainer.setAttribute('class', 'avatar');
                    contentContainer.appendChild(avatarContainer);

                    let innerAvatarContainer = document.createElement('div');
                    innerAvatarContainer.setAttribute('class', 'innerAvatar');
                    avatarContainer.appendChild(innerAvatarContainer);

                    let anchorInnerAvatarContainer = document.createElement('a');
                    anchorInnerAvatarContainer.setAttribute('href', url + '/' + nick + '/user/myProfile');
                    innerAvatarContainer.appendChild(anchorInnerAvatarContainer);

                    let divAnchorInnerAvatarContainer = document.createElement('div');
                    anchorInnerAvatarContainer.appendChild(divAnchorInnerAvatarContainer);

                    let imgDivAnchorInnerAvatarContainer = document.createElement('img');
                    imgDivAnchorInnerAvatarContainer.setAttribute('src', url + '/profiles/' + userId + '/' + avatar);
                    divAnchorInnerAvatarContainer.appendChild(imgDivAnchorInnerAvatarContainer);


                    let contentInnerAvatarContainer = document.createElement('div');
                    contentInnerAvatarContainer.setAttribute('class', 'content');
                    avatarContainer.appendChild(contentInnerAvatarContainer);

                    let paragraphContentContainer = document.createElement('p');
                    paragraphContentContainer.innerHTML = data['content'];
                    contentInnerAvatarContainer.appendChild(paragraphContentContainer);

                    let innerLikesCommentsContainer = document.createElement('div');
                    innerLikesCommentsContainer.setAttribute('data-id', data['commentId']);
                    innerLikesCommentsContainer.setAttribute('class', 'innerLikesComments');
                    contentInnerAvatarContainer.appendChild(innerLikesCommentsContainer);

                    let iconInnerLikesCommentsContainer = document.createElement('i');
                    iconInnerLikesCommentsContainer.setAttribute('data-id', data['commentId']);
                    iconInnerLikesCommentsContainer.setAttribute('class', 'fa-regular fa-heart btn-likeComment');
                    innerLikesCommentsContainer.appendChild(iconInnerLikesCommentsContainer);

                    let divInnerLikesCommentsContainer = document.createElement('div');
                    innerLikesCommentsContainer.appendChild(divInnerLikesCommentsContainer);

                    let paragraphInnerLikesCommentsContainer = document.createElement('p');
                    paragraphInnerLikesCommentsContainer.setAttribute('data-id', data['commentId']);
                    paragraphInnerLikesCommentsContainer.setAttribute('class', 'countLikesComments');
                    paragraphInnerLikesCommentsContainer.innerHTML = 0;
                    divInnerLikesCommentsContainer.appendChild(paragraphInnerLikesCommentsContainer);

                    input.setSelectionRange(0, 0);
                    input.value = "";
                    input.setAttribute('rows', '0');
                    window.scrollTo(0, document.body.scrollHeight);
                }
            })
        }
    });
}