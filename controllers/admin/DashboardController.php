
<?php

class DashboardController
{
    public function __construct()
    {
        $user = $_SESSION['user'] ?? [];
        if (!$user || $user['role'] != 'admin') {
            // Chuyển hướng và dừng thực thi mã sau khi redirect
            header("Location: " . ROOT_URL);
            exit();  // Đảm bảo chương trình dừng lại sau khi redirect
        }
    }

    public function index()
    {
        return view('admin.dashboard');
    }
}

