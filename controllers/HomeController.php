<?php
class HomeController
{
    public function index()
    {
        $product = new Product;

        // Lấy danh mục
        $categories = (new Category)->all();

        // Dữ liệu danh mục và sản phẩm
        $categories_with_products = [];
        foreach ($categories as $category) {
            $categories_with_products[] = [
                'cate_name' => $category['cate_name'],
                'products' => $product->getProductByCate($category['id']),
            ];
        }

        // Tên tiêu đề trang
        $title = 'Trang chủ website';

        // Trả về view
        return view('client.home', compact('categories_with_products', 'title', 'categories'));
    }

}