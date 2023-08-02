    <!-- Page Banner -->
<div class="page-banner container-fluid no-padding">
    <!-- Container -->
    <div class="container">
        <div class="banner-content">
            <h3>Add Product</h3>
            <p>our vision is to be Earth's most customer centric company</p>
        </div>
        <ol class="breadcrumb">
            <li><a href="index.html" title="Home">Home</a></li>
            <li class="active">Add Product</li>
        </ol>
    </div><!-- Container /- -->
</div><!-- Page Banner /- -->

<div class="container-fluid no-left-padding no-right-padding woocommerce-checkout">
    <!-- Container -->
    <div class="container">
        <div class="col-md-12 col-sm-12 col-xs-12 login-block">
            <div class="login-check">
                <h3>Add Your Product</h3>
                <div class="col-md-7 col-sm-    6 col-xs-6 login-form">
                    <form  action="<?= BASEURL; ?>/DashboardProduct/tambah" method="post" enctype="multipart/form-data">
                        <input class="form-control" placeholder="Product Name *" type="hidden" name="seller_id" value="<?= $_SESSION['id'] ?>" required>
                        <div class="form-group">
                            <input class="form-control" placeholder="Product Name *" type="text" name="product_name" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Description *" type="text" name="description" required>
                        </div>
                        <div class="form-group">
                            <label>Category *</label>
                            <select class="form-control" name="category" required>
                                <?php foreach ($data['categories'] as $category) : ?>
                                    <option value="<?= $category['category_name']; ?>"><?= $category['category_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="price *" type="text" name="price" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Stock *" type="text" name="stock" required>
                        </div>
                        <div class="form-group">
                            <label>Status *</label>
                            <select class="form-control" name="status" required>
                                <option value="Baru">Baru</option>
                                <option value="Bekas">Bekas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="posting date *" type="date" name="posting_date" required>
                        </div>
                        <div class="form-group">
                            <label>Product Image *</label>
                            <input type="file" class="form-control-file" id="images" name="images[]" multiple>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-6 check-details">
                    <div class="Show-Image">
                        <label>Preview Image *</label>
                        <img id="previewImage" src="" alt="Product Preview">
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Container /- -->
</div>