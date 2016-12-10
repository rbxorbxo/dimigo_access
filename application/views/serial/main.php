<div id="page-wrapper">
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          외출 조회
        </h1>
      </div>
    </div>
    <!-- /.row -->

    <!-- If form_valdation error exists, display it here -->
    <div class="row">
      <div class="col-lg-12">
        <?php
        $err = explode("\n", preg_replace("/<\/*p>/", "", validation_errors()));
        for ($i = 0; $i < count($err); $i++) {
          if ($err[$i]) {
            ?>
            <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="fa fa-info-circle"></i>
              <?=$err[$i]?>
            </div>
            <?php
          }
        }
        ?>
      </div>
    </div><!-- /.row -->

    <div class="row" style="margin-top: 50px;">
      <div class="col-lg-12">
        <h2 class="text-center" style="margin: 20px 0">조회할 번호를 입력하세요</h2>
        <form method="post" action="<?=site_url('serial/search')?>" style="max-width: 400px;margin: 0 auto" role="form">
          <div class="form-group">
            <input type="text" class="form-control text-center" name="serialNo" value="<?=set_value('serialNo')?>" placeholder="일련번호를 입력하세요" maxlength="">
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" value="조회하기">
          </div>
        </form>
      </div>
    </div><!-- /.row -->
    <?php
    if ($data != "") {
      ?>
      <div class="row" style="margin-top: 50px;">
        <div class="col-lg-12">
          <?php
          if ($data) {
            echo $data;
          } else {
            ?>
            <h3 class="text-center">찾으시는 데이터가 존재하지 않습니다</h3>
            <?php
          }
          ?>
        </div>
      </div><!-- /.row -->
      <?php
    }
    ?>
  </div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
