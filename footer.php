<footer class="footer">
  <div class="container footer-top">
    <div>
      <a class="brand-link" href="<?php echo esc_url(home_url('/')); ?>">
        <span class="brand"><?php echo aseman_icon('plane', 30); ?><span><?php bloginfo('name'); ?><small>فراتر از یک سفر</small></span></span>
      </a>
      <p>هر سفر، آغاز یک داستان تازه است.<br>با <?php bloginfo('name'); ?>، زیباتر سفر کنید.</p>
      <div class="socials">
        <a href="<?php echo esc_url(home_url('/#newsletter')); ?>" aria-label="همراهی در شبکه‌های اجتماعی"><?php echo aseman_icon('at-sign', 14); ?></a>
        <a href="<?php echo esc_url(home_url('/#newsletter')); ?>" aria-label="ارتباط با <?php bloginfo('name'); ?>"><?php echo aseman_icon('send', 14); ?></a>
      </div>
    </div>
    <div>
      <h3>کشف <?php bloginfo('name'); ?></h3>
      <div class="footer-links">
        <a href="#about">درباره ما</a>
        <a href="#services">خدمات ما</a>
        <a href="#destinations">مقاصد گردشگری</a>
        <a href="#tours">تورهای ویژه</a>
      </div>
    </div>
    <div>
      <h3>همراه شما</h3>
      <div class="footer-links">
        <a href="#faq">سوالات متداول</a>
        <a href="#blog">مجله سفر</a>
        <a href="#flight-search">جستجوی پرواز</a>
        <a href="<?php echo esc_url(home_url('/tours/')); ?>">همهٔ تورها</a>
      </div>
    </div>
    <div class="footer-note">
      <?php echo aseman_icon('headphones', 26); ?>
      <h3>آسودگی، در تمام مسیر</h3>
      <p>از اولین تصمیم تا آخرین خاطره،<br>همراه سفر شما هستیم.</p>
      <a href="#newsletter">ارتباط با ما <?php echo aseman_icon('arrow-left', 16); ?></a>
    </div>
  </div>
  <div class="container footer-bottom">
    <span>تمامی حقوق این وب‌سایت محفوظ است. © <?php echo esc_html(date_i18n('Y')); ?> <?php bloginfo('name'); ?></span>
    <span>با عشق به سفر، با نگاه به آسمان <?php echo aseman_icon('plane', 15); ?></span>
  </div>
</footer>

<dialog class="aseman-dialog" id="login-dialog">
  <div class="dialog-body">
    <h2>همراه <?php bloginfo('name'); ?> شوید</h2>
    <p class="dialog-text">ورود و ثبت‌نام هنوز فعال نیست. این نسخه، پیش‌نمایش وب‌سایت است و اطلاعات شخصی یا پرداختی دریافت نمی‌کند.</p>
    <div class="dialog-actions"><button type="button" class="btn small" data-close>متوجه شدم</button></div>
  </div>
</dialog>

<dialog class="aseman-dialog" id="detail-dialog">
  <div class="dialog-body">
    <h2 class="dialog-title"></h2>
    <p class="dialog-sub"></p>
    <img class="detail-photo" alt="">
    <p class="dialog-text"></p>
    <p class="dialog-foot"></p>
    <div class="dialog-actions">
      <a class="btn small" href="#flight-search" data-close>جستجوی پرواز</a>
      <button type="button" class="btn outline small" data-close>بستن</button>
    </div>
  </div>
</dialog>

<?php wp_footer(); ?>
</body>
</html>
