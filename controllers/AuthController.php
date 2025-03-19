
<?php

class AuthController
{
    //Đăng ký
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            //Mã hóa mật khẩu
            $password = $_POST['password'];
            $password = password_hash($password, PASSWORD_DEFAULT);

            //đưa vào data
            $data['password'] = $password;

            //Insert vào database
            (new User)->create($data);

            //Thông báo
            $_SESSION['message'] = 'Đăng ký thành công';
            header("Location: " . ROOT_URL . "?ctl=login");
            die;
        }

        return view('client.users.register');
    }

    //Đăng nhập
    public function login()
    {
        //Kiểm tra xem người dùng đăng nhập chưa
        if (isset($_SESSION['user'])) {
            header("location: " . ROOT_URL);
            die;
        }
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = (new User)->findUserOfEmail($email);

            //Kiểm tra mật khẩu
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    //đăng nhập thành công
                    $_SESSION['user'] = $user;
                    //nếu role = admin, vào admin, ngược lại vào trang chủ
                    if ($user['role'] == 'admin') {
                        header("Location: " . ADMIN_URL);
                        die;
                    }
                    header("Location: " . ROOT_URL);
                    die;
                } else {
                    $error = "Email hoặc Mật khẩu không đúng";
                }
            } else {
                $error = "Email hoặc Mật khẩu không đúng";
            }
        }
        $message = session_flash('message');
        return view('client.users.login', compact('message', 'error'));
    }

    //Đăng xuất
    public function logout()
    {
        unset($_SESSION['user']);
        header('Location:' . ROOT_URL . '?ctl=login');
        die;
    }

    public function index()
    {
        $users = (new User)->all();
        return view('admin.users.list', compact('users'));
    }

    public function updateActive()
    {
        $data = $_POST;  // Nhận dữ liệu từ form

        // Kiểm tra giá trị active và gán lại (0 hoặc 1)
        $data['active'] = $data['active'] ? 1 : 0;  // Nếu active có giá trị, set là 1, nếu không là 0

        // Gọi phương thức updateActive từ model User để cập nhật trạng thái hoạt động của người dùng
        (new User)->updateActive($data['id'], $data['active']);

        // Chuyển hướng người dùng về trang danh sách người dùng
        return header('Location: ' . ADMIN_URL . '?ctl=listuser');
    }
    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $role = $_POST['role'];
            $phone = $_POST['phone'];
            $active = $_POST['active'];
            $address = $_POST['address'];

            // Cập nhật quyền, số điện thoại, trạng thái và địa chỉ người dùng
            (new User)->update($id, [
                'role' => $role,
                'phone' => $phone,
                'active' => $active,
                'address' => $address
            ]);

            // Quay lại trang danh sách người dùng
            header('Location: ' . ADMIN_URL . '?ctl=listuser');
            exit;
        }
    }
    


}
