<?php

class Product extends BaseModel
{
    // Lấy toàn bộ sản phẩm// Lấy toàn bộ sản phẩm
public function all()
{
    $sql = "SELECT p.*, c.cate_name FROM products p JOIN categories c ON p.category_id=c.id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // Lấy danh sách sản phẩm theo danh mục
    //@id mã danh mục
    public function listByCategory($categoryId)
    {
        $sql = "SELECT * FROM products WHERE category_id = :category_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy sản phẩm là thực phẩm (type=1), thay thế cho pets
    public function listFood()
    {
        $sql = "SELECT p.*, c.cate_name FROM products p JOIN categories c ON p.category_id=c.id WHERE type=1 ORDER BY p.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy các sản phẩm không phải thực phẩm (type=0)
    public function listOtherProduct()
    {
        $sql = "SELECT p.*, c.cate_name FROM products p JOIN categories c ON p.category_id=c.id WHERE type=0 ORDER BY p.id DESC LIMIT 8";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm dữ liệu
    public function create($data)
    {
        $sql = "INSERT INTO products(name, image, price, quantity, description, status, category_id) 
                VALUES(:name, :image, :price, :quantity, :description, :status, :category_id)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    // Cập nhật
    public function update($id, $data)
    {
        $sql = "UPDATE products SET 
                    name=:name, 
                    image=:image, 
                    price=:price, 
                    quantity=:quantity, 
                    description=:description, 
                    detailed_description=:detailed_description, 
                    status=:status, 
                    category_id=:category_id 
                WHERE id=:id";
    
        $stmt = $this->conn->prepare($sql);
    
        // Thêm id vào mảng dữ liệu
        $data['id'] = $id;
    
        // Thực thi truy vấn
        $stmt->execute($data);
    }

    // Lấy ra 1 bản ghi
    public function find($id)
    {
        $sql = "SELECT * FROM products WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Xóa sản phẩm
    public function delete($id)
    {
        $sql = "DELETE FROM products WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    // Tìm kiếm sản phẩm theo tên
    public function search($keyword = null)
    {
        $sql = "SELECT * FROM products WHERE name LIKE '%$keyword%'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
