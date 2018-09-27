(function($){
    var footerIndex = Math.floor(Math.random() * 3) + 1;

    $('#footer-banner').attr('data-src', 'https://vericorstaging.eastonpreview.com/wp-content/themes/vericor-homes/assets/vericor-footer-banner-'+ footerIndex +'.jpg');

    $('.menu-toggle').click(function() {
        $('body').toggleClass('menu-open');
    });

    $(window).scroll(function(){
		$('.scrollFade').css("opacity", 1 - $(window).scrollTop() / 750);
    });
    
    $('.close').click(function(){
        $('#alertWrapper').addClass('hidden');
    });

    $('li.mobile-only-item.menu-item-has-children').click(function(e){
        if(e.target !== e.currentTarget) return;
        $(this).addClass('open-sub-menu');
    });

    $('.mobile-back').click(function(){
        $('li.mobile-only-item.menu-item-has-children').removeClass('open-sub-menu');
    })
})(jQuery);