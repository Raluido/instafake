window.onload = function () {
    let userId = document.getElementById("followingId").value;
    let nick = document.getElementById("nickName").value;
    let follow = document.getElementById('follow');
    let unfollow = document.getElementById('unfollow');
    follow.addEventListener('click', function () {
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
                    unfollowContainer.after(follow);
                    follow.classList.add('d-none')
                    $('#followers').html(data + '<br> Seguidores')
                }
            }
        })
    })

    unfollow.addEventListener('click', function () {
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
                    followContainer.after(unfollow);
                    unfollow.classList.add('d-none')
                    $('.followers').html(data + '<br> Seguidores')
                }
            }
        })
    })
}
