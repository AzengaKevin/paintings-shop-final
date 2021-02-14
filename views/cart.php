<main class="min-h-screen">
    <div class="container mt-nav">
        <h1 class="h4 pt-3">Your Cart</h1>

        <form class="mt-3" action="/cart" method="post">
            <input type="hidden" name="action" value="update">

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr class="">
                            <th>Product</th>
                            <th>Action</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="5" class="text-center">You have no products added in your Shopping Cart</td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($products as $key => $product): ?>
                        <tr>
                            <td>
                                <a class="text-decoration-none" href="products/show?id=<?=$product->id?>">
                                    <img src="/uploads/<?= $product->img ?>" class="object-cover rounded-lg" width="96"
                                        height="96" alt="<?= $product->name ?>">
                                    <span><?= $product->name ?></span>
                                </a>
                                <input type="hidden" name="cart[<?= $key ?>][product_id]" value="<?=$product->id?>">
                            </td>

                            <td>
                                <a href="/cart?product_id=<?=$product->id?>&action=remove" class="btn btn-danger">Remove</a>
                            </td>
                            <td class="">&dollar;<?=$product->price?></td>
                            <td class="">
                                <input type="number" class="form-control" name="cart[<?= $key ?>][quantity]"
                                    value="<?=$cartItems[$product->id]?>" min="1" max="<?=$product->quantity?>"
                                    placeholder="Quantity" required>
                            </td>
                            <td class="text-right">
                                &dollar;<?= number_format(floatval($product->price) * intval($cartItems[$product->id]), 2) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>

                    <tfoot>
                        <tr class="h4 text-right">
                            <th colspan="4">Total</th>
                            <th>&dollar;<?= number_format($total, 2) ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-end">
                <button class="btn btn-secondary">Update Cart</button>
                <a href="/order.php" class="btn btn-success mt-3 mt-md-0 ml-0 ml-md-3">Review Cart</a>
            </div>
        </form>

    </div>
</main>