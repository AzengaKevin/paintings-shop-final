<main class="min-h-screen">
    <div class="container mt-nav">
        <h1 class="h4 pt-3">All Orders</h1>

        <div class="table-responsive mt-3">
            <table class="table table-striped">
                <thead>
                    <tr class="">
                        <th>#</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Items</th>
                        <th>Paypal Order ID</th>
                        <th>Paid</td>
                        <th>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                    <tr>
                        <td colspan="7" class="text-center">No orders Made Yet, Patience!!</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($orders as $key => $order): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $order->user ?></td>
                        <td><?= $order->amount ?></td>
                        <td><?= $order->items ?></td>
                        <td><?= $order->paypal_order_id ?></td>
                        <td><?= boolval($order->paid) ? 'Paid' : 'Not Paid' ?></td>
                        <td>
                            <div class="d-flex">
                                <form class="ml-2" action="/admin/orders/delete" method="POST">
                                    <input type="hidden" name="order_id" value="<?= $order->id ?>">
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</main>