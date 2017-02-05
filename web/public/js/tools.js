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

// Bootstrap notify
var notify = {
    settings: {
        element         : 'body',
        allow_dismiss   : true,
        newest_on_top   : true,
        showProgressbar : false,
        placement       : {
            from: 'top',
            align: 'right'
        },
        offset      : 10,
        spacing     : 5,
        z_index     : 1031,
        delay       : 5000,
        timer       : 500,
        mouse_over  : 'pause',
        animate     : {
            enter   : 'animated fadeInDown',
            exit    : 'animated fadeOutRight'
        },
        type        : 'info',
        icon        : 'fa fa-info',
        template    :
        '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss"><span aria-hidden="true">×</span></button>' +
        '<span data-notify="icon"></span> ' +
        '<span data-notify="title">{1}</span> ' +
        '<span data-notify="message">{2}</span>' +
        '<div class="progress" data-notify="progressbar"></div>' +
        '<a href="{3}" target="{4}" data-notify="url"></a>' +
        '</div>'
    },
    simpleMessage: function(message, type, icon){
        var settings = this.settings;
        if (typeof type == 'string'){ settings.type = type; }
        if (typeof icon == 'string'){settings.icon = icon;}
        $.notify({
            message: '<i class="' + settings.icon + '"></i>&nbsp;&nbsp;' + message
        }, settings);
    }
}