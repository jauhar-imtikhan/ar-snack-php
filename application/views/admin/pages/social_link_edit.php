<div class="header float-right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="<?= site_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?= site_url('admin/social_link_edit') ?>" aria-current="page">Edit Sosial Media</a></li>

        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div>
            <h4>Edit Sosial Media</h4>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Link</th>
                            <th>Icon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $datas = $this->db->get('tbl_social_link')->result();
                        foreach ($datas as $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data->social_link ?></td>
                                <td><?= $data->social_link_icon ?></td>
                                <td>
                                    <div class="d-flex justify-content-center flex-wrap" style="gap: 9px;">
                                        <button type="button" class="btn btn-warning text-white btn-sm" onclick="editSocialLink(this)" data-id="<?= $data->social_link_id ?>" data-link="<?= $data->social_link ?>" data-icon="<?= $data->social_link_icon ?>"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>