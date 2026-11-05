(function () {
  var html = document.documentElement;
  html.classList.remove('no-js');

  /* لینک‌های لنگری (مانند #tours) نباید علامت «فعال» بگیرند */
  document.querySelectorAll('.desktop-nav .current-menu-item, .desktop-nav .current_page_item').forEach(function (li) {
    var a = li.querySelector('a');
    if (a && (a.getAttribute('href') || '').indexOf('#') !== -1) {
      li.classList.remove('current-menu-item', 'current_page_item');
    }
  });


  /* ---------- منوی موبایل ---------- */
  var burger = document.querySelector('.mobile-menu');
  var panel = document.getElementById('mobile-navigation');
  if (burger && panel) {
    function setMenu(open) {
      panel.classList.toggle('is-open', open);
      burger.setAttribute('aria-expanded', open ? 'true' : 'false');
      burger.setAttribute('aria-label', open ? 'بستن منو' : 'باز کردن منو');
    }
    burger.addEventListener('click', function () {
      setMenu(!panel.classList.contains('is-open'));
    });
    panel.addEventListener('click', function (e) {
      if (e.target && e.target.closest && e.target.closest('a')) setMenu(false);
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') setMenu(false);
    });
  }

  /* ---------- ویدیوی هدر ---------- */
  var video = document.querySelector('.hero-video');
  var toggle = document.getElementById('video-toggle');
  if (video && toggle) {
    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduce) {
      video.pause();
      toggle.classList.add('is-paused');
      toggle.setAttribute('aria-label', 'پخش ویدیو');
    }
    toggle.addEventListener('click', function () {
      if (video.paused) {
        video.play();
        toggle.classList.remove('is-paused');
        toggle.setAttribute('aria-label', 'توقف ویدیو');
      } else {
        video.pause();
        toggle.classList.add('is-paused');
        toggle.setAttribute('aria-label', 'پخش ویدیو');
      }
    });
  }

  /* ---------- تب‌های نوع سفر ---------- */
  var form = document.getElementById('flight-form');
  var tabs = document.querySelectorAll('.trip-tabs button');
  var returnField = document.querySelector('.return-field');
  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      tabs.forEach(function (t) {
        t.classList.remove('selected');
        t.setAttribute('aria-selected', 'false');
      });
      tab.classList.add('selected');
      tab.setAttribute('aria-selected', 'true');
      var oneWay = tab.dataset.trip === 'one';
      if (form) form.classList.toggle('one-way', oneWay);
      if (returnField) returnField.hidden = oneWay;
    });
  });

  /* ---------- جابه‌جایی مبدا و مقصد ---------- */
  var swap = document.querySelector('.swap-button');
  if (swap && form) {
    swap.addEventListener('click', function () {
      var a = form.elements.origin;
      var b = form.elements.destination;
      var tmp = a.value;
      a.value = b.value;
      b.value = tmp;
    });
  }

  /* ---------- تاریخ برگشت ---------- */
  var depart = form && form.elements.depart;
  var back = form && form.elements.back;
  if (depart && back) {
    depart.addEventListener('change', function () {
      back.min = depart.value || '';
      if (back.value && back.value < depart.value) back.value = depart.value;
    });
  }

  /* ---------- جستجوی پرواز (نمایشی) ---------- */
  var errorBox = document.getElementById('flight-error');
  var summary = document.getElementById('flight-summary');
  function faDate(value) {
    if (!value) return '—';
    try {
      return new Date(value + 'T12:00:00').toLocaleDateString('fa-IR');
    } catch (err) {
      return value;
    }
  }
  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var round = !form.classList.contains('one-way');
      var message = '';
      if (form.elements.origin.value === form.elements.destination.value) {
        message = 'مبدا و مقصد نمی‌توانند یکسان باشند.';
      } else if (!form.elements.depart.value) {
        message = 'لطفاً تاریخ رفت را انتخاب کنید.';
      } else if (round && (!form.elements.back.value || form.elements.back.value < form.elements.depart.value)) {
        message = 'تاریخ برگشت باید در روز رفت یا پس از آن باشد.';
      }
      if (message) {
        if (errorBox) {
          errorBox.textContent = message;
          errorBox.hidden = false;
        }
        if (summary) summary.hidden = true;
        return;
      }
      if (errorBox) {
        errorBox.textContent = '';
        errorBox.hidden = true;
      }
      if (summary) {
        document.getElementById('summary-route').textContent =
          'پرواز ' + form.elements.origin.value + ' به ' + form.elements.destination.value;
        document.getElementById('summary-meta').textContent =
          form.elements.passengers.value + ' · ' + form.elements.seat.value + ' · ' + (round ? 'رفت و برگشت' : 'یک‌طرفه');
        document.getElementById('summary-depart').textContent = 'تاریخ رفت: ' + faDate(form.elements.depart.value);
        var backLine = document.getElementById('summary-back');
        backLine.textContent = round ? 'تاریخ برگشت: ' + faDate(form.elements.back.value) : '';
        backLine.hidden = !round;
        summary.hidden = false;
        summary.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
    });
  }
  var edit = document.getElementById('summary-edit');
  if (edit && summary) {
    edit.addEventListener('click', function () {
      summary.hidden = true;
      if (form) form.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });
  }

  /* ---------- بازشکنه‌ها ---------- */
  document.querySelectorAll('.faq-item > button').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var item = btn.parentElement;
      var answer = item.querySelector('p');
      var open = item.classList.contains('is-open');
      document.querySelectorAll('.faq-item').forEach(function (other) {
        other.classList.remove('is-open');
        var b = other.querySelector('button');
        var p = other.querySelector('p');
        if (b) b.setAttribute('aria-expanded', 'false');
        if (p) p.hidden = true;
      });
      if (!open) {
        item.classList.add('is-open');
        btn.setAttribute('aria-expanded', 'true');
        if (answer) answer.hidden = false;
      }
    });
  });

  /* ---------- پنجره‌ها ---------- */
  function openDialog(id) {
    var d = document.getElementById(id);
    if (!d) return;
    if (typeof d.showModal === 'function') d.showModal();
    else d.setAttribute('open', '');
  }
  document.querySelectorAll('[data-dialog]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      openDialog(btn.dataset.dialog);
      if (panel) panel.classList.remove('is-open');
      if (burger) burger.setAttribute('aria-expanded', 'false');
    });
  });
  document.querySelectorAll('.aseman-dialog').forEach(function (d) {
    d.addEventListener('click', function (e) {
      if (e.target === d || (e.target.closest && e.target.closest('[data-close]'))) {
        d.close ? d.close() : d.removeAttribute('open');
      }
    });
  });

  /* ---------- جزئیات مقصد ---------- */
  var detail = document.getElementById('detail-dialog');
  if (detail) {
    document.querySelectorAll('.destination-card').forEach(function (card) {
      card.addEventListener('click', function () {
        detail.querySelector('.dialog-title').textContent = card.dataset.name;
        detail.querySelector('.dialog-sub').textContent = card.dataset.country;
        var img = detail.querySelector('.detail-photo');
        img.src = card.dataset.img;
        img.alt = card.dataset.name;
        detail.querySelector('.dialog-text').textContent = card.dataset.desc;
        detail.querySelector('.dialog-foot').textContent =
          'قیمت نمونه از ' + card.dataset.price + ' تومان؛ قیمت نهایی به تاریخ و خدمات سفر بستگی دارد.';
        openDialog('detail-dialog');
      });
    });
  }

  /* ---------- خبرنامه (ذخیره نمی‌کند) ---------- */
  document.querySelectorAll('form[data-demo]').forEach(function (f) {
    f.addEventListener('submit', function (e) {
      e.preventDefault();
      var status = f.querySelector('.form-status');
      if (status) {
        status.textContent = 'خبرنامه هنوز متصل نیست؛ آدرس ایمیل شما ذخیره نشده است.';
        status.hidden = false;
      }
      var input = f.querySelector('input');
      if (input) input.value = '';
    });
  });

  /* ---------- ظاهر شدن نرم بخش‌ها ---------- */
  var reveal = document.querySelectorAll('.reveal');
  function showAll() {
    reveal.forEach(function (el) { el.classList.add('revealed'); });
  }
  if (reduce || !('IntersectionObserver' in window)) {
    showAll();
  } else {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('revealed');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.08 });
    reveal.forEach(function (el) { io.observe(el); });
    window.setTimeout(function () {
      reveal.forEach(function (el) {
        var r = el.getBoundingClientRect();
        if (r.top < window.innerHeight && r.bottom > 0) el.classList.add('revealed');
      });
    }, 250);
  }
})();
