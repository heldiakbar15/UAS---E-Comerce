    <!-- Page Banner -->
    <div class="page-banner container-fluid no-padding">
        <!-- Container -->
        <div class="container">
            <div class="banner-content">
                <h3>Shop</h3>
                <p>our vision is to be Earth's most customer centric company</p>
            </div>
            <ol class="breadcrumb">
                <li><a href="index.html" title="Home">Home</a></li>							
                <li class="active">Shop</li>
            </ol>
        </div><!-- Container /- -->
    </div><!-- Page Banner /- -->
    
    <!-- Product Section2 -->
    <div class="product-section product-section1 product-section2 container-fluid no-padding">
        <!-- Container -->
        <div class="container">
            <div class="row">
               <!-- Content Area -->
                <div class="col-md-12 col-sm-12 col-xs-12 content-area product-section2">
                    <!-- Products -->
                    <ul class="products">
                        <?php foreach ($data['products'] as $product) : ?>
                            <!-- Product -->
                            <li class="product">
                                <a href="#">
                                    <img src="<?= BASEURL; ?>/images/<?= $product['images'][0]; ?>" alt="Product" />
                                    <h5><?= $product['product_name']; ?></h5>
                                    <span class="price">$ <?= number_format($product['price'], 0); ?></span>
                                </a>
                                <a href="<?= BASEURL; ?>/Product/Detail/<?= $product['id']; ?>" class="add-to-cart1" title="Add To Cart">View Detail</a>
                            </li><!-- Product /- -->
                        <?php endforeach; ?>
                    </ul><!-- Products /- -->
                </div><!-- Content Area /- -->

            </div><!-- Row /- -->
            <nav class="ow-pagination">
                <ul class="pager">
                    <?php if ($data['currentPage'] > 1) : ?>
                        <li class="previous"><a href="<?= BASEURL; ?>/Product/index?page=<?= $data['currentPage'] - 1; ?>"><i class="fa fa-angle-left"></i></a></li>
                    <?php endif; ?>

                    <?php for ($page = 1; $page <= $data['totalPages']; $page++) : ?>
                        <li class="number <?= ($page == $data['currentPage']) ? 'active' : ''; ?>"><a href="<?= BASEURL; ?>/Product/index?page=<?= $page; ?>"><?= $page; ?></a></li>
                    <?php endfor; ?>

                    <?php if ($data['currentPage'] < $data['totalPages']) : ?>
                        <li class="next"><a href="<?= BASEURL; ?>/Product/index?page=<?= $data['currentPage'] + 1; ?>"><i class="fa fa-angle-right"></i></a></li>
                    <?php endif; ?>
                </ul>
            </nav>

        </div><!-- Container /- -->
    </div><!-- Product Section2 /- -->