<main class="min-h-screen">
    <div class="container mt-nav">
        <h1 class="h4 pt-3">Create Product</h1>
        <form action="/products" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?= @$_SESSION['input']['name'] ?? null ?>"
                    class="form-control <?= @array_key_exists('name', $_SESSION['errors']) ? 'is-invalid' : '' ?>">
                <?php if(@array_key_exists('name', $_SESSION['errors'])) : ?>
                <span class="invalid-feedback">
                    <strong><?= $_SESSION['errors']['name'] ?></strong>
                </span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="form-control <?= @array_key_exists('description', $_SESSION['errors']) ? 'is-invalid' : '' ?>">
                    <?= @$_SESSION['input']['description'] ?? null ?>
                    </textarea>
                <?php if(@array_key_exists('description', $_SESSION['errors'])) : ?>
                <span class="invalid-feedback">
                    <strong><?= $_SESSION['errors']['description'] ?></strong>
                </span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" step="0.01" value="<?= @$_SESSION['input']['price'] ?? null ?>"
                    class="form-control <?= @array_key_exists('price', $_SESSION['errors']) ? 'is-invalid' : '' ?>">
                <?php if(@array_key_exists('price', $_SESSION['errors'])) : ?>
                <span class="invalid-feedback">
                    <strong><?= $_SESSION['errors']['price'] ?></strong>
                </span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" value="<?= @$_SESSION['input']['quantity'] ?? null ?>"
                    class="form-control <?= @array_key_exists('quantity', $_SESSION['errors']) ? 'is-invalid' : '' ?>">
                <?php if(@array_key_exists('quantity', $_SESSION['errors'])) : ?>
                <span class="invalid-feedback">
                    <strong><?= $_SESSION['errors']['quantity'] ?></strong>
                </span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image"
                    class="form-control-file <?= @array_key_exists('image', $_SESSION['errors']) ? 'is-invalid' : '' ?>">
                <?php if(@array_key_exists('image', $_SESSION['errors'])) : ?>
                <span class="invalid-feedback">
                    <strong><?= $_SESSION['errors']['image'] ?></strong>
                </span>
                <?php endif; ?>
            </div>
            <div class="form-group"><button class="btn btn-primary">Submit</button></div>
        </form>
    </div>
</main>