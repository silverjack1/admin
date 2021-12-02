<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

<a class="btn btn-primary m-3" href="" data-toggle="modal" data-target="#newRoleModal">Add New Role</a>

<div class="row">
    <div class="col-lg-6">
        <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>'); ?>
        <?= $this->session->flashdata('message'); ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>

                <?php $i = 1;
                foreach ($role as $r) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $r['role']; ?></td>
                        <td>
                            <a class="badge badge-pill badge-warning" href="<?= base_url('admin/roleaccess/') . $r['id']; ?>">access</a>
                            <a class="badge badge-pill badge-success" href="">edit</a>
                            <a class="badge badge-pill badge-danger" href="">delete</a>
                        </td>

                    </tr>
                <?php $i++;
                endforeach; ?>
            </tbody>
        </table>


    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="form-inline" action=" <?= base_url('menu/role'); ?>" method="post"">

                <div class=" form-group mx-sm-3 my-2">

                <input type="text" class="form-control" id="role" name="role" placeholder="Add New Role">
        </div>
        <button type="submit" class="btn btn-primary my-2">Add</button>
        </form>
    </div>
</div>
</div>