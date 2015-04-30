<?php

get_header();
GLOBAL $webnus_options;
?>



    <section class="container page-content" >
    <hr class="vertical-space2">
	<?php
	
	if( 'left' == $webnus_options->webnus_blog_sidebar() || 'both' == $webnus_options->webnus_blog_sidebar() ): 
		get_sidebar('bleft');
	endif;
	?>
	<!-- begin-main-content -->
    <section class="<?php echo ( 'both' == $webnus_options->webnus_blog_sidebar() )? 'col-md-4 alpha omega':'col-md-8 omega'?>">
     <?php
    $args = array( 'category_name' => 'featured' );
	 query_posts($args);	
	 if(have_posts()):
		while( have_posts() ): the_post();
			
			if( 'both' == $webnus_options->webnus_blog_sidebar() )
			{
				get_template_part('parts/blogloop','bothsidebar');
			}
			else{
				switch( $webnus_options->webnus_blog_template() )
				{
					case 1:
						get_template_part('parts/blogloop');
						break;
					case 2:
						get_template_part('parts/blogloop','type2');
						break;
					default:
						get_template_part('parts/blogloop');
						break;
					
					
				}
			}
		endwhile;
	 else:
		get_template_part('blogloop-none');
	 endif;
	 wp_reset_query();
	 $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	 $idObj = get_category_by_slug('featured'); 
  	 
	 $id=array();
  	 if($idObj)
  	 $id = $idObj->term_id;
	 
	 query_posts(array('category__not_in' => array( $id ), 'paged'=>$paged));
	 
	 if(have_posts()):
		while( have_posts() ): the_post();
			
			if( 'both' == $webnus_options->webnus_blog_sidebar() )
			{
				get_template_part('parts/blogloop','bothsidebar');
			}
			else{
				switch( $webnus_options->webnus_blog_template() )
				{
					case 1:
						get_template_part('parts/blogloop');
						break;
					case 2:
						get_template_part('parts/blogloop','type2');
						break;
					default:
						get_template_part('parts/blogloop');
						break;
					
					
				}
			}
		endwhile;
	 else:
		get_template_part('blogloop-none');
	 endif;
	 wp_reset_query();
	 ?>
       
      <br class="clear">
   
	  <?php 
		if(function_exists('wp_pagenavi'))
		{
			wp_pagenavi();
		}
	  ?>
      <div class="white-space"></div>
    </section>
    <!-- end-main-content -->
	<?php 
	if( 'right' == $webnus_options->webnus_blog_sidebar() || 'both' == $webnus_options->webnus_blog_sidebar() ): 
		get_sidebar('bright');
	endif;
	?>
    <br class="clear">
  </section>

  <?php 
  get_footer();
  ?>