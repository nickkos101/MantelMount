<?php 
GLOBAL $webnus_options;

?><section class="footbot">
	<div class="container">
				<div class="col-md-6">
		<!-- footer-navigation /end -->
		<?php if( 1 == $webnus_options->webnus_footer_bottom_left() ): ?>
			<div class="footer-navi">			
				<a href="http://inspyregroup.com/" target="_blank"><img src="<?php echo $webnus_options->webnus_footer_logo(); ?>" width="120" alt=""></a> 
			</div>
		<?php
		
		elseif(2 == $webnus_options->webnus_footer_bottom_left()):
		?>
		<div class="footer-navi">
		<?php
		if(has_nav_menu('footer-menu')){
			$menuParameters = array(
				'theme_location'=>'footer-menu',
				'container'       => false,
				'echo'            => false,
				'items_wrap'      => '%3$s',
				'after'      => ' | ',
				'depth'           => 0,
			);

		echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
		}
		echo '</div>';
		elseif(3 == $webnus_options->webnus_footer_bottom_left()):
		?>
		<div class="footer-navi">
		<?php
		echo $webnus_options->webnus_footer_copyright();
		echo '</div>';
		endif;
		?>
		
		</div>
		<div class="col-md-6">
		<!-- footer-navigation /end -->
		<?php if( 1 == $webnus_options->webnus_footer_bottom_right() ): ?>
			<div class="footer-navi2"><strong>MantelMount</strong> | 2043 San Elijo Avenue | Cardiff by the Sea, CA 92007 | <span class="telephonenumber">Phone: (800) 897-9755</span></div> 
		<?php
		
		elseif(2 == $webnus_options->webnus_footer_bottom_right()):
		?>`
		<div class="footer-navi floatright">
		<?php
		if(has_nav_menu('footer-menu')){
			$menuParameters = array(
				'theme_location'=>'footer-menu',
				'container'       => false,
				'echo'            => false,
				'items_wrap'      => '%3$s',
				'after'      => ' | ',
				'depth'           => 0,
			);

		echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
		}
		echo '</div>';
		elseif(3 == $webnus_options->webnus_footer_bottom_right()):
		?>
		<div class="footer-navi floatright">
		<?php
		echo $webnus_options->webnus_footer_copyright();
		echo '</div>';
		endif;
		?>
		
		</div>
	</div>
</section>