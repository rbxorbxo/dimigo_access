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
        <form method="post" action="<?=site_url('search/serial')?>" style="max-width: 400px;margin: 0 auto" role="form">
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
    print_r($data);
    if ($data !== FALSE) {
      ?>
      <div class="row" style="margin-top: 50px;">
        <div class="col-lg-12">
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th style="width: 70px;">이름</th>
                  <th style="width: 90px;">승인 여부</th>
                  <th style="width: 80px;">외출 사유</th>
                  <th style="width: 70px;">외출</th>
                  <th style="width: 70px;">귀교</th>
                  <th>비고</th>
                  <th style="width: 120px;">일련번호</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php
                  if (count($data)) {
                    ?>
                  <td><?= $data->name ?></td>
                  <td><?= $data->status == 1 ? "승인됨" : ($data->status == -1 ? "거부됨" : "대기중") ?></td>
                  <td><?= $data->form ?></td>
                  <td><?= $data->start_time ?></td>
                  <td><?= $data->end_time ?></td>
                  <td class="text-left"><?= $data->comment ?></td>
                  <td><?= $data->serial ?></td>
                  <?php
                } else {
                  ?>
                  <td colspan="7" class="text-center">찾으시는 데이터가 존재하지 않습니다.</td>
                  <?php
                }
                ?>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div><!-- /.row -->
      <?php
    }
    ?>
  </div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
