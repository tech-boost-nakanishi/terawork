$(function(){
	var position = $('#latest-message').offset().top;
	$('html, body').animate({scrollTop:position}, 300);
});