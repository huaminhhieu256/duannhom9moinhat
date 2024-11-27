<?php

class CartController
{
    public function addCart()
    {
        $carts = $_SESSION['cart'] ?? []; //tạo giỏ hàng

        // Lấy id để thêm vào giỏ hàng
        $id = $_GET['id'];

        // Lấy sản phẩm theo id
        $product = (new Product)->find($id);

        // Kiểm tra sản phẩm có trong giỏ hàng
        if (isset($carts[$id])) {
            $carts[$id]['quantity'] += 1;
        } else {
            $carts[$id] = [
                'name' => $product['name'],
                'image' => $product['image'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        }

        // Lưu giỏ hàng vào session
        $_SESSION['cart'] = $carts;

        // Lưu số lượng sản phẩm trong giỏ hàng
        $_SESSION['totalQuantity'] = $this->totalQuantityCart($carts);

        // Lấy đường dẫn và chuyển hướng
        $uri = $_SESSION['URI']; // Lấy đường dẫn
        header("Location: " . $uri);
    }

    // Tính tổng số lượng sản phẩm trong giỏ hàng
    public function totalQuantityCart($carts)
    {
        $totalQuantity = 0;
        foreach ($carts as $cart) {
            $totalQuantity += $cart['quantity'];
        }
        return $totalQuantity;
    }

    // Tính tổng tiền trong giỏ hàng
    public function totalPriceInOrder()
    {
        $carts = $_SESSION['cart'] ?? [];

        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart['price'] * $cart['quantity'];
        }
        return $total;
    }

    // Hiển thị giỏ hàng
    public function viewCart()
    {
        $carts = $_SESSION['cart'] ?? [];
        $totalPriceInOrder = $this->totalPriceInOrder();

        $categories = (new Category)->all();

        return view('client.carts.cart', compact('carts', 'totalPriceInOrder', 'categories'));
    }

    // Xóa sản phẩm trong giỏ hàng
    public function deleteProductInCart()
    {
        // Lấy id sản phẩm
        $id = $_GET['id'];

        // Xóa sản phẩm trong giỏ hàng
        unset($_SESSION['cart'][$id]);

        // Chuyển về giỏ hàng
        return header("Location: " . ROOT_URL . '?ctl=view-cart');
    }

    // Cập nhật giỏ hàng
    public function updateCart()
    {
        $quantities = $_POST['quantity'];
        foreach ($quantities as $id => $qty) {
            $_SESSION['cart'][$id]['quantity'] = $qty;
        }
        return header("Location: " . ROOT_URL . '?ctl=view-cart');
    }
}
