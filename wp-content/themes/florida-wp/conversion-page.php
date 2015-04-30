<?php
/*

Template Name: Conversion Page

*/
get_header();

GLOBAL $webnus_options;

$last_time = get_the_time(' F Y');


GLOBAL $webnus_page_options_meta;


$show_titlebar = null;
$titlebar_bg = null;
$titlebar_fg = null;
$have_sidebar = false;
$sidebar_pos = null;

$meta = $webnus_page_options_meta->the_meta();

if(!empty($meta)){
$show_titlebar =  isset($meta['webnus_page_options'][0]['show_page_title_bar'])?$meta['webnus_page_options'][0]['show_page_title_bar']:null;
$titlebar_bg =  isset($meta['webnus_page_options'][0]['title_background_color'])?$meta['webnus_page_options'][0]['title_background_color']:null;
$titlebar_fg =  isset($meta['webnus_page_options'][0]['title_text_color'])?$meta['webnus_page_options'][0]['title_text_color']:null;
$sidebar_pos =  isset($meta['webnus_page_options'][0]['sidebar_position'])?$meta['webnus_page_options'][0]['sidebar_position']:'right';
$have_sidebar = !( 'none' == $sidebar_pos )? true : false;

}
if($show_titlebar && ( 'show' == $show_titlebar)):
?>

<section id="headline" style="<?php

/// To change the title bar background color
if(!empty($titlebar_bg)) echo ' background-color:'.$titlebar_bg.';'; 
 
/// To change the title bar text color 


 ?>">
    <div class="container">
      <h3 style="<?php /* TEXT COLOR OF TITLE */ if(!empty($titlebar_fg)) echo ' color:'.$titlebar_fg.';';  ?>"><?php the_title(); ?></h3>
    </div>
</section>
<?php
endif;
?>
<section id="main-content" class="container">
<!-- Start Page Content -->
<?php
/*
	LEFT SIDEBAR
*/

if( ('left' == $sidebar_pos) || ('both' == $sidebar_pos ) ) get_sidebar('left');
if( $have_sidebar ) {
?>
<section class="<?php  echo('both' == $sidebar_pos )?'col-md-4 alpha omega':'col-md-8 omega'; ?>">
	<article>
	
<?php 
}
	
	echo '<div class="row-wrapper-x">';
		  if( have_posts() ): while( have_posts() ): the_post();
			the_content();
		  endwhile;
		  endif;
	echo '</div>';
		  if( $have_sidebar ) {
?>
	</article>
</section>	
<?php
}
/*
	RIGHT SIDEBAR
*/

if( ('right' == $sidebar_pos) || ('both' == $sidebar_pos) ) get_sidebar('right');

?>

</section>
<!-- start bing conversion code -->
<img src="//bat.bing.com/action/0?ti=4030959&Ver=2" height="0" width="0" style="display:none; visibility: hidden;" />
<!-- end bing conversion code -->
<!-- Facebook Conversion Code for Mantel Mount Facebook Lead Gen Ad -->
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', '6016433972933', {'value':'0.01','currency':'USD'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6022905895191&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6016433972933&amp;cd[value]=0.01&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
<!-- end facebook conversion code -->
<!-- Start google conversion code -->
<!-- Google Code for Pre-Pay Inviite List Lead Gen Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 985529199;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "LaklCJqX4FoQ7_b31QM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/985529199/?label=LaklCJqX4FoQ7_b31QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<!-- end google conversion code -->

<?php get_footer(); ?>