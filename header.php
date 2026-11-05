<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl" class="no-js">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=1280">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header<?php echo is_front_page() ? ' over-hero' : ''; ?>">
  <nav class="nav-bar" aria-label="منوی اصلی">
    <a class="brand-link" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php bloginfo('name'); ?>، صفحه اصلی">
      <span class="brand"><?php echo aseman_icon('plane', 36); ?><span><?php bloginfo('name'); ?><small>فراتر از یک سفر</small></span></span>
    </a>
    <div class="desktop-nav">
      <?php wp_nav_menu(['theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu', 'depth' => 1, 'fallback_cb' => 'aseman_menu_fallback']); ?>
    </div>
    <div class="nav-actions">
      <button type="button" class="login-button" data-dialog="login-dialog">ورود / ثبت‌نام</button>
      <a class="nav-book" href="#flight-search">رزرو بلیط <?php echo aseman_icon('arrow-up-left', 15); ?></a>
      <button type="button" class="mobile-menu" aria-expanded="false" aria-controls="mobile-navigation" aria-label="باز کردن منو">
        <span class="icon-open"><?php echo aseman_icon('menu', 20); ?></span>
        <span class="icon-close"><?php echo aseman_icon('x', 20); ?></span>
      </button>
    </div>
  </nav>
  <div class="mobile-navigation" id="mobile-navigation">
    <?php wp_nav_menu(['theme_location' => 'primary', 'container' => false, 'menu_class' => 'mobile-list', 'depth' => 1, 'fallback_cb' => 'aseman_menu_fallback']); ?>
    <div class="mobile-actions">
      <button type="button" class="btn outline small" data-dialog="login-dialog">ورود / ثبت‌نام</button>
    </div>
  </div>
</header>
