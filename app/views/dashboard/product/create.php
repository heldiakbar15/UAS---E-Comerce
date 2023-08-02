  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Create Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create Product</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
            <h3 class="card-title">Create Product</h3>
            </div>
            <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="<?= BASEURL; ?>/DashboardProduct/tambah" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Product name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="product_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="price" name="price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="stock" name="stock">
                            </div>
                        </div>
                        <!-- Bagian Category -->
                        <div class="form-group row">
                            <label for="category" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" style="width: 100%;" name="category">
                                    <?php foreach ($data['category'] as $category): ?>
                                        <option value="<?= $category['category_name']; ?>"><?= $category['category_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" style="width: 100%;" name="status">
                                        <option value="Baru">Baru</option>
                                        <option value="Bekas">Bekas</option>
                                </select>
                            </div>
                        </div>
                        <!-- Input hidden for Category -->
                        <input type="hidden" name="category_id" value="<?= $data['category'][0]['category_name']; ?>">

                        <input type="hidden" class="form-control" id="author" name="seller_id" value="<?= $_SESSION['id']; ?>" readonly>
                        <!-- Input hidden for Author -->
                        <input type="hidden" name="seller_id" value="<?= $_SESSION['id']; ?>">

                        <div class="form-group row">
                            <label for="deskripsi" class="col-sm-2 col-form-label">Posting Date</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="deskripsi" name="posting_date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deskripsi" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="deskripsi" name="description">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                          <label for="images" class="col-sm-2 col-form-label">tumbnail</label>
                          <div class="col-sm-10">
                              <input type="file" class="form-control-file" id="images" name="images[]" multiple>
                              <small class="form-text text-muted">Select multiple images for the event (Hold Ctrl/Cmd to select multiple images)</small>
                          </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Save</button>
                        <a href="<?= BASEURL; ?>/DashboardProduct" class="btn btn-default float-right">Cancel</a>
                    </div>
                <!-- /.card-footer -->
                </form>
            </div>
          </div>
        </div>
      </div>
    </section>