<?php
/**
 * WP Email Template Functions
 *
 * Table Of Contents
 *
 * replace_shortcode_header()
 * replace_shortcode_footer()
 * email_header()
 * email_footer()
 * email_content()
 * apply_email_template_notice()
 * send()
 * rgb_from_hex()
 * hex_darker()
 * hex_lighter()
 * light_or_dark()
 */
class WP_Email_Template_Functions
{

	public static function replace_shortcode_header ($template_html='', $email_heading='') {
		global $wp_email_template_general, $wp_email_template_style_header_image, $wp_email_template_style_footer, $wp_email_template_style_header, $wp_email_template_style_body, $wp_email_template_social_media;
		global $wp_email_template_style_fonts;
		$background_pattern_image = 'url('.WP_EMAIL_TEMPLATE_IMAGES_URL.'/pattern.png)';

		$email_container_width = trim( $wp_email_template_general['email_container_width'] );
		if ( $email_container_width < 200 || $email_container_width > 1280 ) {
			$email_container_width = 600;
		}

		$header_image_html = '';
		$apply_style_header_image = false;
		$header_image = $wp_email_template_style_header_image['header_image'];
		if ($header_image !== FALSE && trim($header_image) != ''){
			$header_image_html = '<p style="margin:0px 0 0px 0;"><img class="header_image" style="max-width:'.$email_container_width.'px;" alt="'.get_bloginfo('name').'" src="'.trim(esc_attr( stripslashes( $header_image ) ) ).'"></p>';
			$apply_style_header_image = true;
		}

		$outlook_container_border = '';
		if ( isset($wp_email_template_general['outlook_apply_border']) && $wp_email_template_general['outlook_apply_border'] == 'yes') {
			$outlook_container_border = 'border: 1px solid #FFFFFF !important;';
		}

		$content_text_size = 'font-size:'.$wp_email_template_style_body['content_font']['size'].' !important; line-height:1.2em !important; ';

		$content_text_style = '';
		if ( isset($wp_email_template_style_body['content_font']['style']) && stristr($wp_email_template_style_body['content_font']['style'], 'bold') !== FALSE) {
			$content_text_style .= 'font-weight:bold !important; ';
		}
		if ( isset($wp_email_template_style_body['content_font']['style']) && stristr($wp_email_template_style_body['content_font']['style'], '300') !== FALSE) {
			$content_text_style .= 'font-weight:300 !important; ';
		}
		if ( isset($wp_email_template_style_body['content_font']['style']) && stristr($wp_email_template_style_body['content_font']['style'], 'italic') !== FALSE) {
			$content_text_style .= 'font-style:italic !important; ';
		}
		if ( isset($wp_email_template_style_body['content_font']['style']) && stristr($wp_email_template_style_body['content_font']['style'], 'normal') !== FALSE) {
			$content_text_style = 'font-weight:normal !important; font-style:normal !important';
		}

		if ( isset($wp_email_template_general['deactivate_pattern_background']) && $wp_email_template_general['deactivate_pattern_background'] == 'yes') {
			$background_pattern_image= '';
		}

		global $wp_email_template_fonts_face, $wp_email_template_admin_interface;
		$google_fonts   = array( $wp_email_template_style_header['header_font']['face'], $wp_email_template_style_body['content_font']['face'], $wp_email_template_style_footer['footer_font']['face'] );
		$google_fonts[] = $wp_email_template_style_fonts['h1_font']['face'];
		$google_fonts[] = $wp_email_template_style_fonts['h2_font']['face'];
		$google_fonts[] = $wp_email_template_style_fonts['h3_font']['face'];
		$google_fonts[] = $wp_email_template_style_fonts['h4_font']['face'];
		$google_fonts[] = $wp_email_template_style_fonts['h5_font']['face'];
		$google_fonts[] = $wp_email_template_style_fonts['h6_font']['face'];

		$external_link = $wp_email_template_fonts_face->generate_google_webfonts( $google_fonts, false );

		if( $apply_style_header_image ){
			$header_image_margin_bottom    = 20;
			$header_image_alignment        = stripslashes($wp_email_template_style_header_image['header_image_alignment']);
			$header_image_background_color = stripslashes($wp_email_template_style_header_image['header_image_background_color']);
			$header_image_padding_top      = stripslashes($wp_email_template_style_header_image['header_image_padding_top']);
			$header_image_padding_bottom   = stripslashes($wp_email_template_style_header_image['header_image_padding_bottom']);
			$header_image_padding_left     = stripslashes($wp_email_template_style_header_image['header_image_padding_left']);
			$header_image_padding_right    = stripslashes($wp_email_template_style_header_image['header_image_padding_right']);
			$header_image_margin_top       = stripslashes($wp_email_template_style_header_image['header_image_margin_top']);
			$header_image_margin_bottom    = stripslashes($wp_email_template_style_header_image['header_image_margin_bottom']);
			$header_image_margin_left      = stripslashes($wp_email_template_style_header_image['header_image_margin_left']);
			$header_image_margin_right     = stripslashes($wp_email_template_style_header_image['header_image_margin_right']);
			$header_image_border_top       = str_replace("border:", "border-top:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_header_image['header_image_border_top'] ));
			$header_image_border_bottom    = str_replace("border:", "border-bottom:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_header_image['header_image_border_bottom'] ));
			$header_image_border_left      = str_replace("border:", "border-left:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_header_image['header_image_border_left'] ));
			$header_image_border_right     = str_replace("border:", "border-right:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_header_image['header_image_border_right'] ));
			$header_image_border_corner    = stripslashes($wp_email_template_admin_interface->generate_border_corner_css( $wp_email_template_style_header_image['header_image_border_corner'] ));
			$header_image_border           = $header_image_border_top.$header_image_border_bottom.$header_image_border_left.$header_image_border_right.$header_image_border_corner;
		}else{
			$header_image_margin_bottom    = 0;
			$header_image_alignment        = 'none';
			$header_image_background_color = 'transparent';
			$header_image_padding_top      = '0';
			$header_image_padding_bottom   = '0';
			$header_image_padding_left     = '0';
			$header_image_padding_right    = '0';
			$header_image_margin_top       = '0';
			$header_image_margin_bottom    = '0';
			$header_image_margin_left      = '0';
			$header_image_margin_right     = '0';
			$header_image_border           = 'border-top: 0px solid #ffffff !important;border-bottom: 0px solid #ffffff !important;border-left: 0px solid #ffffff !important;border-right: 0px solid #ffffff !important;border-radius: 0px !important;-moz-border-radius: 0px !important;-webkit-border-radius: 0px !important;';
		}

		$header_font = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_header['header_font'] );
		$h1_font     = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_fonts['h1_font'] );
		$h2_font     = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_fonts['h2_font'] );
		$h3_font     = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_fonts['h3_font'] );
		$h4_font     = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_fonts['h4_font'] );
		$h5_font     = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_fonts['h5_font'] );
		$h6_font     = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_fonts['h6_font'] );
		$footer_font = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_footer['footer_font'] );


		$header_border_top    = str_replace("border:", "border-top:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_header['header_border_top'] ));
		$header_border_bottom = str_replace("border:", "border-bottom:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_header['header_border_bottom'] ));
		$header_border_left   = str_replace("border:", "border-left:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_header['header_border_left'] ));
		$header_border_right  = str_replace("border:", "border-right:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_header['header_border_right'] ));
		$header_border_corner = stripslashes($wp_email_template_admin_interface->generate_border_corner_css( $wp_email_template_style_header['header_border_corner'] ));
		$header_border        = $header_border_top.$header_border_bottom.$header_border_left.$header_border_right.$header_border_corner;

		$content_border_top    = str_replace("border:", "border-top:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_body['content_border_top'] ));
		$content_border_bottom = str_replace("border:", "border-bottom:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_body['content_border_bottom'] ));
		$content_border_left   = str_replace("border:", "border-left:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_body['content_border_left'] ));
		$content_border_right  = str_replace("border:", "border-right:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_body['content_border_right'] ));
		$content_border_corner = stripslashes($wp_email_template_admin_interface->generate_border_corner_css( $wp_email_template_style_body['content_border_corner'] ));
		$content_border        = $content_border_top.$content_border_bottom.$content_border_left.$content_border_right.$content_border_corner;

		$footer_border_top    = str_replace("border:", "border-top:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_footer['footer_border_top'] ));
		$footer_border_bottom = str_replace("border:", "border-bottom:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_footer['footer_border_bottom'] ));
		$footer_border_left   = str_replace("border:", "border-left:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_footer['footer_border_left'] ));
		$footer_border_right  = str_replace("border:", "border-right:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_footer['footer_border_right'] ));
		$footer_border_corner = stripslashes($wp_email_template_admin_interface->generate_border_corner_css( $wp_email_template_style_footer['footer_border_corner'] ));
		$footer_border        = $footer_border_top.$footer_border_bottom.$footer_border_left.$footer_border_right.$footer_border_corner;

		$list_header_shortcode = array(
			'blog_name'                     => get_bloginfo('name'),
			'external_link'                 => $external_link,
			'outlook_container_border'      => $outlook_container_border,
			'email_container_width'			=> $email_container_width,

			'header_image'                  => $header_image_html,
			'header_image_margin_bottom'    => $header_image_margin_bottom,
			'header_image_alignment'        => $header_image_alignment,
			'header_image_background_color' => $header_image_background_color,
			'header_image_padding_top'      => $header_image_padding_top,
			'header_image_padding_bottom'   => $header_image_padding_bottom,
			'header_image_padding_left'     => $header_image_padding_left,
			'header_image_padding_right'    => $header_image_padding_right,

			'header_image_margin_top'       => $header_image_margin_top,
			'header_image_margin_bottom'    => $header_image_margin_bottom,
			'header_image_margin_left'      => $header_image_margin_left,
			'header_image_margin_right'     => $header_image_margin_right,

			'header_image_border'           => $header_image_border,

			'email_heading'                 => stripslashes($email_heading),
			'base_colour'                   => stripslashes($wp_email_template_style_header['base_colour']),

			'header_alignment'              => stripslashes($wp_email_template_style_header['header_alignment']),
			'header_padding_top'            => stripslashes($wp_email_template_style_header['header_padding_top']),
			'header_padding_bottom'         => stripslashes($wp_email_template_style_header['header_padding_bottom']),
			'header_padding_left'           => stripslashes($wp_email_template_style_header['header_padding_left']),
			'header_padding_right'          => stripslashes($wp_email_template_style_header['header_padding_right']),
			'header_margin_top'             => stripslashes($wp_email_template_style_header['header_margin_top']),
			'header_margin_bottom'          => stripslashes($wp_email_template_style_header['header_margin_bottom']),
			'header_margin_left'            => stripslashes($wp_email_template_style_header['header_margin_left']),
			'header_margin_right'           => stripslashes($wp_email_template_style_header['header_margin_right']),
			'header_border'                 => $header_border,

			'header_font'                   => $header_font,
			'h1_font'                       => $h1_font,
			'h2_font'                       => $h2_font,
			'h3_font'                       => $h3_font,
			'h4_font'                       => $h4_font,
			'h5_font'                       => $h5_font,
			'h6_font'                       => $h6_font,


			'background_colour'             => stripslashes($wp_email_template_general['background_colour']),
			'background_pattern_image'      => $background_pattern_image,
			'content_background_colour'     => stripslashes($wp_email_template_style_body['content_background_colour']),

			'content_alignment'             => stripslashes($wp_email_template_style_body['content_alignment']),
			'content_padding_top'           => stripslashes($wp_email_template_style_body['content_padding_top']),
			'content_padding_bottom'        => stripslashes($wp_email_template_style_body['content_padding_bottom']),
			'content_padding_left'          => stripslashes($wp_email_template_style_body['content_padding_left']),
			'content_padding_right'         => stripslashes($wp_email_template_style_body['content_padding_right']),

			'content_margin_top'            => stripslashes($wp_email_template_style_body['content_margin_top']),
			'content_margin_bottom'         => stripslashes($wp_email_template_style_body['content_margin_bottom']),
			'content_margin_left'           => stripslashes($wp_email_template_style_body['content_margin_left']),
			'content_margin_right'          => stripslashes($wp_email_template_style_body['content_margin_right']),

			'content_border'                => $content_border,

			'content_text_colour'           => stripslashes($wp_email_template_style_body['content_font']['color']),
			'content_link_colour'           => stripslashes($wp_email_template_style_body['content_link_colour']),
			'content_font'                  => stripslashes($wp_email_template_style_body['content_font']['face']) . ', arial, sans-serif',
			'content_text_size'             => $content_text_size,
			'content_text_style'            => $content_text_style,

			'footer_font'                   => $footer_font,
			'footer_background_colour'      => stripslashes($wp_email_template_style_footer['footer_background_colour']),
			'footer_border'                 => $footer_border,

		);

		foreach ($list_header_shortcode as $shortcode => $value) {
			$template_html = str_replace('<!--'.$shortcode.'-->', $value, $template_html);
			$template_html = str_replace('/*'.$shortcode.'*/', $value, $template_html);
		}

		return $template_html;
	}

	public static function replace_shortcode_footer ($template_html='') {
		global $wp_email_template_fonts_face, $wp_email_template_general, $wp_email_template_style_body, $wp_email_template_style_footer, $wp_email_template_social_media, $wp_email_template_email_footer,$wp_email_template_admin_interface;

		$background_pattern_image = 'url('.WP_EMAIL_TEMPLATE_IMAGES_URL.'/pattern.png)';

		$facebook_html = '';
		if (isset($wp_email_template_social_media['email_facebook']) && trim(esc_attr($wp_email_template_social_media['email_facebook'])) != '')
			$facebook_html = '<a style="padding:0 2px;" href="'.trim( esc_attr (stripslashes($wp_email_template_social_media['email_facebook']) ) ).'" target="_blank" title="'.__('Facebook', 'wp_email_template').'"><img align="top" border="0" src="' . ( ( trim( $wp_email_template_social_media['facebook_icon'] ) != '' ) ? trim( $wp_email_template_social_media['facebook_icon'] ) : WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_facebook.png' ) . '" alt="'.__('Facebook', 'wp_email_template').'" /></a>&nbsp;';

		$twitter_html = '';
		if (isset($wp_email_template_social_media['email_twitter']) && trim(esc_attr($wp_email_template_social_media['email_twitter'])) != '')
			$twitter_html = '<a style="padding:0 2px;" href="'.trim( esc_attr( stripslashes($wp_email_template_social_media['email_twitter']) ) ).'" target="_blank" title="'.__('Twitter', 'wp_email_template').'"><img align="top" border="0" src="' . ( ( trim( $wp_email_template_social_media['twitter_icon'] ) != '' ) ? trim( $wp_email_template_social_media['twitter_icon'] ) : WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_twitter.png' ) . '" alt="'.__('Twitter', 'wp_email_template').'" /></a>&nbsp;';

		$linkedIn_html = '';
		if (isset($wp_email_template_social_media['email_linkedIn']) && trim(esc_attr($wp_email_template_social_media['email_linkedIn'])) != '')
			$linkedIn_html = '<a style="padding:0 2px;" href="'.trim( esc_attr( stripslashes($wp_email_template_social_media['email_linkedIn']) ) ).'" target="_blank" title="'.__('LinkedIn', 'wp_email_template').'"><img align="top" border="0" src="' . ( ( trim( $wp_email_template_social_media['linkedIn_icon'] ) != '' ) ? trim( $wp_email_template_social_media['linkedIn_icon'] ) : WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_linkedin.png' ) . '" alt="'.__('LinkedIn', 'wp_email_template').'" /></a>&nbsp;';

		$pinterest_html = '';
		if (isset($wp_email_template_social_media['email_pinterest']) && trim(esc_attr($wp_email_template_social_media['email_pinterest'])) != '')
			$pinterest_html = '<a style="padding:0 2px;" href="'.trim( esc_attr( stripslashes($wp_email_template_social_media['email_pinterest']) ) ).'" target="_blank" title="'.__('Pinterest', 'wp_email_template').'"><img align="top" border="0" src="' . ( ( trim( $wp_email_template_social_media['pinterest_icon'] ) != '' ) ? trim( $wp_email_template_social_media['pinterest_icon'] ) : WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_pinterest.png' ) . '" alt="'.__('Pinterest', 'wp_email_template').'" /></a>&nbsp;';

		$googleplus_html = '';
		if (isset($wp_email_template_social_media['email_googleplus']) && trim(esc_attr($wp_email_template_social_media['email_googleplus'])) != '')
			$googleplus_html = '<a style="padding:0 2px;" href="'.trim( esc_attr( stripslashes($wp_email_template_social_media['email_googleplus']) ) ).'" target="_blank" title="'.__('Google+', 'wp_email_template').'"><img align="top" border="0" src="' . ( ( trim( $wp_email_template_social_media['googleplus_icon'] ) != '' ) ? trim( $wp_email_template_social_media['googleplus_icon'] ) : WP_EMAIL_TEMPLATE_IMAGES_URL.'/icon_googleplus.png' ) . '" alt="'.__('Google+', 'wp_email_template').'" /></a>&nbsp;';

		$follow_text = '';
		if (trim($facebook_html) != '' || trim($twitter_html) != '' || trim($linkedIn_html) != '' || trim($pinterest_html) != '' || trim($googleplus_html) != '')
			$follow_text = __('Follow us on', 'wp_email_template');

		$wordpress_email_template_url = '<div style="clear:both"></div><div style="float:right;"><a style="color:'.$wp_email_template_style_body['content_link_colour'].'" href="http://a3rev.com/shop/wp-email-template/" target="_blank">'.__('WP Email Template', 'wp_email_template').'</a></div>';
		if (isset($wp_email_template_general['show_plugin_url']) && trim(esc_attr($wp_email_template_general['show_plugin_url'])) == 'no') $wordpress_email_template_url = '';

		if ( isset($wp_email_template_general['deactivate_pattern_background']) && $wp_email_template_general['deactivate_pattern_background'] == 'yes') {
			$background_pattern_image= '';
		}

		$footer_font = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_footer['footer_font'] );

		$footer_border_top    = str_replace("border:", "border-top:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_footer['footer_border_top'] ));
		$footer_border_bottom = str_replace("border:", "border-bottom:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_footer['footer_border_bottom'] ));
		$footer_border_left   = str_replace("border:", "border-left:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_footer['footer_border_left'] ));
		$footer_border_right  = str_replace("border:", "border-right:", $wp_email_template_admin_interface->generate_border_style_css( $wp_email_template_style_footer['footer_border_right'] ));
		$footer_border_corner = stripslashes($wp_email_template_admin_interface->generate_border_corner_css( $wp_email_template_style_footer['footer_border_corner'] ));
		$footer_border        = $footer_border_top.$footer_border_bottom.$footer_border_left.$footer_border_right.$footer_border_corner;


		$list_footer_shortcode = array(
			'email_footer'                 => wpautop(wptexturize(stripslashes($wp_email_template_email_footer))),
			'follow_text'                  => $follow_text,
			'email_facebook'               => $facebook_html,
			'email_twitter'                => $twitter_html,
			'email_linkedIn'               => $linkedIn_html,
			'email_pinterest'              => $pinterest_html,
			'email_googleplus'             => $googleplus_html,

			'background_colour'            => stripslashes($wp_email_template_general['background_colour']),
			'background_pattern_image'     => $background_pattern_image,
			'wordpress_email_template_url' => $wordpress_email_template_url,
			'footer_font'                  => $footer_font ,
			'footer_background_colour'     => stripslashes($wp_email_template_style_footer['footer_background_colour']),
			'footer_padding_top'           => stripslashes($wp_email_template_style_footer['footer_padding_top']),
			'footer_padding_bottom'        => stripslashes($wp_email_template_style_footer['footer_padding_bottom']),
			'footer_padding_left'          => stripslashes($wp_email_template_style_footer['footer_padding_left']),
			'footer_padding_right'         => stripslashes($wp_email_template_style_footer['footer_padding_right']),
			'footer_margin_top'            => stripslashes($wp_email_template_style_footer['footer_margin_top']),
			'footer_margin_bottom'         => stripslashes($wp_email_template_style_footer['footer_margin_bottom']),
			'footer_margin_left'           => stripslashes($wp_email_template_style_footer['footer_margin_left']),
			'footer_margin_right'          => stripslashes($wp_email_template_style_footer['footer_margin_right']),
			'footer_border'                => $footer_border,
		);

		foreach ($list_footer_shortcode as $shortcode => $value) {
			$template_html = str_replace('<!--'.$shortcode.'-->', $value, $template_html);
			$template_html = str_replace('/*'.$shortcode.'*/', $value, $template_html);
		}

		return $template_html;
	}

	public static function email_header($email_heading='') {
		$file 	= 'email_header.html';
		if (file_exists(STYLESHEETPATH . '/'. $file)) {
			// $header_template_path = get_stylesheet_directory() . '/emails/'. $file;
			$header_template_path = STYLESHEETPATH . '/emails/'. $file;
			$header_template_url = get_stylesheet_directory_uri() . '/emails/'. $file;
		} else {

			$header_template_path = WP_EMAIL_TEMPLATE_DIR . '/emails/'. $file;
			$header_template_url = WP_EMAIL_TEMPLATE_URL . '/emails/'. $file;
		}

		$template_html = file_get_contents($header_template_path);
		if ($template_html == false) {
			$ch = curl_init($header_template_url);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$template_html = curl_exec($ch);
			curl_close($ch);
		}

		$template_html = WP_Email_Template_Functions::replace_shortcode_header($template_html, $email_heading);

		return $template_html;
	}

	public static function email_footer() {
		global $wp_email_template_fonts_face, $wp_email_template_style_fonts;
		$file 	= 'email_footer.html';

		if (file_exists(STYLESHEETPATH . '/'. $file)) {
			// $footer_template_path = get_stylesheet_directory() . '/emails/'. $file;
			$footer_template_path = STYLESHEETPATH . '/emails/'. $file;
			$footer_template_url = get_stylesheet_directory_uri() . '/emails/'. $file;
		} else {
			$footer_template_path = WP_EMAIL_TEMPLATE_DIR . '/emails/'. $file;
			$footer_template_url = WP_EMAIL_TEMPLATE_URL . '/emails/'. $file;
		}

		$template_html = file_get_contents($footer_template_path);
		if ($template_html == false) {
			$ch = curl_init($footer_template_url);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$template_html = curl_exec($ch);
			curl_close($ch);
		}

		$template_html = WP_Email_Template_Functions::replace_shortcode_footer($template_html);

		$h1_font     = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_fonts['h1_font'] );
		$h2_font     = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_fonts['h2_font'] );
		$h3_font     = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_fonts['h3_font'] );
		$h4_font     = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_fonts['h4_font'] );
		$h5_font     = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_fonts['h5_font'] );
		$h6_font     = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_fonts['h6_font'] );

		$template_html = str_replace('<h1>', '<h1 style="margin:0 0 10px;padding:0;'.$h1_font.'">', $template_html);
		$template_html = str_replace('<h2>', '<h2 style="margin:0 0 10px;padding:0;'.$h2_font.'">', $template_html);
		$template_html = str_replace('<h3>', '<h3 style="margin:0 0 10px;padding:0;'.$h3_font.'">', $template_html);
		$template_html = str_replace('<h4>', '<h4 style="margin:0 0 10px;padding:0;'.$h4_font.'">', $template_html);
		$template_html = str_replace('<h5>', '<h5 style="margin:0 0 10px;padding:0;'.$h5_font.'">', $template_html);
		$template_html = str_replace('<h6>', '<h6 style="margin:0 0 10px;padding:0;'.$h6_font.'">', $template_html);
		$template_html = str_replace('<h1 style=""', '<h1 style="margin:0 0 10px;padding:0;'.$h1_font.'"', $template_html);
		$template_html = str_replace('<h2 style=""', '<h2 style="margin:0 0 10px;padding:0;'.$h2_font.'"', $template_html);
		$template_html = str_replace('<h3 style=""', '<h3 style="margin:0 0 10px;padding:0;'.$h3_font.'"', $template_html);
		$template_html = str_replace('<h4 style=""', '<h4 style="margin:0 0 10px;padding:0;'.$h4_font.'"', $template_html);
		$template_html = str_replace('<h5 style=""', '<h5 style="margin:0 0 10px;padding:0;'.$h5_font.'"', $template_html);
		$template_html = str_replace('<h6 style=""', '<h6 style="margin:0 0 10px;padding:0;'.$h6_font.'"', $template_html);
		$template_html = str_replace("<p>", '<p style="margin:0 0 10px;padding:0;line-height:1.2em">', $template_html);

		return $template_html;
	}

	public static function email_content($email_heading='', $message='', $preview_mode=false) {
		global $wp_email_template_fonts_face, $wp_email_template_style_fonts;
		global $wp_email_template_general;
		$html = '';

		// Don't remove email template when it's preview mode
		if ( ! $preview_mode ) {
			// Don't apply WP Email Template for email content has exclude shortcodes
			$exclude_shortcode = trim( $wp_email_template_general['exclude_shortcode'] );
			if ( '' == $exclude_shortcode ) $exclude_shortcode = '[not_apply_email_template]';
			if ( stristr( $message, $exclude_shortcode ) !== false ) {
				$message = str_replace( $exclude_shortcode, '', $message );
				$message = str_replace( '[not_apply_email_template]', '', $message );
				return $message;
			}

			// Don't apply WP Email Template if disable this feature
			if ( $wp_email_template_general['apply_template_all_emails'] != 'yes' ) {
				return $message;
			}
		}

		if (stristr($message, '<!--NO_USE_EMAIL_TEMPLATE-->') === false )
			$html .= WP_Email_Template_Functions::email_header($email_heading);

		$html .= wpautop( make_clickable( $message) );

		if (stristr($message, '<!--NO_USE_EMAIL_TEMPLATE-->') === false ) {
			$html .= WP_Email_Template_Functions::email_footer();
			$html .= '<!--NO_USE_EMAIL_TEMPLATE-->';
		}

		$h1_font     = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_fonts['h1_font'] );
		$h2_font     = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_fonts['h2_font'] );
		$h3_font     = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_fonts['h3_font'] );
		$h4_font     = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_fonts['h4_font'] );
		$h5_font     = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_fonts['h5_font'] );
		$h6_font     = $wp_email_template_fonts_face->generate_font_css( $wp_email_template_style_fonts['h6_font'] );

		$html = str_replace('<h1>', '<h1 style="margin:0 0 10px;padding:0;'.$h1_font.'">', $html);
		$html = str_replace('<h2>', '<h2 style="margin:0 0 10px;padding:0;'.$h2_font.'">', $html);
		$html = str_replace('<h3>', '<h3 style="margin:0 0 10px;padding:0;'.$h3_font.'">', $html);
		$html = str_replace('<h4>', '<h4 style="margin:0 0 10px;padding:0;'.$h4_font.'">', $html);
		$html = str_replace('<h5>', '<h5 style="margin:0 0 10px;padding:0;'.$h5_font.'">', $html);
		$html = str_replace('<h6>', '<h6 style="margin:0 0 10px;padding:0;'.$h6_font.'">', $html);
		$html = str_replace('<h1 style=""', '<h1 style="margin:0 0 10px;padding:0;'.$h1_font.'"', $html);
		$html = str_replace('<h2 style=""', '<h2 style="margin:0 0 10px;padding:0;'.$h2_font.'"', $html);
		$html = str_replace('<h3 style=""', '<h3 style="margin:0 0 10px;padding:0;'.$h3_font.'"', $html);
		$html = str_replace('<h4 style=""', '<h4 style="margin:0 0 10px;padding:0;'.$h4_font.'"', $html);
		$html = str_replace('<h5 style=""', '<h5 style="margin:0 0 10px;padding:0;'.$h5_font.'"', $html);
		$html = str_replace('<h6 style=""', '<h6 style="margin:0 0 10px;padding:0;'.$h6_font.'"', $html);
		$html = str_replace("<p>", '<p style="margin:0 0 10px;padding:0;line-height:1.2em">', $html);

		return $html;
	}

	public static function apply_email_template_notice($message='') {
		$message_html = '';
		if ( trim($message) != '') {
			$message_html = '<div style="position:fixed; width: 79%; margin:0 10%; top: 10px; padding:5px 10px; border:1px solid #E6DB55; background:#FFFFE0; font-size:15px; line-height:20px;">'.$message.'</div>';
		}

		return $message_html;
	}

	public static function send($to, $subject, $message, $headers = "Content-Type: text/html\r\n", $attachments = "") {
		ob_start();

		wp_mail( $to, $subject, $message, $headers, $attachments );

		ob_end_clean();
	}

	/**
	 * Hex darker/lighter/contrast functions for colours
	 **/
	public static function rgb_from_hex( $color ) {
		$color = str_replace( '#', '', $color );
		// Convert shorthand colors to full format, e.g. "FFF" -> "FFFFFF"
		$color = preg_replace( '~^(.)(.)(.)$~', '$1$1$2$2$3$3', $color );

		$rgb['R'] = hexdec( $color{0}.$color{1} );
		$rgb['G'] = hexdec( $color{2}.$color{3} );
		$rgb['B'] = hexdec( $color{4}.$color{5} );
		return $rgb;
	}

	public static function hex_darker( $color, $factor = 30 ) {
		$base = WP_Email_Template_Functions::rgb_from_hex( $color );
		$color = '#';

		foreach ($base as $k => $v) :
	        $amount = $v / 100;
	        $amount = round($amount * $factor);
	        $new_decimal = $v - $amount;

	        $new_hex_component = dechex($new_decimal);
	        if(strlen($new_hex_component) < 2) :
	        	$new_hex_component = "0".$new_hex_component;
	        endif;
	        $color .= $new_hex_component;
		endforeach;

		return $color;
	}

	public static function hex_lighter( $color, $factor = 30 ) {
		$base = WP_Email_Template_Functions::rgb_from_hex( $color );
		$color = '#';

	    foreach ($base as $k => $v) :
	        $amount = 255 - $v;
	        $amount = $amount / 100;
	        $amount = round($amount * $factor);
	        $new_decimal = $v + $amount;

	        $new_hex_component = dechex($new_decimal);
	        if(strlen($new_hex_component) < 2) :
	        	$new_hex_component = "0".$new_hex_component;
	        endif;
	        $color .= $new_hex_component;
	   	endforeach;

	   	return $color;
	}

	/**
	 * Detect if we should use a light or dark colour on a background colour
	 **/
	public static function light_or_dark( $color, $dark = '#000000', $light = '#FFFFFF' ) {
	    //return ( hexdec( $color ) > 0xffffff / 2 ) ? $dark : $light;
	    $hex = str_replace( '#', '', $color );

		$c_r = hexdec( substr( $hex, 0, 2 ) );
		$c_g = hexdec( substr( $hex, 2, 2 ) );
		$c_b = hexdec( substr( $hex, 4, 2 ) );
		$brightness = ( ( $c_r * 299 ) + ( $c_g * 587 ) + ( $c_b * 114 ) ) / 1000;

		return $brightness > 155 ? $dark : $light;
	}

}
?>