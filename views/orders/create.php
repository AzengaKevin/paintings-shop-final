<main class="min-h-screen">
    <div class="container mt-nav">
        <div class="py-3">
            <h1 class="h4">Review Your Order</h1>
        </div>

        <form class="mt-3" action="/orders" method="post">
            <input type="hidden" name="action" value="update">

            <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead>
                        <tr class="">
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="4" class="text-center">You have no products added in your Shopping Cart</td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($products as $key => $product): ?>
                        <tr>
                            <td><span><?= $product->name ?></span></td>
                            <td class="">&dollar;<?=$product->price?></td>
                            <td><span><?=$cartItems[$product->id]?></span></td>
                            <td class="text-right">
                                &dollar;<?= number_format(floatval($product->price) * intval($cartItems[$product->id]), 2) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>

                    <tfoot>
                        <tr class="h4 text-right">
                            <th colspan="3">Total</th>
                            <th>&dollar;<?= number_format($total, 2) ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-end">
                <button class="btn btn-secondary">Proceed To Checkout</button>
            </div>
        </form>
    </div>
</main>