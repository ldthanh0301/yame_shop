function addToCart(id) {
    $.get("./ajax/cart.php", { action: 'add', id: id }, function(carts) {
        carts = JSON.parse(carts);
        if (carts.status == 0) {
            alert(carts.message);
        } else {
            showCartInHeader(carts.products)
        }
    })
}

function showCartInHeader(products = []) {
    $("#notification-add-cart").html(products.length);
    if (!products) {
        $("#cart-list-product").html(`<div class="cart_item_null">Giỏ hàng đang trống</div>`);
        return
    }

    let listProucts = products.map((product, index) => {
        return `
        <li class="cart_item">
            <a href="#" class="cart_link">
                <img src="../products-img/${product.images[0].TenHinh}" class="cart_product_image"/>
                <div class="cart_product">
                    <span class="cart_product_name">${product.name}</span>
                    <span class="cart_product_price">${product.price}đ</span>
                </div>
            </a>
            <button onclick="removeProductFromCart(${index})" class="cart_link_delete">
                <i class="far fa-times-circle"></i>
            </button>
        </li>
        `
    })
    $("#cart-list-product").html(listProucts.join(''))
}

function removeProductFromCart(index, callback = null, root = null) {
    $.get("./ajax/cart.php", { action: 'remove', index: index }, function(carts) {
        carts = JSON.parse(carts);
        if (carts.products.length == 0) {
            //hiển thị giỏi hàng trên header
            $("#cart-list-product").html(`<div class="cart_item_null">Giỏ hàng đang trống</div>`);
            // hiển thị giỏi hàng ở view hiện tại
            if (callback && root) {
                callback(carts.products, root)
            }
            return 0
        }
        // hiển thị 
        showCartInHeader(carts.products)
        if (callback && root) {
            callback(carts.products, root)
        }
        return carts;
    })
}

function displayCarts(products, root) {
    if (products.length === 0) {
        root.html(`<div class="cart_item_null">Giỏ hàng đang trống</div>`)
        location.reload();
        return
    }
    console.log('số sản phẩm' + products.length)
    let listProducts = products.map((product, index) => {
        console.log('thanh')
        return `<tr>
                    <td class="cart--product">
                        <div class="cart--product__img">
                            <img src="../products-img/${product.images[0].TenHinh}" alt="" >
                        </div>
                        <div class="cart--product__desc">
                            <p>${product.name}</p>
                            <button href="#" class="remove-from-cart" onclick="handleRemoveProductFromCart(${index})" trigger-remove="remove">Remove</button>
                        </div>
                    </td>
                    <td class="cart--quantity table-data-cart">
                        <input type="number" value="${product.quantity}" name="quantity" data-index="${index}" onblur="calTotalPrice(this)" class="quantity-product-cart"  autocomplete = "off" min="1">
                    </td>
                    <td class="cart--price table-data-cart">
                        <p>${product.price.toLocaleString()}</p>
                    </td>
                    <td class="cart--subtotal table-data-cart">
                        <p type="number" class="subtotal" >${product.totalPrice.toLocaleString()}</p>
                    </td>
                    <!-- <td class="cart--choose table-data-cart">
                        <input type="checkbox" value="1" class="check-cart" name="choose" id="choose" checked="checked" >
                    </td> -->
                </tr>`
    })


    // root.html(listProducts.join(''))
    location.reload();
}