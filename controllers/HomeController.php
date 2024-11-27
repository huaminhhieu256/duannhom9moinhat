<?php
class HomeController
{
    public function index()
    {
        // Lấy danh sách sản phẩm cho từng danh mục
        $product = new Product;

        // Lấy sản phẩm thuộc các danh mục (Bánh ngọt, Kem, Snack)
        $cakes = $product->listByCategory(1);  
        $ice_creams = $product->listByCategory(2);  
        $snacks = $product->listByCategory(3);  
        
        // Thay đổi pets thành food
        $food = $product->listFood();  
        $list_products = $product->listOtherProduct();

        // Lấy danh mục
        $categories = (new Category)->all();
        
        // Tên tiêu đề trang
        $title = 'Trang chủ website';
        
        // Trả về view với dữ liệu phân loại sản phẩm
        return view(
            'client.home',
            compact('food', 'list_products', 'categories', 'title', 'cakes', 'ice_creams', 'snacks')
        );
    }
}
