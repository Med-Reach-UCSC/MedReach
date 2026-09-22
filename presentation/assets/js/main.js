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
  var sidebar = document.querySelector('.mr-sidebar');
  var collapseBtn = document.querySelector('.mr-sidebar__collapse');
  if (!sidebar || !collapseBtn) return;

  var STORAGE_KEY = 'mr-sidebar-compact';

  function setCompact(isCompact) {
    sidebar.classList.toggle('is-compact', isCompact);
    collapseBtn.setAttribute('aria-pressed', isCompact ? 'true' : 'false');
  }

  setCompact(localStorage.getItem(STORAGE_KEY) === 'true');

  collapseBtn.addEventListener('click', function () {
    var isCompact = !sidebar.classList.contains('is-compact');
    setCompact(isCompact);
    localStorage.setItem(STORAGE_KEY, isCompact);
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

document.addEventListener('DOMContentLoaded', function () {
  var toggle = document.querySelector('.mr-pref-toggle');
  if (!toggle) return;

  toggle.querySelectorAll('[data-pref-toggle]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      toggle.querySelectorAll('[data-pref-toggle]').forEach(function (other) {
        other.classList.remove('is-active');
      });
      btn.classList.add('is-active');
    });
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var openers = document.querySelectorAll('[data-modal-open]');
  if (!openers.length) return;

  openers.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var modal = document.getElementById(btn.dataset.modalOpen);
      if (modal) modal.classList.add('is-open');
    });
  });

  document.querySelectorAll('.mr-modal').forEach(function (modal) {
    modal.querySelectorAll('[data-modal-close]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        modal.classList.remove('is-open');
      });
    });

    var form = modal.querySelector('form');
    if (form) {
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        modal.classList.remove('is-open');
      });
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var table = document.getElementById('mr-patient-table');
  if (!table) return;

  var tbody = table.querySelector('tbody');
  var rows = Array.prototype.slice.call(tbody.querySelectorAll('tr'));
  var search = document.getElementById('mr-patient-search');
  var statusFilter = document.getElementById('mr-patient-status-filter');
  var empty = document.querySelector('.mr-roster-empty');
  var count = document.getElementById('mr-patient-count');

  function applyFilters() {
    var term = search ? search.value.trim().toLowerCase() : '';
    var status = statusFilter ? statusFilter.value : '';
    var visible = 0;

    rows.forEach(function (row) {
      var matchesSearch = !term || row.dataset.name.indexOf(term) !== -1;
      var matchesStatus = !status || row.dataset.status === status;
      var match = matchesSearch && matchesStatus;
      row.hidden = !match;
      if (match) visible++;
    });

    if (empty) empty.hidden = visible !== 0;
    if (count) count.textContent = 'Showing ' + (visible ? '1-' + visible : '0') + ' of ' + rows.length;
  }

  if (search) search.addEventListener('input', applyFilters);
  if (statusFilter) statusFilter.addEventListener('change', applyFilters);

  table.querySelectorAll('th[data-sort]').forEach(function (th) {
    th.addEventListener('click', function () {
      var key = th.dataset.sort;
      var ascending = th.getAttribute('aria-sort') !== 'ascending';

      table.querySelectorAll('th[data-sort]').forEach(function (other) {
        other.removeAttribute('aria-sort');
      });
      th.setAttribute('aria-sort', ascending ? 'ascending' : 'descending');

      rows.sort(function (a, b) {
        var valA = key === 'age' ? parseInt(a.dataset.age, 10) : a.dataset[key];
        var valB = key === 'age' ? parseInt(b.dataset.age, 10) : b.dataset[key];
        if (valA < valB) return ascending ? -1 : 1;
        if (valA > valB) return ascending ? 1 : -1;
        return 0;
      });

      rows.forEach(function (row) { tbody.appendChild(row); });
    });
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var list = document.querySelector('[data-request-list]');
  if (!list) return;

  var count = document.querySelector('[data-request-count]');
  var empty = document.querySelector('[data-request-empty]');

  function updateCount() {
    var remaining = list.querySelectorAll('.mr-request-card').length;
    if (count) count.textContent = remaining + ' new';
    if (empty) empty.hidden = remaining !== 0;
  }

  list.querySelectorAll('[data-request-action]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var card = btn.closest('.mr-request-card');
      if (card) card.remove();
      updateCount();
    });
  });
});

// Shared by every Chart.js init below — reads a design token straight off
// :root so charts always match the current --mr-color-* palette.
function mrColor(name) {
  return getComputedStyle(document.documentElement).getPropertyValue(name).trim();
}

document.addEventListener('DOMContentLoaded', function () {
  var canvas = document.getElementById('mr-earnings-chart');
  if (!canvas || typeof Chart === 'undefined') return;

  new Chart(canvas, {
    type: 'bar',
    data: {
      labels: ['8a', '10a', '12p', '2p', '4p', '6p'],
      datasets: [{
        data: [1200, 2600, 4800, 9400, 6100, 2400],
        backgroundColor: mrColor('--mr-color-primary'),
        hoverBackgroundColor: mrColor('--mr-color-primary-dark'),
        borderRadius: 6,
        maxBarThickness: 36
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: {
        x: { grid: { display: false }, ticks: { color: mrColor('--mr-color-text-muted') } },
        y: {
          grid: { color: mrColor('--mr-color-border') },
          ticks: { color: mrColor('--mr-color-text-muted'), callback: function (v) { return 'Rs. ' + v; } }
        }
      }
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var canvas = document.getElementById('mr-network-chart');
  if (!canvas || typeof Chart === 'undefined') return;

  new Chart(canvas, {
    type: 'bar',
    data: {
      labels: ['Q1', 'Q2', 'Q3', 'Q4'],
      datasets: [{
        data: [60, 140, 190, 240],
        backgroundColor: mrColor('--mr-color-primary'),
        hoverBackgroundColor: mrColor('--mr-color-primary-dark'),
        borderRadius: 6,
        maxBarThickness: 48
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: {
        x: { grid: { display: false }, ticks: { color: mrColor('--mr-color-text-muted') } },
        y: { grid: { color: mrColor('--mr-color-border') }, ticks: { color: mrColor('--mr-color-text-muted') } }
      }
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var canvas = document.getElementById('mr-spend-chart');
  if (!canvas || typeof Chart === 'undefined') return;

  new Chart(canvas, {
    type: 'doughnut',
    data: {
      labels: ['Completed', 'Pending'],
      datasets: [{
        data: [3650, 1200],
        backgroundColor: [mrColor('--mr-color-primary'), '#e9e7f3'],
        borderWidth: 0
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: '75%',
      plugins: { legend: { display: false }, tooltip: { enabled: false } }
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var canvas = document.getElementById('mr-earnings-trend-chart');
  if (!canvas || typeof Chart === 'undefined') return;

  new Chart(canvas, {
    type: 'bar',
    data: {
      labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
      datasets: [{
        data: [9600, 11200, 12450, 12630],
        backgroundColor: mrColor('--mr-color-primary'),
        hoverBackgroundColor: mrColor('--mr-color-primary-dark'),
        borderRadius: 6,
        maxBarThickness: 56
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: {
        x: { grid: { display: false }, ticks: { color: mrColor('--mr-color-text-muted') } },
        y: {
          grid: { color: mrColor('--mr-color-border') },
          ticks: { color: mrColor('--mr-color-text-muted'), callback: function (v) { return 'Rs. ' + v; } }
        }
      }
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var canvas = document.getElementById('mr-earnings-target-chart');
  if (!canvas || typeof Chart === 'undefined') return;

  new Chart(canvas, {
    type: 'doughnut',
    data: {
      labels: ['Earned', 'Remaining'],
      datasets: [{
        data: [83, 17],
        backgroundColor: [mrColor('--mr-color-primary'), '#e9e7f3'],
        borderWidth: 0
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: '75%',
      plugins: { legend: { display: false }, tooltip: { enabled: false } }
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var canvas = document.getElementById('mr-adherence-chart');
  if (!canvas || typeof Chart === 'undefined') return;

  var values = [30, 45, 40, 60, 55, 75, 90];

  new Chart(canvas, {
    type: 'bar',
    data: {
      labels: values.map(function (_, i) { return 'Day ' + (i + 1); }),
      datasets: [{
        data: values,
        backgroundColor: values.map(function (_, i) {
          return i === values.length - 1 ? mrColor('--mr-color-primary') : 'rgba(45, 63, 215, 0.55)';
        }),
        borderRadius: 3,
        maxBarThickness: 18
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false }, tooltip: { enabled: false } },
      scales: {
        x: { display: false },
        y: { display: false, beginAtZero: true }
      }
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var table = document.getElementById('mr-pharmacy-table');
  if (!table) return;

  var tbody = table.querySelector('tbody');
  var rows = Array.prototype.slice.call(tbody.querySelectorAll('tr'));
  var search = document.getElementById('mr-pharmacy-search');
  var statusFilter = document.getElementById('mr-pharmacy-status-filter');
  var empty = document.querySelector('.mr-roster-empty');
  var count = document.getElementById('mr-pharmacy-count');

  function applyFilters() {
    var term = search ? search.value.trim().toLowerCase() : '';
    var status = statusFilter ? statusFilter.value : '';
    var visible = 0;

    rows.forEach(function (row) {
      var matchesSearch = !term || row.dataset.name.indexOf(term) !== -1;
      var matchesStatus = !status || row.dataset.status === status;
      var match = matchesSearch && matchesStatus;
      row.hidden = !match;
      if (match) visible++;
    });

    if (empty) empty.hidden = visible !== 0;
    if (count) count.textContent = 'Showing ' + (visible ? '1-' + visible : '0') + ' of ' + rows.length;
  }

  if (search) search.addEventListener('input', applyFilters);
  if (statusFilter) statusFilter.addEventListener('change', applyFilters);

  table.querySelectorAll('th[data-sort]').forEach(function (th) {
    th.addEventListener('click', function () {
      var key = th.dataset.sort;
      var ascending = th.getAttribute('aria-sort') !== 'ascending';

      table.querySelectorAll('th[data-sort]').forEach(function (other) {
        other.removeAttribute('aria-sort');
      });
      th.setAttribute('aria-sort', ascending ? 'ascending' : 'descending');

      rows.sort(function (a, b) {
        var valA = a.dataset[key];
        var valB = b.dataset[key];
        if (valA < valB) return ascending ? -1 : 1;
        if (valA > valB) return ascending ? 1 : -1;
        return 0;
      });

      rows.forEach(function (row) { tbody.appendChild(row); });
    });
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var table = document.getElementById('mr-user-table');
  if (!table) return;

  var tbody = table.querySelector('tbody');
  var rows = Array.prototype.slice.call(tbody.querySelectorAll('tr'));
  var search = document.getElementById('mr-user-search');
  var roleFilter = document.getElementById('mr-user-role-filter');
  var empty = document.querySelector('.mr-roster-empty');
  var count = document.getElementById('mr-user-count');

  function applyFilters() {
    var term = search ? search.value.trim().toLowerCase() : '';
    var role = roleFilter ? roleFilter.value : '';
    var visible = 0;

    rows.forEach(function (row) {
      var matchesSearch = !term || row.dataset.name.indexOf(term) !== -1;
      var matchesRole = !role || row.dataset.role === role;
      var match = matchesSearch && matchesRole;
      row.hidden = !match;
      if (match) visible++;
    });

    if (empty) empty.hidden = visible !== 0;
    if (count) count.textContent = 'Showing ' + (visible ? '1-' + visible : '0') + ' of ' + rows.length;
  }

  if (search) search.addEventListener('input', applyFilters);
  if (roleFilter) roleFilter.addEventListener('change', applyFilters);

  table.querySelectorAll('th[data-sort]').forEach(function (th) {
    th.addEventListener('click', function () {
      var key = th.dataset.sort;
      var ascending = th.getAttribute('aria-sort') !== 'ascending';

      table.querySelectorAll('th[data-sort]').forEach(function (other) {
        other.removeAttribute('aria-sort');
      });
      th.setAttribute('aria-sort', ascending ? 'ascending' : 'descending');

      rows.sort(function (a, b) {
        var valA = a.dataset[key];
        var valB = b.dataset[key];
        if (valA < valB) return ascending ? -1 : 1;
        if (valA > valB) return ascending ? 1 : -1;
        return 0;
      });

      rows.forEach(function (row) { tbody.appendChild(row); });
    });
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var canvas = document.getElementById('mr-role-chart');
  if (!canvas || typeof Chart === 'undefined') return;

  new Chart(canvas, {
    type: 'doughnut',
    data: {
      labels: ['Patients', 'Pharmacists', 'Delivery', 'Admins'],
      datasets: [{
        data: [65, 18, 12, 5],
        backgroundColor: [
          mrColor('--mr-color-primary'),
          '#bdc2ff',
          mrColor('--mr-color-accent'),
          mrColor('--mr-color-text-muted')
        ],
        borderWidth: 0
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: '75%',
      plugins: { legend: { display: false }, tooltip: { enabled: false } }
    }
  });
});

// Admin settings — Broadcast Routing Engine +/- steppers
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.mr-stepper').forEach(function (stepper) {
    var valueEl = stepper.querySelector('.mr-stepper__value');
    if (!valueEl) return;
    var step = parseFloat(stepper.dataset.step || '1');
    var decimals = (stepper.dataset.step || '1').split('.')[1]?.length || 0;

    stepper.querySelectorAll('[data-stepper-action]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var current = parseFloat(valueEl.textContent);
        var next = btn.dataset.stepperAction === 'inc' ? current + step : current - step;
        valueEl.textContent = next.toFixed(decimals);
      });
    });
  });
});

// Admin settings — dispatch radius / response timeout gauges, live-linked
// to the range slider underneath each one (same doughnut-gauge pattern as
// mr-earnings-target-chart, just re-wired to redraw on slider input)
document.addEventListener('DOMContentLoaded', function () {
  function wireRoutingGauge(canvasId, sliderId, max, colorToken, suffix) {
    var canvas = document.getElementById(canvasId);
    var slider = document.getElementById(sliderId);
    if (!canvas || !slider || typeof Chart === 'undefined') return;

    var value = parseFloat(slider.value);
    var chart = new Chart(canvas, {
      type: 'doughnut',
      data: {
        datasets: [{
          data: [value, max - value],
          backgroundColor: [mrColor(colorToken), '#e9e7f3'],
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '75%',
        plugins: { legend: { display: false }, tooltip: { enabled: false } }
      }
    });

    var label = canvas.closest('.mr-spend-ring').querySelector('.mr-spend-ring__inner strong');

    slider.addEventListener('input', function () {
      value = parseFloat(slider.value);
      chart.data.datasets[0].data = [value, max - value];
      chart.update();
      if (label) label.textContent = value + suffix;
    });
  }

  wireRoutingGauge('mr-radius-gauge-chart', 'mr-radius-slider', 100, '--mr-color-primary', ' mi');
  wireRoutingGauge('mr-timeout-gauge-chart', 'mr-timeout-slider', 180, '--mr-color-accent', 's');
});
