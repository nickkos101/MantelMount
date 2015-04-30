<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$wp_email_template_general = get_option('wp_email_template_general');
$wp_email_template_style_header_image = get_option('wp_email_template_style_header_image', array() );
$wp_email_template_style_header_image['header_image'] = $wp_email_template_general['header_image'];
update_option('wp_email_template_style_header_image', $wp_email_template_style_header_image);

$wp_email_template_style = get_option('wp_email_template_style');
$wp_email_template_style_header = get_option('wp_email_template_style_header', array() );
$wp_email_template_style_header['base_colour'] = $wp_email_template_style['base_colour'];
$wp_email_template_style_header['header_font'] = $wp_email_template_style['header_font'];
update_option('wp_email_template_style_header', $wp_email_template_style_header);

$wp_email_template_style_body = get_option('wp_email_template_style_body', array() );
$wp_email_template_style_body['content_background_colour'] = $wp_email_template_style['content_background_colour'];
$wp_email_template_style_body['content_font'] = $wp_email_template_style['content_font'];
$wp_email_template_style_body['content_link_colour'] = $wp_email_template_style['content_link_colour'];
update_option('wp_email_template_style_body', $wp_email_template_style_body);

$wp_email_template_style_footer = get_option('wp_email_template_style_footer', array() );
$wp_email_template_style_footer['footer_background_colour'] = $wp_email_template_style['content_background_colour'];
$wp_email_template_style_footer['footer_font'] = $wp_email_template_style['content_font'];
update_option('wp_email_template_style_footer', $wp_email_template_style_footer);