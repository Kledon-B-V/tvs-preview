<?php
/**
 * Generic page template
 */
get_header();
?>
<section class="section">
  <div class="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <h1><?php the_title(); ?></h1>
      <div class="content"><?php the_content(); ?></div>
    <?php endwhile; endif; ?>
  </div>
</section>
<?php get_footer(); ?>
