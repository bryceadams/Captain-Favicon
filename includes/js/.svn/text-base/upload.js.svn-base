jQuery(document).ready(function($){
	$('#upload_favicon_button').click(function() {
		tb_show('Upload a Favicon', 'media-upload.php?referer=ctfavicon-settings&amp;type=image&amp;TB_iframe=true&amp;post_id=0', false);
		return false;
	});
	
	window.send_to_editor = function(html) {
		var image_url = $('img',html).attr('src');
		$('#favicon_url').val(image_url);
		tb_remove();
		$('#upload_favicon_preview img').attr('src',image_url);
		
		$('#submit_options_form').trigger('click');
	}
	
	
	
});