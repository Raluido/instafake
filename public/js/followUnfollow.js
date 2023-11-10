window.onload = function () {
    let userId = document.getElementById("followingId").value;
    let nick = document.getElementById("nickName").value;
    let follow = document.getElementById('follow');
    let unfollow = document.getElementById('unfollow');
    follow.onclick = function () {
        let unfollowContainer = document.createElement("button");
        unfollowContainer.innerHTML = "Dejar de seguir";
        unfollowContainer.setAttribute('id', "unfollow");
        $.ajax({
            url: '/' + nick + '/user/follow/',
            type: 'GET',
            data: {
                'userId': userId
            },
            success: function (data) {
                if (data) {
                    follow.classList.add('d-none')
                    follow.classList.remove('d-block')
                    unfollow.classList.add('d-block')
                    unfollow.classList.remove('d-none')
                    $('.followers').html(data + '<br> Seguidores')
                }
            }
        })
    }

    unfollow.onclick = function () {
        let unfollow = document.getElementById('unfollow');
        let followContainer = document.createElement("button");
        followContainer.innerHTML = "Seguir";
        followContainer.setAttribute('id', "follow");
        $.ajax({
            url: '/' + nick + '/user/unfollow/',
            type: 'GET',
            data: {
                'userId': userId
            },
            success: function (data) {
                if (data) {
                    unfollow.classList.add('d-none')
                    unfollow.classList.remove('d-block')
                    follow.classList.add('d-block')
                    follow.classList.remove('d-none')
                    $('.followers').html(data + '<br> Seguidores')
                }
            }
        })
    }
}
