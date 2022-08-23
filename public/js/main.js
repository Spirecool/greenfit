// SCRIPT MENU TOGGLE BUTTON 

$(document).ready(function(){
    $(".sidebar-btn").click(function(){
    $(".wrapper").toggleClass("collapse_menu");
  });
  });

// SEARCH BAR

var $box = $('#box');
function moveBox (e) { 
  TweenMax.to( $box, 1.8, {
    css: { left: e.pageX, top: e.pageY },
    ease: Elastic.easeOut});
}
$(window).on('mousemove', moveBox);