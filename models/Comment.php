<?php

class Comment extends BaseModel

{
    
    // Hiển thị danh sách bình luận của sản phẩm
    public function listCommentInProduct($productId)
    {
        $sql = "SELECT c.*, u.fullname FROM comments c 
                JOIN users u ON u.id = c.user_id 
                WHERE c.product_id = :product_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['product_id' => $productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }

    // Hiển thị danh sách sản phẩm có bình luận
    public function listProductHasComments()
    {
        $sql = "SELECT p.id, p.name AS product_name, COUNT(c.id) AS comment_count 
                FROM products p 
                JOIN comments c ON p.id = c.product_id 
                GROUP BY p.id, p.name";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tạo bình luận mới
    public function create($data)
    {
        $sql = "INSERT INTO comments (user_id, product_id, content) 
                VALUES (:user_id, :product_id, :content)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // Cập nhật trạng thái kích hoạt bình luận
    public function updateActive($id, $active)
    {
        $sql = "UPDATE comments 
                SET active = :active 
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id, 'active' => $active]);
    }

    public function listCommentInProductClient($productId)
    {
        // Kiểm tra câu truy vấn SQL
        $sql = "SELECT c.*, u.fullname 
                FROM comments c 
                JOIN users u ON u.id = c.user_id 
                WHERE c.product_id = :product_id AND c.active = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['product_id' => $productId]);
        
        // Kiểm tra nếu có dữ liệu
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $comments;
    }
    

    
}
