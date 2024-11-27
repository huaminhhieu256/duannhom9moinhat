<?php
session_start();
session_destroy(); // Hủy session
header("Location: " . ROOT_URL); // Quay lại trang chính
exit;
?>
