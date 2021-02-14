<main class="min-h-screen">
    <div class="container mt-nav">
        <h1 class="h4 pt-3">Checkout Order</h1>

        <div class="card mt-3">
            <div class="card-header">Order Details</div>
            <div class="card-body">
                <div class="row py-3 bg-white">
                    <div class="col-md-4">Order ID:</div>
                    <div class="col-md-8 font-weight-bold"><?= $order->id ?></div>
                </div>
                <div class="row py-3 bg-light">
                    <div class="col-md-4">Created At:</div>
                    <div class="col-md-8 font-weight-bold"><?= $order->created_at ?></div>
                </div>
                <div class="row py-3 bg-white">
                    <div class="col-md-4">Amount:</div>
                    <div class="col-md-8 font-weight-bold">&dollar; <?= number_format($order->amount, 2) ?>
                    </div>
                </div>
                <div class="row py-3 bg-light">
                    <div class="col-md-4">Paid:</div>
                    <div class="col-md-8 font-weight-bold"><?= boolval($order->paid) ? 'Paid' : 'Not Paid' ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>