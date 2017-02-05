// Modale globale
var globalModalObj = {

    id      : '#global-modal',
    header  : '#global-modal .modal-header',
    body    : '#global-modal .modal-body',
    footer  : '#global-modal .modal-footer',
    title   : '#global-modal .modal-title',
    view    :       "<div class='modal-dialog'>"
    + "<div class='modal-content'>"
    + "<div class='modal-header'>"
    + "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"
    + "<h4 class='modal-title'></h4>"
    + "</div>"
    + "<div class='modal-body'></div>"
    + "<div class='modal-footer'>"
    + "<button type='button' class='btn btn-default' data-dismiss='modal'>Fermer</button>"
    + "</div>"
    + "</div>"
    + "</div>",
    class_modal_container : null,

    init: function(){
        $(this.id).html( this.view );
        this.class_modal_container = $(this.id).closest('.modal').attr('class');
        return this;
    },

    show: function(){
        $(this.id).modal('show');
    },

    hide: function(){
        $(this.id).modal('hide');
    },

    setTitle: function(content){
        $(this.title).html(content);
        return this;
    },

    setBodyContent: function(content){
        $(this.body).html(content);
        return this;
    },

    addFooterContent: function(content){
        var footer_content = $(this.footer).html();
        $(this.footer).html( footer_content + content );
        return this;
    },

    setFooterContent: function(content){
        if( content == null ){
            $(this.id).find('.modal-footer').remove();
        }else{
            $(this.footer).html( content );
        }
        return this;
    },

    setTitleClass: function(c){
        $(this.title).attr('class', 'modal-title ' + c);
        return this;
    },

    setFooterClass: function(c){
        $(this.footer).attr('class', 'modal-footer ' + c );
        return this;
    },

    setHeaderClass: function(c){
        $(this.header).attr('class', 'modal-header ' + c);
        return this;
    },

    setModalClass: function(c){
        $(this.id).addClass(c);
        return this;
    },

    reset: function(){
        $(this.id).html( this.view ).closest('.modal').attr('class', this.class_modal_container);
        return this;
    },

    setWidth: function(width){
        $(this.id + ' .modal-dialog').attr('style', 'width:' + width + 'px !important;')
        return this;
    },

    getId: function(){
        return this.id;
    }
}
var GlobaleModal = Object.create(globalModalObj).init();

// Notification
var notify = {
    options: {
        "closeButton": true,
        "debug": false,
        "progressBar": true,
        "preventDuplicates": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "400",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    },

    message: function(type, message, title){
        try {
            var title = typeof title == 'string' ? title : null;
            toastr[type](message, title, this.options);
        } catch (e){
            console.log(e);
        }
    }
}