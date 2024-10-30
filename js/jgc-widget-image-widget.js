jQuery(document).ready( function(){
	
     function media_upload( button_class) {

        var _custom_media = true, _orig_send_attachment = wp.media.editor.send.attachment;

        jQuery('body').on('click',button_class, function(e) {
    		
    		var aux_id = jQuery(this).attr('name');
    		var num_widget = aux_id.substr(21);

            var button_id ='#'+jQuery(this).attr('id');
            var self = jQuery(button_id);
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = jQuery(button_id);
            var id = button.attr('id').replace('_button', '');
            _custom_media = true;

            wp.media.editor.send.attachment = function(props, attachment){

                if ( _custom_media  ) { 
    				
    				var img_wh = attachment.width + 'x' + attachment.height;

    				jQuery('input#url_imagen_widget_' + num_widget).val(attachment.url);
    				jQuery('input#url_imagen_widget_' + num_widget).trigger('change'); // To update image in the customizer.
    				jQuery('input#id_imagen_widget_' + num_widget).val(attachment.id);
    				jQuery('img#img_imagen_widget_' + num_widget).attr('src',attachment.url).css('display','block'); 
    				jQuery('div#img_info_' + num_widget).text(img_wh); 

                } else {

                    return _orig_send_attachment.apply( button_id, [props, attachment] );
                    
                }
            }

            wp.media.editor.open(button);
            return false;

        });
    }

    media_upload( '.button-img-widget-upload');

});