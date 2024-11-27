
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ANVATONLINE - <?= $title ?? '' ?></title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel=" stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= ROOT_URL ?>">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Sản phẩm
                            </a>
                            <ul class="dropdown-menu">
                                <?php foreach ($categories as $cate): ?>
                                    <li><a class="dropdown-item" href="<?= ROOT_URL . '?ctl=category&id=' . $cate['id'] ?>">
                                            <?= $cate['cate_name'] ?>
                                        </a></li>
                                <?php endforeach ?>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="<?= ROOT_URL ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user"></i>
                                <?= $_SESSION['user']['fullname'] ?? '' ?>
                            </a>
                            <ul class="dropdown-menu">
                                <?php if (isset($_SESSION['user'])) : ?>
                                    <li>
                                        <a class="dropdown-item" href="<?= ROOT_URL ?>">
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= ROOT_URL . '?ctl=logout' ?>">
                                            Logout
                                        </a>
                                    </li>
                                <?php else : ?>
                                    <li>
                                        <a class="dropdown-item" href="<?= ROOT_URL . '?ctl=login' ?>">
                                            Đăng nhập
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= ROOT_URL . '?ctl=register' ?>">
                                            Đăng ký
                                        </a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT_URL . '?ctl=view-cart' ?>">Giỏ hàng (<?= $_SESSION['totalQuantity'] ?? 0 ?>)</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="keyword">
                        <button class="btn btn-outline-success" type="button" id="search">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Slideshow Section -->
<div id="carouselExample" class="carousel slide mt-3" data-bs-ride="carousel">
    <!-- Indicators -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <!-- Slides -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/slide1.jpg" class="d-block w-100" alt="Slide 1">
            <div class="carousel-caption d-none d-md-block">
                <h5>Chào mừng đến ANVATONLINE</h5>
                <p>Đặt món ăn vặt yêu thích của bạn ngay hôm nay!</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="images/slide2.jpg" class="d-block w-100" alt="Slide 2">
            <div class="carousel-caption d-none d-md-block">
                <h5>Sản phẩm đa dạng</h5>
                <p>Khám phá các món ăn ngon hấp dẫn.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="images/slide3.jpg" class="d-block w-100" alt="Slide 3">
            <div class="carousel-caption d-none d-md-block">
                <h5>Ưu đãi đặc biệt</h5>
                <p>Nhận ngay các ưu đãi siêu hot khi mua sắm.</p>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

                                    