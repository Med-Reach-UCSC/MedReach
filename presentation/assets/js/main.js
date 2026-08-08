document.addEventListener('DOMContentLoaded', function () {
  var nav = document.querySelector('.mr-nav');
  var toggle = document.querySelector('.mr-nav__toggle');
  if (!nav || !toggle) return;

  toggle.addEventListener('click', function () {
    var isOpen = nav.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
  });

  nav.querySelectorAll('.mr-nav__menu a, .mr-nav__menu button').forEach(function (link) {
    link.addEventListener('click', function () {
      nav.classList.remove('is-open');
      toggle.setAttribute('aria-expanded', 'false');
    });
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var sidebar = document.querySelector('.mr-sidebar');
  var toggle = document.querySelector('.mr-sidebar__toggle');
  if (!sidebar || !toggle) return;

  toggle.addEventListener('click', function () {
    var isOpen = sidebar.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
  });

  sidebar.querySelectorAll('.mr-sidebar__menu a').forEach(function (link) {
    link.addEventListener('click', function () {
      sidebar.classList.remove('is-open');
      toggle.setAttribute('aria-expanded', 'false');
    });
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var tabs = document.querySelector('.mr-auth-tabs');
  if (!tabs) return;

  var roleInput = document.querySelector('.mr-auth-form input[name="role"]');

  tabs.querySelectorAll('.mr-auth-tabs__btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      tabs.querySelectorAll('.mr-auth-tabs__btn').forEach(function (other) {
        other.classList.remove('is-active');
        other.setAttribute('aria-selected', 'false');
      });
      btn.classList.add('is-active');
      btn.setAttribute('aria-selected', 'true');
      if (roleInput) roleInput.value = btn.dataset.role;
    });
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var form = document.querySelector('.mr-reset-form');
  var notice = document.querySelector('.mr-auth-notice');
  if (!form || !notice) return;

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    notice.hidden = false;
  });
});
