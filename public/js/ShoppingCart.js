var ROUTES = {
    SHOPPING_CART_GET: '/ShoppingCartGet',
    SHOPPING_CART_ADD: '/ShoppingCartAdd',
    SHOPPING_CART_UPDATE: '/ShoppingCartUpdate',
    SHOPPING_CART_REMOVE: '/ShoppingCartRemove'
};

var SELECTORS = {
    PRODUCT_ADD: '.product-add button',
    PRODUCT_AMOUNT: 'input.product-amount',
    PRODUCT_REMOVE: '.product-remove',
    SHOPPING_CART: '.shopping_cart_dropdown',
    SHOPPING_CART_TOGGLE: '.header-dropdown[data-dropdown=shopping_cart]',
    SHOPPING_CART_ICON: '.header-dropdown[data-dropdown=shopping_cart] > i',
    SHOPPING_CART_BADGE: '.header-dropdown[data-dropdown=shopping_cart] .badge',
    SHOPPING_CART_TABLE: '.shopping_cart_dropdown tbody',
    ORDER_FORM: '.order-form'
};

$(window).ready(function () {

    // Setup CSRF Token for validation.
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var _ShoppingCart = {};

    getShoppingCart();

    $(SELECTORS.PRODUCT_ADD).on('click', addToShoppingCart);
    $(SELECTORS.SHOPPING_CART).on('change', SELECTORS.PRODUCT_AMOUNT, updateShoppingCart);
    $(SELECTORS.SHOPPING_CART).on('click', SELECTORS.PRODUCT_REMOVE, removeFromShoppingCart);
    $(SELECTORS.SHOPPING_CART_TOGGLE).on('click', toggleShoppingCart);

    $(SELECTORS.ORDER_FORM).on('change', SELECTORS.PRODUCT_AMOUNT, updateShoppingCart);
    $(SELECTORS.ORDER_FORM).on('click', SELECTORS.PRODUCT_REMOVE, removeFromShoppingCart);

    /**
     * Get the contents of the Shopping Cart
     */
    function getShoppingCart() {
        $.ajax({
            method: 'GET',
            url: ROOT_PATH + ROUTES.SHOPPING_CART_GET,
            success: function (response) {
                _ShoppingCart = response;
                populateShoppingCart();
            }
        });
    }

    /**
     * Add a Product to the Shopping Cart
     * @param {NativeEvent} event - Native click event data
     * @param {Number} id - Product ID
     */
    function addToShoppingCart(event, id = null) {
        id = id || $(this).data('product-id');

        $.ajax({
            method: 'POST',
            url: ROOT_PATH + ROUTES.SHOPPING_CART_ADD,
            data: {
                id: id
            },
            success: function (response) {
                getShoppingCart();
            }
        });
    }

    /**
     * Remove a Product from Shopping Cart
     * @param {NativeEvent} event - Native click event data
     * @param {Number} id - Product ID
     */
    function removeFromShoppingCart(event, id = null) {
        id = id || $(this).data('product-id');

        $.ajax({
            method: 'POST',
            url: ROOT_PATH + ROUTES.SHOPPING_CART_REMOVE,
            data: {
                id: id
            },
            success: function (response) {
                getShoppingCart();
            }
        });
    }

    /**
     * Change the requested amount of a Product in the Shopping Cart
     * @param {NativeEvent} event - Native change event data
     * @param {Number} id - Product ID
     * @param {Number} amount - The new requested amount off this Product.
     */
    function updateShoppingCart(event, id = null, amount = null) {
        amount = amount || $(this).val();
        id = id || $(this).data('product-id');

        $.ajax({
            method: 'POST',
            url: ROOT_PATH + ROUTES.SHOPPING_CART_UPDATE,
            data: {
                id: id,
                amount: amount
            },
            success: function (response) {
                getShoppingCart();
            }
        });
    }

    /**
     * Shows the Shopping Cart view to the user
     * @param {NativeEvent} event - Native click event data
     * @param {Boolean} visible (Default: true) - show/hide Shopping Cart Dropdown
     */
    function toggleShoppingCart(event, visible = null) {
        visible = visible === null
            ? $(SELECTORS.SHOPPING_CART).is(':hidden')
            : visible;

        if(visible) {
            $(SELECTORS.SHOPPING_CART).show();
            $(SELECTORS.SHOPPING_CART_ICON).addClass('active');
            $(SELECTORS.SHOPPING_CART_BADGE).hide();
        } else {
            if(event){
                if ($(event.target).parents(SELECTORS.SHOPPING_CART).length)
                    return;
            }
            $(SELECTORS.SHOPPING_CART).hide();
            $(SELECTORS.SHOPPING_CART_ICON).removeClass('active');
            $(SELECTORS.SHOPPING_CART_BADGE).show();
        }
    }

    /**
     * Update the Shopping Cart Dropdown table contents
     * and the corresponding badge count
     */
    function populateShoppingCart() {
        var products = _ShoppingCart.products;
        var productCount = 0;
        var tbody = '';

        if(products.length) {

            for (var productIndex in products) {
                var product = products[productIndex];
                productCount += product.amount;
                tbody += (
                    '<tr>' +
                        '<td><img src="' + ROOT_PATH + '/storage/images/' + product.thumb + '" style="max-width: 70px; max-height: 50px;"/></td>' +
                        '<td>' + product.title + '</td>' +
                        '<td><input type="text" size="2" value="' + product.amount + '" class="product-amount" data-product-id="' + product.id + '"/></td>' +
                        '<td>$' + (product.price * product.amount).toFixed(2) + '</td>' +
                        '<td><span class="product-remove" data-product-id="' + product.id + '"><i class="fas fa-trash"></i></span></td>' +
                    '</tr>'
                );
            }

            tbody += (
                '<tr>' +
                    '<td colspan="3" >Total</td>' +
                    '<td>$' + _ShoppingCart.totalPrice.toFixed(2) + '</td>' +
                '</tr>'
            );

        } else {
            tbody = (
                '<tr><td>There are no items in your shopping cart.</td></tr>'
            );
        }

        $(SELECTORS.SHOPPING_CART_TABLE).html(tbody);
        $(SELECTORS.SHOPPING_CART_BADGE).html(productCount);
    }

});
