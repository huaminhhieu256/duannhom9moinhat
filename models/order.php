<?php
class Order extends BaseModel
{
    public $status_details = [
        1 => 'Chờ xác nhận',
        2 => 'Chờ giao hàng',
        3 => 'Đã giao',
        4 => 'Đã hủy',
    ];

    // Fetch all orders
    public function all()
    {
        $sql = "SELECT o.*, u.fullname AS fullname, u.email AS email, u.phone AS phone, u.address AS address 
                FROM orders o 
                JOIN users u ON o.user_id = u.id 
                ORDER BY o.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch specific order details
    public function find($id)
    {
        $sql = "SELECT o.*, u.fullname AS fullname, u.email AS email, u.phone AS phone, u.address AS address
                FROM orders o 
                JOIN users u ON o.user_id = u.id 
                WHERE o.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fetch list of products in an order
    public function listOrderDetail($id)
    {
        $sql = "SELECT od.*, p.name AS product_name, p.image AS image
                FROM order_details od 
                JOIN products p ON od.product_id = p.id
                WHERE od.order_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // Create a new order
    public function create($data)
    {
        $sql = "INSERT INTO orders(user_id, status, payment_method, total_price) 
                VALUES(:user_id, :status, :payment_method, :total_price)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        return $this->conn->lastInsertId();
    }

    // Update order status
    public function updateStatus($id, $status){
        $sql = "UPDATE orders SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['status' => $status, 'id' => $id]);
    }
    

    // Add order details
    public function createOrderDetail($data)
    {
        $sql = "INSERT INTO order_details(order_id, product_id, quantity, price) 
                VALUES(:order_id, :product_id, :quantity, :price)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }
}
?>
