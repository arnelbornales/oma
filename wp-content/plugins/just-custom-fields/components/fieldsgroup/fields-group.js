var jcf_fieldsgroup_max_index = 0;
jQuery(document).ready(function() {

	var node = jQuery('#post-body-content');
	if( node.find('div.jcf-fieldsgroup-field').size() == 0 ) return;
	
	jcf_fieldsgroup_max_index = jQuery('#post-body-content div.jcf-fieldsgroup-row').size();
	
	node.find('div.jcf-fieldsgroup-field a.jcf_delete').live( 'click', function() {
		var row = jQuery(this).parents('div.jcf-fieldsgroup-row:first');
		row.find('div.jcf-fieldsgroup-container').css({'opacity': 0.3});
		row.find('div.jcf-delete-layer')
			.show()
			.find('input:hidden').val('1');
		return false;
	});

	node.find('div.jcf-fieldsgroup-field a.jcf_cancel').live( 'click' ,function() {
		var row = jQuery(this).parents('div.jcf-fieldsgroup-row:first');
		row.find('div.jcf-fieldsgroup-container').css({'opacity': 1});
		row.find('div.jcf-delete-layer')
			.hide()
			.find('input:hidden').val('0');
		return false;
	});
	
	// add more button
	node.find('div.jcf-fieldsgroup-field a.jcf_add_more').click(function(){
		var container = jQuery(this).parent();
		
		jcf_fieldsgroup_max_index++;
		var new_html = container.find('div.jcf-fieldsgroup-row:first').html();
		new_html = new_html
			.replace(/\[00\]/g, '[' + jcf_fieldsgroup_max_index + ']')
			.replace(/\-00\-/g, '-' + jcf_fieldsgroup_max_index + '-');
		new_html = '<div class="jcf-fieldsgroup-row">' + new_html + '</div>';
		
		// add new html row
		container.find('div.jcf-fieldsgroup-row:last').after( new_html );
		
		return false;
	})

});