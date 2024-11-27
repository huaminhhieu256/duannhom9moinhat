
<?php

class ProductController
{
    //Hàm list sẽ lấy các sản phẩm theo danh mục
    public function list()
    {
        $id = $_GET['id']; //id danh mục
        //Lấy sản phẩm theo danh mục
        $products = (new Product)->listByCategory($id);

        $title = '';
        if ($products) {
            $title = $products[0]['cate_name'];
        }
        //Lấy danh mục
        $categories = (new Category)->all();

        return view(
            'client.products.category',
            compact('products', 'categories', 'title')
        );
    }

    //Hiển thị chi tiết
    public function show()
    {
        //Lấy id của sản phẩm
        $id = $_GET['id'];
        //Lấy ra sản phẩm theo id
        $product = (new Product)->find($id);
        //Lấy tên sản phẩm đưa và title
        $title = $product['name'] ?? '';
        //lấy danh mục
        $categories = (new Category)->all();

        //Lưu URI vào session
        $_SESSION['URI'] = $_SERVER['REQUEST_URI'];

        return view(
            'client.products.detail',
            compact('product', 'title', 'categories')
        );
    }
}
