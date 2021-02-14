<main class="min-h-screen mt-nav">
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-4">
            <div class="card my-5">
                <div class="card-body">
                    <div class="card-text">
                        <div class="text-center">
                            <h3 class="text-center">Login</h3>
                            <hr>
                            <h4 class="h6">Not a member yet ? <a href="/register">Register</a></h4>
                        </div>

                        <form class="needs-validation" action="/login"
                            method="post">
                            <div class="form-group">
                                <label class="font-weight-bold" for="login">Login</label>
                                <input
                                    class="form-control <?= @array_key_exists('login', $_SESSION['errors']) ? 'is-invalid' : '' ?>"
                                    type="text" name="login" id="login" placeholder="Username / Email Address"
                                    value="<?= @array_key_exists('login', $_SESSION['input']) ? $_SESSION['input']['login'] : '' ?>" />
                                <?php if(@array_key_exists('login', $_SESSION['errors'])) : ?>
                                <span class="invalid-feedback">
                                    <?= $_SESSION['errors']['login'] ?>
                                    <?php unset($_SESSION['errors']['login']); ?>
                                </span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold" for="password">Password</label>
                                <input
                                    class="form-control <?= @array_key_exists('password', $_SESSION['errors']) ? 'is-invalid' : '' ?>"
                                    type="password" name="password" placeholder="Password" />
                                <?php if(@array_key_exists('password', $_SESSION['errors'])) : ?>
                                <span class="invalid-feedback">
                                    <?= $_SESSION['errors']['password'] ?>
                                    <?php unset($_SESSION['errors']['password']); ?>
                                </span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-block btn-primary">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>