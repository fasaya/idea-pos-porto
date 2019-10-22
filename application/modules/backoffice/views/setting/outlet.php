<section role="main" class="content-body card-margin">
    <header class="page-header">
        <h2>Outlets</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs" style="margin-right:20px">
                <li>
                    <!-- <a href="index.html"> -->
                    <i class="fas fa-home"></i>
                    <!-- </a> -->
                </li>
                <li><span>Setting</span></li>
                <li><span>Outlets</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <header class="card-header">
                    <h2 class="card-title">Outlets</h2>
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
                        </div>

                        <div class="col-sm-12">
                            <a class="modal-with-form btn btn-sm btn-primary" href="#modalAdd"><i class=" fas fa-plus"></i> Create Outlet</a>

                        </div>

                        <div class="col-sm-12" style="margin-top:20px;">
                            <table class="table table-bordered table-striped mb-0" id="datatable-default">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Outlet Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>Province</th>
                                        <th>Status</th>
                                        <th class="text-center"><i class="fas fa-pencil-alt"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($outlet as $u) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no; ?></td>
                                            <td><?= $u->nama ?></td>
                                            <td><?= $u->address ?></td>
                                            <td>0<?= $u->phone ?></td>
                                            <td><?= $this->Outlet->idtokota($u->kota) ?></td>
                                            <td><?= $this->Outlet->idtoprovinsi($u->provinsi) ?></td>
                                            <td><?= ($u->is_active == '1') ? 'Active' : 'Not Active'; ?></td>
                                            <td class="actions-hover actions-fade text-center"><a href="<?= base_url() ?>backoffice/outlets/editoutlets/<?= $u->id_outlet ?>"><i class="fas fa-pencil-alt"></i></a></td>
                                        </tr>
                                        <?php $no++; ?>
                                    <?php endforeach; ?>
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
<div id="modalAdd" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Create New Outlet</h2>
        </header>
        <div class="card-body">
            <form method="post" action="<?= base_url() ?>backoffice/outlets/add">
                <div class="form-group">
                    <label>Outlet Name</label>
                    <input type="text" class="form-control" placeholder="Outlet Name" name='nama_outlet'>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" placeholder="Address" name='address'>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-phone-alt"></i> +62
                            </span>
                        </span>
                        <input type="text" name="phone" class="form-control" placeholder="812....">
                    </div>
                </div>
                <div class="form-group">
                    <label>Province</label>
                    <select name="provinsi" id="provinsi" class="form-control">
                        <option value="">--- SELECT PROVINCE ---</option>
                        <?php foreach ($provinsi as $p) :
                            ?>
                            <option value="<?= $p->id; ?>"><?= $p->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>City / Kabupaten</label>
                    <select name="kota" id="kota" class="form-control">
                        <option value="">SELECT PROVINCE FIRST</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kecamatan</label>
                    <select name="kecamatan" id="kecamatan" class="form-control">
                        <option value="">SELECT CITY/KABUPATEN FIRST</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Postal Code</label>
                    <input type="text" class="form-control" placeholder="Postal Code" name='postal'>
                </div>
        </div>
        <footer class="card-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                    <button type="submit" class="btn btn-primary">Assign</button>
                </div>
            </div>
        </footer>
        </form>
    </section>
</div>


<script>
    $(document).ready(function() {

        $('#provinsi').change(function() {
            var id_provinsi = $('#provinsi').val();
            if (id_provinsi != '') {
                $.ajax({
                    url: "<?= base_url(); ?>backoffice/outlets/fetch_kota",
                    method: "POST",
                    data: {
                        id_provinsi: id_provinsi
                    },
                    success: function(data) {
                        $('#kota').html(data);
                    }
                })
            }
        });

        $('#kota').change(function() {
            var id_kota = $('#kota').val();
            if (id_kota != '') {
                $.ajax({
                    url: "<?= base_url(); ?>backoffice/outlets/fetch_kecamatan",
                    method: "POST",
                    data: {
                        id_kota: id_kota
                    },
                    success: function(data) {
                        $('#kecamatan').html(data);
                    }
                })
            }
        });
    });
</script>