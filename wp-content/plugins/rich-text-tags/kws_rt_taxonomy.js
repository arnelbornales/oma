// For use with Rich Text Tags, Categories, and Taxonomies WordPress Plugin

//this is for compatability with cforms
var purl = '';

jQuery(document).ready(function($) {
	
		// Add the Rich Text Editor to the "description" textarea
		tinyMCE.execCommand('mceAddControl',false,'content');
			
		if($().prop) {
			$("textarea#description,textarea#tag-description,textarea#category_description").prop('id', 'content');
			$("label[for='description'],label[for='tag-description'],label[for='category_description']").prop('for', 'content');
		} else {		
			$("textarea#description,textarea#tag-description,textarea#category_description").attr('id', 'content');
			$("label[for='description'],label[for='tag-description'],label[for='category_description']").attr('for', 'content');
		}
		
		// We do this the right way on the Update (Edit) page.
		if($('.wp-list-table').length === 0) {
			tinyMCE.settings['save_callback'] = function (e,c,body) { return c; }
			$('label[for="content"]').parent().append('<div id="toggleRichText" class="hide-if-no-js"><p><a href="#">Toggle Rich Text Editor</a></p></div>');
		} else { // Otherwise, we hack it.
			
			$('label[for="content"]').append('<a id="toggleRichText" class="hide-if-no-js alignright" href="#">Toggle Rich Text Editor</a>');
			
			// We've added an invalid element to trap the submission process
			$('#addtag').prepend('<div class="form-field form-required hide-if-js"><input aria-required="true" type="hidden" id="richtextadded" /></div>');
			
			$('#submit').click(function(){
				
				$('#wpbody form textarea').html(tinyMCE.activeEditor.getContent({format : 'raw'}));
								
				$('#richtextadded').val('1').removeClass('form-invalid');  
				if(validateForm($(this).parents('form'))) {
					if($('table.wp-list-table.widefat').length > 0) {
						tinyMCE.activeEditor.setContent('<p><br data-mce-bogus="1"></p>',{format : 'raw'});
					}
				} else {
					$('#richtextadded').val('').addClass('form-invalid'); 
				}
			});
		}
		
		$('#toggleRichText').click(function(e) {
			e.preventDefault();
			tinyMCE.execCommand('mceToggleEditor',false,'content');
			return false;
		});	
		
		// Move floating media buttons into the media buttons div
		$('#editor-toolbar').remove().prependTo($("textarea#content").parent());
		$('.wrap form a[href*=TB_inline]:has(img)').remove().appendTo('#media-buttons');
		$('.wrap form a[href=#]:has(img)').remove().appendTo('#media-buttons');
		
});	/* end ready() */	