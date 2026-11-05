<?php get_header();

$cities       = aseman_cities();
$destinations = aseman_destinations();
$services     = aseman_services();
$why          = aseman_why();
$testimonials = aseman_testimonials();
$stats        = aseman_stats();
$faqs         = aseman_faqs();
$samples      = aseman_sample_tours();
?>
<main>
<section class="hero">
  <img class="hero-poster" src="<?php echo aseman_img('hero.jpg'); ?>" alt="بال هواپیما بر فراز ابرهای روشن" width="1920" height="1088">
  <video class="hero-video" src="<?php echo aseman_video('sky-flight.webm'); ?>" poster="<?php echo aseman_img('hero.jpg'); ?>" autoplay muted loop playsinline aria-hidden="true"></video>
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <span class="hero-eyebrow"><span></span> به مقصد رویاهای شما</span>
    <h1>سفر بعدی شما،<br>از اینجا آغاز می‌شود</h1>
    <p>بلیط هواپیما، تورهای داخلی و خارجی و تجربه‌ای متفاوت<br class="desktop-break"> از سفر را با ما تجربه کنید.</p>
    <div class="hero-ctas">
      <a class="btn" href="#flight-search">رزرو بلیط <?php echo aseman_icon('arrow-left', 16); ?></a>
      <a class="btn ghost" href="#destinations">کشف مقاصد <?php echo aseman_icon('arrow-up-left', 16); ?></a>
    </div>
  </div>
  <div class="hero-bottom">
    <span>دنیا منتظر شماست <?php echo aseman_icon('arrow-down', 16); ?></span>
    <button type="button" id="video-toggle" aria-label="توقف ویدیو">
      <span class="is-playing"><?php echo aseman_icon('pause', 15); ?></span>
      <span class="is-paused"><?php echo aseman_icon('play', 15); ?></span>
    </button>
  </div>
</section>

<div class="container search-overlap">
  <div class="flight-search" id="flight-search">
    <div class="search-top">
      <div class="trip-tabs" role="tablist" aria-label="نوع سفر">
        <button type="button" role="tab" aria-selected="true" class="selected" data-trip="round">رفت و برگشت</button>
        <button type="button" role="tab" aria-selected="false" data-trip="one">یک‌طرفه</button>
      </div>
      <span><?php echo aseman_icon('plane-takeoff', 15); ?> جهان، به شما نزدیک‌تر است</span>
    </div>
    <form class="search-fields" id="flight-form" novalidate>
      <div class="city-fields">
        <label>
          <span><?php echo aseman_icon('plane-takeoff', 14); ?>مبدا</span>
          <select name="origin" aria-label="مبدا">
            <?php foreach ($cities as $c) : ?><option value="<?php echo esc_attr($c); ?>"<?php selected($c, 'تهران'); ?>><?php echo esc_html($c); ?></option><?php endforeach; ?>
          </select>
        </label>
        <button type="button" class="swap-button" aria-label="جابه‌جایی مبدا و مقصد" title="جابه‌جایی مبدا و مقصد"><?php echo aseman_icon('arrow-left-right', 12); ?></button>
        <label>
          <span><?php echo aseman_icon('plane-landing', 14); ?>مقصد</span>
          <select name="destination" aria-label="مقصد">
            <?php foreach ($cities as $c) : ?><option value="<?php echo esc_attr($c); ?>"<?php selected($c, 'استانبول'); ?>><?php echo esc_html($c); ?></option><?php endforeach; ?>
          </select>
        </label>
      </div>
      <label>
        <span><?php echo aseman_icon('calendar-days', 14); ?>تاریخ رفت</span>
        <input type="date" name="depart" aria-label="تاریخ رفت" required>
      </label>
      <label class="return-field">
        <span><?php echo aseman_icon('calendar-days', 14); ?>تاریخ برگشت</span>
        <input type="date" name="back" aria-label="تاریخ برگشت">
      </label>
      <label>
        <span><?php echo aseman_icon('users', 14); ?>مسافران</span>
        <select name="passengers" aria-label="مسافران">
          <?php foreach (['۱ مسافر', '۲ مسافر', '۳ مسافر', '۴ مسافر', '۵ مسافر', '۶ مسافر'] as $p) : ?>
            <option value="<?php echo esc_attr($p); ?>"><?php echo esc_html($p); ?></option>
          <?php endforeach; ?>
        </select>
      </label>
      <label>
        <span><?php echo aseman_icon('armchair', 14); ?>کلاس پروازی</span>
        <select name="seat" aria-label="کلاس پروازی">
          <?php foreach (['اکونومی', 'بیزینس', 'فرست کلاس'] as $s) : ?>
            <option value="<?php echo esc_attr($s); ?>"><?php echo esc_html($s); ?></option>
          <?php endforeach; ?>
        </select>
      </label>
      <button class="btn search-button" type="submit"><?php echo aseman_icon('search', 15); ?>جستجوی پرواز</button>
    </form>
    <p class="form-error" id="flight-error" role="alert" hidden></p>
    <div class="search-summary" id="flight-summary" hidden>
      <strong id="summary-route"></strong>
      <span id="summary-meta"></span>
      <span id="summary-depart"></span>
      <span id="summary-back"></span>
      <p class="search-note">اطلاعات سفر شما آماده است. نمایش موجودی و قیمت زندهٔ پروازها نیازمند اتصال به سامانهٔ رزرو است؛ در این نسخه بلیطی صادر نمی‌شود.</p>
      <div class="summary-actions">
        <button type="button" class="btn outline small" id="summary-edit">ویرایش جستجو</button>
      </div>
    </div>
    <p class="search-note">جستجوی پرواز نمایشی است و هنوز به سامانهٔ رزرو واقعی متصل نشده است؛ بلیطی صادر یا پرداختی انجام نمی‌شود.</p>
  </div>
</div>

<div class="container trust-strip">
  <span><?php echo aseman_icon('shield-check', 14); ?>رزرو با خیال راحت</span>
  <span><?php echo aseman_icon('headphones', 14); ?>همراه شما در تمام مسیر</span>
  <span><?php echo aseman_icon('globe-2', 14); ?>دنیایی از انتخاب</span>
</div>

<section class="container section reveal" id="destinations">
  <div class="section-heading">
    <div>
      <span class="eyebrow">دنیا را از نزدیک ببینید</span>
      <h2>مقصد بعدی شما کجاست؟</h2>
      <p>از شهرهای پرهیجان دنیا تا آرام‌ترین سواحل، مقصد مورد علاقه‌تان را پیدا کنید.</p>
    </div>
    <a class="section-link" href="#tours">مشاهده همه <?php echo aseman_icon('arrow-left', 14); ?></a>
  </div>
  <div class="destination-grid">
    <?php foreach ($destinations as $i => $d) : ?>
      <button type="button" class="destination-card reveal"
        data-name="<?php echo esc_attr($d['name']); ?>"
        data-country="<?php echo esc_attr($d['country']); ?>"
        data-price="<?php echo esc_attr($d['price']); ?>"
        data-desc="<?php echo esc_attr($d['description']); ?>"
        data-img="<?php echo esc_url(aseman_img($d['image'])); ?>">
        <img src="<?php echo esc_url(aseman_img($d['image'])); ?>" alt="<?php echo esc_attr($d['name'] . '، ' . $d['country']); ?>" width="600" height="760" loading="lazy">
        <span class="destination-number">۰<?php echo (int) $i + 1; ?></span>
        <span class="destination-content">
          <span><?php echo esc_html($d['country']); ?></span>
          <h3><?php echo esc_html($d['name']); ?></h3>
          <span class="destination-row">
            <span>از <strong><?php echo esc_html($d['price']); ?></strong> <small>تومان</small></span>
            <?php echo aseman_icon('arrow-up-left', 22); ?>
          </span>
        </span>
      </button>
    <?php endforeach; ?>
  </div>
</section>

<section class="services-section reveal" id="services">
  <div class="container">
    <div class="section-heading">
      <div>
        <span class="eyebrow">شما فقط به سفر فکر کنید</span>
        <h2>همه چیز برای یک سفر بی‌دغدغه</h2>
      </div>
    </div>
    <div class="services-grid">
      <?php foreach ($services as $s) : ?>
        <div class="service-item">
          <?php echo aseman_icon($s['icon'], 30); ?>
          <h3><?php echo esc_html($s['title']); ?></h3>
          <p><?php echo esc_html($s['text']); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="container section experience-section reveal" id="about">
  <div class="experience-visual">
    <img src="<?php echo aseman_img('experience.jpg'); ?>" alt="اقامتگاه لوکس در میان طبیعت و آب" width="1100" height="850" loading="lazy">
    <span class="image-caption">لحظه‌هایی که با شما می‌مانند</span>
  </div>
  <div class="experience-copy">
    <span class="eyebrow">سفر، به سبک شما</span>
    <h2>بیشتر از یک بلیط،<br>یک تجربه</h2>
    <p>بعضی سفرها فقط جابه‌جایی نیستند؛ فرصتی‌اند برای کشف، برای آرامش و برای ساختن خاطره‌هایی تازه.</p>
    <p>از انتخاب پرواز تا اقامت در هتلی خاص و تجربه‌های محلی، جزئیات سفر شما را با دقت و سلیقه کنار هم می‌چینیم.</p>
    <a class="btn outline" href="#services">مشاهده خدمات <?php echo aseman_icon('arrow-left', 16); ?></a>
    <div class="experience-footnote">
      <span>با دقت انتخاب‌شده</span>
      <span>با عشق برنامه‌ریزی‌شده</span>
    </div>
  </div>
</section>

<section class="partners container reveal">
  <p>هم‌مسیر با معتبرترین ایرلاین‌های جهان</p>
  <div dir="ltr">
    <span class="partner-emirates">Emirates</span>
    <span class="partner-qatar">QATAR<small>AIRWAYS</small></span>
    <span class="partner-turkish">&#9673; TURKISH<br>AIRLINES</span>
    <span class="partner-lufthansa">&#9673; Lufthansa</span>
    <span class="partner-airfrance">AIRFRANCE &#9568;</span>
    <span class="partner-singapore">SINGAPORE<br><small>AIRLINES</small></span>
  </div>
</section>

<section class="container section reveal" id="tours">
  <div class="section-heading">
    <div>
      <span class="eyebrow">فرصت‌های خاص، سفرهای ماندگار</span>
      <h2>تورهای ویژه</h2>
      <p>مجموعه‌ای منتخب از سفرهایی که ارزش تجربه کردن دارند.</p>
    </div>
    <a class="section-link" href="<?php echo esc_url(home_url('/tours/')); ?>">مشاهده همه <?php echo aseman_icon('arrow-left', 14); ?></a>
  </div>
  <div class="package-grid">
    <?php
    $tours = new WP_Query(['post_type' => 'tour', 'posts_per_page' => 3, 'no_found_rows' => true]);
    if ($tours->have_posts()) :
      while ($tours->have_posts()) : $tours->the_post();
        $rating   = get_post_meta(get_the_ID(), 'rating', true);
        $duration = get_post_meta(get_the_ID(), 'duration', true);
        $hotel    = get_post_meta(get_the_ID(), 'hotel', true);
        $price    = get_post_meta(get_the_ID(), 'price', true);
        $dest     = get_post_meta(get_the_ID(), 'destination', true);
        ?>
        <a class="package-card reveal" href="<?php the_permalink(); ?>">
          <span class="package-image">
            <?php if (has_post_thumbnail()) : the_post_thumbnail('aseman_card'); else : ?>
              <img src="<?php echo aseman_img('experience.jpg'); ?>" alt="" loading="lazy">
            <?php endif; ?>
            <span><?php echo aseman_icon('star', 13, 'fill="currentColor"'); ?><?php echo esc_html($rating ? $rating : '۴٫۸'); ?></span>
          </span>
          <span class="package-body">
            <p><?php echo esc_html(($dest ? $dest : get_the_excerpt()) . ($duration ? ' · ' . $duration : '')); ?></p>
            <h3><?php the_title(); ?></h3>
            <span class="hotel-label"><?php echo aseman_icon('hotel', 15); ?><?php echo esc_html($hotel ? $hotel : 'خدمات انتخابی'); ?></span>
            <span class="package-bottom">
              <span>از <strong><?php echo esc_html($price ? $price : '—'); ?></strong><small> تومان</small></span>
              <span>مشاهده تور <?php echo aseman_icon('arrow-left', 14); ?></span>
            </span>
          </span>
        </a>
        <?php
      endwhile;
      wp_reset_postdata();
    else :
      foreach ($samples as $t) : ?>
        <div class="package-card reveal">
          <span class="package-image">
            <img src="<?php echo esc_url(aseman_img($t['image'])); ?>" alt="<?php echo esc_attr($t['destination']); ?>" loading="lazy">
            <span><?php echo aseman_icon('star', 13, 'fill="currentColor"'); ?><?php echo esc_html($t['rating']); ?></span>
          </span>
          <span class="package-body">
            <p><?php echo esc_html($t['destination'] . ' · ' . $t['duration']); ?></p>
            <h3><?php echo esc_html($t['name']); ?></h3>
            <span class="hotel-label"><?php echo aseman_icon('hotel', 15); ?><?php echo esc_html($t['hotel']); ?></span>
            <span class="package-bottom">
              <span>از <strong><?php echo esc_html($t['price']); ?></strong><small> تومان</small></span>
              <span>نمونه <?php echo aseman_icon('arrow-left', 14); ?></span>
            </span>
          </span>
        </div>
      <?php endforeach;
    endif; ?>
  </div>
</section>

<section class="why-section reveal">
  <div class="container">
    <div class="section-heading">
      <div>
        <span class="eyebrow">اعتماد شما، ارزشمندترین همراه ما</span>
        <h2>سفر، وقتی بهتر است که خیالتان راحت باشد</h2>
      </div>
    </div>
    <div class="why-grid">
      <?php foreach ($why as $w) : ?>
        <div>
          <?php echo aseman_icon($w['icon'], 30); ?>
          <div>
            <h3><?php echo esc_html($w['title']); ?></h3>
            <p><?php echo esc_html($w['text']); ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="container section testimonials reveal">
  <div class="section-heading">
    <div>
      <span class="eyebrow">قصه‌های واقعی، حس‌های ماندگار</span>
      <h2>مسافرانی که به ما اعتماد کردند</h2>
    </div>
  </div>
  <div class="testimonial-grid">
    <?php foreach ($testimonials as $t) : ?>
      <article class="testimonial">
        <div class="review-stars">
          <?php for ($k = 0; $k < 5; $k++) : echo aseman_icon('star', 14, 'fill="currentColor"'); endfor; ?>
          <?php echo aseman_icon('quote', 25); ?>
        </div>
        <p>«<?php echo esc_html($t['text']); ?>»</p>
        <div class="review-person">
          <span class="avatar"><?php echo esc_html($t['initial']); ?></span>
          <div>
            <h3><?php echo esc_html($t['name']); ?></h3>
            <span><?php echo esc_html($t['destination']); ?></span>
          </div>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
  <div class="stats">
    <?php foreach ($stats as $s) : ?>
      <div><strong dir="ltr"><?php echo esc_html($s[0]); ?></strong><span><?php echo esc_html($s[1]); ?></span></div>
    <?php endforeach; ?>
  </div>
  <p class="sample-note">نظرها و آمار این بخش نمونه‌اند و باید با تجربه‌ها و داده‌های واقعی جایگزین شوند.</p>
</section>

<section class="blog-section reveal" id="blog">
  <div class="container">
    <div class="section-heading">
      <div>
        <span class="eyebrow">مجله <?php bloginfo('name'); ?></span>
        <h2>الهام‌بخش سفر بعدی شما</h2>
        <p>قصه‌ها، راهنماها و ایده‌هایی برای زیباتر سفر کردن.</p>
      </div>
      <a class="section-link" href="<?php echo esc_url(home_url('/blog/')); ?>">مشاهده همه <?php echo aseman_icon('arrow-left', 14); ?></a>
    </div>
    <div class="blog-grid">
      <?php
      $posts = new WP_Query(['posts_per_page' => 4, 'no_found_rows' => true]);
      if ($posts->have_posts()) :
        while ($posts->have_posts()) : $posts->the_post(); ?>
          <article>
            <span class="blog-image">
              <?php if (has_post_thumbnail()) : the_post_thumbnail('aseman_card'); else : ?>
                <span class="blog-placeholder"><?php echo aseman_icon('plane', 30); ?></span>
              <?php endif; ?>
            </span>
            <span class="blog-meta"><?php echo esc_html(aseman_blog_category()); ?> · ۵ دقیقه مطالعه</span>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?> <?php echo aseman_icon('arrow-up-left', 14); ?></a></h3>
          </article>
          <?php
        endwhile;
        wp_reset_postdata();
      else : ?>
        <p class="empty-state">هنوز نوشته‌ای منتشر نشده است. از بخش «نوشته‌ها» در پیشخوان، نخستین مطلب مجله سفر را اضافه کنید.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="container newsletter reveal" id="newsletter">
  <div>
    <span class="eyebrow">همیشه یک سفر تازه در راه است</span>
    <h2>مقصد بعدی‌تان را از دست ندهید</h2>
    <p>از جدیدترین پیشنهادهای سفر و قیمت‌های ویژه باخبر شوید.</p>
  </div>
  <form data-demo>
    <div>
      <?php echo aseman_icon('mail', 18); ?>
      <input type="email" required placeholder="آدرس ایمیل شما" aria-label="آدرس ایمیل شما" dir="rtl">
      <button class="btn" type="submit">عضویت <?php echo aseman_icon('arrow-left', 15); ?></button>
    </div>
    <p class="form-status" role="status" hidden></p>
  </form>
</section>

<section class="container section faq-section reveal" id="faq">
  <div>
    <span class="eyebrow">پاسخ‌هایی برای یک شروع آسوده</span>
    <h2>پیش از سفر،<br>بیشتر بدانید</h2>
    <p>پاسخ پرسش‌های متداول شما، اینجاست.</p>
    <a class="btn link" href="#newsletter">سوال دیگری دارید؟ <?php echo aseman_icon('arrow-left', 15); ?></a>
  </div>
  <div class="faq-list">
    <?php foreach ($faqs as $i => $f) : ?>
      <div class="faq-item<?php echo $i === 0 ? ' is-open' : ''; ?>">
        <button type="button" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>" aria-controls="faq-answer-<?php echo (int) $i; ?>">
          <?php echo esc_html($f[0]); ?><?php echo aseman_icon('chevron-down', 14); ?>
        </button>
        <p id="faq-answer-<?php echo (int) $i; ?>"<?php echo $i === 0 ? '' : ' hidden'; ?>><?php echo esc_html($f[1]); ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</section>
</main>
<?php get_footer(); ?>
