<?php
class OrderController{
    public function index(){
        $orders = (new Order) -> all();
        return view("admin.orders.list" , compact('orders'));
    }
    // chuyển đổi trạng thái đơn hàng
    public function showOrder(){
        $id = $_GET['id'];
    
        // Xử lý cập nhật trạng thái đơn hàng
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $status = isset($_POST['status']) ? trim($_POST['status']) : null;
    
            // Kiểm tra nếu giá trị status không hợp lệ
            if ($status === null) {
                die("Lỗi: Trạng thái đơn hàng không hợp lệ.");
            }
    
            // Cập nhật trạng thái đơn hàng
            (new Order)->updateStatus($id, $status);
        }
    
        // Lấy thông tin chi tiết đơn hàng và trạng thái
        $order = (new Order)->find($id);
        $order_details = (new Order)->listOrderDetail($id); 
        $status = (new Order)->status_details;
    
        return view("admin/orders/detail", compact('order', 'order_details', 'status'));
    }
    
}