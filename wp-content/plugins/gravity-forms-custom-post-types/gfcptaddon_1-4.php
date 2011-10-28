<?php

if (!class_exists('GFCPTAddon1_4')) {

    class GFCPTAddon1_4 extends GFCPTAddonBase {

        /*
         * Override. Extract taxonomy from CSS class name
         */
        function get_field_taxonomy( $field ) {
            return self::extract_value( $field['cssClass'], 'taxonomy-' );
        }

        /*
         * Override. Extract post type from CSS class name
         */
        function get_form_post_type( $form ) {
            $cpt = self::extract_value( $form['cssClass'], 'posttype-' );
            if ( !$cpt ) {
                //try to extract it from the post title field
                foreach ( $form['fields'] as $field ) {
                    if ( $field['type'] == 'post_title' )
                        return self::extract_value( $field['cssClass'], 'posttype-' );
                
                }
            }
            return $cpt;
        }

        /*
         * extract the css class name by prefix
         */
        private static function extract_value( $class_names, $prefix ) {
            $classes = explode(' ', $class_names);

            foreach($classes as $class) {
                //check if the class starts with $prefix
                if(GFCPTAddon::starts_with($class, $prefix)) {
                    return str_replace($prefix, '', $class);
                }
            }

            return false;
        }
    }
}

?>