jQuery(document).ready(function ($) {
  const $body = $('body');

  function setWishlistButtonState($buttons, isActive, label) {
    $buttons.each(function () {
      const $button = $(this);
      const $icon = $button.find('.djs-wishlist-toggle__icon');
      const activeIcon = $icon.attr('data-icon-active');
      const defaultIcon = $icon.attr('data-icon-default');

      $button.toggleClass('is-active', isActive);
      $button.attr('aria-pressed', isActive ? 'true' : 'false');
      $button.attr('aria-label', label);

      if ($icon.length) {
        $icon.html(isActive ? activeIcon : defaultIcon);
      }

      const $text = $button.find('.djs-wishlist-toggle__text');
      if ($text.length) {
        $text.text(label);
      }
    });
  }

  function renderWishlistEmptyState($wishlistPage) {
    const emptyMessage = $wishlistPage.data('empty-message') || 'Votre liste de souhaits est vide pour le moment.';
    $wishlistPage.html(`<p class="djs-wishlist-page__empty">${emptyMessage}</p>`);
  }

  $body.on('click', '.djs-wishlist-toggle', function (e) {
    e.preventDefault();

    const $button = $(this);
    const productId = parseInt($button.data('product-id'), 10) || 0;

    if (!productId || $button.hasClass('is-loading')) {
      return;
    }

    $button.addClass('is-loading');

    $.ajax({
      url: djs_ajax_obj.ajax_url,
      type: 'POST',
      data: {
        action: 'djs_toggle_wishlist',
        nonce: djs_ajax_obj.nonce,
        product_id: productId,
      },
      success: function (response) {
        if (!response.success || !response.data) {
          return;
        }

        const selector = `.djs-wishlist-toggle[data-product-id="${response.data.product_id}"]`;
        const $relatedButtons = $(selector);

        setWishlistButtonState($relatedButtons, response.data.is_active, response.data.label);

        if (!response.data.is_active) {
          const $wishlistProduct = $button.closest('.djs-wishlist-page li.product');
          const $wishlistPage = $button.closest('.djs-wishlist-page');

          if ($wishlistProduct.length) {
            $wishlistProduct.remove();

            if ($wishlistPage.length && !$wishlistPage.find('li.product').length) {
              renderWishlistEmptyState($wishlistPage);
            }
          }
        }
      },
      complete: function () {
        $button.removeClass('is-loading');
      }
    });
  });
});
