jQuery(document).ready(function ($) {
  $('.mobile-nav-open').on('click', function () {
    $('.mobile-nav').addClass('active');
    $('body').addClass('mobile-menu-active');
  });

  $('.mobile-nav-close, .mobile-nav-close-top').on('click', function () {
    $('.mobile-nav').removeClass('active');
    $('body').removeClass('mobile-menu-active');
  });
});

jQuery(document).ready(function ($) {
  const $window = $(window);
  const $header = $('.site-header');
  const $topbar = $header.find('.header-topbar');
  const $mainHeader = $header.find('.header-main');

  if (!$header.length || !$mainHeader.length || !$topbar.length) {
    return;
  }

  function updateStickyHeader() {
    const topbarHeight = $topbar.outerHeight() || 0;
    const mainHeaderHeight = $mainHeader.outerHeight() || 0;
    const adminBarHeight = $('body').hasClass('admin-bar')
      ? ($(window).width() > 782 ? 32 : 46)
      : 0;

    const scrollTop = $window.scrollTop();

    $header[0].style.setProperty('--djs-sticky-offset', mainHeaderHeight + 'px');

    if (scrollTop >= topbarHeight) {
      $header.addClass('is-sticky has-sticky-header');
      $mainHeader.css('top', adminBarHeight + 'px');
    } else {
      $header.removeClass('is-sticky has-sticky-header');
      $mainHeader.css('top', '');
    }
  }

  updateStickyHeader();

  $window.on('scroll', function () {
    updateStickyHeader();
  });

  $window.on('resize', function () {
    updateStickyHeader();
  });
});


jQuery(document).ready(function ($) {
  $('.djs-search-toggle').on('click', function () {
    $('.mobile-nav').removeClass('active');
    $('body').removeClass('mobile-menu-active');
    $('.djs-search-overlay').addClass('active');
    $('body').addClass('search-overlay-active');
    setTimeout(function () {
      $('#djs-product-search').trigger('focus');
    }, 50);
  });

  $('.djs-search-overlay__close').on('click', function () {
    $('.djs-search-overlay').removeClass('active');
    $('body').removeClass('search-overlay-active');
  });

  $(document).on('keydown', function (e) {
    if (e.key === 'Escape') {
      $('.djs-search-overlay').removeClass('active');
      $('body').removeClass('search-overlay-active');
    }
  });
});


jQuery(document).ready(function ($) {
  if ($('.home-announcement-slider').length) {
    new Swiper('.home-announcement-slider', {
      slidesPerView: 'auto',
      spaceBetween: 0,
      loop: true,
      speed: 5000,
      allowTouchMove: false,
      autoplay: {
        delay: 0,
        disableOnInteraction: false,
      },
    });
  }
});



jQuery(document).ready(function ($) {
  const $shopPage = $('.djs-shop-page');

  if (!$shopPage.length) return;

  const $drawer = $('.djs-filter-drawer');
  const $form = $('#djs-filter-form');
  const $productsWrap = $('.djs-products-grid-wrap');
  const $paginationWrap = $('.djs-pagination-wrap');
  const $activeFilters = $('.djs-active-filters');
  const $filterCount = $('.djs-filter-count');
  const $foundCount = $('.djs-found-count');
  const $drawerFoundCount = $('.djs-filter-found-count');
  const $sortSelect = $('#djs-sort-select');

  const shopUrl = $shopPage.data('shop-url');
  const currentTermId = $shopPage.data('current-term-id');
  const currentTaxonomy = $shopPage.data('current-taxonomy');
  const searchTerm = $shopPage.data('search-term') || '';

  function getSelectedValues(name) {
    const values = [];
    $form.find(`input[name="${name}[]"]:checked`).each(function () {
      values.push($(this).val());
    });
    return values;
  }

  function getFormData(paged = 1) {
    return {
      action: 'djs_ajax_filter_products',
      nonce: djs_ajax_obj.nonce,
      paged: paged,
      order: $sortSelect.val(),
      current_term_id: currentTermId,
      current_taxonomy: currentTaxonomy,
      categories: getSelectedValues('categories'),
      genre: getSelectedValues('genre'),
      color: getSelectedValues('color'),
      size: getSelectedValues('size'), 
      search_term: searchTerm,
    };
  }

  function updateFilterCount() {
    const count =
      getSelectedValues('categories').length +
      getSelectedValues('genre').length +
      getSelectedValues('color').length +
      getSelectedValues('size').length;

    $filterCount.text(`(${count})`);

    // 👉 toggle reset button
    if (count === 0) {
      $('.djs-filter-reset').hide();
    } else {
      $('.djs-filter-reset').show();
    }

  }

  function updateActiveTabs() {
    const genre = getSelectedValues('genre');

    $('.djs-shop-tab').removeClass('active');

    if (genre.length === 1) {
      $(`.djs-shop-tab[data-genre="${genre[0]}"]`).addClass('active');
    } else {
      $('.djs-shop-tab-all').addClass('active');
    }
  }

  function updateActiveFilterPills() {
    let html = '';

    function addPills(name) {
      $form.find(`input[name="${name}[]"]:checked`).each(function () {
        const value = $(this).val();
        let label = '';

        if ($(this).closest('.djs-check-label').length) {
          label = $(this).siblings('.djs-check-text').text();
        } else {
          label = $(this).siblings('span').text();
        }

        html += `
          <button type="button" class="djs-filter-pill" data-name="${name}" data-value="${value}">
            ${label} <span>×</span>
          </button>
        `;
      });
    }

    addPills('categories');
    addPills('genre');
    addPills('color');
    addPills('size');

    $activeFilters.html(html);
  }

  function buildUrl(paged = 1) {
    const params = new URLSearchParams();

    const categories = getSelectedValues('categories');
    const genre = getSelectedValues('genre');
    const color = getSelectedValues('color');
    const size = getSelectedValues('size');
    const order = $sortSelect.val();

    if (categories.length) {
      params.set('categories', categories.join(','));
    }

    if (genre.length) {
      params.set('genre', genre.join(','));
    }

    if (color.length) {
      params.set('color', color.join(','));
    }

    if (size.length) {
      params.set('size', size.join(','));
    }

    if (order && order !== 'menu_order') {
      params.set('order', order);
    }

    if (paged > 1) {
      params.set('paged', paged);
    }

    if (searchTerm) {
      params.set('s', searchTerm);
      params.set('post_type', 'product');
    }

    const queryString = params.toString();
    return queryString ? `${shopUrl}?${queryString}` : shopUrl;
  }

  function applyStateToFormFromUrl() {
    const params = new URLSearchParams(window.location.search);

    function setCheckedFromParam(paramName, inputName) {
      const value = params.get(paramName);
      if (!value) return;

      const values = value.split(',');
      values.forEach(function (item) {
        $form.find(`input[name="${inputName}[]"][value="${item}"]`).prop('checked', true);
      });
    }

    setCheckedFromParam('categories', 'categories');
    setCheckedFromParam('genre', 'genre');
    setCheckedFromParam('color', 'color');
    setCheckedFromParam('size', 'size');

    const order = params.get('order');
    if (order) {
      $sortSelect.val(order);
    }

    if (!params.get('genre') && currentTaxonomy === 'pa_genre' && currentTermId) {
      const archiveSlug = $('.djs-shop-tab.active').data('genre');
      if (archiveSlug) {
        $form.find(`input[name="genre[]"][value="${archiveSlug}"]`).prop('checked', true);
      }
    }
  }

  function loadProducts(paged = 1, pushUrl = true) {
    const data = getFormData(paged);

    $productsWrap.addClass('loading');
    $paginationWrap.addClass('loading');

    $.ajax({
      url: djs_ajax_obj.ajax_url,
      type: 'POST',
      data: data,
      success: function (response) {
        if (response.success) {
          $productsWrap.html(response.data.products);
          $paginationWrap.html(response.data.pagination);
          $foundCount.text(response.data.found);
          $drawerFoundCount.text(response.data.found);

          updateFilterCount();
          updateActiveFilterPills();
          updateActiveTabs();

          if (pushUrl) {
            const newUrl = buildUrl(paged);
            window.history.pushState({ path: newUrl }, '', newUrl);
          }
        }
      },
      complete: function () {
        $productsWrap.removeClass('loading');
        $paginationWrap.removeClass('loading');
      }
    });
  }

  function triggerInstantFilter() {
    loadProducts(1, true);
  }

  $('.djs-filter-toggle').on('click', function () {
    $drawer.addClass('active');
    $('body').addClass('mobile-menu-active');
  });

  $('.djs-filter-close, .djs-filter-drawer__overlay').on('click', function () {
    $drawer.removeClass('active');
    $('body').removeClass('mobile-menu-active');
  });

  $('.djs-filter-apply').on('click', function () {
    $drawer.removeClass('active');
    $('body').removeClass('mobile-menu-active');
  });

  $('.djs-filter-reset').on('click', function () {
    $form[0].reset();
    $sortSelect.val('menu_order');
    loadProducts(1, true);
  });

  $(document).on('change', '#djs-filter-form input[type="checkbox"]', function () {
    triggerInstantFilter();
  });

  $sortSelect.on('change', function () {
    loadProducts(1, true);
  });

  $(document).on('click', '.djs-pagination-wrap .page-numbers a', function (e) {
    e.preventDefault();

    const href = $(this).attr('href');
    let paged = 1;

    const matchPretty = href.match(/\/page\/([0-9]+)/);
    const matchQuery = href.match(/[?&]paged=([0-9]+)/);

    if (matchPretty) {
      paged = parseInt(matchPretty[1], 10);
    } else if (matchQuery) {
      paged = parseInt(matchQuery[1], 10);
    }

    loadProducts(paged, true);

    $('html, body').animate({
      scrollTop: $('.djs-shop-toolbar').offset().top - 80
    }, 300);
  });

  $(document).on('click', '.djs-filter-pill', function () {
    const name = $(this).data('name');
    const value = $(this).data('value');

    $form.find(`input[name="${name}[]"][value="${value}"]`).prop('checked', false);
    loadProducts(1, true);
  });

  $('.djs-shop-tab').on('click', function (e) {
    e.preventDefault();

    const genre = $(this).data('genre');

    $form.find('input[name="genre[]"]').prop('checked', false);

    if (genre) {
      $form.find(`input[name="genre[]"][value="${genre}"]`).prop('checked', true);
    }

    loadProducts(1, true);
  });

  window.addEventListener('popstate', function () {
    $form[0].reset();
    $sortSelect.val('menu_order');
    applyStateToFormFromUrl();
    loadProducts(1, false);
  });

  applyStateToFormFromUrl();
  updateFilterCount();
  updateActiveFilterPills();
  updateActiveTabs();

  if (window.location.search) {
    loadProducts(1, false);
  }

  $(document).on('click', '.djs-filter-collapse', function () {
    const $btn = $(this);
    const $group = $btn.closest('.djs-filter-group');
    const $options = $group.find('.djs-filter-options').first();

    if ($group.hasClass('is-collapsed')) {
      $group.removeClass('is-collapsed');
      $btn.text('−');
      $options.stop(true, true).slideDown(200);
    } else {
      $group.addClass('is-collapsed');
      $btn.text('+');
      $options.stop(true, true).slideUp(200);
    }
  });

});

jQuery(document).ready(function ($) {
  const $variationForms = $('.single-product .variations_form');

  if (!$variationForms.length) {
    return;
  }

  $variationForms.each(function () {
    const $form = $(this);

    $form.find('table.variations select').each(function () {
      const $select = $(this);
      const $valueCell = $select.closest('td.value');

      if ($valueCell.find('.djs-variation-chips').length) {
        return;
      }

      const options = $select.find('option').filter(function () {
        return $(this).val() !== '';
      });

      if (!options.length) {
        return;
      }

      $valueCell.addClass('has-djs-chips');

      const $chipWrap = $('<div class="djs-variation-chips" />');

      options.each(function () {
        const $option = $(this);
        const value = $option.val();
        const label = $option.text();
        const $chip = $(
          `<button type="button" class="djs-variation-chip" data-value="${value}">${label}</button>`
        );

        if ($select.val() === value) {
          $chip.addClass('is-active');
        }

        $chip.on('click', function () {
          $select.val(value).trigger('change');
        });

        $chipWrap.append($chip);
      });

      $valueCell.append($chipWrap);

      $select.on('change', function () {
        const currentValue = $select.val();
        $chipWrap.find('.djs-variation-chip').removeClass('is-active');
        $chipWrap
          .find(`.djs-variation-chip[data-value="${currentValue}"]`)
          .addClass('is-active');
      });
    });

    $form.on('click', '.reset_variations', function () {
      window.setTimeout(function () {
        $form.find('.djs-variation-chip').removeClass('is-active');
      }, 0);
    });
  });
});

jQuery(document).ready(function ($) {
  const $contactForm = $('#djs-contact-form');

  if (!$contactForm.length) {
    return;
  }

  const $submitButton = $contactForm.find('.djs-contact-form__submit');
  const $status = $contactForm.find('.djs-contact-form__status');

  $contactForm.on('submit', function (e) {
    e.preventDefault();

    const formData = {
      action: 'djs_submit_contact_form',
      nonce: djs_ajax_obj.nonce,
      name: $.trim($('#djs-contact-name').val()),
      email: $.trim($('#djs-contact-email').val()),
      subject: $.trim($('#djs-contact-subject').val()),
      message: $.trim($('#djs-contact-message').val()),
    };

    $status.removeClass('is-error is-success').text('');
    $submitButton.addClass('is-loading').prop('disabled', true);

    $.ajax({
      url: djs_ajax_obj.ajax_url,
      type: 'POST',
      data: formData,
      success: function (response) {
        if (response.success) {
          $status.addClass('is-success').text(response.data.message);
          $contactForm[0].reset();
        } else if (response.data && response.data.message) {
          $status.addClass('is-error').text(response.data.message);
        } else {
          $status.addClass('is-error').text('Une erreur est survenue.');
        }
      },
      error: function (xhr) {
        const message =
          xhr.responseJSON && xhr.responseJSON.data && xhr.responseJSON.data.message
            ? xhr.responseJSON.data.message
            : 'Une erreur est survenue.';

        $status.addClass('is-error').text(message);
      },
      complete: function () {
        $submitButton.removeClass('is-loading').prop('disabled', false);
      }
    });
  });
});

jQuery(document).ready(function ($) {
  const $cartPage = $('.djs-cart-page');

  if (!$cartPage.length) {
    return;
  }

  let updateTimer = null;
  let isUpdating = false;

  function queueCartUpdate() {
    window.clearTimeout(updateTimer);
    updateTimer = window.setTimeout(function () {
      $cartPage.find('.woocommerce-cart-form').trigger('submit');
    }, 250);
  }

  function updateCartAjax($form) {
    if (!$form.length || isUpdating) {
      return;
    }

    const requestData =
      $form.serialize() + '&action=djs_update_cart_quantities&nonce=' + encodeURIComponent(djs_ajax_obj.nonce);

    isUpdating = true;
    $cartPage.addClass('is-updating');
    $form.addClass('is-updating');
    $form.find('.djs-cart-qty-btn, input.qty').prop('disabled', true);

    $.ajax({
      url: djs_ajax_obj.ajax_url,
      type: 'POST',
      data: requestData,
      success: function (response) {
        if (!response.success || !response.data) {
          return;
        }

        if (response.data.header_html) {
          $cartPage.find('.djs-cart-page__header').replaceWith(response.data.header_html);
        }

        if (response.data.form_html) {
          $cartPage.find('.woocommerce-cart-form').replaceWith(response.data.form_html);
        }

        if (typeof response.data.cart_count !== 'undefined') {
          $('.header-cart-count').text(response.data.cart_count);
        }

        if (typeof wc_cart_fragments_params !== 'undefined') {
          $(document.body).trigger('wc_fragment_refresh');
        }
      },
      error: function () {
        window.location.reload();
      },
      complete: function () {
        isUpdating = false;
        $cartPage.removeClass('is-updating');
        $cartPage.find('.woocommerce-cart-form').removeClass('is-updating');
        $cartPage.find('.djs-cart-qty-btn, input.qty').prop('disabled', false);
      }
    });
  }

  $cartPage.on('submit', '.woocommerce-cart-form', function (e) {
    e.preventDefault();
    updateCartAjax($(this));
  });

  $cartPage.on('click', '.djs-cart-qty-btn', function () {
    const $button = $(this);
    const $input = $button
      .closest('.djs-cart-item__quantity-controls')
      .find('input.qty');

    if (!$input.length) {
      return;
    }

    const currentValue = parseInt($input.val(), 10) || 0;
    const min = parseInt($input.attr('min'), 10) || 0;
    const max = parseInt($input.attr('max'), 10) || 9999;
    let nextValue = currentValue;

    if ($button.hasClass('djs-cart-qty-btn--plus')) {
      nextValue = Math.min(currentValue + 1, max);
    } else {
      nextValue = Math.max(currentValue - 1, min);
    }

    $input.val(nextValue).trigger('change');
    queueCartUpdate();
  });

  $cartPage.on('change', 'input.qty', function () {
    queueCartUpdate();
  });
});

jQuery(document).ready(function ($) {
  const $newsletterForm = $('#djs-newsletter-form');

  if (!$newsletterForm.length) {
    return;
  }

  const $newsletterEmail = $('#djs-newsletter-email');
  const $newsletterButton = $newsletterForm.find('button[type="submit"]');
  const $newsletterStatus = $('#djs-newsletter-status');
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  function setNewsletterStatus(type, message) {
    $newsletterStatus.removeClass('is-error is-success').text('');

    if (!message) {
      return;
    }

    $newsletterStatus.addClass(type).text(message);
  }

  $newsletterForm.on('submit', function (e) {
    e.preventDefault();

    const email = $.trim($newsletterEmail.val());

    setNewsletterStatus('', '');

    if (!email) {
      setNewsletterStatus('is-error', 'Veuillez saisir votre adresse e-mail.');
      $newsletterEmail.trigger('focus');
      return;
    }

    if (!emailPattern.test(email)) {
      setNewsletterStatus('is-error', 'Veuillez saisir une adresse e-mail valide.');
      $newsletterEmail.trigger('focus');
      return;
    }

    $newsletterButton.addClass('is-loading').prop('disabled', true);

    $.ajax({
      url: djs_ajax_obj.ajax_url,
      type: 'POST',
      data: {
        action: 'djs_submit_footer_newsletter',
        nonce: djs_ajax_obj.nonce,
        email: email,
      },
      success: function (response) {
        if (response.success) {
          setNewsletterStatus('is-success', response.data.message);
          $newsletterForm[0].reset();
        } else if (response.data && response.data.message) {
          setNewsletterStatus('is-error', response.data.message);
        } else {
          setNewsletterStatus('is-error', 'Une erreur est survenue.');
        }
      },
      error: function (xhr) {
        const message =
          xhr.responseJSON && xhr.responseJSON.data && xhr.responseJSON.data.message
            ? xhr.responseJSON.data.message
            : 'Une erreur est survenue.';

        setNewsletterStatus('is-error', message);
      },
      complete: function () {
        $newsletterButton.removeClass('is-loading').prop('disabled', false);
      }
    });
  });
});

jQuery(document).ready(function ($) {
  const storageKey = 'djsRecentlyViewedProducts';
  const maxStoredProducts = 12;
  const currentProductId = parseInt(djs_ajax_obj.current_product_id, 10) || 0;

  function getStoredProductIds() {
    try {
      const rawValue = window.localStorage.getItem(storageKey);
      const parsedValue = rawValue ? JSON.parse(rawValue) : [];

      if (!Array.isArray(parsedValue)) {
        return [];
      }

      return parsedValue
        .map(function (value) {
          return parseInt(value, 10) || 0;
        })
        .filter(function (value) {
          return value > 0;
        });
    } catch (error) {
      return [];
    }
  }

  function setStoredProductIds(productIds) {
    try {
      window.localStorage.setItem(storageKey, JSON.stringify(productIds.slice(0, maxStoredProducts)));
    } catch (error) {
      // Ignore storage write failures.
    }
  }

  if (currentProductId > 0) {
    const nextProductIds = getStoredProductIds().filter(function (productId) {
      return productId !== currentProductId;
    });

    nextProductIds.unshift(currentProductId);
    setStoredProductIds(nextProductIds);
  }

  const $cartSuggestions = $('.djs-cart-suggestions');

  if (!$cartSuggestions.length) {
    return;
  }

  const $tabs = $cartSuggestions.find('.djs-cart-suggestions__tab');
  const $panels = $cartSuggestions.find('.djs-cart-suggestions__panel');
  const $recentWrap = $cartSuggestions.find('.djs-cart-suggestions__recently-viewed');
  const emptyText = $recentWrap.data('empty-text') || 'Aucun produit consulte recemment pour le moment.';
  let recentlyViewedLoaded = false;
  let recentlyViewedLoading = false;

  function activateSuggestionTab(target) {
    $tabs.removeClass('is-active');
    $tabs.filter(`[data-target="${target}"]`).addClass('is-active');

    $panels.removeClass('is-active');
    $panels.filter(`[data-panel="${target}"]`).addClass('is-active');
  }

  function loadRecentlyViewedProducts() {
    const productIds = getStoredProductIds();

    if (!$recentWrap.length) {
      return;
    }

    if (!productIds.length) {
      $recentWrap.html(`<p class="djs-cart-suggestions__empty">${emptyText}</p>`);
      recentlyViewedLoaded = true;
      return;
    }

    recentlyViewedLoading = true;
    $recentWrap.html('<p class="djs-cart-suggestions__empty">Chargement des produits recemment consultes...</p>');

    $.ajax({
      url: djs_ajax_obj.ajax_url,
      type: 'POST',
      data: {
        action: 'djs_get_recently_viewed_products',
        nonce: djs_ajax_obj.nonce,
        product_ids: productIds,
      },
      success: function (response) {
        if (response.success && response.data && response.data.html) {
          $recentWrap.html(response.data.html);
        } else {
          $recentWrap.html(`<p class="djs-cart-suggestions__empty">${emptyText}</p>`);
        }

        recentlyViewedLoaded = true;
      },
      error: function () {
        $recentWrap.html(`<p class="djs-cart-suggestions__empty">${emptyText}</p>`);
      },
      complete: function () {
        recentlyViewedLoading = false;
      }
    });
  }

  $cartSuggestions.on('click', '.djs-cart-suggestions__tab', function () {
    const target = $(this).data('target');

    if (!target) {
      return;
    }

    activateSuggestionTab(target);

    if (target === 'recently-viewed' && !recentlyViewedLoaded && !recentlyViewedLoading) {
      loadRecentlyViewedProducts();
    }
  });
});

jQuery(document).ready(function ($) {
  const $accountAuth = $('.djs-account-auth__inner');

  if (!$accountAuth.length) {
    return;
  }

  function activateTab(tabName) {
    $accountAuth.find('.djs-account-auth__tab').removeClass('is-active');
    $accountAuth
      .find(`.djs-account-auth__tab[data-target="${tabName}"]`)
      .addClass('is-active');

    $accountAuth.find('.djs-account-panel').removeClass('is-active');
    $accountAuth
      .find(`.djs-account-panel[data-panel="${tabName}"]`)
      .addClass('is-active');
  }

  $accountAuth.on('click', '.djs-account-auth__tab', function () {
    activateTab($(this).data('target'));
  });

  $accountAuth.on('click', '.djs-account-password-toggle', function () {
    const $button = $(this);
    const $field = $button.siblings('input');
    const nextType = $field.attr('type') === 'password' ? 'text' : 'password';

    $field.attr('type', nextType);
    $button.toggleClass('is-visible', nextType === 'text');
  });
});
