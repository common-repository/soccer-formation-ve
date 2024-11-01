<?php

/*
 * this class should be used to stores value shared by the admin and public side
 * of wordpress
 */
class Daextsfve_Shared{

	//regex
	public $font_family_regex = '/^([A-Za-z0-9-\'", ]*)$/';

    protected static $instance = null;
    
    private $data = array();
    
    private function __construct(){

	    //Set plugin textdomain
	    load_plugin_textdomain('soccer-formation-ve', false, 'soccer-formation-ve/lang/');

        $this->data['slug'] = 'daextsfve';
        $this->data['ver'] = '1.02';
        $this->data['dir'] = substr(plugin_dir_path(__FILE__), 0, -7);
        $this->data['url'] = substr(plugin_dir_url(__FILE__), 0, -7);

	    //Here are stored the plugin option with the related default values
	    $this->data['options'] = [

		    //Database Version -----------------------------------------------------------------------------------------
		    $this->get( 'slug' ) . "_database_version"                                => "0",

		    //General --------------------------------------------------------------------------------------------------
	        $this->get('slug') . "_player_number_color" => "#001c70",
	        $this->get('slug') . "_player_name_color" => "#001c70",
	        $this->get('slug') . "_player_number_bg_color" => "#C3512F",
	        $this->get('slug') . "_player_name_bg_color" => "#F0F0F0",
	        $this->get('slug') . "_field_bg_color" => "#001c70",
	        $this->get('slug') . "_field_lines_color" => "#F0F0F0",
	        $this->get('slug') . "_font_size" => "20",
	        $this->get('slug') . "_font_weight" => "800",
	        $this->get('slug') . "_font_family" => "'Open Sans', sans-serif",
	        $this->get('slug') . "_load_google_font" => "https://fonts.googleapis.com/css2?family=Open+Sans:wght@800&display=swap",
	        $this->get('slug') . "_field_top_margin" => "0",
	        $this->get('slug') . "_field_bottom_margin" => "0",

	    ];
        
    }
    
    public static function get_instance() {

        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
            
    }
    
    //retrieve data
    public function get($index){
        return $this->data[$index];
    }
    
}