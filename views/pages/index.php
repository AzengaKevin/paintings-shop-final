<main class="min-h-screen">
    <div class="hero min-h-screen d-flex flex-column align-items-center justify-content-center p-2 p-sm-0">
        <h1 class="text-white">Welcome to our Painting Shop</h1>
        <p class="text-muted">Supporting art and Artists</p>
    </div>
    <section class="py-5">
        <div class="container">
            <h2 class="text-center">Recently Added Products</h2>
            <hr class="my-5">

            <div class="row products">

                <?php foreach($products as $product) : ?>
                <div class="col-md-3 product">
                    <a href="/products/show?id=<?= $product->id ?>" class="text-decoration-none">
                        <img src="/uploads/<?= $product->img ?>" height="200" class="w-100 rounded object-cover" alt="">
                        <div class="mt-3">
                            <span class="d-block text-dark h5"><?= $product->name ?></span>
                            <span class="text-muted">&dollar; <?= $product->price ?></span>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="py-2 d-flex justify-content-end">
                <a href="/products" class="btn btn-lg btn-light">View All</a>
            </div>
        </div>
    </section>
</main>