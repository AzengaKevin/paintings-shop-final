<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/vendor/bootstrap-4.6.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/vendor/fontawesome-free-5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="/css/master.css" />

    <base href="<?= \BASE_URL ?>">

    <title>Sell You Painting Online - Art & Painting Shop</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand font-weight-bold" style="color:orange" href="/">Art & Painting Shop</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contact">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/products">Products</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item">
                            <a href="/cart" class="nav-link">
                                <i class="fas fa-shopping-cart"></i>
                                <sup>
                                    <span class="badge badge-pill badge-primary"><?= cartCount() ?></span>
                                </sup>
                            </a>
                        </li>

                        <?php if(!isLoggedIn()) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Register</a>
                        </li>
                        <?php else : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $_SESSION['user']['name'] ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" role="button" data-toggle="modal" data-target="#logout-modal"
                                    href="#">Logout</a>
                            </div>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
        <?php if(array_key_exists('message', $_SESSION)) : ?>
        <div class="alert alert-<?= $_SESSION['message']['type'] ?> mt-nav rounded-0 mb-0">
            <?= $_SESSION['message']['content'] ?>
            <?php unset($_SESSION['message']) ?>
        </div>
        <?php endif; ?>
    </header>

    <?= $content ?>

    <div class="modal" tabindex="-1" id="logout-modal">
        <div class="modal-dialog">
            <form class="modal-content" action="/logout" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Sign Out</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you wanna, sign out, all the session data will be lost.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Nevermind</button>
                    <button class="btn btn-primary">Logout</button>
                </div>
            </form>
        </div>
    </div>
    <footer class="p-3 bg-light">
        <p>Copyright &copy; All Rights Reservec, Art & Painting Shop 2021</p>
    </footer>
    <!-- JQuery -->
    <script src="/vendor/jquery/jquery-3.5.1.min.js"></script>
    <!-- Bundled Bootstrap and popper JS -->
    <script src="/vendor/bootstrap-4.6.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>