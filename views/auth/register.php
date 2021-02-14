<main class="min-h-screen mt-nav">
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-4">
            <div class="card my-5">
                <div class="card-body">
                    <div class="card-text">
                        <div class="text-center">
                            <h3 class="text-center">Register</h3>
                            <hr>
                            <h4 class="h6">Already Have an Account ? <a href="/login">Login</a></h4>
                        </div>

                        <form action="/register" method="post" novalidate>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input
                                    class="form-control <?= @array_key_exists('name', $_SESSION['errors']) ? 'is-invalid' : '' ?>"
                                    type="text" id="name" name="name" placeholder="Name"
                                    value="<?= @array_key_exists('name', $_SESSION['input']) ? $_SESSION['input']['name'] : '' ?>" />
                                <?php if(@array_key_exists('name', $_SESSION['errors'])) : ?>
                                <span class="invalid-feedback">
                                    <strong>
                                        <?= $_SESSION['errors']['name'] ?>
                                    </strong>
                                </span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input
                                    class="form-control <?= @array_key_exists('username', $_SESSION['errors']) ? 'is-invalid' : '' ?>"
                                    type="text" id="username" name="username" placeholder="Username"
                                    value="<?= @array_key_exists('username', $_SESSION['input']) ? $_SESSION['input']['username'] : '' ?>" />
                                <?php if(@array_key_exists('username', $_SESSION['errors'])) : ?>
                                <span class="invalid-feedback">
                                    <strong>
                                        <?= $_SESSION['errors']['username'] ?>
                                    </strong>
                                </span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                    class="form-control <?= @array_key_exists('email', $_SESSION['errors']) ? 'is-invalid' : '' ?>"
                                    type="email" id="email" name="email" placeholder="Enter Email"
                                    value="<?= @array_key_exists('email', $_SESSION['input']) ? $_SESSION['input']['email'] : '' ?>" />
                                <?php if(@array_key_exists('email', $_SESSION['errors'])) : ?>
                                <span class="invalid-feedback">
                                    <strong>
                                        <?= $_SESSION['errors']['email'] ?>
                                    </strong>
                                </span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input
                                    class="form-control <?= @array_key_exists('password', $_SESSION['errors']) ? 'is-invalid' : '' ?>"
                                    type="password" name="password" id="password" placeholder="Password..." />
                                <?php if(@array_key_exists('password', $_SESSION['errors'])) : ?>
                                <span class="invalid-feedback">
                                    <strong>
                                        <?= $_SESSION['errors']['password'] ?>
                                    </strong>
                                </span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="confirm-password">Password</label>
                                <input class="form-control" type="password" name="confirm_password"
                                    id="confirm-password" placeholder="Confirm Password..." />
                            </div>

                            <div class="form-group">
                                <button class="btn btn-block btn-primary">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>