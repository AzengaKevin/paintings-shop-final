<main class="min-h-screen mt-nav py-5">
    <div class="container">
        <div class="d-flex justify-content-between">
            <h1 class="h4 font-weight-bold">All Products</h1>

            <?php if(isLoggedIn()) : ?>
            <?php if(isLoggedIn()): ?>
            <a href="/products/create">Add Product</a>
            <?php endif; ?>
            <?php endif; ?>
        </div>

        <form class="input-group my-3">
            <input type="search" name="s" class="form-control" placeholder="Product Name..."
                aria-label="Product Name..." value="<?= $needle ?? '' ?>" aria-describedby="search-button-addon">
            <div class="input-group-append">
                <button class="btn btn-success" id="search-button-addon">Search</button>
            </div>
        </form>
        <div class="row products mt-4">

            <?php foreach($products as $product) : ?>
            <div class="col-md-3 product mb-4">
                <a href="/products/show?id=<?= $product->id ?>" class="text-decoration-none">
                    <img src="/uploads/<?= $product->img ?>" height="200" class="w-100 rounded object-cover" alt="">
                    <div class="mt-3">
                        <span class="d-block text-dark h5"><?= $product->name ?></span>
                        <span class="text-muted">$<?= $product->price ?></span>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="py-3">

            <?php if(ceil($totalProducts / $pageItems) > 1) : ?>
            <nav>
                <ul class="pagination">
                    <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li> -->
                    <?php for($i = 0; $i < ceil($totalProducts / $pageItems); $i++) : ?>
                    <li class="page-item <?= ($page == ($i + 1)) ? 'active' : '' ?>"><a class="page-link"
                            href="/products?p=<?= $i + 1 ?>"><?= $i + 1 ?></a></li>
                    <?php endfor; ?>
                    <!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
                </ul>
            </nav>
            <?php endif; ?>
        </div>
    </div>
</main>