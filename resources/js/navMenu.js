$(document).ready(function() {
	$("#dotMenu").click(function() {
		$(this).toggleClass('open');
	})
});

$.fn.goTo = function() {
    $('html, body').animate({
        scrollTop: $(this).offset().top + 'px'
    }, 'slow');
    
    return this;
}   