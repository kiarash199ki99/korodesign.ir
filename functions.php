<?php
if (!defined('ABSPATH')) exit;

require_once get_theme_file_path('/assets/icons.php');

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', ['search-form', 'gallery', 'caption', 'style', 'script']);
    register_nav_menus([
        'primary' => 'منوی اصلی',
        'footer'  => 'منوی فوتر',
    ]);
    add_image_size('aseman_card', 900, 620, true);
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('aseman-fonts', get_template_directory_uri() . '/assets/fonts.css', [], '1.0');
    wp_enqueue_style('aseman-style', get_stylesheet_uri(), ['aseman-fonts'], '2.0');
    wp_enqueue_script('aseman-main', get_template_directory_uri() . '/assets/main.js', [], '2.0', true);
});

/* تورها: نوع محتوای اختصاصی، قابل مدیریت از پیشخوان */
add_action('init', function () {
    register_post_type('tour', [
        'label'         => 'تورها',
        'labels'        => ['name' => 'تورها', 'singular_name' => 'تور', 'add_new_item' => 'افزودن تور'],
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-airplane',
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'show_in_rest'  => true,
        'rewrite'       => ['slug' => 'tours'],
    ]);
});

/* ---------- ابزارها ---------- */
function aseman_img($name) {
    return esc_url(get_template_directory_uri() . '/assets/img/' . $name);
}

function aseman_video($name) {
    return esc_url(get_template_directory_uri() . '/assets/video/' . $name);
}

function aseman_menu_fallback($args = null) {
    $items = [
        ['صفحه اصلی', home_url('/')],
        ['بلیط هواپیما', home_url('/#flight-search')],
        ['تورها', home_url('/#tours')],
        ['مقاصد', home_url('/#destinations')],
        ['خدمات', home_url('/#services')],
        ['درباره ما', home_url('/#about')],
    ];
    /* وردپرس این آرگومان‌ها را به‌صورت شیء می‌فرستد؛ هر دو حالت را بپذیر */
    $class = '';
    if (is_object($args) && isset($args->menu_class)) {
        $class = (string) $args->menu_class;
    } elseif (is_array($args) && isset($args['menu_class'])) {
        $class = (string) $args['menu_class'];
    }
    if ($class === '') {
        $class = 'menu';
    }
    echo '<ul class="' . esc_attr($class) . '">';
    foreach ($items as $it) {
        echo '<li class="menu-item"><a href="' . esc_url($it[1]) . '">' . esc_html($it[0]) . '</a></li>';
    }
    echo '</ul>';
}

function aseman_footer_fallback() {
    $items = [
        ['درباره ما', home_url('/#about')],
        ['خدمات ما', home_url('/#services')],
        ['مقاصد گردشگری', home_url('/#destinations')],
        ['تورهای ویژه', home_url('/#tours')],
        ['سوالات متداول', home_url('/#faq')],
        ['مجله سفر', home_url('/#blog')],
    ];
    echo '<div class="footer-links">';
    foreach ($items as $it) {
        echo '<a href="' . esc_url($it[1]) . '">' . esc_html($it[0]) . '</a>';
    }
    echo '</div>';
}

/* ---------- داده‌های نمونه (جایگزین با محتوای واقعی) ---------- */
function aseman_cities() {
    return ['تهران', 'استانبول', 'دبی', 'پاریس', 'لندن', 'مالدیو', 'توکیو', 'مشهد', 'شیراز'];
}

function aseman_destinations() {
    return [
        ['name' => 'استانبول', 'country' => 'ترکیه', 'price' => '۱۲٬۹۰۰٬۰۰۰', 'image' => 'istanbul.jpg',
         'description' => 'میان دو قاره، در کوچه‌هایی که تاریخ و زندگی به هم می‌رسند. از تماشای بسفر تا کافه‌های دنج کاراکوی، استانبول همیشه چیزی برای کشف کردن دارد.'],
        ['name' => 'دبی', 'country' => 'امارات', 'price' => '۱۵٬۵۰۰٬۰۰۰', 'image' => 'dubai.jpg',
         'description' => 'از معماری آینده‌نگر تا آرامش ساحل و سکوت کویر؛ تجربه‌ای متفاوت در شهری که هر روز از نو ساخته می‌شود.'],
        ['name' => 'پاریس', 'country' => 'فرانسه', 'price' => '۳۸٬۹۰۰٬۰۰۰', 'image' => 'paris.jpg',
         'description' => 'قدم‌زدن کنار سن، یک قهوه در کافه‌ای قدیمی و تماشای هنر؛ پاریس را باید آرام زندگی کرد.'],
        ['name' => 'لندن', 'country' => 'انگلستان', 'price' => '۴۲٬۵۰۰٬۰۰۰', 'image' => 'london.jpg',
         'description' => 'شهری از فرهنگ، پارک‌های سرسبز و خیابان‌های پرقصه؛ مقصدی برای کشف هر روزه.'],
        ['name' => 'مالدیو', 'country' => 'اقیانوس هند', 'price' => '۴۹٬۹۰۰٬۰۰۰', 'image' => 'maldives.jpg',
         'description' => 'اقیانوسی فیروزه‌ای، شن‌های سفید و روزهایی آرام؛ فرصتی برای فاصله گرفتن از شلوغی دنیا.'],
        ['name' => 'توکیو', 'country' => 'ژاپن', 'price' => '۵۸٬۹۰۰٬۰۰۰', 'image' => 'tokyo.jpg',
         'description' => 'تلاقی سنت و فردا؛ از باغ‌های آرام ژاپنی تا خیابان‌های روشن و تجربه‌های تازه.'],
    ];
}

function aseman_services() {
    return [
        ['icon' => 'plane', 'title' => 'رزرو بلیط هواپیما', 'text' => 'پرواز به هر گوشه از جهان'],
        ['icon' => 'map', 'title' => 'تورهای مسافرتی', 'text' => 'تجربه‌هایی به یاد ماندنی'],
        ['icon' => 'hotel', 'title' => 'رزرو هتل', 'text' => 'اقامتی به سلیقه شما'],
        ['icon' => 'file-check', 'title' => 'خدمات ویزا', 'text' => 'همراه شما تا مقصد'],
        ['icon' => 'shield-check', 'title' => 'بیمه مسافرتی', 'text' => 'آرامش در تمام مسیر'],
        ['icon' => 'car', 'title' => 'ترانسفر فرودگاهی', 'text' => 'آغاز آسوده یک سفر'],
    ];
}

function aseman_why() {
    return [
        ['icon' => 'wallet', 'title' => 'قیمت‌های رقابتی', 'text' => 'انتخاب بهتر برای بودجه شما'],
        ['icon' => 'clock', 'title' => 'رزرو سریع و آسان', 'text' => 'مسیر کوتاه‌تر تا سفر بعدی'],
        ['icon' => 'headphones', 'title' => 'پشتیبانی ۲۴ ساعته', 'text' => 'در تمام مسیر، کنار شما'],
        ['icon' => 'shield-check', 'title' => 'پرداخت امن', 'text' => 'اطمینان در هر مرحله'],
        ['icon' => 'globe-2', 'title' => 'ایرلاین‌های معتبر', 'text' => 'انتخاب از پروازهای بین‌المللی'],
        ['icon' => 'badge-check', 'title' => 'خدمات پس از فروش', 'text' => 'همراهی، حتی پس از رزرو'],
    ];
}

function aseman_testimonials() {
    return [
        ['name' => 'نگار محمدی', 'destination' => 'سفر به مالدیو', 'initial' => 'ن',
         'text' => 'از لحظه برنامه‌ریزی تا برگشت، همه چیز دقیق و بی‌دغدغه بود. هتلی که پیشنهاد شد، واقعاً فراتر از انتظارمان بود.'],
        ['name' => 'علی رضایی', 'destination' => 'سفر به استانبول', 'initial' => 'ع',
         'text' => 'انتخاب پرواز و هتل خیلی راحت بود. چیزی که بیشتر از همه دوست داشتم، همراهی و توجه به جزئیات سفر بود.'],
        ['name' => 'سارا احمدی', 'destination' => 'سفر به پاریس', 'initial' => 'س',
         'text' => 'یک سفر فوق‌العاده و پر از خاطره‌های خوب. برای اولین سفر اروپایی‌مان، همراهی تیم واقعاً دلگرم‌کننده بود.'],
    ];
}

function aseman_stats() {
    return [
        ['+۲۵۰٬۰۰۰', 'مسافر راضی'],
        ['+۱۲۰', 'مقصد گردشگری'],
        ['+۵۰۰', 'مسیر پروازی'],
        ['+۱۵', 'سال تجربه'],
    ];
}

function aseman_faqs() {
    return [
        ['چگونه بلیط هواپیما رزرو کنم؟', 'مبدا، مقصد، تاریخ و تعداد مسافران را انتخاب کنید. پس از اتصال سامانه به تامین‌کننده پرواز، می‌توانید پروازها را مقایسه و رزرو کنید. در این نسخه، خرید بلیط فعال نیست.'],
        ['امکان استرداد بلیط وجود دارد؟', 'امکان استرداد و میزان جریمه به قوانین ایرلاین و نوع بلیط بستگی دارد. شرایط دقیق باید پیش از خرید در جزئیات پرواز بررسی شود.'],
        ['میزان بار مجاز پرواز چقدر است؟', 'بار مجاز بر اساس ایرلاین، مسیر و کلاس پروازی متفاوت است. اطلاعات درج‌شده در بلیط و قوانین شرکت هواپیمایی ملاک هستند.'],
        ['چگونه می‌توانم تور رزرو کنم؟', 'از بخش تورها، جزئیات سفر مورد علاقه‌تان را ببینید. قیمت‌ها و برنامه‌های فعلی نمونه هستند و رزرو نهایی هنوز فعال نشده است.'],
        ['آیا امکان پرداخت آنلاین وجود دارد؟', 'در این نسخه پرداخت آنلاین فعال نیست. پس از اتصال به سامانه رزرو و درگاه پرداخت، خرید امن در دسترس خواهد بود.'],
        ['پشتیبانی در چه ساعاتی فعال است؟', 'پشتیبانی ۲۴ ساعته بخشی از خدمات پیشنهادی این برند است. اطلاعات تماس و ساعات واقعی فعالیت پس از تأیید آژانس اضافه می‌شود.'],
    ];
}

function aseman_sample_tours() {
    return [
        ['name' => 'تور رویایی مالدیو', 'destination' => 'مالدیو · اقیانوس هند', 'duration' => '۷ شب و ۸ روز',
         'hotel' => 'هتل ۵ ستاره لوکس', 'price' => '۴۹٬۹۰۰٬۰۰۰', 'rating' => '۴٫۹', 'image' => 'maldives.jpg'],
        ['name' => 'روزهای آفتابی دبی', 'destination' => 'دبی · امارات', 'duration' => '۴ شب و ۵ روز',
         'hotel' => 'هتل ۵ ستاره ساحلی', 'price' => '۲۳٬۹۰۰٬۰۰۰', 'rating' => '۴٫۸', 'image' => 'dubai.jpg'],
        ['name' => 'استانبول، شهر قصه‌ها', 'destination' => 'استانبول · ترکیه', 'duration' => '۵ شب و ۶ روز',
         'hotel' => 'هتل ۴ ستاره مرکز شهر', 'price' => '۱۸٬۹۰۰٬۰۰۰', 'rating' => '۴٫۹', 'image' => 'istanbul.jpg'],
    ];
}

/* نام دستهٔ نمایشی برای کارت‌های مجله سفر */
function aseman_blog_category($post_id = 0) {
    $cats = get_the_category($post_id ? $post_id : get_the_ID());
    foreach ($cats as $c) {
        if (!in_array($c->slug, ['uncategorized'], true)) {
            return $c->name;
        }
    }
    return 'مجله سفر';
}
