<?php

class ProductController
{
    // Hàm list sẽ lấy các sản phẩm theo danh mục
    public function list()
    {
        $id = $_GET['id']; // id danh mục
        // Lấy sản phẩm theo danh mục
        $products = (new Product)->listByCategory($id);
    
        $title = '';
        if (!empty($products) && isset($products[0]['cate_name'])) {
            $title = $products[0]['cate_name'];
        } else {
            $title = 'Danh mục không có sản phẩm';
        }
    
        // Lấy danh mục
        $categories = (new Category)->all();
    
        // Truyền tất cả dữ liệu vào view
        return view('client.products.category', compact('products', 'categories', 'title'));
    }
    

    // Hiển thị chi tiết sản phẩm
    public function show()
    {
        // Lấy id của sản phẩm
        $id = $_GET['id'];
        // Lấy ra sản phẩm theo id
        $product = (new Product)->find($id);
        // Lấy tên sản phẩm và đưa vào title
        $title = $product['name'] ?? '';
        // Lấy danh mục
        $categories = (new Category)->all();

        // Lưu URI vào session để có thể quay lại trang trước
        $_SESSION['URI'] = $_SERVER['REQUEST_URI'];

        // Lấy danh sách bình luận của sản phẩm này (đã kích hoạt)
        $comments = (new Comment)->listCommentInProductClient($id);
        

        // Truyền tất cả dữ liệu vào view
        return view(
            'client.products.detail',
            compact('product', 'title', 'categories', 'comments')
        );
    }
}
