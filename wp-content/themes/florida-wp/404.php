<?php
get_header('404');
GLOBAL $webnus_options;
?>

 <section id="hero" class="tbg1">
    <div class="blox dark dark">
      <div class="container alignleft">
        <h1 class="pnf404">Oops...</h1>
        <h2 class="pnf404">The page you are looking for no longer exists.</h2>
        <br>

        <br class="clear">
        <p>&nbsp;</p>
        <?php echo $webnus_options->webnus_404_text(); ?>
      </div>
    </div>
  </section>

<?php get_footer(); ?>
