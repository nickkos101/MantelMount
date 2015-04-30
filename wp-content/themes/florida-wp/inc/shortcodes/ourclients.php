<?php

/*
function ourclients_shortcode($attributes, $content){


	extract(shortcode_atts(array(
	'icon'=>'none',
	"title" => 'Our Clients',
	"subtitle"=> '',
	'client_id'=>''
	), $attributes));
	
	$id_array = array();
	
	if(!empty($client_id))
	{
		
		$id_array = explode(',',$client_id);
		
	}
	if(!empty( $id_array ))
	$query_atts = array(

					'post_type'=>'client',
					'nopaging ' => true,
					'posts_per_page'=>-1,
					'post__in' => $id_array,
				);
	else {
		$query_atts = array(

					'post_type'=>'client',
					'nopaging ' => true,
					'posts_per_page'=>-1,
					
				);
	}

	$query = new WP_Query($query_atts);
	
	$client_images_url = '';
	
	if($query->have_posts())
	while($query->have_posts())
	{
			
		$query->the_post();
		$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
		$large_image = $large_image[0];
		$client_images_url .= "<li><img src=\"$large_image\" alt=". get_the_title() . "/></li>";	
	}
	
	
	wp_reset_query();
	$out = '';
	$out .= '<div class="icon-top-title aligncenter"><hr class="vertical-space2">';
	if( 'none' != $icon )
	$out .="<i class=\"$icon\"></i>";
    $out .= '<hr class="vertical-space1">';

	$out .= '<h2 class="subtitle">'. $title .'</h2>';
	$out .= "<h4 class=\"slight\">$subtitle</h4>";
	$out .= '<div class="col-md-12 our-clients-wrap">';
	$out .='<ul id="our-clients" class="our-clients">';
	$out .= $client_images_url;
	$out .= do_shortcode($content);
	$out .='</ul>';
	$out .= '</div><hr class="vertical-space4"></div>';
	
	return $out;
}
add_shortcode("ourclients", "ourclients_shortcode");


function webnus_client($attributes, $content){
	extract(shortcode_atts(array(
		"img" => '',
		"img_alt" => '',
	), $attributes));

return !empty($img)?'<li><img src="'.$img.'" alt="'.$img_alt.'"></li>':'';

}
add_shortcode("client", "webnus_client");
 * */ 
//Old Client




function ourclients_shortcode($attributes, $content){


	extract(shortcode_atts(array(
	"title" => 'Our Clients',
	"subtitle"=> '',
	'client_images'=>'',
	'icon'=>''
	), $attributes));
	
	$client_images_url = '';
	
	if(!empty($client_images))
	{
		
		$images_id_array = array();
		
		$images_id_array =explode(',',$client_images);
		
		foreach($images_id_array as $id)
		{
			$client_images_url .= '<li><img src="' .wp_get_attachment_url( $id ) . '"/></li>';
		}
		
	}
	$out = '';
	
	$out .= '<div class="icon-top-title aligncenter"><hr class="vertical-space2">';
	if(empty($icon) || $icon == 'none')
	$out .="<i class=\"icomoon-users-5\"></i>";
	else
    $out .="<i class=\"{$icon}\"></i>";
    $out .= '<hr class="vertical-space1">';

	$out .= '<h2 class="subtitle">'. $title .'</h2>';
	$out .= "<h4 class=\"slight\">$subtitle</h4>";
	$out .= '<div class="sixteen columns our-clients-wrap">';
	$out .='<ul id="our-clients" class="our-clients">';
	$out .= $client_images_url;
	$out .= do_shortcode($content);
	$out .='</ul>';
	$out .= '</div><hr class="vertical-space4"></div>';
	
	return $out;
}
add_shortcode("ourclients", "ourclients_shortcode");


function webnus_client($attributes, $content){
	extract(shortcode_atts(array(
		"img" => '',
		"img_alt" => '',
	), $attributes));

return !empty($img)?'<li><img src="'.$img.'" alt="'.$img_alt.'"></li>':'';

}
add_shortcode("client", "webnus_client");

?>