(function($){

    var getInventoryURL = $('#getFile').val();
    var getModelsURL = $('#getFileModels').val();

    var _loading;

    $('.sitemap-pop').click(function(){
        var linkedInv = $(this).data('inventory');
               
        console.log(linkedInv);
        $.ajax({
            type: 'POST',
            url: getInventoryURL,
            data: {
                inventoryID : linkedInv,
            },
            beforeSend: function() {
                $('#modal-1 > div > div').css('overflow', 'hidden');
                MicroModal.show('modal-2');
                $('#loaded-content').remove();
            }
        }).done(function(response) {
            // console.log(response);
            $('#loader').addClass('hidden');
            $('#modal-2-content').append(response);
            _loading = false;
        }).fail(function(data) {
            console.log(data);
            $('#modal-2-content').append(data);
            _loading = false;
        });
    });

    $('.sitemap-pop-model').click(function(){
        var linkedModels = $(this).data('models');
        linkedModels = JSON.stringify(linkedModels);
               
        console.log(linkedModels);
        $.ajax({
            type: 'POST',
            url: getModelsURL,
            data: {
                modelsID : linkedModels,
            },
            beforeSend: function() {
                $('#modal-1 > div > div').css('overflow', 'hidden');
                MicroModal.show('modal-2');
                $('#loaded-content').remove();
            }
        }).done(function(response) {
            // console.log(response);
            $('#loader').addClass('hidden');
            $('#modal-2-content').append(response);
            _loading = false;
        }).fail(function(data) {
            console.log(data);
            $('#modal-2-content').append(data);
            _loading = false;
        });
    });

})(jQuery);