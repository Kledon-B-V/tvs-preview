/**
 * TVS Theme — Main JavaScript (Dark Theme)
 */
(function () {
  'use strict';

  /* ============ Scroll Animations ============ */
  function initAnimations() {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('[data-animate]').forEach(function (el) {
      observer.observe(el);
    });
  }

  /* ============ Header Scroll (Dark Theme) ============ */
  function initHeader() {
    var header = document.querySelector('[data-header]');
    if (!header) return;

    window.addEventListener('scroll', function () {
      var y = window.scrollY;
      if (y > 100) {
        header.classList.add('header--scrolled');
      } else {
        header.classList.remove('header--scrolled');
      }
    }, { passive: true });
  }

  /* ============ Product Filters ============ */
  function initProductFilters() {
    var grid = document.getElementById('products-grid');
    if (!grid) return;

    var searchInput = document.getElementById('product-search');
    var clearBtn = document.getElementById('clear-filters');
    var toggleBtn = document.getElementById('toggle-filters');
    var sidebar = document.getElementById('filters-sidebar');
    var countEl = document.getElementById('products-count');

    var cards = Array.from(grid.querySelectorAll('.product-card'));

    // Active filter state — supports both legacy <select> dropdowns and new pill buttons
    var activeFilters = {
      category: '',
      type: '',
      brand: '',
      application: ''
    };

    // ---- Legacy <select> dropdowns (kept for backwards compatibility) ----
    var filterCategory = document.getElementById('filter-category');
    var filterType = document.getElementById('filter-type');
    var filterBrand = document.getElementById('filter-brand');
    var filterApplication = document.getElementById('filter-application');

    // ---- New pill / tag buttons ----
    // Expected markup: <button class="filter-pill" data-filter-key="type" data-filter-value="Gas">Gas</button>
    var pillButtons = document.querySelectorAll('.filter-pill');

    /* ---------- Core filter logic ---------- */
    function filterProducts() {
      // Read from select dropdowns if present (legacy)
      if (filterCategory) activeFilters.category = filterCategory.value;
      if (filterType) activeFilters.type = filterType.value;
      if (filterBrand) activeFilters.brand = filterBrand.value;
      if (filterApplication) activeFilters.application = filterApplication.value;

      var search = (searchInput ? searchInput.value : '').toLowerCase();
      var visible = 0;

      cards.forEach(function (card) {
        var name = (card.dataset.name || '').toLowerCase();
        var matchSearch = !search || name.indexOf(search) !== -1;
        var matchCat = !activeFilters.category || card.dataset.category === activeFilters.category;
        var matchType = !activeFilters.type || card.dataset.type === activeFilters.type;
        var matchBrand = !activeFilters.brand || card.dataset.brand === activeFilters.brand;
        var matchApp = !activeFilters.application || card.dataset.application === activeFilters.application;

        if (matchSearch && matchCat && matchType && matchBrand && matchApp) {
          card.style.display = '';
          visible++;
        } else {
          card.style.display = 'none';
        }
      });

      if (countEl) {
        countEl.innerHTML = '<strong>' + visible + '</strong> producten gevonden';
      }

      // Show/hide clear button
      var hasFilters = search ||
        activeFilters.category ||
        activeFilters.type ||
        activeFilters.brand ||
        activeFilters.application;

      if (clearBtn) {
        clearBtn.style.display = hasFilters ? '' : 'none';
      }
    }

    /* ---------- Pill button handling (toggle on/off) ---------- */
    pillButtons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var key = btn.dataset.filterKey;   // e.g. "type"
        var value = btn.dataset.filterValue; // e.g. "Gas"

        if (!key || !value) return;

        // If this pill is already active, deselect it (toggle off)
        var isActive = btn.classList.contains('filter-pill--active');

        // Deactivate all pills in the same filter group
        pillButtons.forEach(function (other) {
          if (other.dataset.filterKey === key) {
            other.classList.remove('filter-pill--active');
          }
        });

        if (isActive) {
          // Was active, now deselected
          activeFilters[key] = '';
        } else {
          btn.classList.add('filter-pill--active');
          activeFilters[key] = value;
        }

        // Sync the legacy select if present
        var selectMap = {
          category: filterCategory,
          type: filterType,
          brand: filterBrand,
          application: filterApplication
        };
        if (selectMap[key]) {
          selectMap[key].value = activeFilters[key];
        }

        filterProducts();
      });
    });

    /* ---------- Legacy select events ---------- */
    if (searchInput) searchInput.addEventListener('input', filterProducts);
    if (filterCategory) filterCategory.addEventListener('change', filterProducts);
    if (filterType) filterType.addEventListener('change', filterProducts);
    if (filterBrand) filterBrand.addEventListener('change', filterProducts);
    if (filterApplication) filterApplication.addEventListener('change', filterProducts);

    /* ---------- Clear all ---------- */
    if (clearBtn) {
      clearBtn.addEventListener('click', function () {
        if (searchInput) searchInput.value = '';
        if (filterCategory) filterCategory.value = '';
        if (filterType) filterType.value = '';
        if (filterBrand) filterBrand.value = '';
        if (filterApplication) filterApplication.value = '';
        activeFilters.category = '';
        activeFilters.type = '';
        activeFilters.brand = '';
        activeFilters.application = '';

        // Deactivate all pills
        pillButtons.forEach(function (btn) {
          btn.classList.remove('filter-pill--active');
        });

        filterProducts();
      });
    }

    /* ---------- Sidebar toggle ---------- */
    if (toggleBtn && sidebar) {
      toggleBtn.addEventListener('click', function () {
        sidebar.classList.toggle('active');
        var isActive = sidebar.classList.contains('active');
        var label = toggleBtn.querySelector('span');
        if (label) {
          label.textContent = isActive ? 'Verberg Filters' : 'Filters';
        }
      });
    }

    /* ---------- Advanced filters <details> ---------- */
    var advancedDetails = document.querySelector('.filters-advanced');
    if (advancedDetails && advancedDetails.tagName === 'DETAILS') {
      advancedDetails.addEventListener('toggle', function () {
        // When advanced filters are opened/closed, recalculate layout if needed
        if (advancedDetails.open) {
          advancedDetails.classList.add('active');
        } else {
          advancedDetails.classList.remove('active');
        }
      });
    }

    // Initial count
    filterProducts();
  }

  /* ============ Contact Form ============ */
  function initContactForm() {
    var form = document.getElementById('tvs-contact-form');
    if (!form) return;

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      var feedback = document.getElementById('form-feedback');
      var btn = form.querySelector('button[type="submit"]');
      var originalText = btn.textContent;

      btn.textContent = 'Versturen...';
      btn.disabled = true;

      var data = new FormData(form);
      data.append('action', 'tvs_contact');
      data.append('nonce', window.TVS ? window.TVS.nonce : '');

      fetch(window.TVS ? window.TVS.ajaxUrl : '/wp-admin/admin-ajax.php', {
        method: 'POST',
        body: data,
      })
        .then(function (res) { return res.json(); })
        .then(function (res) {
          if (feedback) {
            feedback.style.display = 'block';
            if (res.success) {
              feedback.className = 'form-feedback form-feedback--success';
              feedback.textContent = res.data.message;
              form.reset();
            } else {
              feedback.className = 'form-feedback form-feedback--error';
              feedback.textContent = res.data ? res.data.message : 'Er ging iets mis.';
            }
          }
        })
        .catch(function () {
          if (feedback) {
            feedback.style.display = 'block';
            feedback.className = 'form-feedback form-feedback--error';
            feedback.textContent = 'Verbindingsfout. Probeer het later opnieuw.';
          }
        })
        .finally(function () {
          btn.textContent = originalText;
          btn.disabled = false;
        });
    });
  }

  /* ============ Cookie Consent ============ */
  function initCookieConsent() {
    var banner = document.getElementById('cookie-banner');
    if (!banner) return;

    var consent = getCookie('tvs_consent');
    if (consent) {
      if (consent === 'all') {
        loadAnalytics();
      }
      return;
    }

    // Show banner after short delay
    setTimeout(function () {
      banner.style.display = 'block';
    }, 1500);

    var acceptBtn = document.getElementById('cc-accept');
    var saveBtn = document.getElementById('cc-save');
    var rejectBtn = document.getElementById('cc-reject');
    var analyticsCheck = document.getElementById('cc-analytics');

    if (acceptBtn) {
      acceptBtn.addEventListener('click', function () {
        setCookie('tvs_consent', 'all', 365);
        loadAnalytics();
        banner.style.display = 'none';
      });
    }

    if (saveBtn) {
      saveBtn.addEventListener('click', function () {
        var val = (analyticsCheck && analyticsCheck.checked) ? 'all' : 'necessary';
        setCookie('tvs_consent', val, 365);
        if (val === 'all') loadAnalytics();
        banner.style.display = 'none';
      });
    }

    if (rejectBtn) {
      rejectBtn.addEventListener('click', function () {
        setCookie('tvs_consent', 'necessary', 365);
        banner.style.display = 'none';
      });
    }

    // Reopen banner
    document.querySelectorAll('[data-cc-open]').forEach(function (el) {
      el.addEventListener('click', function (e) {
        e.preventDefault();
        banner.style.display = 'block';
      });
    });
  }

  function loadAnalytics() {
    if (typeof tvs_load_ga4 === 'function') {
      tvs_load_ga4();
    }
  }

  function setCookie(name, value, days) {
    var d = new Date();
    d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
    document.cookie = name + '=' + value + ';expires=' + d.toUTCString() + ';path=/;SameSite=Lax;Secure';
  }

  function getCookie(name) {
    var v = document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)');
    return v ? v.pop() : '';
  }

  /* ============ Grid Pattern Background ============ */
  function initGridPattern() {
    var containers = document.querySelectorAll('[data-grid-bg]');
    if (!containers.length) return;

    containers.forEach(function (container) {
      // Create canvas element for the grid
      var canvas = document.createElement('canvas');
      canvas.className = 'grid-pattern-canvas';
      canvas.setAttribute('aria-hidden', 'true');
      canvas.style.cssText =
        'position:absolute;inset:0;width:100%;height:100%;pointer-events:none;z-index:0;opacity:0;transition:opacity 1s ease';

      container.style.position = container.style.position || 'relative';
      container.insertBefore(canvas, container.firstChild);

      var ctx = canvas.getContext('2d');
      var cellSize = parseInt(container.dataset.gridBg, 10) || 60;
      var animationId = null;
      var phase = 0;

      function resize() {
        var rect = container.getBoundingClientRect();
        var dpr = window.devicePixelRatio || 1;
        canvas.width = rect.width * dpr;
        canvas.height = rect.height * dpr;
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
      }

      function draw() {
        var w = canvas.width / (window.devicePixelRatio || 1);
        var h = canvas.height / (window.devicePixelRatio || 1);
        ctx.clearRect(0, 0, w, h);

        var cols = Math.ceil(w / cellSize) + 1;
        var rows = Math.ceil(h / cellSize) + 1;

        // Draw vertical lines
        for (var c = 0; c < cols; c++) {
          var x = c * cellSize;
          // Subtle shimmer: vary opacity per line using sine wave
          var opacity = 0.04 + 0.02 * Math.sin(phase + c * 0.3);
          ctx.strokeStyle = 'rgba(255,255,255,' + opacity + ')';
          ctx.lineWidth = 1;
          ctx.beginPath();
          ctx.moveTo(x, 0);
          ctx.lineTo(x, h);
          ctx.stroke();
        }

        // Draw horizontal lines
        for (var r = 0; r < rows; r++) {
          var y = r * cellSize;
          var opacity2 = 0.04 + 0.02 * Math.sin(phase + r * 0.3 + 1.5);
          ctx.strokeStyle = 'rgba(255,255,255,' + opacity2 + ')';
          ctx.lineWidth = 1;
          ctx.beginPath();
          ctx.moveTo(0, y);
          ctx.lineTo(w, y);
          ctx.stroke();
        }

        // Draw subtle glow dots at intersections near the center
        var cx = w / 2;
        var cy = h / 2;
        var maxDist = Math.sqrt(cx * cx + cy * cy);

        for (var gc = 0; gc < cols; gc++) {
          for (var gr = 0; gr < rows; gr++) {
            var gx = gc * cellSize;
            var gy = gr * cellSize;
            var dist = Math.sqrt((gx - cx) * (gx - cx) + (gy - cy) * (gy - cy));
            var proximity = 1 - (dist / maxDist);
            var dotOpacity = proximity * 0.08 * (0.5 + 0.5 * Math.sin(phase + gc * 0.5 + gr * 0.5));

            if (dotOpacity > 0.005) {
              ctx.fillStyle = 'rgba(255,255,255,' + dotOpacity + ')';
              ctx.beginPath();
              ctx.arc(gx, gy, 1.5, 0, Math.PI * 2);
              ctx.fill();
            }
          }
        }

        phase += 0.008;
        animationId = requestAnimationFrame(draw);
      }

      // Only animate when visible
      var gridObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            resize();
            canvas.style.opacity = '1';
            if (!animationId) draw();
          } else {
            if (animationId) {
              cancelAnimationFrame(animationId);
              animationId = null;
            }
            canvas.style.opacity = '0';
          }
        });
      }, { threshold: 0 });

      gridObserver.observe(container);

      // Resize handler
      var resizeTimeout;
      window.addEventListener('resize', function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(resize, 200);
      }, { passive: true });
    });
  }

  /* ============ Theme Toggle ============ */
  function initThemeToggle() {
    var toggle = document.getElementById('theme-toggle');
    if (!toggle) return;

    toggle.addEventListener('click', function() {
      var html = document.documentElement;

      // Add transition class for smooth color changes
      html.classList.add('theme-transitioning');

      var isDark = html.classList.contains('dark');

      if (isDark) {
        html.classList.remove('dark');
        localStorage.setItem('tvs-theme', 'light');
        // Update meta theme-color
        var meta = document.getElementById('meta-theme-color');
        if (meta) meta.content = '#f9fafb';
      } else {
        html.classList.add('dark');
        localStorage.setItem('tvs-theme', 'dark');
        var meta = document.getElementById('meta-theme-color');
        if (meta) meta.content = '#000000';
      }

      // Remove transition class after animation completes
      setTimeout(function() {
        html.classList.remove('theme-transitioning');
      }, 300);
    });
  }

  /* ============ Init ============ */
  document.addEventListener('DOMContentLoaded', function () {
    initAnimations();
    initHeader();
    initProductFilters();
    initContactForm();
    initCookieConsent();
    initGridPattern();
    initThemeToggle();
  });
})();
