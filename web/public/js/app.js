$(document).on('ready', function(){

    // Tooltip
    $('[data-original-title]').tooltip()

    // Modale de confirmation standard
    $('[data-confirm]').on('click', function(e){
        e.preventDefault();
        var type = $(this).data('confirm');
        Global.modal
            .reset()
            .setModalClass('modal-' + type)
            .setTitle($(this).data('confirm-title'))
            .setBodyContent($(this).data('confirm-content'))
            .setFooterContent('<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>')
            .addFooterContent('<a class="btn btn btn-' + type + '" href="' + $(this).attr('href') + '">' + $(this).data('confirm-action') + '</a>')
            .show()
        ;
    });
})