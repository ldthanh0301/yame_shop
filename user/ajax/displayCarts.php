<table class="table--cart">
    <thead>
        <tr class="table--cart__row">
            <th class="header--table w-product">Món Ăn</th>
            <th class="header--table">Số lượng</th>
            <th class="header--table">Giá</th>
            <th class="header--table">Thành Tiền</th>
        </tr>
    </thead>
    <tbody id="table_list_item">
        <?php 
        if(!empty($_SESSION['cart']->products)){
            $index=0;
            foreach($_SESSION['cart']->products as $product){ 
        ?>
        <tr>
            <td class="cart--product">
                <div class="cart--product__img">
                    <img src="./products-img/<?php echo $product['images'][0]['TenHinh']?>" alt="" >
                </div>
                <div class="cart--product__desc">
                    <p><?php echo $product['name']?></p>
                    <button href="#" class="remove-from-cart" onclick="handleRemoveProductFromCart('<?php echo $index?>')" trigger-remove="remove">Remove</button>
                </div>
            </td>
            <td class="cart--quantity table-data-cart">
                <input type="number" value="<?php echo $product['quantity'] ?>" name="quantity" data-index="<?php echo $index?>" onchange="calTotalPrice(this)" class="quantity-product-cart"  autocomplete = "off" min="1">
            </td>
            <td class="cart--price table-data-cart">
                <p><?php echo number_format($product['price'])?></p>
            </td>
            <td class="cart--subtotal table-data-cart">
                <p type="number" class="subtotal" ><?php echo number_format($product['totalPrice'])?></p>
            </td>
            <!-- <td class="cart--choose table-data-cart">
                <input type="checkbox" value="1" class="check-cart" name="choose" id="choose" checked="checked" >
            </td> -->
        </tr>
        <?php
                $index++;
            }
        }
        ?>
    </tbody>
</table>