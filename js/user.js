$(document).ready(function () {
    markActiveItem();
    $("#btnPersonForm").click(function () {
        hidden = $("#personFormBlock").attr('hidden');
        $("#personFormBlock").attr('hidden', !hidden);
        span = $(this).children("span");
        if (hidden) {
            span.addClass('rotate');
            
        } else {
            span.removeClass('rotate');
        }
    });
});

function markActiveItem() {
    $("#" + activeItem).addClass("active");
}

function description(event) {
    obj = $(event.target).children(".postDescription");
    if (obj.attr('hidden'))
        obj.attr('hidden', false);
    else
        obj.attr('hidden', true);
}

function createPostDialog() {
    $("#modalPost").modal('show');
}