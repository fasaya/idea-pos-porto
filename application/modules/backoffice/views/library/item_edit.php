<section role="main" class="content-body card-margin">
    <header class="page-header">
        <h2>Item</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs" style="margin-right:20px">
                <li>
                    <!-- <a href="index.html"> -->
                    <i class="fas fa-home"></i>
                    <!-- </a> -->
                </li>
                <li><span>Library</span></li>
                <li><span>Edit Item</span></li>
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
                            <h2 class="card-title">Item Variant</h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="pull-right">
                                <a href="#modalAddOptions" class="modal-with-form btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add Variant</a>
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
                            <?= $this->session->flashdata('message_1') ?>
                        </div>

                        <div class="col-sm-12">
                            <table class="table table-bordered table-striped mb-0" id="datatable-default">
                                <thead>
                                    <tr>
                                        <th>Variant Name</th>
                                        <th>Price</th>
                                        <th class="text-center">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($variant as $r) { ?>
                                        <tr>
                                            <td><?= $r->nama ?></td>
                                            <td><?= $this->Helper->setting("CURRENCY") ?> <?= rupiah($r->harga) ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url() ?>backoffice/library/itemDelVar/<?= $r->id_variant ?>"><i class="fas fa-trash-alt text-danger"></i></a>
                                                <a href="#modalPrimary" class="modal-with-move-anim ws-normal" onclick="showDataToModal('<?= $r->id_variant ?>')"> <i class="fas fa-pencil-alt text-primary"></i></a>
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

        <div class="col-lg-12">
            <section class="card">
                <header class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 class="card-title">Assigned Outlet</h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="pull-right">
                                <a href="#modalAssign" class="modal-with-form btn btn-sm btn-primary"><i class="fas fa-plus"></i> Assign</a>
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
                            <?= $this->session->flashdata('message_2') ?>
                        </div>

                        <div class="col-sm-12">
                            <table class="table table-bordered table-striped mb-0" id="datatable-default">
                                <thead>
                                    <tr>
                                        <th>Assigned Outlets</th>
                                        <th class="text-center"><i class="fas fa-minus-circle"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($outlets as $r) { ?>
                                        <tr>
                                            <td><?= $r->nama ?></td>
                                            <td class="text-center"><a href="<?= base_url() ?>backoffice/library/itemUnassign/<?= $r->id_prd_rel_outlet ?>"><i class="fas fa-minus-circle text-danger"></i></a></td>
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
<div id="modalAddOptions" class="modal-block modal-block-primary mfp-hide">
    <form method="post" action="<?= base_url() ?>backoffice/library/itemAddVar/<?= $id_item ?>">
        <section class="card">
            <header class="card-header">
                <h2 class="card-title">Create Variant</h2>
            </header>
            <div class="card-body">
                <div class="form-group">
                    <label>Variant Name</label>
                    <input type="text" class="form-control" placeholder="Variant Name" name='nama'>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <span class="input-group-text">
                                <?= $this->Helper->setting("CURRENCY") ?>
                            </span>
                        </span>
                        <input type="number" name="price" class="form-control" placeholder="20000">
                    </div>
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

<!-- Modal Form -->
<div id="modalAssign" class="modal-block modal-block-primary mfp-hide">
    <form method="post" action="<?= base_url() ?>backoffice/library/itemAssign/<?= $id_item ?>">
        <section class="card">
            <header class="card-header">
                <h2 class="card-title">Assign to Outlet</h2>
            </header>
            <div class="card-body">
                <div class="form-group">
                    <label>Outlet</label>
                    <select name="outlet" class="form-control mb-3">
                        <?php foreach ($outletAssign as $r) { ?>
                            <option value="<?= $r->id_outlet ?>"><?= $r->nama ?></option>
                        <?php } ?>

                    </select>
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
    function showDataToModal(id_variant) {

        if (id_variant != '') {
            $.ajax({
                url: "<?= base_url(); ?>backoffice/library/fetch_dataVariant",
                method: "POST",
                data: {
                    id_variant: id_variant
                },
                success: function(data) {
                    $('#isiCard').html(data);
                }
            });
        }
    }
</script>