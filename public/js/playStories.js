window.addEventListener("load", function () {
    var i = 0;
    var videoCount = 0;
    var player = document.getElementById('storyPlay');
    var mp4Vid = document.getElementById('mp4Source');
    var arr_video = new Array();
    var nick = this.document.getElementById('inputNick');

    $('.btn-play').on("click", function (event) {
        event.preventDefault();
        $.ajax({
            url: nick + '/story/' + $(this).data('story') + '/' + $(this).data('user'),
            type: 'GET',
            success: function (data) {
                if (data != 'undefined') {
                    arr_video = data;
                    videoCount = arr_video.length;
                    videoPlay(0);
                    player.addEventListener('ended', myHandler, false);
                }
            }
        });

        // Set video source and start autoplay     
        function videoPlay(num) {
            $(mp4Vid).attr('src', "/uploads/" + arr_video[num]);
            player.load();
            player.play();
        }

        // Continuously play videos one after another
        function myHandler() {
            i++;
            if (i == (videoCount - 1)) {
                i = 0;
                videoPlay(i);
            }
            else {
                videoPlay(i);
            }
        }
    })
})