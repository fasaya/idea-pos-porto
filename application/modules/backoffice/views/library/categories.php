<section role="main" class="content-body card-margin">
    <header class="page-header">
        <h2>Categories</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs" style="margin-right:20px">
                <li>
                    <!-- <a href="index.html"> -->
                    <i class="fas fa-home"></i>
                    <!-- </a> -->
                </li>
                <li><span>Library</span></li>
                <li><span>Categories</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <header class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 class="card-title">Categories</h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="pull-right">
                                <a href="#modalForm" class="modal-with-form btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add Category</a>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="card-body">
                    <div class="row">
                        <?php if (validation_errors()) : ?>
                            <div class="col-sm-12">
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?= validation_errors(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="col-sm-12">
                            <?= $this->session->flashdata('message') ?>
                            <table class="table table-bordered table-striped mb-0" id="datatable-default">
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Item Stocks</th>
                                        <th class="text-center">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($category as $r) { ?>
                                        <tr>
                                            <td><?= $r->nama ?></td>
                                            <td><?= $this->Library->category_item_stocks($r->id_kategori); ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url() ?>backoffice/library/editcategory/<?= $r->id_kategori ?>"><i class="fas fa-pencil-alt text-primary"></i></a>

                                                <a href="#modalDanger" class="modal-with-move-anim" onclick="showDelCtgry('<?= $r->id_kategori; ?>')"><i class="fas fa-trash-alt text-danger"></i> </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>

<!-- Modal Form -->
<div id="modalForm" class="modal-block modal-block-primary mfp-hide">
    <form method="post" action="<?= base_url() ?>backoffice/library/addcategory">
        <section class="card">
            <header class="card-header">
                <h2 class="card-title">Create Category</h2>
            </header>
            <div class="card-body">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" class="form-control" placeholder="Category Name" name='nama'>
                </div>
            </div>
            <footer class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" name="save" class="btn btn-primary">Add</button>
                        <button class="btn btn-default modal-dismiss">Cancel</button>
                    </div>
                </div>
            </footer>
        </section>
    </form>
</div>

<script>
    function showDelCtgry(id_kategori) {

        if (id_kategori != '') {
            $.ajax({
                url: "<?= base_url(); ?>backoffice/library/fetch_delCategory",
                method: "POST",
                data: {
                    id_kategori: id_kategori
                },
                success: function(data) {
                    $('#isiCard').html(data);
                }
            });
        }
    }
</script>