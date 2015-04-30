<?php
GLOBAL $webnus_options;
?>
<?php if( $webnus_options->webnus_header1_sticky() ): ?>
<div id="sticker">
<?php endif; ?>
<header id="header">
	<div  class="container">
	 <div class="col-md-5 col-sm-5">
		<div class="logo">
			<a href="<?php echo home_url( '/' ); ?>">
				<?php
					$logo = $webnus_options->webnus_logo();
					if(!empty($logo))
					{
						?>
						<img src="<?php echo $logo; ?>" width="<?php $logo_width = $webnus_options->webnus_logo_width(); echo !empty($logo_width)?$logo_width:"150"; ?>" id="img-logo" alt="logo">
						<?php 
						}else{ ?>
						<h5 id="site-title"><?php bloginfo( 'name' ); ?>
						<small>
						<?php 
										
							$slogan = $webnus_options->webnus_slogan();
						   
							if( empty($slogan))
								bloginfo( 'description' );
							else
								echo $slogan;
										
										
						?>
						</small></h5>

				<?php } ?>
			</a>
		</div></div>
		<?php
		$logo_rightside = $webnus_options->webnus_header_logo_rightside();
		if( 0 != $logo_rightside )
		{
			if( 1 == $logo_rightside )
			{
			?>
				<div class="col-md-7 col-sm-7 alignright">
					<hr class="vertical-space" />
<div class="socailfollow rgtflot">

	<a href="#" class="facebook"><i class="icomoon-facebook"></i></a>

	<a href="#" class="twitter"><i class="icomoon-twitter"></i></a>

	<a href="#" class="pinterest"><i class="icomoon-pinterest"></i></a>

        <a href="#" class="instagram"><i class="icomoon-instagram"></i></a>
    
</div>
					
				</div>
				
			<?php
			}else
			{
			?>
				<div class="col-md-9 col-sm-9 alignright"><hr class="vertical-space" /><h6><i class="icomoon-envelop-2"></i> <?php echo $webnus_options->webnus_header_email(); ?></h6> <h6><i class="icomoon-phone-2"></i> <?php echo $webnus_options->webnus_header_phone(); ?></h6></div>
		<?php 
			}
		}
		?>
		
	</div>

	<nav id="nav-wrap" class="nav-wrap2 <?php 
		
		switch($webnus_options->webnus_header_menu_type()){
			case 3:
				echo 'darknavi';
				break;
			case 4:
				echo 'mn4';
				break;
			case 5:
				echo 'mn4 darknavi';
				break;
			default:
				echo '';
		}


	?>">
		<div class="container">	
			<?php
				if ( has_nav_menu( 'header-menu' ) ) { 
					wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul id="%1$s">%3$s</ul>',  'walker' => new description_walker() ) );
				}
			?>
		</div>
	</nav>
			<!-- /nav-wrap -->
	
</header>
<?php if( $webnus_options->webnus_header1_sticky() ): ?>
</div>
<?php endif; ?>
<!-- end-header -->
