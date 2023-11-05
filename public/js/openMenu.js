function openMenu() {
    var element = $('.dropDown');
    if (element.hasClass('d-block')) {
        element.removeClass('d-block');
        element.addClass('d-none');
    } else {
        element.removeClass('d-none');
        element.addClass('d-block');
    }
}