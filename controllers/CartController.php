<?php


class CartController
{
    public function addCart()
    {
        session_start();
        $carts = $_SESSION['cart'] ?? []; // Tạo giỏ hàng nếu chưa tồn tại
        $id = $_GET['id'];

        // Lấy sản phẩm theo id
        $product = (new Product)->find($id);
        if (!$product) {
            die("Sản phẩm không tồn tại.");
        }

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

        // Lưu giỏ hàng và số lượng vào session
        $_SESSION['cart'] = $carts;
        $_SESSION['totalQuantity'] = $this->totalQuantityCart($carts);

        // Điều hướng về URI hoặc ROOT_URL nếu URI không tồn tại
        $uri = $_SESSION['URI'] ?? ROOT_URL;
        header("Location: " . $uri);
    }

    public function totalQuantityCart($carts)
    {
        $totalQuantity = 0;
        foreach ($carts as $cart) {
            $totalQuantity += $cart['quantity'];
        }
        return $totalQuantity;
    }

    public function totalPriceInOrder()
    {
        $carts = $_SESSION['cart'] ?? [];
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart['price'] * $cart['quantity'];
        }
        return $total;
    }

    public function viewCart()
    {
        $carts = $_SESSION['cart'] ?? [];
        $totalPriceInOrder = !empty($carts) ? $this->totalPriceInOrder() : 0;
        $categories = (new Category)->all();

        return view('client.carts.cart', compact('carts', 'totalPriceInOrder', 'categories'));
    }

    public function deleteProductInCart()
    {
        session_start();
        $id = $_GET['id'];
        unset($_SESSION['cart'][$id]);
        $_SESSION['totalQuantity'] = $this->totalQuantityCart($_SESSION['cart']);
        return header("Location: " . ROOT_URL . '?ctl=view-cart');
    }

    public function updateCart()
    {
        session_start();
        $quantities = $_POST['quantity'];
        foreach ($quantities as $id => $qty) {
            $_SESSION['cart'][$id]['quantity'] = $qty;
        }
        $_SESSION['totalQuantity'] = $this->totalQuantityCart($_SESSION['cart']);

        return header("Location: " . ROOT_URL . '?ctl=view-cart');
    }

    public function viewCheckOut()
    {
        // Kiểm tra xem session đã khởi tạo chưa
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            return header("Location: " . ROOT_URL . '?ctl=login');
        }
    
        // Lấy thông tin từ session
        $user = $_SESSION['user'];

        // dd($user);
        $carts = $_SESSION['cart'] ?? []; // Sử dụng đúng tên session
        $totalPriceInOrder = !empty($carts) ? $this->totalPriceInOrder() : 0;
    
        // Hiển thị view
        return view("client.carts.checkout", compact('user', 'carts', 'totalPriceInOrder'));

    }
    public function checkOut()
    {
        // Lấy thông tin người dùng
        $user = [
            'id' => $_POST['id'],
            'fullname' => $_POST['fullname'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'role' => $_SESSION['user']['role'],
            'active' => $_SESSION['user']['active'],
        ];
        $totalPriceInOrder = (new CartController)->totalPriceInOrder();

// Lấy thông tin thanh toán
$order = [
    'user_id' => $_POST['id'],
    'status' => 1,
    'payment_method' => $_POST['payment_method'],
    'total_price' => $totalPriceInOrder,
];

(new User)->update($user['id'], $user);
$order_id = (new Order)->create($order);

$carts = $_SESSION['cart'];
foreach ($carts as $id => $cart) {
    $or_detail = [
        'order_id' => $order_id,
        'product_id' => $id,
        'price' => $cart['price'],
        'quantity' => $cart['quantity']
    ];
    (new Order)->createOrderDetail($or_detail);
}
$this->clearCart();
return view("client.carts.success");
}
public function clearCart()
{
    unset($_SESSION['cart']);           // Removes the 'cart' session variable
    unset($_SESSION['totalQuantity']); // Removes the 'totalQuantity' session variable
    unset($_SESSION['URI']);           // Removes the 'URI' session variable
}
public function success(){
    return view("client.carts.success");
}

    
}
