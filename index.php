
    <?php
    session_start();
    require_once __DIR__ . "/env.php";
    require_once __DIR__ . "/common/function.php";
    require_once __DIR__ . "/models/BaseModel.php";
    require_once __DIR__ . "/models/Category.php";
    require_once __DIR__ . "/models/Product.php";
    require_once __DIR__ . "/models/User.php";
    require_once __DIR__ . "/models/order.php";
    require_once __DIR__ . "/models/Comment.php";



    require_once __DIR__ . "/controllers/HomeController.php";
    require_once __DIR__ . "/controllers/ProductController.php";
    require_once __DIR__ . "/controllers/SearchController.php";
    require_once __DIR__ . "/controllers/CartController.php";
    require_once __DIR__ . "/controllers/AuthController.php";
        

    $ctl = $_GET['ctl'] ?? '';

    match ($ctl) {
        '', 'home'  => (new HomeController)->index(),
        'category'  => (new ProductController)->list(),
        'search'    => (new SearchController)->search(),
        'detail'    => (new ProductController)->show(),
        'add-cart'  => (new CartController)->addCart(),
        'view-cart' => (new CartController)->viewCart(),
        'delete-cart'   => (new CartController)->deleteProductInCart(),
        'update-cart'   => (new CartController)->updateCart(),
        'login'     => (new AuthController)->login(),
        'register'  => (new AuthController)->register(),
        'logout'    => (new AuthController)->logout(),
        'view-checkout' => (new CartController) ->viewCheckOut(),
        'checkout' => (new CartController) ->CheckOut(),
          'success'=> (new CartController) -> success(),
        default => view("errors.404"),
    };
