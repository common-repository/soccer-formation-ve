<?php

/*
 * this is a dynamically generated svg that generates the players, the colors
 * comes fromm the parameters passed with the query string
 */

/**
 * Sanitization. Note that the WordPress core should not be loaded for performance reasons and a copy of the original
 * daextsfve_sanitize_hex_color() function available in the core has been added at the end of the file.
 */
$player_number_bg_color = daextsfve_sanitize_hex_color('#' . $_GET['player_number_bg_color']);
$player_name_bg_color = daextsfve_sanitize_hex_color('#' . $_GET['player_name_bg_color']);

//calculate gradients
$player_number_top_gradient = daextsfve_change_brightness( $player_number_bg_color, 12);
$player_number_left_gradient = daextsfve_change_brightness( $player_number_bg_color, 6);
$player_number_bottom_gradient = daextsfve_change_brightness( $player_number_bg_color, -30);
$player_name_top_gradient = daextsfve_change_brightness( $player_name_bg_color, 12);
$player_name_right_gradient = daextsfve_change_brightness( $player_name_bg_color, 6);
$player_name_bottom_gradient = daextsfve_change_brightness( $player_name_bg_color, -30);

//set the content type as a image/svg+xml
header('Content-type: image/svg+xml');

//echo the svg content
$output = '<?xml version="1.0" encoding="utf-8"?>
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 191 32" enable-background="new 0 0 191 32" xml:space="preserve">
<rect id="player_name_bg" x="38" fill="' . htmlspecialchars($player_name_bg_color, ENT_QUOTES) . '" width="153" height="32"/>
<rect id="player_number_bg" fill="' . htmlspecialchars($player_number_bg_color, ENT_QUOTES) . '" width="38" height="32"/>
<polygon fill="' . htmlspecialchars($player_number_left_gradient, ENT_QUOTES) . '" points="0,0 3,3 3,29 0,32 "/>
<polygon fill="' . htmlspecialchars($player_number_top_gradient, ENT_QUOTES) . '" points="38,0 38,3 3,3 0,0 "/>
<polygon fill="' . htmlspecialchars($player_number_bottom_gradient, ENT_QUOTES) . '" points="38,29 38,32 0,32 3,29 "/>
<polygon fill="' . htmlspecialchars($player_name_bottom_gradient, ENT_QUOTES) . '" points="187.9,28.9 191,32 38,32 38,29 "/>
<polygon fill="' . htmlspecialchars($player_name_right_gradient, ENT_QUOTES) . '" points="191.1,0.1 188,3.2 188,29 191,32 "/>
<polygon fill="' . htmlspecialchars($player_name_top_gradient, ENT_QUOTES) . '" points="38,0 38,3 188,3 191,0 "/>
</svg>';

echo $output;

/**
 * Change the brightess value of a given RGB color
 *
 * @since 1.00
 *
 * @param hex string The hexadecimal RGB color
 * @param steps int The brightness steps between -255 and 255. Negative = darker, positive = lighter
 * @return string The modified RGB color
 */
function daextsfve_change_brightness($hex, $steps) {

	//remove the hash character
	$hex = substr($hex, 1);

    //steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    //format the hex color string
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2) . str_repeat(substr($hex,1,1), 2) . str_repeat(substr($hex,2,1), 2);
    }

    //get decimal values
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));

    //adjust number of steps and keep it inside 0 to 255
    $r = max(0,min(255,$r + $steps));
    $g = max(0,min(255,$g + $steps));  
    $b = max(0,min(255,$b + $steps));

    //convert to hex and add a pad to the left
    $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
    $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
    $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

    return '#' . $r_hex . $g_hex . $b_hex;
    
}

/**
 * Sanitize HEX color
 *
 * @param  string $color setting input.
 * @return string        setting input value.
 */
function daextsfve_sanitize_hex_color( $color ) {

	if ( '' === $color ) {
		return '';
	}

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
		return $color;
	}

	return '';
}