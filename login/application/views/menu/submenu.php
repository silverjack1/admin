<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

<a class="btn btn-primary m-3" href="" data-toggle="modal" data-target="#newSubMenuModal">Add New Menu</a>

<div class="row">

    <div class="col-lg">
        <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert"><?= validation_errors(); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?= $this->session->flashdata('message'); ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Url</th>
                    <th scope="col">Icon</th>
                    <th scope="col">Active</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($subMenu as $sm) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $sm['title']; ?></td>
                        <td><?= $sm['menu']; ?></td>
                        <td><?= $sm['url']; ?></td>
                        <td><?= $sm['icon']; ?></td>
                        <td><?= $sm['is_active']; ?></td>
                        <td>
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
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New Submenu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="form" action=" <?= base_url('menu/submenu'); ?>" method="post"">

                <div class=" form-group mx-sm-3 my-2">
                <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title">
        </div>
        <div class=" form-group mx-sm-3 my-2">
            <select class="form-control" id="menu_id" name="menu_id">
                <option value="">Select Menu</option>
                <?php foreach ($menu as $m) : ?>
                    <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class=" form-group mx-sm-3 my-2">
            <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
        </div>
        <div class=" form-group mx-sm-3 my-2">
            <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
        </div>
        <div class=" form-group mx-sm-3 my-2">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" value="1" id="is_active" name="is_active" checked>
                <label class="custom-control-label" for="is_active">Active?</label>
            </div>
        </div>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary my-2">Add</button>
        </form>
    </div>
</div>
</div>