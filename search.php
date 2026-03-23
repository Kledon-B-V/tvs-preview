<?php get_header(); ?>
<section class="section page-hero page-hero--sm">
  <div class="container">
    <h1>Zoekresultaten voor: &ldquo;<?php echo esc_html(get_search_query()); ?>&rdquo;</h1>
  </div>
</section>
<section class="section">
  <div class="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <article class="search-result">
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p><?php the_excerpt(); ?></p>
      </article>
    <?php endwhile; else : ?>
      <p>Geen resultaten gevonden. Probeer andere zoektermen.</p>
    <?php endif; ?>
  </div>
</section>
<?php get_footer(); ?>
