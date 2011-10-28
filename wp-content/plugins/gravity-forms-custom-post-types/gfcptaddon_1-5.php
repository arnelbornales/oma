<?php

if (!class_exists('GFCPTAddon1_5')) {

    /*
     * GFCPT Addon class targetting version 1.5 of Gravity Forms
     */
    class GFCPTAddon1_5 extends GFCPTAddonBase {

        /*
         * Override. Include a couple more hooks
         */
        public function init() {
            //hook up the defaults
            parent::init();

            //then add these for 1.5...
            //add our advanced options to the form builder
            add_action('gform_field_advanced_settings', array(&$this, 'render_field_advanced_settings'), 10, 2);

            //include javascript for the form builder
            add_action('gform_editor_js', array(&$this, 'render_editor_js'));

            // filter to add a new tooltip
            add_filter('gform_tooltips', array(&$this, 'add_gf_tooltips'));
        }

        /*
         * Override. Gets the taxonomy from our new field value
         */
        function get_field_taxonomy( $field ) {
          if (array_key_exists('populateTaxonomy', $field)) {
            return $field['populateTaxonomy'];
          } else {
            return false;
          }
        }

        /*
         * Override. Gets the custom post type from the post title field value
         */
        function get_form_post_type( $form ) {
            foreach ( $form['fields'] as $field ) {
                if ( $field['type'] == 'post_title' && $field['saveAsCPT'] )
                    return $field['saveAsCPT'];
            }
            return false;
        }

        /*
         * Add tooltips for the new field values
         */
        function add_gf_tooltips($tooltips){
           $tooltips["form_field_custom_taxonomy"] = "<h6>Populate with a Taxonomy</h6>Check this box to populate this field from a custom taxonomy.";
           $tooltips["form_field_custom_post_type"] = "<h6>Save As Custom Post Type</h6>Check this box to save this form to a custom post type.";
           return $tooltips;
        }

        /*
         * Add some advanced settings to the fields
         */
         function render_field_advanced_settings($position, $form_id){

            if($position == 50){
                ?>
                <li class="populate_with_taxonomy_field_setting field_setting" style="display:list-item;">
                    <input type="checkbox" id="field_enable_populate_with_taxonomy" />
                    <label for="field_enable_populate_with_taxonomy" class="inline">
                        <?php _e("Populate with a Taxonomy", "gravityforms"); ?>
                    </label>
                    <?php gform_tooltip("form_field_custom_taxonomy") ?><br />
                    <select id="field_populate_taxonomy" onchange="SetFieldProperty('populateTaxonomy', jQuery(this).val());" style="margin-top:10px; display:none;">
                        <option value="" style="color:#999;">Select a Taxonomy</option>
                    <?php
                    $args=array(
                      'public'   => true,
                      '_builtin' => false
                    );
                    $taxonomies = get_taxonomies($args, 'objects');
                    foreach($taxonomies as $taxonomy): ?>
                        <option value="<?php echo $taxonomy->name; ?>"><?php echo $taxonomy->label; ?></option>
                    <?php endforeach; ?>
                    </select>

                </li>
                <li class="custom_post_type_field_setting field_setting" style="display:list-item;">
                    <input type="checkbox" id="field_enable_custom_post_type" />
                    <label for="field_enable_custom_post_type" class="inline">
                        <?php _e("Save As Custom Post Type", "gravityforms"); ?>
                    </label>
                    <?php gform_tooltip("form_field_custom_post_type") ?><br />
                    <select id="field_populate_custom_post_type" onchange="SetFieldProperty('saveAsCPT', jQuery(this).val());" style="margin-top:10px; display:none;">
                        <option value="" style="color:#999;">Select a Custom Post Type</option>
                    <?php
                    $args=array(
                      'public'   => true
                    );
                    $post_types = get_post_types($args, 'objects');
                    foreach($post_types as $post_type): ?>
                        <option value="<?php echo $post_type->name; ?>"><?php echo $post_type->label; ?></option>
                    <?php endforeach; ?>
                    </select>

                </li>
                <?php
            }

        }

        /*
         * render some custom JS to get the settings to work
         */
        function render_editor_js(){
            ?>
            <script type='text/javascript'>

                jQuery(document).bind("gform_load_field_settings", function(event, field, form){
                    //only show taxonomy for selects and radios
                    var valid_types = new Array('select', 'radio', 'checkbox');
                    if(jQuery.inArray(field['type'], valid_types) != -1) {
                        var $taxonomy_setting_container = jQuery(".populate_with_taxonomy_field_setting");
                        //show the setting container!
                        $taxonomy_setting_container.show();

                        //get the saved taxonomy
                        var populateTaxonomy = (typeof field['populateTaxonomy'] != 'undefined' && field['populateTaxonomy'] != '') ? field['populateTaxonomy'] : false;

                        if (populateTaxonomy != false) {
                            //check the checkbox if previously checked
                            $taxonomy_setting_container.find("input:checkbox").attr("checked", "checked");
                            //set the select and show
                            $taxonomy_setting_container.find("select").val(populateTaxonomy).show();
                        } else {
                            $taxonomy_setting_container.find("input:checkbox").removeAttr("checked");
                            $taxonomy_setting_container.find("select").val('').hide();
                        }
                    } else if (field['type'] == 'post_title') {
                        var $cpt_setting_container = jQuery(".custom_post_type_field_setting");

                        $cpt_setting_container.show();

                        var saveAsCPT = (typeof field['saveAsCPT'] != 'undefined' && field['saveAsCPT'] != '') ? field['saveAsCPT'] : false;

                        if (saveAsCPT != false) {
                            //check the checkbox if previously checked
                            $cpt_setting_container.find("input:checkbox").attr("checked", "checked");
                            //set the select and show
                            $cpt_setting_container.find("select").val(saveAsCPT).show();
                        } else {
                            $cpt_setting_container.find("input:checkbox").removeAttr("checked");
                            $cpt_setting_container.find("select").val('').hide();
                        }
                    }
                });

                jQuery(".populate_with_taxonomy_field_setting input:checkbox").click(function() {
                    var checked = jQuery(this).is(":checked");
                    var $select = jQuery(this).parent(".populate_with_taxonomy_field_setting:first").find("select");
                    if(checked){
                        $select.slideDown();
                    } else {
                        SetFieldProperty('populateTaxonomy','');
                        $select.slideUp();
                    }
                });

                jQuery(".custom_post_type_field_setting input:checkbox").click(function() {
                    var checked = jQuery(this).is(":checked");
                    var $select = jQuery(this).parent(".custom_post_type_field_setting:first").find("select");
                    if(checked){
                        $select.slideDown();
                    } else {
                        SetFieldProperty('saveAsCPT','');
                        $select.slideUp();
                    }
                });

            </script>
            <?php
        }

    }

}
?>