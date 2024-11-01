<?php

/*
 * this is a dynamically generated svg that generate the field, the field colors
 * are based on the parameters passed with the query string
 */

/**
 * Sanitization. Note that the WordPress core should not be loaded for performance reasons and a copy of the original
 * daextsfve_sanitize_hex_color() function available in the core has been added at the end of the file.
 */

//get field colors from the query string
$field_bg_color = daextsfve_sanitize_hex_color('#' . $_GET['field_bg_color']);
$field_lines_color = daextsfve_sanitize_hex_color('#' . $_GET['field_lines_color']);

//set the content type as a image/svg+xml
header('Content-type: image/svg+xml');

//echo the svg content
$output = '<?xml version="1.0" encoding="utf-8"?>
<svg version="1.1" id="field" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 710 785" enable-background="new 0 0 710 785" xml:space="preserve">
<polygon id="field_fill" fill="' . htmlspecialchars($field_bg_color, ENT_QUOTES) . '" points="605.8,33 106.2,33 7.1,751.3 149.1,751.3 704.9,751.3 "/>
<g id="field_lines">
	<polygon id="field_border" fill="none" stroke="' . htmlspecialchars($field_lines_color, ENT_QUOTES) . '" stroke-width="3" points="605.8,33 106.2,33 7.1,751.3 149.1,751.3 
		704.9,751.3 	"/>
	<path fill="none" stroke="' . htmlspecialchars($field_lines_color, ENT_QUOTES) . '" stroke-width="3" d="M425.6,604c-16.5-18.4-41.9-30.1-70.1-30.1c-28.3,0-53.6,11.7-70.1,30.1"/>
	<polyline fill="none" stroke="' . htmlspecialchars($field_lines_color, ENT_QUOTES) . '" stroke-width="3" points="147.4,751.5 159.5,604.5 547.8,604.5 559.6,751.3 	"/>
	<polyline fill="none" stroke="' . htmlspecialchars($field_lines_color, ENT_QUOTES) . '" stroke-width="3" points="260.4,751.6 262.3,700.5 444.8,700.5 446.6,751.5 	"/>
	
		<line id="_x3C_Path_x3E__1_" fill="none" stroke="' . htmlspecialchars($field_lines_color, ENT_QUOTES) . '" stroke-width="3" stroke-miterlimit="10" x1="65" y1="333.5" x2="647" y2="333.5"/>
	<path id="_x3C_Path_x3E_" fill="none" stroke="' . htmlspecialchars($field_lines_color, ENT_QUOTES) . '" stroke-width="3" stroke-miterlimit="10" d="M433.6,332.8
		c-1.2-33-36.1-58.9-78-58.9s-76.8,26-78,58.9c-1.3,34,33.6,62.4,78,62.4S434.8,366.8,433.6,332.8z"/>
	<polyline fill="none" stroke="' . htmlspecialchars($field_lines_color, ENT_QUOTES) . '" stroke-width="3" points="501.8,32.5 508.6,117.5 199.6,117.5 206.7,32.5 	"/>
	<path fill="none" stroke="' . htmlspecialchars($field_lines_color, ENT_QUOTES) . '" stroke-width="3" d="M299.3,117.2c12.5,11.8,32.8,19.5,55.8,19.5c23,0,43.3-7.7,55.8-19.5"/>
	<polyline fill="none" stroke="' . htmlspecialchars($field_lines_color, ENT_QUOTES) . '" stroke-width="3" points="420.9,32.8 421.9,61.5 286.5,61.5 287.6,32.9 	"/>
</g>
</svg>';

echo $output;

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
