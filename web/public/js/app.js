$(document).on('ready', function(){

    // Tooltip
    $('[data-original-title]').tooltip()

    // Modale de confirmation standard
    $('[data-confirm]:not(:disabled)').on('click', function(e){
        if ($(e.target).attr('disabled') == 'disabled') {
            return false;
        }
        e.preventDefault();
        var type = $(this).data('confirm');
        Global.modal
            .reset()
            .setModalClass('modal-' + type)
            .setTitle($(this).data('confirm-title'))
            .setBodyContent($(this).data('confirm-content'))
            .setFooterContent('<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>')
            .addFooterContent('<a class="btn btn btn-' + type + '" href="' + $(this).attr('href') + '">' + $(this).data('confirm-action') + '</a>')
            .setWidth(400)
            .show()
        ;
    });

    // Flash message
    $.each($('#flash-message-container li'), function(key, item) {
        var $_item = $(item);
        Global.notify.message($_item.data('type'), $_item.html());
    });
})