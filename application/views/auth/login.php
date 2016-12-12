<div id="main">

  <section class="two">
    <div class="container">

      <header>
        <h2 class="text-left" style="padding-left: 10px; padding-right: 10px;">Login <small>via Dimigoin Account</small></h2>
      </header>

    </div>
  </section>

  <div class="container">

    <!-- If form_valdation error exists, display it here -->
    <div class="row">
      <div style="display: block; padding: 0;float:none; clear: both;">
        <?php
        $err = explode("\n", preg_replace("/<\/*p>/", "", validation_errors()));
        for ($i = 0; $i < count($err); $i++) {
          if ($err[$i]) {
            ?>
            <div class="alert alert-info">
              <i class="fa fa-info-circle"></i>
              <?=$err[$i]?>
            </div>
            <?php
          }
        }
        ?>
      </div>
    </div><!-- /.row -->

    <div class="row">
      <form method="post" action="<?=site_url('auth/login')?>" role="form" style="max-width: 500px; margin-left: auto; margin-right: auto">
        <div class="form-group">
          <h3 class="text-left">ID</h3>
          <input type="text" class="form-control" name="USER_ID" value="<?=set_value('USER_ID')?>">
        </div>
        <div class="form-group">
          <h3 class="text-left">Password</h3>
          <input type="password" class="form-control" name="USER_PW" value="<?=set_value('USER_PW')?>">
        </div>
        <div class="form-group text-right">
          <input type="submit" class="btn btn-primary" value="Login">
        </div>
      </form>
    </div>
  </div>
</div>
