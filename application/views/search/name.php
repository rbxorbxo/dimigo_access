<div id="main">

  <section class="two">
    <div class="container">

      <header>
        <h2 class="text-left" style="padding-left: 10px; padding-right: 10px;">
          외출 조회
          <small>
            <?php
            $date = new DateTime('now', new DateTimeZone('Asia/Seoul'));
            echo $date->format('Y-m-d');
            ?>
          </small>
        </h2>
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
      <div class="col-lg-12">
        <h3 class="text-center" style="margin: 20px 0">조회할 이름을 입력하세요</h3>
        <form method="post" action="<?=site_url('search/name')?>" style="max-width: 400px;margin: 0 auto" role="form">
          <div class="form-group">
            <input type="text" class="form-control text-center" name="name" value="<?=set_value('name')?>" placeholder="이름을 입력하세요" maxlength="">
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" value="조회하기">
          </div>
        </form>
      </div>
    </div><!-- /.row -->

    <?php
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
                <?php
                if (count($data)) {
                  foreach ($data as $req) {
                    ?>
                    <tr>
                      <td><?= $req->name ?></td>
                      <td><?= $req->status == 2 ? "승인됨" : ($req->status < 0 ? "거부됨" : "대기중") ?></td>
                      <td><?= $req->form ?></td>
                      <td><?= $req->start_time ?></td>
                      <td><?= $req->end_time ?></td>
                      <td class="text-left"><?= $req->comment ?></td>
                      <td><?= $req->serial ?></td>
                    </tr>
                    <?php
                  }
                } else {
                  ?>
                  <tr>
                    <td colspan="7">찾으시는 데이터가 존재하지 않습니다</td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div><!-- /.row -->
      <?php
    }
    ?>
  </div>
</div>
