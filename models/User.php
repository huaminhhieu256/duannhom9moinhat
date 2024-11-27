<?php
class User extends BaseModel
{
    // Lấy tất cả người dùng
    public function all()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy thông tin người dùng theo ID
    public function find($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute(['id' => "id"]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Tìm theo email
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        
        // Sử dụng đúng giá trị của biến $email thay vì chuỗi "email"
        $stmt->execute(['email' => $email]);
        
        // Trả về kết quả, hoặc null nếu không tìm thấy người dùng
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function create($data)
    {
        $sql = "INSERT INTO users(fullname,email,password,phone,address) VALUES
    (:fullname,:email,:password,:phone,:address)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);



    }

    // Cập nhật user
    public function update($id, $data)
    {
        // Câu lệnh SQL cập nhật
        $sql = "UPDATE users 
            SET fullname = :fullname, 
                phone = :phone, 
                address = :address, 
                role = :role, 
                active = :active 
            WHERE id = :id";

        // Chuẩn bị câu lệnh SQL
        $stmt = $this->conn->prepare($sql);

        // Thêm id vào mảng dữ liệu
        $data['id'] = $id;

        // Thực thi câu lệnh
        $stmt->execute($data);
    }
    public function updateActive($id, $active)
    {
        $sql = "UPDATE users SET active=:active WHERE id=:id";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute(['id' => $id, 'active' => $active]);
    }

}
