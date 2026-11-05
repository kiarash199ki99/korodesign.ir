<?php get_header(); ?>
<main class="container content-page">
  <div class="page-intro">
    <span class="eyebrow">مجله <?php bloginfo('name'); ?></span>
    <h1><?php single_post_title(); ?></h1>
    <p>قصه‌ها، راهنماها و ایده‌هایی برای زیباتر سفر کردن.</p>
  </div>
  <?php if (have_posts()) : ?>
    <div class="blog-grid">
      <?php while (have_posts()) : the_post(); ?>
        <article>
          <span class="blog-image">
            <?php if (has_post_thumbnail()) : the_post_thumbnail('aseman_card'); else : ?>
              <span class="blog-placeholder"><?php echo aseman_icon('plane', 30); ?></span>
            <?php endif; ?>
          </span>
          <span class="blog-meta"><?php echo esc_html(aseman_blog_category()); ?> · ۵ دقیقه مطالعه</span>
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?> <?php echo aseman_icon('arrow-up-left', 14); ?></a></h3>
        </article>
      <?php endwhile; ?>
    </div>
    <div class="pagination"><?php the_posts_pagination(['mid_size' => 1]); ?></div>
  <?php else : ?>
    <p class="empty-state">نوشته‌ای یافت نشد. از بخش «نوشته‌ها» در پیشخوان، نخستین مطلب را منتشر کنید.</p>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
