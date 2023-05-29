window.addEventListener("load", function () {
    var i = 0;
    var videoCount = 0;
    var player = document.getElementById('storyPlay');
    var mp4Vid = document.getElementById('mp4Source');
    var arr_video = new Array();
    var nick = this.document.getElementById('inputNick');

    $('.btn-play').on("click", function (event) {
        player.classList.remove('d-none');
        event.preventDefault();
        $.ajax({
            url: nick + '/stories/' + $(this).data('story') + '/' + $(this).data('user'),
            type: 'GET',
            success: function (data) {
                if (data != 'undefined') {
                    arr_video = data;
                    videoCount = arr_video.length;
                    videoPlay(arr_video[i].user_id, arr_video[i].path);
                    player.addEventListener('ended', (event) => {
                        i++;
                        if (i == (videoCount)) {
                            player.classList.add('d-none');
                            location.reload();
                        }
                        else {
                            videoPlay(arr_video[i].user_id, arr_video[i].path);
                        }
                    });
                }
            }
        });

        // Set video source and start autoplay     
        function videoPlay(userId, path) {
            $(mp4Vid).attr('src', '/storage/media/' + userId + '/library/stories/' + path);
            player.load();
            player.play();
            player.requestFullscreen();
        }
    })
})

// window.setInterval(function () {
//     $(".innerTop").load(window.location.href + " .innerTop");
// }, 5000);