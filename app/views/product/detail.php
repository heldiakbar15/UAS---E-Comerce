    <!-- Page Banner -->
    <div class="page-banner container-fluid no-padding">
        <!-- Container -->
        <div class="container">
            <div class="banner-content">
                <h3><?= $data['product']['product_name']; ?></h3>
                <p>our vision is to be Earth's most customer centric company</p>
            </div>
            <ol class="breadcrumb">
                <li><a href="index.html" title="Home">Home</a></li>							
                <li class="active">Shop</li>
            </ol>
        </div>
    </div>
    
    <!-- Shop Single -->
    <div class="shop-single container-fluid no-padding">
        <!-- Container -->
        <div class="container">
            <div class="product-views">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="item">
                    <img src="<?= BASEURL; ?>/images/<?= $data['product']['images'][0] ?>" alt="product" />
                    </div>
                </div>
                <!-- Entry Summary -->
                <div class="col-md-6 col-sm-6 col-xs-12 entry-summary">
                    <h3 class="product_title"><?= $data['product']['product_name']; ?></h3>
                    <p class="stock in-stock"><span>Availability:</span> <?= $data['product']['stock']; ?> stock</p>
                    <div>
                        <p><?= $data['product']['description']; ?></p>
                    </div>
                    <span class="price">$<?= number_format($data['product']['price'], 0); ?></span>
                    <form action="<?= BASEURL; ?>/Product/addToCart" method="post">
                        <input type="hidden" name="product_id" value="<?= $data['product']['id']; ?>">
                        <div class="product-quantity" data-title="Quantity">
                            <input type="button" value="-" class="qtyminus btn" data-field="quantity">
                            <input type="text" name="quantity" value="1" min="1" class="qty btn" id="quantity">
                            <input type="button" value="+" class="qtyplus btn" data-field="quantity">
                        </div>
                        <button type="submit" title="Add To Cart" class="add_to_cart">Add To Cart</button>
                    </form>
                </div><!-- Entry Summary /- -->
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 description">
                <h5>Description about this product</h5>
                <p><?= $data['product']['description']; ?></p>
            </div>

            <?php if (!empty($data['relatedProducts'])) : ?>
                <div class="product-section container-fluid no-padding">
                    <div class="section-header">
                        <h3>Related Products</h3>
                        <p>our vision is to be Earth's most customer-centric company</p>
                    </div>
                    <ul class="products">
                        <?php foreach ($data['relatedProducts'] as $relatedProduct) : ?>
                            <li class="product">
                                <a href="<?= BASEURL; ?>/product/detail/<?= $relatedProduct['id']; ?>">
                                    <img src="<?= BASEURL; ?>/images/<?= $relatedProduct['images'][0] ?>" alt="Product" style="padding: 20px;"/>
                                    <h5><?= $relatedProduct['product_name']; ?></h5>
                                    <span class="price">$<?= $relatedProduct['price']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>