$(document).ready(function(){
    markActiveItem();
});

function markActiveItem(){
    $("#"+activeItem).addClass("active");
}