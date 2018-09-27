(function($){
    var _addLotOpen;
    var _sitemapOptionsOpen;
    var _itemStatusOpen;
    var _linkedInventoryOpen;
    var _availableModelsOpen;

    var _currentItem;

    var _numberDeleted = 0;

    var rowIndex = parseInt($('#rowIndex').val());
    var startIndexValue = parseInt($('#startIndex').val());
	var postid = $('#id').val();
    var updateURL = $('#updateFile').val();

    var closeAddWrapper = function() {
        $('#add-lot-wrapper').addClass('hidden');
        _addLotOpen = 0;
    };

    var closeItemStatus = function() {
        $('#add-status-wrapper').addClass('hidden');
        _itemStatusOpen = 0;
    }

    var showLinkedInventoryOptions = function() {
        $('#link-inventory-wrapper').removeClass('hidden');
        _linkedInventoryOpen = 1;
    }

    var closeLinkedInventoryOptions = function() {
        $('#link-inventory-wrapper').addClass('hidden');
        _linkedInventoryOpen = 0;
    }

    var showAvailableModelsOptions = function() {
        $('#available-models-wrapper').removeClass('hidden');
        _availableModelsOpen = 1;
    }

    var closeAvailableModelsOptions = function() {
        $('#available-models-wrapper').addClass('hidden');
        _availableModelsOpen = 0;
    }

    var showSitemapOptions = function(item) {
        _sitemapOptionsOpen = 1;
        // show status and delete buttons
        $('#status-button, #delete-button, #linked-button, #models-button').removeClass('hidden');
        $('#status-button, #delete-button, #linked-button, #models-button').addClass('inline-flex');
        // get (this) and set to var
        _currentItem = item;
        $('.sitemap-item').removeClass('shadow-lg border-2 border-white');
        _currentItem.addClass('shadow-lg border-2 border-white');

        var invTitle = _currentItem[0].dataset.invtitle;
        if ( invTitle ) {
            $('#current-inventory').text(invTitle);
        } else {
            $('#current-inventory').text('N/A');
        }
        if ( _currentItem[0].dataset.modelnames ) {
            var itemModels = _currentItem[0].dataset.modelnames;
            itemModels = JSON.parse(itemModels);
            // console.log(itemModels);
        }
        if( _currentItem[0].dataset.models ) {
            var thisModels = _currentItem[0].dataset.models;
            thisModels = JSON.parse(thisModels);
            // console.log(thisModels);
            // thisModels.forEach(thisModel => {
            //     console.log(thisModel);
            // });

            $('.available-model-item').each(function() {
                $(this).removeClass('font-bold');
                // console.log(this.dataset);
                // console.log($(this));
                if( thisModels.indexOf(this.dataset.model*1) > -1 ) {
                    // console.log('indexOf > -1');
                    $(this).addClass('font-bold');
                }
            });
        }
        if ( itemModels ) {
            $('#current-models').empty();
            itemModels.forEach(itemModel => {
                // console.log(itemModel)
                $('#current-models').append('<p>'+itemModel+'</p>')
            });
        } else {
            $('#current-models').empty();
            $('#current-models').append('<p>N/A</p>')
        }
        // console.log('_currentItem', _currentItem);
    };

    var closeSitemapOptions = function() {
        _sitemapOptionsOpen = 0;
        $('#status-button, #delete-button, #linked-button, #models-button').removeClass('inline-flex');
        $('#status-button, #delete-button, #linked-button, #models-button').addClass('hidden');
        $('.sitemap-item').removeClass('shadow-lg border-2 border-white');
        _currentItem = null;
        $('#current-inventory').text('N/A');
    }

    var addDot = function(label) {
        rowIndex = ++rowIndex;
        var newDot = '<div style="top: 15%; left: 15%;" class="absolute text-xs text-white rounded-full flex h-6 w-6 items-center justify-center bg-gray-lighter sitemap-item shadow" data-id="'+ rowIndex +'" data-label="'+label+'" data-status="future" data-inventory="" data-invtitle="" data-models="[]" data-modelnames="[]">'+label+'</div>';
        $('#sitemap-data').append(newDot);
        $('#rowIndex').attr('value', rowIndex);
    };


    $('#add-lot-opener').click(function() {
        $('#add-lot-wrapper').removeClass('hidden');
        _addLotOpen = 1;
        $('#lot-label').focus();
        closeSitemapOptions();
    });

    $('#add-lot-wrapper').parent().click(function(e) {
        if( _addLotOpen == 1) {
            if (e.target !== e.currentTarget) return;
            closeAddWrapper();
        }
    });

    $('#add-lot-button').click(function(){
        var newDotLabel = $('#lot-label').val();
        if( newDotLabel == '' ) {
            $('#lot-label').addClass('border-red');
            $('#lot-label').parent().parent().after('<p class="text-red text-xs italic mt-2" id="lot-label-warning">Please input a label for this lot.</p>');
            $('#lot-label').focus();
            return;
        }
        //add dot to #sitemap-data
        // console.log('addDot', newDotLabel);
        addDot(newDotLabel);
        $('#lot-label').val('');
        $('#lot-label').removeClass('border-red');
        $('#lot-label-warning').remove();
        closeAddWrapper();
        $('.sitemap-item').draggable({
            appendTo: "#sitemap-data",
            containment: "parent",
            cursor: "move",
            stop: function () {
                var l = ( 100 * parseFloat($(this).position().left / parseFloat($(this).parent().width())) ) + "%" ;
                var t = ( 100 * parseFloat($(this).position().top / parseFloat($(this).parent().height())) ) + "%" ;
                $(this).css("left", l);
                $(this).css("top", t);
            }
        });

        $('.sitemap-item').click(function() {
            showSitemapOptions($(this));
        });
    });

    $('#add-form').submit(function(e) {
        e.preventDefault();
        var newDotLabel = $('#lot-label').val();
        $('#lot-label').val('');
        //add dot to #sitemap-data
        // console.log('addDot', newDotLabel);
        addDot(newDotLabel);
        closeAddWrapper();
        $('.sitemap-item').draggable({
            appendTo: "#sitemap-data",
            containment: "parent",
            cursor: "move",
            stop: function () {
                var l = ( 100 * parseFloat($(this).position().left / parseFloat($(this).parent().width())) ) + "%" ;
                var t = ( 100 * parseFloat($(this).position().top / parseFloat($(this).parent().height())) ) + "%" ;
                $(this).css("left", l);
                $(this).css("top", t);
            }
        });

        $('.sitemap-item').click(function() {
            showSitemapOptions($(this));
        });
    });

    $('.sitemap-item').draggable({
        appendTo: "#sitemap-data",
        containment: "parent",
        cursor: "move",
        stop: function () {
            var l = ( 100 * parseFloat($(this).position().left / parseFloat($(this).parent().width())) ) + "%" ;
            var t = ( 100 * parseFloat($(this).position().top / parseFloat($(this).parent().height())) ) + "%" ;
            $(this).css("left", l);
            $(this).css("top", t);
        }
    });

    $('.sitemap-item').click(function() {
        showSitemapOptions($(this));
    });

    $('.sitemap-item').parent().click(function(e) {
        if(_sitemapOptionsOpen == 1) {
            if (e.target !== e.currentTarget) return;
            closeSitemapOptions();
        }
    });

    $('#sitemap-data').click(function(e) {
        if(_addLotOpen == 1) {
            if(e.target != this) return;
            closeAddWrapper();
        }
        if(_sitemapOptionsOpen == 1) {
            if(e.target != this) return;
            closeSitemapOptions();
        }
        if (_itemStatusOpen == 1){
            if(e.target != this) return;
            closeItemStatus();
        }
        if (_linkedInventoryOpen == 1){
            if(e.target != this) return;
            closeLinkedInventoryOptions();
        }
        if (_availableModelsOpen == 1){
            if(e.target != this) return;
            closeAvailableModelsOptions();
        }
    });

    $('#delete-button').click(function() {
        if( _numberDeleted < 3 ) {
            if (confirm('Are you sure you want to delete this item?')) {
                console.log('Item deleted.');
                // console.log(_currentItem);
                _currentItem.remove();
                closeSitemapOptions();
                _numberDeleted++;
            } else {
                return;
            }
        } else {
            console.log('Item deleted.');
            _currentItem.remove();
            closeSitemapOptions();
            _numberDeleted++;
        }
        
    });

    $('#status-button').click(function() {
        $('#add-status-wrapper').removeClass('hidden');
        _itemStatusOpen = 1;
    });

    $('#models-button').click(function() {
        showAvailableModelsOptions();
    });

    
    var availableModels;

    $('.available-model-item').click(function() {
        console.log('available-model-item clicked');
        if ( _currentItem.attr('data-models') ) {
            console.log('current item has data-models');
            availableModels = _currentItem.attr('data-models');
            availableModels = JSON.parse(availableModels);
            // console.log('availableModels', availableModels)
        } else {
            console.log('current item does not have data-models')
            availableModels = [];
            // console.log('availableModels', availableModels)
        }
        var itemModelID = $(this).data('model');
        var itemModelName = $(this).data('modelname');
        var modelStatus = $(this).data('status');

        if ( itemModelID == 'emptyItems' ) {
            console.log('clicked empty all items');
            _currentItem.removeClass('bg-gray-lighter bg-model bg-future bg-reserved bg-sold bg-moveinready bg-availablelot bg-availablehome');
            _currentItem.addClass('bg-future');
            _currentItem.data('status', 'future');
            _currentItem.attr('data-status', 'future');

            _currentItem.data('models', []);
            _currentItem.attr('data-models', []);

            $('#current-models').empty();
            $('#current-models').append('<p>N/A</p>');

            return;

        }
        console.log(itemModelID);
        if ( !availableModels.includes(itemModelID) ) { 
            console.log('availableModels', availableModels);
            console.log('itemModelID', itemModelID);
            console.log('available models does not include current model id');
            /*  if data-models for the current lot DOES NOT include the selected model already
                ADD the selected model to the array of models
            */
            availableModels.push(itemModelID);
            // console.log('availableModels', availableModels);
            // console.log('typeof availableModels', typeof availableModels);

            availableModels = JSON.stringify(availableModels);

            _currentItem.removeClass('bg-gray-lighter bg-model bg-future bg-reserved bg-sold bg-moveinready bg-availablelot bg-availablehome');
            _currentItem.addClass('bg-'+modelStatus);
            _currentItem.data('models', availableModels);
            _currentItem.attr('data-models', availableModels);
            _currentItem.data('status', modelStatus);
            _currentItem.attr('data-status', modelStatus);

            var itemModels = _currentItem[0].dataset.modelnames;
            itemModels = JSON.parse(itemModels);
            itemModels.push(itemModelName);
            
            itemModels = JSON.stringify(itemModels);
            _currentItem.data('modelnames', itemModels);
            _currentItem.attr('data-modelnames', itemModels);
            
            itemModels = JSON.parse(itemModels);
            // console.log(itemModels);

            $('.available-model-item').each(function() {
                $(this).removeClass('font-bold');
                // console.log(this.dataset);
                // console.log($(this));
                if( availableModels.indexOf(this.dataset.model*1) > -1 ) {
                    // console.log('indexOf > -1');
                    $(this).addClass('font-bold');
                }
            });

            if ( itemModels ) {
                console.log('There are model names in the current item');
                $('#current-models').empty();
                itemModels.forEach(itemModel => {
                    // console.log(itemModel)
                    $('#current-models').append('<p>'+itemModel+'</p>')
                });
            } else {
                console.log('There are NOT model names in the current item');
                $('#current-models').empty();
                $('#current-models').append('<p>N/A</p>')
            }
        } else {
            /*  if data-models for the current lot DOES include the selected model already
                REMOVE the selected model from the array of models
            */
            console.log('Remove item because current item contains clicked model ID');
            console.log('availableModels', availableModels);
            console.log('itemModelID', itemModelID);
            console.log(itemModelName);
            var removeIndex = availableModels.indexOf(itemModelID);
            console.log('removeIndex', removeIndex);
            if ( removeIndex > -1 ) {
                // remove one array element at position removeIndex
                console.log('availableModels before splice', availableModels);
                availableModels.splice(removeIndex, 1);
                console.log('availableModels after splice', availableModels);
                // console.log('availableModels', availableModels);
                // console.log('typeof availableModels', typeof availableModels);
            }
            if ( availableModels === undefined || availableModels.length == 0 ) {
                _currentItem.removeClass('bg-gray-lighter bg-model bg-future bg-reserved bg-sold bg-moveinready bg-availablelot bg-availablehome');
                _currentItem.addClass('bg-future');
                _currentItem.data('status', 'future');
                _currentItem.attr('data-status', 'future');
            } else {
                _currentItem.removeClass('bg-gray-lighter bg-model bg-future bg-reserved bg-sold bg-moveinready bg-availablelot bg-availablehome');
                _currentItem.addClass('bg-'+modelStatus);
                _currentItem.data('status', modelStatus);
                _currentItem.attr('data-status', modelStatus);
            }

            availableModels = JSON.stringify(availableModels);
            
            _currentItem.data('models', availableModels);
            _currentItem.attr('data-models', availableModels);

            var itemModels = _currentItem[0].dataset.modelnames;
            itemModels = JSON.parse(itemModels);
            console.log('modelNames', itemModels);
            var removeNameIndex = itemModels.indexOf(itemModelName);
            console.log('removeNameIndex', removeNameIndex);
            if ( removeIndex > -1 ) {
                itemModels.splice(removeNameIndex, 1);
                console.log('itemModels after splice', itemModels);
            }
            
            itemModels = JSON.stringify(itemModels);
            console.log('itemModels JSON stringified', itemModels);
            _currentItem.data('modelnames', itemModels);
            _currentItem.attr('data-modelnames', itemModels);
            
            itemModels = JSON.parse(itemModels);
            // console.log(itemModels);

            $('.available-model-item').each(function() {
                $(this).removeClass('font-bold');
                // console.log(this.dataset);
                // console.log($(this));
                if( availableModels.indexOf(this.dataset.model*1) > -1 ) {
                    // console.log('indexOf > -1');
                    $(this).addClass('font-bold');
                }
            });

            if ( itemModels ) {
                $('#current-models').empty();
                itemModels.forEach(itemModel => {
                    // console.log(itemModel)
                    $('#current-models').append('<p>'+itemModel+'</p>');
                });
            } else {
                $('#current-models').empty();
                $('#current-models').append('<p>N/A</p>');
            }

            if ( itemModels.length == 0 ) {
                $('#current-models').empty();
                $('#current-models').append('<p>N/A</p>');
            }
            
        }
        

    });

    $('#available-models-wrapper').parent().click(function(e) {
        if( _availableModelsOpen == 1) {
            if (e.target !== e.currentTarget) return;
            closeAvailableModelsOptions();
        }
    });

    $('#linked-button').click(function() {
        showLinkedInventoryOptions();
    });

    $('.linked-inventory-item').click(function() {
        var linkedInventory = $(this).data('inventory');
        var invStatus = $(this).data('status');
        console.log(linkedInventory);
        _currentItem.removeClass('bg-gray-lighter bg-model bg-future bg-reserved bg-sold bg-moveinready bg-availablelot bg-availablehome');
        _currentItem.addClass('bg-'+invStatus);
        _currentItem.data('inventory', linkedInventory);
        _currentItem.attr('data-inventory', linkedInventory);
        _currentItem.data('status', invStatus);
        _currentItem.attr('data-status', invStatus);

        closeLinkedInventoryOptions();
    });

    $('#link-inventory-wrapper').parent().click(function(e) {
        if( _linkedInventoryOpen == 1) {
            if (e.target !== e.currentTarget) return;
            closeLinkedInventoryOptions();
        }
    });

    $('#add-status-wrapper').parent().click(function(e) {
        if( _itemStatusOpen == 1) {
            if (e.target !== e.currentTarget) return;
            closeItemStatus();
        }
    });

    $('#add-status-wrapper li').click(function() {
        var status = $(this).data('status');
        // console.log('status', status);
        _currentItem.removeClass('bg-gray-lighter bg-model bg-future bg-reserved bg-sold bg-moveinready bg-availablelot bg-availablehome');
        _currentItem.addClass('bg-'+status);
        _currentItem.data('status', status);
        _currentItem.attr('data-status', status);
        closeItemStatus();
    });

    $('#save-button').click(function() {
        // alert('Saved!');
        // run ajax function which takes all of the sitemap-items, deletes all of the rows of the current sitemap's lot data, then saves all the items as new rows
        event.preventDefault();

        var items = [];

        // get all sitemap-items and make an array
        var sitemapItems = $('#sitemap-data .sitemap-item');
        // console.log(sitemapItems);
        // put together all of the items into a json object
        $.each(sitemapItems, function(index, value) {
            // console.log(value);
            var itemLabel = value.attributes[3].value;
            var itemStatus = value.attributes[4].value;
            var itemInventory = value.attributes[5].value;
            if ( value.attributes[7].length != 0 ) {
                var itemModels = value.attributes[7].value;
                console.log(typeof itemModels);
                console.log(itemModels);

                if(itemModels.length === 0 || itemModels === '[]' || itemModels === []) {
                    itemModels = null;
                } else {
                    itemModels = JSON.parse(itemModels);
                    console.log(itemModels);
                    console.log('parsed');
                }    
            } else {
                var itemModels = null;
            }
            var itemTopPos = ( 100.5 * parseFloat( value.offsetTop / parseFloat(value.offsetParent.clientHeight) ) ).toFixed(2);
            var itemTopPos = parseFloat($(value).css('top')) / parseFloat($(value).parent().height()) * 100;
            var itemLeftPos = ( 99.9 * parseFloat( value.offsetLeft / parseFloat(value.offsetParent.clientWidth) ) ).toFixed(2);
            var itemLeftPos = parseFloat($(value).css('left')) / parseFloat($(value).parent().width()) * 100;
            // console.log(itemLabel);
            // console.log(itemStatus);
            // console.log(itemInventory);
            // console.log(itemTopPos);
            // console.log(itemLeftPos);

            var item = {
                'label' : itemLabel,
                'status' : itemStatus,
                'inventory' : itemInventory,
                'top' : itemTopPos,
                'left' : itemLeftPos,
                'models' : itemModels
            };
            // console.log(item);

            items.push(item);
            // console.log(items);
        });
        
        items = JSON.stringify(items);
        console.log(items);

		// Submit the form using AJAX.
		$.ajax({
			type: 'POST',
			url: updateURL,
            data: {
                startIndex : startIndexValue,
                id : postid,
                items: items
            },
			beforeSend: function() {
                // console.log('before send');
                $('#save-button').prop('disabled', true);
                closeSitemapOptions();
                alert('Saving updated items');
			}
		}).done(function(response) {
            console.log(response);
            alert('Sitemap data saved!');
            $('#save-button').removeAttr('disabled');
		}).fail(function(data) {
            console.log(data);
            alert('An error occurred.');
            $('#save-button').removeAttr('disabled');
		});
    });

})(jQuery);