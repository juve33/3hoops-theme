$(document).ready(function() {
    var lastScrollTop = $(this).scrollTop();
    var scrollInertia = 5;

	$(window).on('scroll', function() {
        let delta = $(this).scrollTop() - lastScrollTop;
        console.log(delta);

        if ((delta > scrollInertia) && ($(this).scrollTop() > scrollInertia)) {
		    $('.main-nav').addClass('small');
        }
        else {
            if ((delta < -scrollInertia) || ($(this).scrollTop() <= scrollInertia)) {
    		    $('.main-nav').removeClass('small');
            }
        }

        lastScrollTop = $(this).scrollTop();
    });
});