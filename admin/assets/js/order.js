
function handleChangeQuantity(e) {
    let index = e.dataset.index;
    let quantity = e.valueAsNumber;
    let price = parseInt(e.dataset.price);
    let isCartOrder = location.search.split('&').includes('?action=cart');
    let maxQuantity = parseInt(e.max);
    if (quantity > maxQuantity ) {
        e.value = maxQuantity;
        quantity = maxQuantity;
    }
    if (quantity< 1){
        e.value = 1;
        quantity =1;
    }
    if (isCartOrder){
        $.get('./ajax/cart.php',{action:'update',index:index,quantity:quantity},function(carts) {
            let root= $('#cart-list-items');
            carts = JSON.parse(carts);
            displayProductsInOrder(carts.products,root);
            // hiển thị tổng  tiền
            $('.js-total-price')[0].innerHTML = carts.totalPrice.toLocaleString();
        })
    } else {
        let row = e.parentElement.closest('.row');
        let priceElement = row.querySelector('span.js-price');
        let totalPrice = document.querySelector('span.js-total-price');
        let unitPrice =quantity * price;
        priceElement.innerHTML= unitPrice.toLocaleString();
        totalPrice.innerHTML = unitPrice.toLocaleString();
    }
}
// Hiển thị danh sách sản phẩm trang order
function displayProductsInOrder(products,root =null) {
    if (!root) {
        console.log('Lỗi hàm displayProductsInOrder , thiếu root')
        return
    }
    if (products.length ==0) {
        root.html(`<div class="cart_item_null">Giỏ hàng đang trống</div>`)
        return
    }
    if (!products) {
        console.log('Lỗi hàm displayProductsInOrder , thiếu products')
        return
    }
    let listProducts= products.map((product, index)=> {
        return  `<div class="product-info__row">                 
                    <div class="row">
                        <div class="col-1">
                            <button type="button" class="btn btn-danger" onclick="handleRemoveProductFromCart(${index})" style="border-radius: 8px;">
                                <i style="font-size: 1.5rem;color: white;" class="far fa-times-circle"></i>
                            </button>
                        </div>
                        <div class="col-2">
                            <img style='width:100px' src="../products-img/${product.images[0].TenHinh}" alt="Ảnh review">
                        </div>    
                        <div class="col-5">
                            <div>
                                <span>Mã sản phẩm:</span>
                                <input style="width: 100px;" type='text' value="${product.MSHH}"  name="MSHH"readonly/>
                            </div>
                            <span>${product.name}</span>
                            
                            <div class="div">
                                <span>Số lượng còn lại:</span>
                                <span>${product.totalQuantity}</span>
                                <span>cái</span>
                            </div>
                            <div>
                                <span>Giá sản phẩm</span>
                                <span>${product.price.toLocaleString()}Đ</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="product-info__quantity">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Số lượng sản phẩm</h6>
                                            <input data-index="${index}" onchange='handleChangeQuantity(this)' class="form-control" name='quantity' type="number" value='${product.quantity}'  min='1' max="${product.totalQuantity}" >
                                    </div>
                                    <div class="col-6">
                                        <h6>Thành tiền</h6>
                                        <span>${product.totalPrice.toLocaleString()}</span>
                                        <span>Đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>`
    })

    
    root.html(listProducts.join(''));
  
}

// xử lý xóa sản phẩm 
function handleRemoveProductFromCart(index) {
    let root= $('#cart-list-items');
    let isCartOrder = location.search.split('&').includes('?action=cart');
    if (isCartOrder){
       removeProductFromCart(index,displayProductsInOrder,root);
       console.log(carts);
    } else {
        root.html(`<div class="cart_item_null">Giỏ hàng đang trống</div>`)
        let totalPrice = document.querySelector('span.js-total-price');
        totalPrice.innerHTML = 0;
    }
}