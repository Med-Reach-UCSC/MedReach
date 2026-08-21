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
  var backdrop = document.querySelector('.mr-sidebar-backdrop');
  if (!sidebar || !toggle) return;

  function closeSidebar() {
    sidebar.classList.remove('is-open');
    toggle.setAttribute('aria-expanded', 'false');
    if (backdrop) backdrop.classList.remove('is-open');
  }

  toggle.addEventListener('click', function () {
    var isOpen = sidebar.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    if (backdrop) backdrop.classList.toggle('is-open', isOpen);
  });

  sidebar.querySelectorAll('.mr-sidebar__menu a').forEach(function (link) {
    link.addEventListener('click', closeSidebar);
  });

  if (backdrop) backdrop.addEventListener('click', closeSidebar);
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

document.addEventListener('DOMContentLoaded', function () {
  var filters = document.querySelector('.mr-resp-filters');
  var grid = document.querySelector('.mr-resp-grid');
  if (!filters || !grid) return;

  var cards = grid.querySelectorAll('[data-status]');
  var empty = grid.querySelector('.mr-resp-grid__empty');

  filters.querySelectorAll('.mr-resp-filters__btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var turningOn = !btn.classList.contains('is-active');

      filters.querySelectorAll('.mr-resp-filters__btn').forEach(function (other) {
        other.classList.remove('is-active');
      });

      var activeFilter = turningOn ? btn.dataset.filter : null;
      if (turningOn) btn.classList.add('is-active');

      var visibleCount = 0;
      cards.forEach(function (card) {
        var match = !activeFilter || card.dataset.status === activeFilter;
        card.hidden = !match;
        if (match) visibleCount++;
      });
      if (empty) empty.hidden = visibleCount !== 0;
    });
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var list = document.querySelector('.mr-pharm-list');
  if (!list) return;

  var cards = list.querySelectorAll('.mr-pharm-card');
  var pins = document.querySelectorAll('.mr-pharm-map__pin');
  var search = document.querySelector('.mr-pharm-search input');
  var filters = document.querySelector('.mr-pharm-filters');

  var info = document.querySelector('.mr-pharm-info');
  var detailName = document.querySelector('.mr-pharm-detail__name');
  var detailAddr = document.querySelector('.mr-pharm-detail__addr');
  var detailWait = document.querySelector('.mr-pharm-detail__wait');
  var detailStock = document.querySelector('.mr-pharm-detail__stock');
  var infoClose = document.querySelector('.mr-pharm-info__close');
  var backdrop = document.querySelector('.mr-pharm-backdrop');
  var isMobile = window.matchMedia('(max-width: 992px)');

  function closeDetailModal() {
    if (info) info.classList.remove('is-open');
    if (backdrop) backdrop.classList.remove('is-open');
  }

  function selectCard(card) {
    cards.forEach(function (c) { c.classList.remove('is-selected'); });
    pins.forEach(function (p) { p.classList.remove('mr-pharm-map__pin--active'); });

    card.classList.add('is-selected');
    var pin = document.querySelector('.mr-pharm-map__pin[data-name="' + card.dataset.name + '"]');
    if (pin) pin.classList.add('mr-pharm-map__pin--active');

    if (detailName) detailName.textContent = card.dataset.name;
    if (detailAddr) detailAddr.lastChild.textContent = ' ' + card.dataset.addr;
    if (detailWait) detailWait.textContent = card.dataset.wait;
    if (detailStock) detailStock.lastChild.textContent = ' ' + card.dataset.stock;

    if (isMobile.matches && info && backdrop) {
      info.classList.add('is-open');
      backdrop.classList.add('is-open');
    }
  }

  cards.forEach(function (card) {
    card.addEventListener('click', function () { selectCard(card); });
  });

  if (infoClose) infoClose.addEventListener('click', closeDetailModal);
  if (backdrop) backdrop.addEventListener('click', closeDetailModal);

  pins.forEach(function (pin) {
    pin.addEventListener('click', function () {
      var card = list.querySelector('.mr-pharm-card[data-name="' + pin.dataset.name + '"]');
      if (card) selectCard(card);
    });
  });

  if (search) {
    search.addEventListener('input', function () {
      var term = search.value.trim().toLowerCase();
      cards.forEach(function (card) {
        var match = (card.dataset.name + ' ' + card.dataset.addr).toLowerCase().indexOf(term) !== -1;
        card.hidden = !match;
      });
    });
  }

  if (filters) {
    filters.querySelectorAll('.mr-pharm-filters__btn').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var turningOn = !btn.classList.contains('is-active');

        filters.querySelectorAll('.mr-pharm-filters__btn').forEach(function (other) {
          other.classList.remove('is-active');
        });

        var activeFilter = turningOn ? btn.dataset.filter : null;
        if (turningOn) btn.classList.add('is-active');

        cards.forEach(function (card) {
          card.hidden = !!activeFilter && card.dataset.status !== activeFilter;
        });
      });
    });
  }
});

document.addEventListener('DOMContentLoaded', function () {
  var group = document.querySelector('[data-fulfillment]');
  if (!group) return;

  var methods = group.querySelectorAll('.mr-confirm-method');
  var subtotal = 3830;
  var feeValue = group.querySelector('[data-fee-value]');
  var totalValue = document.querySelector('[data-total-value]');

  function formatLkr(amount) {
    return 'LKR ' + amount.toLocaleString('en-US', { minimumFractionDigits: 2 });
  }

  function selectMethod(method) {
    methods.forEach(function (m) {
      m.classList.remove('is-selected');
      m.setAttribute('aria-pressed', 'false');
    });
    method.classList.add('is-selected');
    method.setAttribute('aria-pressed', 'true');

    var fee = Number(method.dataset.fee);
    if (feeValue) feeValue.textContent = fee === 0 ? 'Free' : formatLkr(fee);
    if (totalValue) totalValue.textContent = formatLkr(subtotal + fee);
  }

  methods.forEach(function (method) {
    method.addEventListener('click', function () { selectMethod(method); });
    method.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        selectMethod(method);
      }
    });
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var list = document.querySelector('.mr-history-list');
  if (!list) return;

  var cards = list.querySelectorAll('.mr-history-card');
  var listEmpty = list.querySelector('.mr-history-list__empty');
  var sidebarEmpty = document.querySelector('.mr-history-empty');
  var search = document.querySelector('.mr-history-toolbar .mr-pharm-search input');
  var filters = document.querySelector('.mr-history-filters');
  var activeFilter = null;

  function applyFilters() {
    var term = search ? search.value.trim().toLowerCase() : '';
    var visibleCount = 0;

    cards.forEach(function (card) {
      var matchesStatus = !activeFilter || card.dataset.status === activeFilter;
      var matchesSearch = !term || card.dataset.name.toLowerCase().indexOf(term) !== -1;
      var match = matchesStatus && matchesSearch;
      card.hidden = !match;
      if (match) visibleCount++;
    });

    if (listEmpty) listEmpty.hidden = visibleCount !== 0;
    if (sidebarEmpty) sidebarEmpty.hidden = visibleCount !== 0;
  }

  cards.forEach(function (card) {
    var toggle = card.querySelector('.mr-history-card__toggle');
    if (toggle) {
      toggle.addEventListener('click', function () {
        card.classList.toggle('is-open');
      });
    }

    card.querySelectorAll('.mr-star-rating__btn').forEach(function (star, index) {
      star.addEventListener('click', function () {
        var rating = index + 1;
        var stars = card.querySelectorAll('.mr-star-rating__btn img');
        stars.forEach(function (img, i) {
          img.src = i < rating
            ? 'https://img.icons8.com/ios-filled/50/dd8e1c/star.png'
            : 'https://img.icons8.com/ios/50/c5c5d8/star.png';
        });
        card.querySelector('.mr-star-rating').dataset.rating = rating;
      });
    });
  });

  if (search) search.addEventListener('input', applyFilters);

  if (filters) {
    filters.querySelectorAll('.mr-history-filters__btn').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var turningOn = !btn.classList.contains('is-active');

        filters.querySelectorAll('.mr-history-filters__btn').forEach(function (other) {
          other.classList.remove('is-active');
        });

        activeFilter = turningOn ? btn.dataset.filter : null;
        if (turningOn) btn.classList.add('is-active');

        applyFilters();
      });
    });
  }
});

document.addEventListener('DOMContentLoaded', function () {
  var markAll = document.getElementById('mr-notif-mark-all');
  var list = document.querySelector('.mr-notif-list');
  if (!markAll || !list) return;

  markAll.addEventListener('click', function () {
    list.querySelectorAll('.mr-notif-item.is-unread').forEach(function (item) {
      item.classList.remove('is-unread');
      var dot = item.querySelector('.mr-notif-item__dot');
      if (dot) dot.remove();
    });

    var sidebarDots = document.querySelectorAll('.mr-notif-btn__dot');
    sidebarDots.forEach(function (dot) { dot.remove(); });
  });
});
