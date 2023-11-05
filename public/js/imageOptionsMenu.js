$(".menuImage").on("click", function (e) {
    var id = e.currentTarget.closest('.imageOptions').querySelector('.links').id;
    e.currentTarget.closest('.imageOptions').querySelector('.links').classList.add(id);
    if (e.currentTarget.closest('.imageOptions').querySelector('.links').classList.contains('d-none')) {
        e.currentTarget.closest('.imageOptions').querySelector('.links').classList.remove('d-none');
        e.currentTarget.closest('.imageOptions').querySelector('.links').classList.add('d-block');
        e.currentTarget.closest('.innerImageOptions').querySelector("#" + id + "").style.position = "absolute";
        e.currentTarget.closest('.imageOptions').querySelector("#" + id + "").style.position = "relative";
    } else if ((e.currentTarget.closest('.imageOptions').querySelector('.links').classList.contains('d-block'))) {
        var id = e.currentTarget.closest('.imageOptions').querySelector('.links').id;
        e.currentTarget.closest('.imageOptions').querySelector('.links').classList.remove('d-block');
        e.currentTarget.closest('.imageOptions').querySelector('.links').classList.add('d-none');
        e.currentTarget.closest('.innerImageOptions').querySelector('#' + id + '').style.position = "unset";
        e.currentTarget.closest('.imageOptions').querySelector('#' + id + '').style.position = "unset";
    }
})