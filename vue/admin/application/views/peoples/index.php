<div class="row">
    <div class="col-md-10">
        <h3>List of Peoples</h3>
   <div class="row">
       <div class="col-md-3">

<form action="http://localhost/ci-app/peoples" method="post">
<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Find keyword..." name="keyword" autocomplete="off" autofocus> 
  <div class="input-group-append">
    <input class="btn btn-outline-secondary" type="submit" name="submit" value="Find">
  </div>
</div>


</form>
       </div>

   </div>
   <h5>Result: <?= $total_rows; ?></h5>
        <table class="table">
    <thead>
    <tr>
    <th>#</th>
    <th>Name</th>
    <th>Email</th>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if( empty($peoples)) : ?>
      <tr><td colspan="4"><div class="alert alert-danger" role="alert">
  This is a danger alert—check it out!
</div></td></tr>
    <?php endif; ?>
        <?php $i=1;
        foreach ($peoples as $people) : ?>
    <tr>
    <th><?= ++$start; ?></th>
    <th><?= $people['name']; ?></th>
    <th><?= $people['email']; ?></th>
    <th><a href="" class="badge badge-warning">Detail</a>
    <a href="" class="badge badge-success">Edit</a>
    <a href="" class="badge badge-danger">Hapus</a>
    </tr>
    <?php endforeach; ?>
    </tbody>



    </table>
    <?= $this->pagination->create_links(); ?>
    
    
    
    
    </div>
</div>