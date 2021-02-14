<main class="min-h-screen">
    <div class="container mt-nav">
        <h1 class="h4 pt-3">Checkout Order</h1>

        <div class="row mt-3">
            <div class="col-md-8">

                <div class="card">
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
            <div class="col-md-4">
                <form action="/checkout" method="post">

                    <h3>Complete Checkout With</h3>

                    <div class="form-group">
                        <input type="hidden" name="amount" value="<?= $order->amount ?>">
                    </div>

                    <div class="form-group">
                        <label for="payment-method">Payment Method</label>
                        <fieldset id="payment-method">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="payment_methods" id="inlineRadio1"
                                    value="paypal">
                                <label class="form-check-label" for="inlineRadio1">Paypal</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="payment_methods" id="inlineRadio2"
                                    value="cc">
                                <label class="form-check-label" for="inlineRadio2">Credit Card</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="payment_methods" id="inlineRadio3"
                                    value="mpesa" disabled>
                                <label class="form-check-label" for="inlineRadio3">M-PESA</label>
                            </div>
                        </fieldset>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary btn-block">Submit</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</main>