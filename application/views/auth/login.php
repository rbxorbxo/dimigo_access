<div id="page-wrapper">
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          Login <small>via Dimigoin Account</small>
        </h1>
      </div>
    </div>
    <!-- /.row -->

    <!-- If form_valdation error exists, display it here -->
    <!--div class="row">
      <div class="col-lg-12">
        <div class="alert alert-info alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="fa fa-info-circle"></i>  <strong>Like SB Admin?</strong> Try out <a href="http://startbootstrap.com/template-overviews/sb-admin-2" class="alert-link">SB Admin 2</a> for additional features!
        </div>
      </div>
    </div-->
    <!-- /.row -->

    <div class="row">
      <div class="col-lg-12">
        <form method="post" action="<?=site_url('Auth/login')?>" role="form">
          <div class="form-group">
            <h3 class="text-left">ID</h3>
            <input type="text" class="form-control" name="USER_ID" required>
          </div>
          <div class="form-group">
            <h3 class="text-left">Password</h3>
            <input type="password" class="form-control" name="USER_PW" required>
          </div>
          <div class="form-group text-right">
            <button class="btn btn-default" onclick="history.go(-1)">Cancel</button>
            <input type="submit" class="btn btn-primary" value="Login">
          </div>
        </form>
      </div>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
