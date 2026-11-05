<?php get_header(); ?>
<main class="container content-page">
  <?php while (have_posts()) : the_post(); ?>
    <article class="article-card">
      <span class="eyebrow"><?php echo esc_html(aseman_blog_category()); ?></span>
      <h1><?php the_title(); ?></h1>
      <p class="article-meta"><?php echo esc_html(get_the_date('j F Y')); ?> · <?php echo esc_html(get_the_author()); ?></p>
      <?php if (has_post_thumbnail()) : ?>
        <span class="article-thumb"><?php the_post_thumbnail('large'); ?></span>
      <?php endif; ?>
      <div class="prose-copy"><?php the_content(); ?></div>
      <div class="dialog-actions">
        <a class="btn small" href="#flight-search">جستجوی پرواز <?php echo aseman_icon('arrow-left', 15); ?></a>
        <a class="btn outline small" href="<?php echo esc_url(home_url('/blog/')); ?>">بازگشت به مجله سفر</a>
      </div>
    </article>
  <?php endwhile; ?>
</main>
<?php get_footer(); ?>
