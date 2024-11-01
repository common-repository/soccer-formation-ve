<?php

/**
 * This class adds the options with the related callbacks and validations.
 */
class Daextsfve_Menu_Options {

	private $shared = null;

	public function __construct( $shared ) {

		//assign an instance of the plugin info
		$this->shared = $shared;

	}

	public function register_options() {

		//section general
		add_settings_section(
			'daextsfve_general_settings_section',
			null,
			null,
			'daextsfve_general_options'
		);

		add_settings_field(
			'daextsfve_player_number_color',
			esc_html__( 'Player Number Color', 'soccer-formation-ve'),
			array( $this, 'player_number_color_callback' ),
			'daextsfve_general_options',
			'daextsfve_general_settings_section'
		);

		register_setting(
			'daextsfve_general_options',
			'daextsfve_player_number_color',
			array( $this, 'player_number_color_validation' )
		);

		add_settings_field(
			'daextsfve_player_name_color',
			esc_html__( 'Player Name Color', 'soccer-formation-ve'),
			array( $this, 'player_name_color_callback' ),
			'daextsfve_general_options',
			'daextsfve_general_settings_section'
		);

		register_setting(
			'daextsfve_general_options',
			'daextsfve_player_name_color',
			array( $this, 'player_name_color_validation' )
		);

		add_settings_field(
			'daextsfve_player_number_bg_color',
			esc_html__( 'Player Number Background Color', 'soccer-formation-ve'),
			array( $this, 'player_number_bg_color_callback' ),
			'daextsfve_general_options',
			'daextsfve_general_settings_section'
		);

		register_setting(
			'daextsfve_general_options',
			'daextsfve_player_number_bg_color',
			array( $this, 'player_number_bg_color_validation' )
		);

		add_settings_field(
			'daextsfve_player_name_bg_color',
			esc_html__( 'Player Name Background Color', 'soccer-formation-ve'),
			array( $this, 'player_name_bg_color_callback' ),
			'daextsfve_general_options',
			'daextsfve_general_settings_section'
		);

		register_setting(
			'daextsfve_general_options',
			'daextsfve_player_name_bg_color',
			array( $this, 'player_name_bg_color_validation' )
		);

		add_settings_field(
			'daextsfve_field_bg_color',
			esc_html__( 'Field Background Color', 'soccer-formation-ve'),
			array( $this, 'field_bg_color_callback' ),
			'daextsfve_general_options',
			'daextsfve_general_settings_section'
		);

		register_setting(
			'daextsfve_general_options',
			'daextsfve_field_bg_color',
			array( $this, 'field_bg_color_validation' )
		);

		add_settings_field(
			'daextsfve_field_lines_color',
			esc_html__( 'Field Lines Color', 'soccer-formation-ve'),
			array( $this, 'field_lines_color_callback' ),
			'daextsfve_general_options',
			'daextsfve_general_settings_section'
		);

		register_setting(
			'daextsfve_general_options',
			'daextsfve_field_lines_color',
			array( $this, 'field_lines_color_validation' )
		);

		add_settings_field(
			'daextsfve_font_size',
			esc_html__( 'Font Size', 'soccer-formation-ve'),
			array( $this, 'font_size_callback' ),
			'daextsfve_general_options',
			'daextsfve_general_settings_section'
		);

		register_setting(
			'daextsfve_general_options',
			'daextsfve_font_size',
			array( $this, 'font_size_validation' )
		);

		add_settings_field(
			'daextsfve_font_weight',
			esc_html__( 'Font Weight', 'soccer-formation-ve'),
			array( $this, 'font_weight_callback' ),
			'daextsfve_general_options',
			'daextsfve_general_settings_section'
		);

		register_setting(
			'daextsfve_general_options',
			'daextsfve_font_weight',
			array( $this, 'font_weight_validation' )
		);

		add_settings_field(
			'daextsfve_font_family',
			esc_html__( 'Font Family', 'soccer-formation-ve'),
			array( $this, 'font_family_callback' ),
			'daextsfve_general_options',
			'daextsfve_general_settings_section'
		);

		register_setting(
			'daextsfve_general_options',
			'daextsfve_font_family',
			array( $this, 'font_family_validation' )
		);

		add_settings_field(
			'daextsfve_load_google_font',
			esc_html__( 'Load Google Font', 'soccer-formation-ve'),
			array( $this, 'load_google_font_callback' ),
			'daextsfve_general_options',
			'daextsfve_general_settings_section'
		);

		register_setting(
			'daextsfve_general_options',
			'daextsfve_load_google_font',
			array( $this, 'load_google_font_validation' )
		);

		add_settings_field(
			'daextsfve_field_top_margin',
			esc_html__( 'Field Top Margin', 'soccer-formation-ve'),
			array( $this, 'field_top_margin_callback' ),
			'daextsfve_general_options',
			'daextsfve_general_settings_section'
		);

		register_setting(
			'daextsfve_general_options',
			'daextsfve_field_top_margin',
			array( $this, 'field_top_margin_validation' )
		);

		add_settings_field(
			'daextsfve_field_bottom_margin',
			esc_html__( 'Field Bottom Margin', 'soccer-formation-ve'),
			array( $this, 'field_bottom_margin_callback' ),
			'daextsfve_general_options',
			'daextsfve_general_settings_section'
		);

		register_setting(
			'daextsfve_general_options',
			'daextsfve_field_bottom_margin',
			array( $this, 'field_bottom_margin_validation' )
		);

	}

	public function player_number_color_callback() {

		$html = '<input class="wp-color-picker" type="text" id="' . $this->shared->get( 'slug' ) . '_player_number_color" name="' . $this->shared->get( 'slug' ) . '_player_number_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_player_number_color' ) ) . '" class="color" maxlength="7" size="6" />';
        $html .= '<div class="help-icon" title="' . esc_attr__( 'The text color of player number.',
                'soccer-formation-ve' ) . '"></div>';
		echo $html;

	}

	public function player_number_color_validation( $input ) {

		return sanitize_hex_color( $input );

	}

	public function player_name_color_callback() {

		$html = '<input class="wp-color-picker" type="text" id="' . $this->shared->get( 'slug' ) . '_player_name_color" name="' . $this->shared->get( 'slug' ) . '_player_name_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_player_name_color' ) ) . '" class="color" maxlength="7" size="6" />';
        $html .= '<div class="help-icon" title="' . esc_attr__( 'The text color of the player name.',
                'soccer-formation-ve' ) . '"></div>';
		echo $html;

	}

	public function player_name_color_validation( $input ) {

		return sanitize_hex_color( $input );

	}

	public function player_number_bg_color_callback() {

		$html = '<input class="wp-color-picker" type="text" id="' . $this->shared->get( 'slug' ) . '_player_number_bg_color" name="' . $this->shared->get( 'slug' ) . '_player_number_bg_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_player_number_bg_color' ) ) . '" class="color" maxlength="7" size="6" />';
        $html .= '<div class="help-icon" title="' . esc_attr__( 'The background color of the player number.',
                'soccer-formation-ve' ) . '"></div>';
		echo $html;

	}

	public function player_number_bg_color_validation( $input ) {

		return sanitize_hex_color( $input );

	}

	public function player_name_bg_color_callback() {

		$html = '<input class="wp-color-picker" type="text" id="' . $this->shared->get( 'slug' ) . '_player_name_bg_color" name="' . $this->shared->get( 'slug' ) . '_player_name_bg_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_player_name_bg_color' ) ) . '" class="color" maxlength="7" size="6" />';
        $html .= '<div class="help-icon" title="' . esc_attr__( 'The background color of the player name.',
                'soccer-formation-ve' ) . '"></div>';
		echo $html;

	}

	public function player_name_bg_color_validation( $input ) {

		return sanitize_hex_color( $input );

	}

	public function field_bg_color_callback() {

		$html = '<input class="wp-color-picker" type="text" id="' . $this->shared->get( 'slug' ) . '_field_bg_color" name="' . $this->shared->get( 'slug' ) . '_field_bg_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_field_bg_color' ) ) . '" class="color" maxlength="7" size="6" />';
        $html .= '<div class="help-icon" title="' . esc_attr__( 'The background color of the player field.',
                'soccer-formation-ve' ) . '"></div>';
		echo $html;

	}

	public function field_bg_color_validation( $input ) {

		return sanitize_hex_color( $input );

	}

	public function field_lines_color_callback() {

		$html = '<input class="wp-color-picker" type="text" id="' . $this->shared->get( 'slug' ) . '_field_lines_color" name="' . $this->shared->get( 'slug' ) . '_field_lines_color" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_field_lines_color' ) ) . '" class="color" maxlength="7" size="6" />';
        $html .= '<div class="help-icon" title="' . esc_attr__( 'The background color of the field.',
                'soccer-formation-ve' ) . '"></div>';
		echo $html;

	}

	public function field_lines_color_validation( $input ) {

		return sanitize_hex_color( $input );

	}

	public function font_size_callback() {

		$html = '<input type="text" id="' . $this->shared->get( 'slug' ) . '_font_size" name="' . $this->shared->get( 'slug' ) . '_font_size" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_font_size' ) ) . '" maxlength="2" size="2" />';
        $html .= '<div class="help-icon" title="' . esc_attr__( 'The color of the lines of the field.',
                'soccer-formation-ve' ) . '"></div>';
		echo $html;

	}

	public function font_size_validation( $input ) {

		$input = intval( $input, 10 );

		if ( $input < 1 or $input > 24 ) {
			add_settings_error( $this->shared->get( "slug" ) . '_font_size', 'daextsfve_invalid_font_size',
				esc_html__( 'Please enter a valid value in the "Font Size" option.', 'soccer-formation-ve') );
			$output = get_option( $this->shared->get( "slug" ) . '_font_size' );
		} else {
			$output = $input;
		}

		return $output;

	}

	public function font_weight_callback() {

		$html = '<input type="text" id="' . $this->shared->get( 'slug' ) . '_font_weight" name="' . $this->shared->get( 'slug' ) . '_font_weight" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_font_weight' ) ) . '" maxlength="4" size="6" />';
        $html .= '<div class="help-icon" title="' . esc_attr__( 'The base font weight of all the text elements in the field.',
                'soccer-formation-ve' ) . '"></div>';
		echo $html;

	}

	public function font_weight_validation( $input ) {

		return intval( $input, 10 );

	}

	public function font_family_callback() {

		$html = '<input type="text" id="' . $this->shared->get( 'slug' ) . '_font_family" name="' . $this->shared->get( 'slug' ) . '_font_family" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_font_family' ) ) . '" class="regular-text" maxlength="1000"/>';
        $html .= '<div class="help-icon" title="' . esc_attr__( 'The font family of all the text elements in the field.',
                'soccer-formation-ve' ) . '"></div>';
		echo $html;

	}

	public function font_family_validation( $input ) {

		$input = sanitize_text_field( $input );

		if ( ! preg_match( $this->shared->font_family_regex, $input ) ) {
			add_settings_error( 'daextsfve_headings_font_family', 'daextsfve_headings_font_family',
				esc_html__( 'Please enter a valid value in the "Font Family" option.', 'soccer-formation-ve') );
			$output = get_option( 'daextsfve_headings_font_family' );
		} else {
			$output = $input;
		}

		return $output;

	}

	public function load_google_font_callback() {

		$html = '<input type="text" id="' . $this->shared->get( 'slug' ) . '_load_google_font" name="' . $this->shared->get( 'slug' ) . '_load_google_font" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_load_google_font' ) ) . '" class="regular-text" maxlength="2048" />';
        $html .= '<div class="help-icon" title="' . esc_attr__( 'The URL of the Google Fonts embed.',
                'soccer-formation-ve' ) . '"></div>';
		echo $html;

	}

	public function load_google_font_validation( $input ) {

		return esc_url_raw( $input );

	}

	public function field_top_margin_callback() {

		$html = '<input type="text" id="' . $this->shared->get( 'slug' ) . '_field_top_margin" name="' . $this->shared->get( 'slug' ) . '_field_top_margin" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_field_top_margin' ) ) . '" maxlength="3" size="6" />';
        $html .= '<div class="help-icon" title="' . esc_attr__( 'The top margin of the field.',
                'soccer-formation-ve' ) . '"></div>';
		echo $html;

	}

	public function field_top_margin_validation( $input ) {

		return intval( $input, 10 );

	}

	public function field_bottom_margin_callback() {

		$html = '<input type="text" id="' . $this->shared->get( 'slug' ) . '_field_bottom_margin" name="' . $this->shared->get( 'slug' ) . '_field_bottom_margin" value="' . esc_attr( get_option( $this->shared->get( 'slug' ) . '_field_bottom_margin' ) ) . '" maxlength="3" size="6" />';
        $html .= '<div class="help-icon" title="' . esc_attr__( 'The bottom margin of the field.',
                'soccer-formation-ve' ) . '"></div>';
		echo $html;

	}

	public function field_bottom_margin_validation( $input ) {

		return intval( $input, 10 );

	}

}