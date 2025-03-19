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
        // Giả sử bạn đã có kết nối cơ sở dữ liệu trong $this->conn
        $sql = "SELECT * FROM products WHERE category_id = :category_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();

        // Trả về kết quả dưới dạng mảng
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getProductByCate($category_id = null)
    {
        $sql = "SELECT c.cate_name, p.name, p.image, p.price, p.description, p.id
        FROM products as p 
        JOIN categories as c ON p.category_id = c.id";
        
        // Nếu có category_id, thêm điều kiện WHERE
        if ($category_id) {
            $sql .= " WHERE p.category_id = :category_id";
        }
        
        $stmt = $this->conn->prepare($sql);
    
        // Nếu có category_id, bind giá trị
        if ($category_id) {
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy sản phẩm là thực phẩm (type=1),
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
    
    try {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':name' => $data['name'],
            ':image' => $data['image'],
            ':price' => $data['price'],
            ':quantity' => $data['quantity'],
            ':description' => $data['description'],
            ':status' => $data['status'],
            ':category_id' => $data['category_id']
        ]);
    } catch (PDOException $e) {
        die("Lỗi thêm sản phẩm: " . $e->getMessage());
    }
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
