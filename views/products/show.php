<main class="min-h-screen mt-nav py-5">
    <div class="container">
        <h1 class="h4 font-weight-bold"><?= $product->name ?></h1>
        <div class="row products mt-4">
            <div class="col-md-8">
                <img class="w-100" src="/uploads/<?= $product->img ?>" alt="<?= $product->name ?>">
            </div>
            <div class="col-md-4">
                <div>
                    <div class="row"><span class="col-md-5">Name: </span><span
                            class="col-md-7 font-weight-bold h5"><?= $product->name ?></span></div>
                    <div class="row mt-3"><span class="col-md-5">Price: </span><span
                            class="col-md-7 font-weight-bold h5 text-muted">$<?= $product->price ?></span></div>
                    <div class="row mt-3"><span class="col-md-5">Description: </span><span
                            class="col-md-7"><?= $product->proddesc ?></span></div>
                </div>

                <form class="mt-5" action="/cart" method="post">
                    <input type="hidden" name="product_id" value="<?= $product->id ?>">
                    <input type="hidden" name="action" value="add">
                    <div class="form-group">
                        <input type="number" class="form-control" name="quantity" value="1" min="1"
                            max="<?= $product->quantity ?>" placeholder="Quantity" required>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-secondary" type="submit" value="Add To Cart">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>