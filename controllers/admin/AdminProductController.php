<?php
//AdminProductController Điều sản phẩm
class AdminProductController
{
    public function __construct()
    {
        $user = $_SESSION['user'] ?? [];
        if (!$user || $user['role'] != 'admin') {
            // Gọi header() trực tiếp mà không cần return
            header("Location: " . ROOT_URL);
            exit(); // Dừng việc thực thi sau khi redirect
        }
    }
    
    //Hàm index để hiển thị ds sản phẩm
    public function index()
    {
        //Lấy thông tin message từ session
        $message = $_SESSION['message'] ?? '';
        unset($_SESSION['message']);
        $products = (new Product)->all();
        $title = 'Trang chủ website';
        return view("admin.products.list", compact('products', 'message', 'title'));
    }

    //Hàm create hiển thị form thêm mới
    public function create()
    {
        $categories = (new Category)->all();
        $title = "Thêm sản phẩm";
        return view(
            "admin.products.add",
            compact('categories', 'title')
        );
    }

    //Hàm store dùng để lưu dữ liệu thêm vào database
    public function store()
    {
        $data = $_POST;

        $image = ""; //Khi người dùng không upload ảnh
        //Nếu người dùng upload hình ảnh
        $file = $_FILES['image'];
        if ($file['size'] > 0) {
            //lấy ảnh
            $image = "images/" . $file['name'];
            //Upload ảnh
            move_uploaded_file($file['tmp_name'], ROOT_DIR . $image);
        }
        //đưa ảnh vào $data
        $data['image'] = $image;
        $product = new Product;
        $product->create($data);
        header("location: " . ADMIN_URL . "?ctl=listsp");
    }

    //Hmf edit dùng để hiển thị form cập nhật
    public function edit()
    {
        $id = $_GET['id'];
        $product = (new Product)->find($id);
        $categories = (new Category)->all();
        $title = "Cập nhật sản phẩm: " . $product['name'];
        return view(
            "admin.products.edit",
            compact('product', 'categories', 'title')
        );
    }

    //Cập nhật sản phẩm
    
    public function update()
    {
        $data = $_POST;
    
        // Lấy sản phẩm hiện tại
        $product = new Product;
        $item = $product->find($data['id']);
        $image = $item['image']; // Sử dụng ảnh cũ nếu không upload ảnh mới
    
        // Xử lý tệp ảnh
        $file = $_FILES['image'];
        if ($file['size'] > 0) {
            $image = "images/" . $file['name'];
            move_uploaded_file($file['tmp_name'], ROOT_DIR . $image);
        }
    
        // Đưa ảnh vào mảng $data
        $data['image'] = $image;
    
        // Cập nhật sản phẩm
        $product->update($data['id'], $data);
    
        // Chuyển hướng sau khi cập nhật
        header("location: " . ADMIN_URL . "?ctl=editsp&id=" . $data['id']);
        die;
    }
    

    //Xóa sản phẩm
    public function delete()
    {
        $id = $_GET['id'];
        //Xóa sp
        (new Product)->delete($id);
        //Session lưu thông báo khi xóa thành công
        $_SESSION['message'] = "Xóa dữ liệu thành công";
        //về giao diện hiển thị danh sách sp
        header("location: " . ADMIN_URL . "?ctl=listsp");
        die;
    }
}
