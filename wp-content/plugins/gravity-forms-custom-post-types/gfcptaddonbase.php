<?php

if (!class_exists('GFCPTAddonBase')) {

    /*
     * Base class for the GFCPT Addon. All common code is in here and differences per version are overrided
     */
    class GFCPTAddonBase {

        /*
         * Main initilize method for wiring up all the hooks
         */
        public function init() {
            //alter the way forms are rendered by inserting taxomony dropdowns,radios and checkboxes
            add_filter('gform_pre_render' , array(&$this, 'setup_form') );

            //alter the form for submission - this is mainly for checkboxes
            add_filter('gform_pre_submission_filter', array(&$this, 'setup_form') );

            //set the post type when saving a post
            add_filter("gform_post_data", array(&$this, 'set_post_type'), 10, 2);

            //intercept the form save and save any taxonomy links if needed
            add_action('gform_post_submission', array(&$this, 'save_taxonomies'), 10, 2);
        }

        /*
         * Setup the form with any taxonomies
         */
        function setup_form( $form ) {
        
          //loop thru all fields
          foreach($form['fields'] as &$field) {
            //see if the field is using a taxonomy
            $taxonomy = $this->get_field_taxonomy( $field );

            if(!$taxonomy)
                continue;

            $this->setup_taxonomy_field( $field, $taxonomy );
          }

          return $form;
        }

        /*
         * Set the post type (if set)
         */
        function set_post_type( $post_data, $form ) {

            //check if the form saves a post
            if ( $this->is_form_a_post_form($form) ) {
                $target_post_type = $this->get_form_post_type( $form );

                if ($target_post_type)
                    $post_data["post_type"] = $target_post_type;
            }
            return $post_data;

        }

        /*
         * Checks if a form includes a 'post field'
         */
        function is_form_a_post_form( $form ) {
            foreach ($form["fields"] as $field) {
                if(in_array($field["type"],
                        array("post_category","post_title","post_content",
                            "post_excerpt","post_tags","post_custom_fields","post_image")))
                    return true;
            }
            return false;
        }

        /*
         * override this to get the post type for a form
         */
        function get_form_post_type( $form ) {
            return null;
        }

        /*
         * override this to get the taxonomy for a field
         */
        function get_field_taxonomy( $field ) {
            return null;
        }


        /*
         * setup a field if it is linked to a taxonomy
         */
        function setup_taxonomy_field( &$field, $taxonomy ) {
            $first_choice = $field['choices'][0]['text'];
            $field['choices'] = $this->load_taxonomy_choices( $taxonomy, $field['type'], $first_choice );

            //now check if we are dealing with a checkbox list and do some extra magic
            if ( $field['type'] == 'checkbox' ) {
                //clear the inputs first
                $field['inputs'] = array();

                $counter = 0;
                //recreate the inputs so they are captured correctly on form submission
                foreach( $field['choices'] as $choice ) {
                    $counter++;
                    if ( ($counter % 10) == 0 ) $counter++; //thanks to Peter Schuster for the help on this fix
                    $id = floatval( $field['id'] . '.' . $counter );
                    $field['inputs'][] = array('label' => $choice['text'], 'id' => $id);
                }
            }
        }

        /*
         * Load any taxonomy terms
         */
        function load_taxonomy_choices($taxonomy, $type, $first_choice = '') {
            $choices = array();

            if ($type === 'select') {
                $terms = $this->load_taxonomy_hierarchical( $taxonomy );
                if ($first_choice === ''){
                    // if no default option is specified, dynamically create based on taxonomy name
                    $taxonomy = get_taxonomy($taxonomy);
                    $choices[] = array('text' => "-- select a {$taxonomy->labels->singular_name} --", 'value' => '');
                } else {
                    $choices[] = array('text' => $first_choice, 'value' => '');
                }
            } else {
                $terms = get_terms($taxonomy, 'orderby=name&hide_empty=0');
            }

            foreach($terms as $term) {
                $choices[] = array('value' => $term->term_id, 'text' => $term->name);
            }

            return $choices;
        }

        /*
         * Get a hierarchical list of taxonomies
         */
        function load_taxonomy_hierarchical( $taxonomy ) {
            $args = array(
                'taxonomy'      => $taxonomy,
                'orderby'       => 'name',
                'hierarchical'  => 1,
                'hide_empty'    => 0
            );
            $terms = get_categories( $args );
            return $this->walk_terms( $terms );
        }

        /*
         * Helper function to recursively 'walk' the taxonomy terms
         */
        function walk_terms( $input_array, $parent_id=0, &$out_array=array(), $level=0 ){
            foreach ( $input_array as $item ) {
                if ( $item->parent == $parent_id ) {
                        $item->name = str_repeat('--', $level) . $item->name;
                        $out_array[] = $item;
                        $this->walk_terms( $input_array, $item->term_id, $out_array, $level+1 );
                }
            }
            return $out_array;
        }

        /*
         * Loop through all fields and save any linked taxonomies
         */
        function save_taxonomies( $entry, $form ) {
            // Check if the submission contains a WordPress post
            if ( isset ( $entry['post_id'] ) ) {

                foreach( $form['fields'] as &$field ) {

                    $taxonomy = $this->get_field_taxonomy( $field );

                    if ( !$taxonomy ) continue;

                    $this->save_taxonomy_field( $field, $entry, $taxonomy );
                }
            }
        }

        /*
         * Save linked taxonomies for a sinle field
         */
        function save_taxonomy_field( &$field, $entry, $taxonomy ) {
            if ( array_key_exists( 'type', $field ) && $field['type'] == 'checkbox' ) {
                $term_ids = array();
                foreach ( $field['inputs'] as $input ) {
                    $term_id = (int) $entry[ (string) $input['id'] ];
                    if ( $term_id > 0 )
                        $term_ids[] = $term_id;
                }
                if ( !empty ( $term_ids ))
                    wp_set_object_terms( $entry['post_id'], $term_ids, $taxonomy, true );

            } else {
                $term_id = (int) $entry[$field['id']];
                if ( $term_id > 0 )
                    wp_set_object_terms( $entry['post_id'], $term_id, $taxonomy, true );
            }
        }
    }
}

?>