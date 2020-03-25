jQuery(document).ready(function ($) {
	'use strict';
 
	$('.ctc_reset_data').on('click',function(){
            var post_id = $('#post_ID').val() 
            $.ajax({
                  url: ajaxurl,
                  type: "POST",
                  dataType: "json",
                  data: {
                      action: 'ctc_reset_countdown',
                      post_id:post_id
                  },
                  success: function(d) {
                      $('.wp-heading-inline').after('<div id="message" class="updated notice notice-success is-dismissible"><p>All users data are reseted with success!</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>')
                

                   }
              });
      
         });

});
