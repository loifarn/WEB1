$(document).ready(function() {
	$('#projects').waypoint({
        handler: function(direction) {
        	if (direction == 'down') {
        		$("#dotMenu").removeClass("light").addClass("dark");
        	} else if (direction == 'up') {
        		$("#dotMenu").removeClass("dark").addClass("light");
        	}
            // alert('Change font-colour of side nav');
        },
        offset: 40
    })

    $(".cd-stretchy-nav ul li").click(function() {
	    $(".cd-stretchy-nav ul li").removeClass('active');
	    $(this).addClass('active');
	});
});



//     $('#projects').waypoint({
//         handler: function(direction) {
//             alert('testme');
//             var elem = document.querySelector('.cd-stretchy-nav.nav-is-visible ul a.active');
//             elem.style.color = 'black';
//         }
//     })
// })

// $(".active").click(function() {
//     $(".cd-stretchy-nav ul a").removeClass('active');
//     $(this).addClass('active');
// })