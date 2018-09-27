(function($){
    var target;
    var switchTabContent = function(data) {
        $('#tabContent > div').addClass('hidden');
        $('#tabContent > #' + data).removeClass('hidden');
    };
    $('#tabNavs a').click(function() {
        $(this).parent().siblings().removeClass('active');
        $(this).parent().addClass('active');
        target = $(this).data('target');
        switchTabContent(target);
    });
})(jQuery);