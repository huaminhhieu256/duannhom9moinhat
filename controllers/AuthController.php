<?php

class AuthController
{
    // Đăng ký
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;

            // Mã hóa mật khẩu
            $password = $_POST['password'];
            $password = password_hash($password, PASSWORD_DEFAULT);

            // Đưa vào data
            $data['password'] = $password;

            // Insert vào database
            (new User)->create($data);

            // Thông báo
            $_SESSION['message'] = 'Đăng ký thành công';
            header("Location: " . ROOT_URL . "?ctl=login");
            die;
        }

        return view('client.users.register');
    }

    // Đăng nhập
    public function login()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (isset($_SESSION['user'])) {
            header("Location: " . ROOT_URL);
            die;
        }
    
        $error = null;
        
        // Kiểm tra nếu yêu cầu là POST (người dùng gửi thông tin đăng nhập)
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            // Lấy email và mật khẩu người dùng nhập vào
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            // Tìm người dùng theo email
            $user = (new User)->findByEmail($email);
    
            // Kiểm tra nếu người dùng tồn tại trong cơ sở dữ liệu
            if ($user) {
                // Kiểm tra mật khẩu với mật khẩu đã mã hóa trong cơ sở dữ liệu
                if (password_verify($password, $user['password'])) {
                    // Đăng nhập thành công, lưu thông tin người dùng vào session
                    $_SESSION['user'] = $user;
    
                    // Điều hướng dựa trên vai trò của người dùng
                    if ($user['role'] == 'admin') {
                        // Nếu là admin, chuyển hướng đến trang quản trị
                        header("Location: " . ADMIN_URL);
                        die;
                    }
    
                    // Nếu không phải admin, chuyển hướng về trang chủ
                    header("Location: " . ROOT_URL);
                    die;
                } else {
                    // Mật khẩu không đúng
                    $error = "Email hoặc Mật khẩu không đúng";
                }
            } else {
                // Không tìm thấy người dùng với email đã nhập
                $error = "Email hoặc Mật khẩu không đúng";
            }
        }
    
        // Lấy thông báo flash message nếu có
        $message = session_flash('message');
    
        // Trả về view đăng nhập với thông báo lỗi nếu có
        return view('client.users.login', compact('message', 'error'));
    }
    

    // Hiển thị danh sách người dùng
    public function index()
    {
        $users = (new User)->all();
        return view('admin.users.list', compact('users'));
    }

    // Cập nhật trạng thái kích hoạt người dùng
    public function updateActive()
    {
        $data = $_POST;

        // Đảo trạng thái active
        $data['active'] = $data['active'] ? 0 : 1;

        // Cập nhật trạng thái active
        (new User)->updateActive($data['id'], $data['active']);
        return header('Location: ' . ADMIN_URL . '?ctl=listuser');
    }
    public function logout()
{
    // Xóa thông tin người dùng khỏi session
    unset($_SESSION['user']);
    
    // Chuyển hướng về trang đăng nhập
    header('Location: ' . ROOT_URL . '?ctl=login');
    die; // Dừng thực thi mã sau khi chuyển hướng
}

}
