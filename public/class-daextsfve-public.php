<?php

/*
 * this class should be used to work with the public side of wordpress
 */
class Daextsfve_Public{
    
    protected static $instance = null;
    private $shared = null;
    
    /*
     * This numeric array is used to store all the formations used in a single
     * post. The purpose is to avoid adding multiple times the same formation in a single post.
     */
    private $formations_added = array();
    
    private function __construct() {
        
        //assign an instance of the plugin info
        $this->shared = Daextsfve_Shared::get_instance();
        
        //Load public css and js
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'en_public_scripts' ) );
        
        //shortcode
        add_shortcode('soccer-formation-ve', array( $this, 'sc_daextsfve_callback') );

    }
    
    /*
     * create an instance of this class
     */
    public static function get_instance() {

        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
        
    }
    
    /*
     * enqueue public-specific style sheets
     */
    public function enqueue_styles() {

	    //if is set load a google font
	    if( strlen( trim( get_option( $this->shared->get("slug") . "_load_google_font" ) ) )  > 0 ){

		    wp_enqueue_style( $this->shared->get( 'slug' ) . '-google-font',
			    esc_url( get_option( $this->shared->get( 'slug' ) . '_load_google_font' ) ), false );

	    }

	    //Enqueue the main public CSS file
        wp_enqueue_style( $this->shared->get('slug') . '-public-style', $this->shared->get('url') . 'public/assets/css/public.css', array(), $this->shared->get('ver') );

    }
    
    /*
     * enqueue public-specific javascipt
     */
    public function en_public_scripts() {

	    //Enqueue the main public JavaScript file
        wp_enqueue_script( $this->shared->get('slug') . '-public-script', $this->shared->get('url') . 'public/assets/js/public.js', array( 'jquery' ), $this->shared->get('ver') );

	    //Add parameters before the script
	    $parameters_script = 'window.DAEXTSFVE_PARAMETERS = {';
	    $parameters_script .= 'font_size: ' . intval( get_option( $this->shared->get("slug") . "_font_size" ), 10 );
	    $parameters_script .= '};';
	    wp_add_inline_script( $this->shared->get('slug') . '-public-script', $parameters_script, 'before' );

    }
    
    /*
     * callback for the [soccer-formaton-ve] shortcode
     * 
     * @uses sc_generate_formation_output() to get the html of a single formation
     * 
     * @param array $atts user defined attributes in the shortcode tag
     * @return string the html of a single or a double formation
     */
    public function sc_daextsfve_callback( $atts ){

        if( !is_feed() and ( is_single() or is_page() ) ){

            //get the table id
            if(isset($atts['id'])){
                $id = intval($atts['id'], 10);
            }else{
                return '<p>' . esc_html__('Please enter the identifier of the formation.', 'soccer-formation-ve') . '</p>';
            }

            /*
             * if this formation ( $id ) doesn't exists echo an error
             * message
             */
            if( !$this->ut_formation_exists( $id ) ){

                //output an error message
                $output = "<p>" . esc_html__("The formation associated with the [soccer-formation-ve] shortcode doesn't exist.", 'soccer-formation-ve') . "</p>";

            /*
             * if this formation has been already added in this post output
             * an error message
             */
            }elseif( $this->ut_formation_already_added( $id ) ){

                //output an error message
                $output = "<p>" . esc_html__("You can't included multiple times the same formation in single post.", 'soccer-formation-ve') . "</p>";

            /*
             * the html output of this formation will be generated
             */
            }else{

                //generate output for a single formation
                $output = $this->sc_generate_formation_output($id);

            }

            return $output;

        }

    }
    
    /*
     * Return the html of a single formation.
     * 
     * @param int $formation_id the id of the formation
     * @return string the html of a single formation
     */
    public function sc_generate_formation_output($formation_id){
     
        //get formation data
        global $wpdb; $table_name = $wpdb->prefix . $this->shared->get('slug') . "_formations";
        $safe_sql = $wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $formation_id);
        $formation_obj = $wpdb->get_row($safe_sql);

        //OUTPUT -----------------------------------------------------------

        $output = '<div id="daextsfve-container-' . $formation_obj->id .'" class="daextsfve-container" style="' . $this->get_inline_css(".daextsfve-container") . '" >';

            //add players
            for($i=1;$i<=11;$i++){

                //set the player status hidden or visible
                if($this->ut_is_player_hidden( $formation_obj->id, $i )){$player_status = "daextsfve-hidden-player";}else{$player_status = "";}

                $output .= '<div class="daextsfve-player-container ' . $player_status . ' daextsfve-player-container-' . $i . '" style="' . $this->get_inline_css(".daextsfve-player-container") . '" >';

                    $output .= '<div class="daextsfve-player-number" style="' . $this->get_inline_css(".daextsfve-player-number") . '" >' . esc_html(stripslashes($formation_obj->{"player_number_" . $i})) . '</div>';

                    $output .= '<div class="daextsfve-player-name" style="' . $this->get_inline_css(".daextsfve-player-name") . '" >' . esc_html(stripslashes($formation_obj->{"player_name_" . $i})) . '</div>';

                    $output .= '<div class="daextsfve-position-x-' . $i . '" data-id="' . $this->get_player_css_position( $formation_obj->layout_id, $i, "x") . '" ></div>';

                     $output .= '<input type="hidden" class="daextsfve-position-y-' . $i . '" data-id="' . $this->get_player_css_position( $formation_obj->layout_id, $i, "y") . '" >';

                $output .= '</div>';

            }

        $output .= '</div>';
        
        return $output;
        
    }

    /*
     * return the css position of a specified player
     * 
     * @param int $layout_id the layout id
     * @param int $player_number the player number
     * @param string $axis the axis x or y
     * 
     * @return int the x or y coordinate
     */
    public function get_player_css_position($layout_id, $player_number, $axis){

        //get layout data
        global $wpdb; $table_name = $wpdb->prefix . $this->shared->get('slug') . "_layouts";
        $safe_sql = $wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $layout_id);
        $layout_obj = $wpdb->get_row($safe_sql);

        //get position
        $player_x = $layout_obj->{"player_x_" . $player_number};
        $player_y = $layout_obj->{"player_y_" . $player_number};

        return ${"player_" . $axis};
        
    }
    
    /**
     * Returns the inline style of the element based on the given selector
     * 
     * @param string $selector the selector that calls the function
     * @return string the inline style of the element
     */
    public function get_inline_css($selector){

        switch ($selector){
            
            case ".daextsfve-single-formation":
                
                $style = "float: left !important;" .
                        "width: 50% !important;";
                break;
            
            case ".daextsfve-container":

                $style = "position: relative !important;" .
                        "margin-top: " . intval(get_option( $this->shared->get('slug') . "_field_top_margin"),10) . "px !important;" .
                        "margin-bottom: " . intval(get_option( $this->shared->get('slug') . "_field_bottom_margin"),10) . "px !important;" .
                        "margin-left: 0 !important;" .
                        "margin-right: 0 !important;" .
                        "padding: 0 !important;" .
                        "border: 0 !important;" .
                        "max-width: 100% !important;" .
                        "visibility: hidden;" .
                        "background-image: url('" . esc_url($this->shared->get('url') . "shared/assets/img/field.php" . $this->ut_field_query_string()) . "') !important;" .
                        "background-size: contain !important; -webkit-background-size: contain !important; -moz-background-size: contain !important;";
                break;
            
            case ".daextsfve-player-container":

                $style = "position: absolute !important;" .
                        "z-index: 1 !important;" .
                        "border: 0 !important;" .
                        "padding: 0 !important;" .
                        "text-decoration: none !important;" .
                        "background-image: url('" . $this->shared->get('url') . "shared/assets/img/player.php" . $this->ut_player_query_string() . "') !important;" .
                        "background-repeat: no-repeat !important;" .
                        "background-size: contain !important; -webkit-background-size: contain !important; -moz-background-size: contain !important;" .
                        "background-position: center !important;";

                break;
            
            case ".daextsfve-player-number":

                $style = "position: absolute !important;" .
                        "text-transform: uppercase !important;" .
                        "color: #" . str_replace('#', '', sanitize_hex_color(get_option($this->shared->get('slug') . '_player_number_color'))) . " !important;" .
                        "font-family: " . esc_attr(get_option($this->shared->get('slug') . '_font_family')) . " !important;" .
                        "font-weight: " . intval(get_option($this->shared->get('slug') . '_font_weight'), 10) . " !important;" .
                        "text-align: center !important;" .
                        "top: 0 !important;" .
                        "z-index: 1 !important;" .
                        "border: 0 !important;" .
                        "padding: 0 !important;" .
                        "text-decoration: none !important;" .
                        "letter-spacing: 0em !important;" .
                        "box-shadow: none !important;" .
                        "text-shadow: none !important;" .
                        "overflow: hidden !important;";

                break;
            
            case ".daextsfve-player-name":

                $style = "position: absolute !important;" .
                        "text-transform: uppercase !important;" .
                        "color: #" . str_replace('#', '', sanitize_hex_color(get_option($this->shared->get('slug') . '_player_name_color'))) . " !important;" .
                        "font-family: " . esc_attr(get_option($this->shared->get('slug') . '_font_family')) . " !important;" .
                        "font-weight: " . intval(get_option($this->shared->get('slug') . '_font_weight'), 10) . " !important;" .
                        "text-align: center !important;" .
                        "top: 0 !important;" .
                        "text-align: center !important;" .
                        "z-index: 1 !important;" .
                        "border: 0 !important;" .
                        "padding: 0 !important;" .
                        "text-decoration: none !important;" .
                        "letter-spacing: 0em !important;" .
                        "box-shadow: none !important;" .
                        "text-shadow: none !important;" .
                        "overflow: hidden !important;";
                break;
            
        }

        //apply anti div highlight
        $style .= "-webkit-user-select: none !important;".        
                "-moz-user-select: none !important;".
                "-ms-user-select: none !important;".
                "-khtml-user-select: none !important;".
                "-o-user-select: none !important;".
                "user-select: none !important;".
                "-webkit-touch-callout: none !important;";

        return $style;

    }
    
    /**
     * check if this is a hidden player, 
     * 
     * @param int $formation_id the formation id
     * @param int $player_number the player number
     * @return bool true if this player is hidden, false if this player is not
     * hidden
     */
    public function ut_is_player_hidden( $formation_id, $player_number ){

        //get layout id of a formation
        $layout_id = $this->ut_get_layout_id( $formation_id );

        //get layout obj
        global $wpdb; $table_name = $wpdb->prefix . $this->shared->get('slug') . "_layouts";
        $safe_sql = $wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $layout_id);
        $layout_obj = $wpdb->get_row($safe_sql);

        if($layout_obj->{"player_show_" . $player_number}){
            return false;
        }else{
            return true;
        }

    }
    
    /**
     * Returns the layout_id of a formation
     * 
     * @param int $formation_id the formation id
     * @return int The layout id
     */
    public function ut_get_layout_id( $formation_id ){

        //get layout id of a formation
        global $wpdb; $table_name = $wpdb->prefix . $this->shared->get('slug') . "_formations";
        $safe_sql = $wpdb->prepare("SELECT layout_id FROM $table_name WHERE id = %d ", $formation_id);
        $formation_obj = $wpdb->get_row($safe_sql);

        return $formation_obj->layout_id;

    }
    
    /*
     * check if this formation exists
     * 
     * @param int $formation_id the id of the formation
     * @return bool true if the formation exists, false if the formation doesn't
     * exist
     */
    public function ut_formation_exists( $formation_id ){
     
        //get layout id of a formation
        global $wpdb; $table_name = $wpdb->prefix . $this->shared->get('slug') . "_formations";
        $safe_sql = $wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE id = %d ", $formation_id);
        $number_of_records = $wpdb->get_var($safe_sql);

        if( $number_of_records > 0 ){
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
    /*
     * Check if this formation has been already added in this post, the
     * formations already added are available in the $this->formations_added
     * property of this class.
     * 
     * 
     * @param int $formation_id the formation id
     * @return bool true if the formation has been already added, false if the
     * formation has not been already added
     */
    public function ut_formation_already_added( $formation_id ){
    
        if( in_array( $formation_id, $this->formations_added ) ){
            
            //this formations has been already added, return true
            return true;
        
        }else{
         
            /*
             * This formation has not been already added, add this formation
             * to the array that stores all the formations in this post and
             * return false.
             */
            array_push( $this->formations_added, $formation_id );
            return false;
            
        }
        
    }
    
    /*
     * Generate the query string for the dynamically generated svg field based
     * on the plugin option.
     * 
     * @return string the query string
     */
    public function ut_field_query_string(){
        
        //get the colors from the plugin options
        $field_bg_color = get_option( $this->shared->get('slug') . '_field_bg_color');
        $field_lines_color = get_option( $this->shared->get('slug') . '_field_lines_color');
        
        //generate the query string
        $query_string = '?field_bg_color=' . str_replace('#', '', sanitize_hex_color($field_bg_color)) . '&';
        $query_string .= 'field_lines_color=' . str_replace('#', '', sanitize_hex_color($field_lines_color));
        
        //output the query string
        return $query_string;
        
    }
    
    /*
     * Generate the query string for the dynamically generated svg player based
     * on the plugin options.
     * 
     * @return string the query string
     */
    public function ut_player_query_string(){
        
        //get the colors from the plugin options
        $player_number_bg_color = sanitize_hex_color(get_option( $this->shared->get('slug') . '_player_number_bg_color'));
        $player_name_bg_color = sanitize_hex_color(get_option( $this->shared->get('slug') . '_player_name_bg_color'));
        
        //generate the query string
        $query_string = '?player_number_bg_color=' . str_replace('#', '', sanitize_hex_color($player_number_bg_color)) . '&';
        $query_string .= 'player_name_bg_color=' . str_replace('#', '', sanitize_hex_color($player_name_bg_color));
        
        //output the query string
        return $query_string;
        
    }
    
}