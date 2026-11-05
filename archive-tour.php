<?php get_header(); ?>
<main class="container content-page">
  <div class="page-intro">
    <span class="eyebrow">فرصت‌های خاص، سفرهای ماندگار</span>
    <h1>تورهای ویژه</h1>
    <p>مجموعه‌ای منتخب از سفرهایی که ارزش تجربه کردن دارند.</p>
  </div>
  <?php if (have_posts()) : ?>
    <div class="package-grid">
      <?php while (have_posts()) : the_post();
        $rating   = get_post_meta(get_the_ID(), 'rating', true);
        $duration = get_post_meta(get_the_ID(), 'duration', true);
        $hotel    = get_post_meta(get_the_ID(), 'hotel', true);
        $price    = get_post_meta(get_the_ID(), 'price', true);
        $dest     = get_post_meta(get_the_ID(), 'destination', true);
        ?>
        <a class="package-card" href="<?php the_permalink(); ?>">
          <span class="package-image">
            <?php if (has_post_thumbnail()) : the_post_thumbnail('aseman_card'); else : ?>
              <img src="<?php echo aseman_img('experience.jpg'); ?>" alt="" loading="lazy">
            <?php endif; ?>
            <span><?php echo aseman_icon('star', 13, 'fill="currentColor"'); ?><?php echo esc_html($rating ? $rating : '۴٫۸'); ?></span>
          </span>
          <span class="package-body">
            <p><?php echo esc_html(($dest ? $dest : '') . ($duration ? ' · ' . $duration : '')); ?></p>
            <h3><?php the_title(); ?></h3>
            <span class="hotel-label"><?php echo aseman_icon('hotel', 15); ?><?php echo esc_html($hotel ? $hotel : 'خدمات انتخابی'); ?></span>
            <span class="package-bottom">
              <span>از <strong><?php echo esc_html($price ? $price : '—'); ?></strong><small> تومان</small></span>
              <span>مشاهده تور <?php echo aseman_icon('arrow-left', 14); ?></span>
            </span>
          </span>
        </a>
      <?php endwhile; ?>
    </div>
    <div class="pagination"><?php the_posts_pagination(['mid_size' => 1]); ?></div>
  <?php else :
    $samples = aseman_sample_tours(); ?>
    <div class="package-grid">
      <?php foreach ($samples as $s) : ?>
        <article class="package-card">
          <span class="package-image">
            <img src="<?php echo aseman_img($s['image']); ?>" alt="" loading="lazy">
            <span><?php echo aseman_icon('star', 13, 'fill="currentColor"'); ?><?php echo esc_html($s['rating']); ?></span>
          </span>
          <span class="package-body">
            <p><?php echo esc_html($s['destination'] . ' · ' . $s['duration']); ?></p>
            <h3><?php echo esc_html($s['name']); ?></h3>
            <span class="hotel-label"><?php echo aseman_icon('hotel', 15); ?><?php echo esc_html($s['hotel']); ?></span>
            <span class="package-bottom">
              <span>از <strong><?php echo esc_html($s['price']); ?></strong><small> تومان</small></span>
              <span>نمونه</span>
            </span>
          </span>
        </article>
      <?php endforeach; ?>
    </div>
    <p class="empty-state">این تورها نمونه‌اند؛ با افزودن تور از بخش «تورها» در پیشخوان، جای خود را به تورهای واقعی می‌دهند.</p>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
