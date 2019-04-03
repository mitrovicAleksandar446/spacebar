$(document).ready(function () {

    $(".js-like-article").on("click", function (e) {
       e.preventDefault();

       var $link = $(e.currentTarget);
       $link.toggleClass('fa-heart-o').toggleClass("fa-heart");

       $.post($link.attr('href'))
           .then(function (data) {
               $(".js-like-article-count").html(data.hearts);
           });
    });
});