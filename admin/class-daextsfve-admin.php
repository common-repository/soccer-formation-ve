<?php

/*
 * this class should be used to work with the administrative side of wordpress
 */
class Daextsfve_Admin{
    
    protected static $instance = null;
    private $shared = null;
    private $screen_id_formations = null;
    private $screen_id_layouts = null;
	private $screen_id_help = null;
	private $screen_id_soccer_engine = null;
    private $screen_id_options = null;

	private $menu_options = null;

    private function __construct() {

        //assign an instance of the plugin info
        $this->shared = Daextsfve_Shared::get_instance();
        
        //Load admin style sheet and JavaScript.
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

        //Load the options API registrations and callbacks
        add_action('admin_init', array( $this, 'op_register_options' ));
        
        //Add the admin menu
        add_action( 'admin_menu', array( $this, 'me_add_menu' ) );

	    //Require and instantiate the class used to register the menu options
	    require_once( $this->shared->get( 'dir' ) . 'admin/inc/class-daextsfve-menu-options.php' );
	    $this->menu_options = new Daextsfve_Menu_Options( $this->shared );

    }
    
    /*
     * return an istance of this class
     */
    public static function get_instance() {

        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
            
    }
    
    /*
     * enqueue admin-specific style sheet
     */
    public function enqueue_admin_styles() {

        $screen = get_current_screen();

	    //menu formations
	    if ($screen->id == $this->screen_id_formations) {

		    //Select2
		    wp_enqueue_style( $this->shared->get( 'slug' ) . '-select2',
			    $this->shared->get( 'url' ) . 'admin/assets/inc/select2/dist/css/select2.min.css', array(),
			    $this->shared->get( 'ver' ) );
		    wp_enqueue_style( $this->shared->get( 'slug' ) . '-select2-custom',
			    $this->shared->get( 'url' ) . 'admin/assets/css/select2-custom.css', array(),
			    $this->shared->get( 'ver' ) );
	    	
		    //jQuery UI Dialog
		    wp_enqueue_style($this->shared->get('slug') . '-jquery-ui-dialog',
			    $this->shared->get('url') . 'admin/assets/css/jquery-ui-dialog.css', array(),
			    $this->shared->get('ver'));
		    wp_enqueue_style($this->shared->get('slug') . '-jquery-ui-dialog-custom',
			    $this->shared->get('url') . 'admin/assets/css/jquery-ui-dialog-custom.css', array(),
			    $this->shared->get('ver'));

            wp_enqueue_style($this->shared->get('slug') . '-jquery-ui-tooltip-custom', $this->shared->get('url') . 'admin/assets/css/jquery-ui-tooltip-custom.css', array(), $this->shared->get('ver'));
            wp_enqueue_style($this->shared->get('slug') . '-framework-menu', $this->shared->get('url') . 'admin/assets/css/framework/menu.css', array(), $this->shared->get('ver'));
		    wp_enqueue_style( $this->shared->get('slug') .'-menu-formations', $this->shared->get('url') . 'admin/assets/css/menu-formations.css', array(), $this->shared->get('ver') );

	    }
        
        if ( $screen->id == $this->screen_id_layouts ) {

            //if is set load a google font
            if( strlen( trim( get_option( $this->shared->get("slug") . "_load_google_font" ) ) )  > 0 ){

                wp_enqueue_style( $this->shared->get( 'slug' ) . '-google-font',
                    esc_url( get_option( $this->shared->get( 'slug' ) . '_load_google_font' ) ), false );

            }

	        //Select2
	        wp_enqueue_style( $this->shared->get( 'slug' ) . '-select2',
		        $this->shared->get( 'url' ) . 'admin/assets/inc/select2/dist/css/select2.min.css', array(),
		        $this->shared->get( 'ver' ) );
	        wp_enqueue_style( $this->shared->get( 'slug' ) . '-select2-custom',
		        $this->shared->get( 'url' ) . 'admin/assets/css/select2-custom.css', array(),
		        $this->shared->get( 'ver' ) );
        	
	        //jQuery UI Dialog
	        wp_enqueue_style($this->shared->get('slug') . '-jquery-ui-dialog',
		        $this->shared->get('url') . 'admin/assets/css/jquery-ui-dialog.css', array(),
		        $this->shared->get('ver'));
	        wp_enqueue_style($this->shared->get('slug') . '-jquery-ui-dialog-custom',
		        $this->shared->get('url') . 'admin/assets/css/jquery-ui-dialog-custom.css', array(),
		        $this->shared->get('ver'));

            wp_enqueue_style($this->shared->get('slug') . '-jquery-ui-tooltip-custom', $this->shared->get('url') . 'admin/assets/css/jquery-ui-tooltip-custom.css', array(), $this->shared->get('ver'));
            wp_enqueue_style($this->shared->get('slug') . '-framework-menu', $this->shared->get('url') . 'admin/assets/css/framework/menu.css', array(), $this->shared->get('ver'));
	        wp_enqueue_style( $this->shared->get('slug') .'-menu-layouts', $this->shared->get('url') . 'admin/assets/css/menu-layouts.css', array(), $this->shared->get('ver') );
            wp_enqueue_style( $this->shared->get('slug') .'-admin-style-draggable', $this->shared->get('url') . 'admin/assets/css/draggable.css', array(), $this->shared->get('ver') );

        }

	    //Menu Help
	    if ($screen->id == $this->screen_id_help) {

		    wp_enqueue_style($this->shared->get('slug') . '-menu-help',
			    $this->shared->get('url') . 'admin/assets/css/menu-help.css', array(), $this->shared->get('ver'));

	    }

        //Menu Soccer Engine
        if ($screen->id == $this->screen_id_soccer_engine) {

            wp_enqueue_style($this->shared->get('slug') . '-menu-soccer-engine',
                $this->shared->get('url') . 'admin/assets/css/menu-soccer-engine.css', array(), $this->shared->get('ver'));

        }

	    if ( $screen->id == $this->screen_id_options ) {

		    //Select2
		    wp_enqueue_style( $this->shared->get( 'slug' ) . '-select2',
			    $this->shared->get( 'url' ) . 'admin/assets/inc/select2/dist/css/select2.min.css', array(),
			    $this->shared->get( 'ver' ) );
		    wp_enqueue_style( $this->shared->get( 'slug' ) . '-select2-custom',
			    $this->shared->get( 'url' ) . 'admin/assets/css/select2-custom.css', array(),
			    $this->shared->get( 'ver' ) );

		    wp_enqueue_style('wp-color-picker');

            wp_enqueue_style($this->shared->get('slug') . '-framework-options', $this->shared->get('url') . 'admin/assets/css/framework/options.css', array(), $this->shared->get('ver'));
		    wp_enqueue_style($this->shared->get('slug') . '-jquery-ui-tooltip-custom', $this->shared->get('url') . 'admin/assets/css/jquery-ui-tooltip-custom.css', array(), $this->shared->get('ver'));

	    }

    }
    
    /*
     * enqueue admin-specific javascript
     */
    public function enqueue_admin_scripts() {

        //Store the JavaScript parameters in the window.DAEXTSFVE_PARAMETERS object
        $php_data = 'window.DAEXTSFVE_PARAMETERS = {';
        $php_data .= 'admin_url: "' . get_admin_url() . '"';
        $php_data .= '};';

	    $wp_localize_script_data = array(
		    'deleteText' => esc_html__( 'Delete', 'soccer-formation-ve'),
		    'cancelText' => esc_html__( 'Cancel', 'soccer-formation-ve'),
	    );
    	
        $screen = get_current_screen();

	    //menu formations
	    if ( $screen->id == $this->screen_id_formations ) {

	        //JQuery UI Tooltips
            wp_enqueue_script('jquery-ui-tooltip');
            wp_enqueue_script($this->shared->get('slug') . '-jquery-ui-tooltip-init', $this->shared->get('url') . 'admin/assets/js/jquery-ui-tooltip-init.js', array('jquery'), $this->shared->get('ver'));

            //Select2
		    wp_enqueue_script( $this->shared->get( 'slug' ) . '-select2',
			    $this->shared->get( 'url' ) . 'admin/assets/inc/select2/dist/js/select2.min.js', array('jquery'),
			    $this->shared->get( 'ver' ) );

		    //Formations Menu
		    wp_enqueue_script( $this->shared->get( 'slug' ) . '-menu-formations',
			    $this->shared->get( 'url' ) . 'admin/assets/js/menu-formations.js',
			    array( 'jquery', 'jquery-ui-dialog', 'daextsfve-select2' ),
			    $this->shared->get( 'ver' ) );

		    wp_localize_script( $this->shared->get( 'slug' ) . '-menu-formations', 'objectL10n',
			    $wp_localize_script_data );

            wp_add_inline_script( $this->shared->get('slug') . '-menu-formations', $php_data, 'before' );

        }
        
        //menu layouts
        if ( $screen->id == $this->screen_id_layouts ) {

            //JQuery UI Tooltips
            wp_enqueue_script('jquery-ui-tooltip');
            wp_enqueue_script($this->shared->get('slug') . '-jquery-ui-tooltip-init', $this->shared->get('url') . 'admin/assets/js/jquery-ui-tooltip-init.js', array('jquery'), $this->shared->get('ver'));

	        //Select2
	        wp_enqueue_script( $this->shared->get( 'slug' ) . '-select2',
		        $this->shared->get( 'url' ) . 'admin/assets/inc/select2/dist/js/select2.min.js', array('jquery'),
		        $this->shared->get( 'ver' ) );

	        //Layouts Menu
	        wp_enqueue_script( $this->shared->get( 'slug' ) . '-menu-layouts',
		        $this->shared->get( 'url' ) . 'admin/assets/js/menu-layouts.js',
		        array( 'jquery', 'jquery-ui-dialog', 'daextsfve-select2' ),
		        $this->shared->get( 'ver' ) );
	        wp_localize_script( $this->shared->get( 'slug' ) . '-menu-layouts', 'objectL10n',
		        $wp_localize_script_data );
        	
            wp_enqueue_script( $this->shared->get('slug') . '-admin-script-draggable', $this->shared->get('url') . 'admin/assets/js/draggable.js', array( 'jquery', 'jquery-ui-draggable' ), $this->shared->get('ver') );

            wp_add_inline_script( $this->shared->get('slug') . '-menu-layouts', $php_data, 'before' );

        }
        
        //menu options
        if ( $screen->id == $this->screen_id_options ) {

            //JQuery UI Tooltips
            wp_enqueue_script('jquery-ui-tooltip');
            wp_enqueue_script($this->shared->get('slug') . '-jquery-ui-tooltip-init', $this->shared->get('url') . 'admin/assets/js/jquery-ui-tooltip-init.js', array('jquery'), $this->shared->get('ver'));

	        //Select2
	        wp_enqueue_script( $this->shared->get( 'slug' ) . '-select2',
		        $this->shared->get( 'url' ) . 'admin/assets/inc/select2/dist/js/select2.min.js', array('jquery'),
		        $this->shared->get( 'ver' ) );

//	        //Options Menu
//	        wp_enqueue_script( $this->shared->get( 'slug' ) . '-menu-options',
//		        $this->shared->get( 'url' ) . 'admin/assets/js/menu-options.js',
//		        array( 'jquery', 'jquery-ui-dialog', 'daextsfve-select2' ),
//		        $this->shared->get( 'ver' ) );
//	        wp_localize_script( $this->shared->get( 'slug' ) . '-menu-options', 'objectL10n',
//		        $wp_localize_script_data );

	        //Color Picker Initialization
	        wp_enqueue_script( $this->shared->get( 'slug' ) . '-wp-color-picker-init',
		        $this->shared->get( 'url' ) . 'admin/assets/js/wp-color-picker-init.js',
		        array( 'jquery', 'wp-color-picker' ), false, true );

        }

    }
    
    /*
     * register the admin menu
     */
    public function me_add_menu() {

	    //The icon in Base64 format
	    $icon_base64 = 'PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyNS4yLjMsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9IjAgMCAyMCAyMCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjAgMjA7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwYXRoIGQ9Ik02LjgsOS4xTDEwLDYuOGwzLjIsMi4zTDEyLDEyLjlIOEw2LjgsOS4xeiBNMTAsMGMxLjQsMCwyLjcsMC4zLDMuOSwwLjhzMi4zLDEuMiwzLjIsMi4xYzAuOSwwLjksMS42LDEuOSwyLjEsMy4yDQoJUzIwLDguNywyMCwxMHMtMC4yLDIuNi0wLjgsMy45Yy0wLjYsMS4zLTEuMywyLjMtMi4xLDMuMmMtMC45LDAuOS0xLjksMS42LTMuMiwyLjFTMTEuMywyMCwxMCwyMHMtMi42LTAuMy0zLjktMC44UzMuOCwxOCwyLjksMTcuMQ0KCXMtMS42LTEuOS0yLjEtMy4yUzAsMTEuMywwLDEwczAuMy0yLjYsMC44LTMuOVMyLDMuOCwyLjksMi45czItMS42LDMuMi0yLjFTOC42LDAsMTAsMHogTTE2LjksMTUuMWMxLjEtMS41LDEuNy0zLjIsMS43LTUuMWwwLDANCglsLTEuMSwxbC0yLjctMi41bDAuNy0zLjZMMTcsNWMtMS4xLTEuNS0yLjYtMi42LTQuMy0zLjFsMC42LDEuNEwxMCw1TDYuOCwzLjJsMC42LTEuNEM1LjYsMi40LDQuMiwzLjQsMyw1bDEuNS0wLjFsMC43LDMuNkwyLjYsMTENCglsLTEuMS0xbDAsMGMwLDEuOSwwLjYsMy42LDEuNyw1LjFsMC4zLTEuNUw3LjEsMTRsMS42LDMuM2wtMS4zLDAuOGMwLjksMC4zLDEuOCwwLjQsMi43LDAuNHMxLjgtMC4xLDIuNy0wLjRsLTEuMy0wLjhsMS42LTMuMw0KCWwzLjYtMC40TDE2LjksMTUuMXoiLz4NCjwvc3ZnPg0K';

	    //The icon in the data URI scheme
	    $icon_data_uri = 'data:image/svg+xml;base64,' . $icon_base64;

        add_menu_page(
	        esc_html__('SFVE', 'soccer-formation-ve'),
	        esc_html__('SFVE', 'soccer-formation-ve'),
            'edit_posts',
            $this->shared->get('slug') . '-formations',
            array( $this, 'me_display_menu_formations'),
	        $icon_data_uri
        );
        
        $this->screen_id_formations = add_submenu_page(
            $this->shared->get('slug') . '-formations',
	        esc_html__('SFVE - Formations', 'soccer-formation-ve'),
		    esc_html__('Formations', 'soccer-formation-ve'),
            'edit_posts',
            $this->shared->get('slug') . '-formations',
            array( $this, 'me_display_menu_formations')
        );
        
        $this->screen_id_layouts = add_submenu_page(
            $this->shared->get('slug') . '-formations',
	        esc_html__('SFVE - Layouts', 'soccer-formation-ve'),
		    esc_html__('Layouts', 'soccer-formation-ve'),
            'edit_posts',
            $this->shared->get('slug') . '-layouts',
            array( $this, 'me_display_menu_layouts')
        );

	    $this->screen_id_help = add_submenu_page(
		    $this->shared->get( 'slug' ) . '-formations',
		    esc_html__( 'SFVE - Help', 'soccer-formation-ve'),
		    esc_html__( 'Help', 'soccer-formation-ve'),
		    'manage_options',
		    $this->shared->get( 'slug' ) . '-help',
		    array( $this, 'me_display_menu_help' )
	    );

        $this->screen_id_soccer_engine = add_submenu_page(
            $this->shared->get( 'slug' ) . '-formations',
            esc_html__( 'SFVE - Soccer Engine', 'soccer-formation-ve'),
            esc_html__( 'Soccer Engine', 'soccer-formation-ve'),
            'manage_options',
            $this->shared->get( 'slug' ) . '-soccer-engine',
            array( $this, 'me_display_menu_soccer_engine' )
        );
        
        $this->screen_id_options = add_submenu_page(
            $this->shared->get('slug') . '-formations',
	        esc_html__('SFVE - Options', 'soccer-formation-ve'),
		    esc_html__('Options', 'soccer-formation-ve'),
            'manage_options',
            $this->shared->get('slug') . '-options',
            array( $this, 'me_display_menu_options')
        );

    }

    /*
     * includes the formations view
     */
    public function me_display_menu_formations() {
        include_once( 'view/formations.php' );
    }
    
    /*
     * includes the layouts view
     */
    public function me_display_menu_layouts() {
        include_once( 'view/layouts.php' );
    }

	/*
	 * includes the help view
	 */
	public function me_display_menu_help() {
		include_once( 'view/help.php' );
	}

    /*
     * includes the soccer engine view
     */
    public function me_display_menu_soccer_engine() {
        include_once( 'view/soccer-engine.php' );
    }

    /*
     * includes the options view
     */
    public function me_display_menu_options() {
        include_once( 'view/options.php' );
    }
    
    /*
     * get the layout description
     * 
     * @since 1.00
     * 
     * @param int $layout_id the layout id
     * @return string the layout description
     */
    private function ut_get_layout_name($layout_id){
        
        global $wpdb;
        $table_name = $wpdb->prefix . $this->shared->get('slug') . "_layouts";
        $safe_sql = $wpdb->prepare("SELECT description FROM $table_name WHERE id = %d", $layout_id);
        $layout_obj = $wpdb->get_row($safe_sql);
        
        return $layout_obj->description;
        
    }
    
    /**
     * check if the layout is used by a formation
     * 
     * @param int $layout_id the layout id
     * @return bool true if the layout is used, false if the layout is not uysed
     */
    private function ut_layout_is_used($layout_id){

        global $wpdb; $table_name = $wpdb->prefix . $this->shared->get('slug') . "_formations";
        $safe_sql = $wpdb->prepare("SELECT id FROM $table_name WHERE layout_id = %d ", $layout_id);
        $results = $wpdb->get_results($safe_sql, ARRAY_A);  

        if( count($results) == 0 ){
            return false;
        }else{
            return true;
        }

    }
    
    /**
     * check if the layout is a default layout
     * 
     * @param int $layout_id the layout id
     * @return bool true if the layout is a default layout, false if the layout
     * is not a default layout
     */
    private function ut_is_default_layout($layout_id){

        if( $layout_id == 1){
            return true;
        }else{
            return false;
        }

    }
    
    /*
     * plugin activation
     */
    static public function ac_activate(){

        self::ac_initialize_options();
        self::ac_create_database_tables();
        
    }
    
    /*
     * initialize plugin options
     */
    static private function ac_initialize_options(){

	    //assign an instance of Daextsfve_Shared
	    $shared = Daextsfve_Shared::get_instance();

	    foreach ( $shared->get( 'options' ) as $key => $value ) {
		    add_option( $key, $value );
	    }
        
    }  
        
    /*
     * create the plugin database tables
     */
    static private function ac_create_database_tables(){

	    global $wpdb;

	    //Get the database character collate that will be appended at the end of each query
	    $charset_collate = $wpdb->get_charset_collate();

        //check database version and create the database
        if( intval(get_option( 'daextsfve_database_version')) < 1 ){

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

            //create *prefix*_formations
            global $wpdb;
            $table_name = $wpdb->prefix . "daextsfve_formations";
            $sql = "CREATE TABLE $table_name (
              id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
              description VARCHAR(255) DEFAULT '' NOT NULL,
              layout_id BIGINT NOT NULL,
              player_name_1 VARCHAR(255) DEFAULT '' NOT NULL,
              player_number_1 VARCHAR(2) DEFAULT '' NOT NULL,
              player_name_2 VARCHAR(255) DEFAULT '' NOT NULL,
              player_number_2 VARCHAR(2) DEFAULT '' NOT NULL,
              player_name_3 VARCHAR(255) DEFAULT '' NOT NULL,
              player_number_3 VARCHAR(2) DEFAULT '' NOT NULL,
              player_name_4 VARCHAR(255) DEFAULT '' NOT NULL,
              player_number_4 VARCHAR(2) DEFAULT '' NOT NULL,
              player_name_5 VARCHAR(255) DEFAULT '' NOT NULL,
              player_number_5 VARCHAR(2) DEFAULT '' NOT NULL,
              player_name_6 VARCHAR(255) DEFAULT '' NOT NULL,
              player_number_6 VARCHAR(2) DEFAULT '' NOT NULL,
              player_name_7 VARCHAR(255) DEFAULT '' NOT NULL,
              player_number_7 VARCHAR(2) DEFAULT '' NOT NULL,
              player_name_8 VARCHAR(255) DEFAULT '' NOT NULL,
              player_number_8 VARCHAR(2) DEFAULT '' NOT NULL,
              player_name_9 VARCHAR(255) DEFAULT '' NOT NULL,
              player_number_9 VARCHAR(2) DEFAULT '' NOT NULL,
              player_name_10 VARCHAR(255) DEFAULT '' NOT NULL,
              player_number_10 VARCHAR(2) DEFAULT '' NOT NULL,
              player_name_11 VARCHAR(255) DEFAULT '' NOT NULL,
              player_number_11 VARCHAR(2) DEFAULT '' NOT NULL
            ) $charset_collate";

            dbDelta($sql);

            //create *prefix*_layouts
            global $wpdb;$table_name=$wpdb->prefix . "daextsfve_layouts";
            $sql = "CREATE TABLE $table_name (
              id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
              description VARCHAR(255) DEFAULT '' NOT NULL,
              player_x_1 INT DEFAULT 0 NOT NULL,
              player_y_1 INT DEFAULT 0 NOT NULL,
              player_x_2 INT DEFAULT 0 NOT NULL,
              player_y_2 INT DEFAULT 0 NOT NULL,
              player_x_3 INT DEFAULT 0 NOT NULL,
              player_y_3 INT DEFAULT 0 NOT NULL,
              player_x_4 INT DEFAULT 0 NOT NULL,
              player_y_4 INT DEFAULT 0 NOT NULL,
              player_x_5 INT DEFAULT 0 NOT NULL,
              player_y_5 INT DEFAULT 0 NOT NULL,
              player_x_6 INT DEFAULT 0 NOT NULL,
              player_y_6 INT DEFAULT 0 NOT NULL,
              player_x_7 INT DEFAULT 0 NOT NULL,
              player_y_7 INT DEFAULT 0 NOT NULL,
              player_x_8 INT DEFAULT 0 NOT NULL,
              player_y_8 INT DEFAULT 0 NOT NULL,
              player_x_9 INT DEFAULT 0 NOT NULL,
              player_y_9 INT DEFAULT 0 NOT NULL,
              player_x_10 INT DEFAULT 0 NOT NULL,
              player_y_10 INT DEFAULT 0 NOT NULL,
              player_x_11 INT DEFAULT 0 NOT NULL,
              player_y_11 INT DEFAULT 0 NOT NULL,
              player_show_1 TINYINT(1) DEFAULT 1 NOT NULL,
              player_show_2 TINYINT(1) DEFAULT 1 NOT NULL,
              player_show_3 TINYINT(1) DEFAULT 1 NOT NULL,
              player_show_4 TINYINT(1) DEFAULT 1 NOT NULL,
              player_show_5 TINYINT(1) DEFAULT 1 NOT NULL,
              player_show_6 TINYINT(1) DEFAULT 1 NOT NULL,
              player_show_7 TINYINT(1) DEFAULT 1 NOT NULL,
              player_show_8 TINYINT(1) DEFAULT 1 NOT NULL,
              player_show_9 TINYINT(1) DEFAULT 1 NOT NULL,
              player_show_10 TINYINT(1) DEFAULT 1 NOT NULL,
              player_show_11 TINYINT(1) DEFAULT 1 NOT NULL
            ) $charset_collate";

            dbDelta($sql);
            
            //set default layout
            $wpdb->query("INSERT INTO $table_name (id, description, player_x_1, player_y_1, player_x_2, player_y_2, player_x_3, player_y_3, player_x_4, player_y_4, player_x_5, player_y_5, player_x_6, player_y_6, player_x_7, player_y_7, player_x_8, player_y_8, player_x_9, player_y_9, player_x_10, player_y_10, player_x_11, player_y_11, player_show_1, player_show_2, player_show_3, player_show_4, player_show_5, player_show_6, player_show_7, player_show_8, player_show_9, player_show_10, player_show_11) VALUES " .
                    "(1, 'Default', 258, 654, 93, 433, 153, 514, 369, 514, 429, 433, 93, 213, 153, 294, 369, 294, 429, 213, 153, 73, 369, 72, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1)");

            //Update database version
            update_option( 'daextsfve_database_version',"1");

        }

    }
    
    /*
     * delete plugin options
     */
    static public function un_delete_options(){

	    //assign an instance of Daextsfve_Shared
	    $shared = Daextsfve_Shared::get_instance();

	    foreach ( $shared->get( 'options' ) as $key => $value ) {
		    delete_option( $key );
	    }
        
    }
    
    /*
     * delete plugin database
     */
    static public function un_delete_database_tables(){
        
        //assign an instance of the plugin info
        $shared = Daextsfve_Shared::get_instance();
        
        global $wpdb;

        $table_name = $wpdb->prefix . $shared->get('slug') . "_formations";
        $sql = "DROP TABLE $table_name";  
        $wpdb->query($sql);

        $table_name = $wpdb->prefix . $shared->get('slug') . "_layouts";
        $sql = "DROP TABLE $table_name";  
        $wpdb->query($sql);
        
    }

	/*
	 * register options
	 */
	public function op_register_options() {

		$this->menu_options->register_options();

	}

	/**
	 * Echo all the dismissible notices based on the values of the $notices array.
	 *
	 * @param $notices
	 */
	public function dismissible_notice($notices){

		foreach($notices as $key => $notice){
			echo '<div class="' . esc_attr($notice['class']) . ' settings-error notice is-dismissible below-h2"><p>' . esc_html($notice['message']) . '</p></div>';
		}

	}
    
}