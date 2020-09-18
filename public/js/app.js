$(document).ready(function(){
	$(".icon-open-menu").on('click', function(){
		showMenu();
	})

	$(".close-menu, .bg-menu").on('click', function(){
		hideMenu();
	})
})