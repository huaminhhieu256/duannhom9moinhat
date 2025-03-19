<?php

class User extends BaseModel
{
    //lấy toàn bộ users
    public function all()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Lấy ra 1 user
    public function find($id)
    {
        $sql = "SELECT * FROM users WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Lấy ra 1 user theo email
    public function findUserOfEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email=:email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Thêm 1 user
    public function create($data)
    {
        $sql = "INSERT INTO users(fullname, email, password, phone, address) VALUES(:fullname, :email, :password, :phone, :address)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    //Cập nhật user
    // Cập nhật thông tin người dùng
public function update($id, $data)
{
    // Cập nhật các thông tin: fullname, phone, address, role, active
    $sql = "UPDATE users SET fullname=:fullname, phone=:phone, address=:address, role=:role, active=:active WHERE id=:id";
    $stmt = $this->conn->prepare($sql);

    // Thêm id vào data để chuẩn bị cập nhật
    $data['id'] = $id;
    // Thực thi câu lệnh SQL
    $stmt->execute($data);
}

    //cập nhật hoạt động của user (active)
public function updateActive($id, $active)
{
    $sql = "UPDATE users SET active = :active WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id, 'active' => $active]);
}

}
