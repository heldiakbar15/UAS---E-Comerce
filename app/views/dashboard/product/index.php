<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
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
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">Daftar Product</h2>
                <a href="<?= BASEURL; ?>/DashboardProduct/create" class="btn btn-primary float-right">Create Data</i></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Product</th>
                      <th>description</th>
                      <th>Catrogry</th>
                      <th>status</th>
                      <th>Image</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach ( $data['product'] as $data ): 
                    ?>
                        <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?= $data['product_name']; ?></td>
                        <td><?= $data['description']; ?></td>
                        <td><?= $data['category']; ?></td>
                        <td><?= $data['status']; ?></td>
                          <?php if (!empty($data['images'])): ?>
                            <td>
                              <div class="image-gallery">
                                <?php foreach ($data['images'] as $image): ?>
                                  <img src="<?= BASEURL; ?>/images/<?= $image; ?>" alt="tubnai Image" style=" max-width:30px;">
                                <?php endforeach; ?>
                              </div>
                            </td>
                          <?php endif; ?>
                        <td>
                        <div class="btn-group">
                            <a href="<?= BASEURL; ?>/DashboardProduct/edit/<?= $data['id']; ?>" class="btn btn-success float-right" ><i class="fa fa-pen"></i></a>
                            <a href="<?= BASEURL; ?>/DashboardProduct/hapus/<?= $data['id']; ?>" class="btn btn-danger float-right" onclick="return confirm('yakin?');"><i class="fa fa-trash"></i></a>
                        </div>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>