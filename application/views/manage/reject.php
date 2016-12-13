<div id="main">

  <section class="two">
    <div class="container">

      <header>
        <h2 class="text-left" style="padding-left: 10px; padding-right: 10px;">
          외출 신청 현황
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

    <div class="row">
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
                <th style="width:80px;">승인/거부</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (count($data)) {
                foreach ($data as $req) {
                  ?>
                  <tr>
                    <td><?= $req->name ?></td>
                    <td>거부됨</td>
                    <td><?= $req->form ?></td>
                    <td><?= $req->start_time ?></td>
                    <td><?= $req->end_time ?></td>
                    <td class="text-left"><?= $req->comment ?></td>
                    <td><?= $req->serial ?></td>
                    <td><button class="btn btn-danger" onclick="changeAdmit(<?=$req->idx?>)">거부됨</button></td>
                    <?php
                  }
                  ?>
                </tr>
                <?php
              } else {
                ?>
                <tr>
                  <td colspan="8" class="text-center">찾으시는 데이터가 존재하지 않습니다.</td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
function changeAdmit(idx) {
  if (confirm("확인을 누르시면 취소됩니다.\n취소하시겠습니까?"))
  location.href = "<?=site_url('manage/reset')?>/" + idx + "?prev=<?=current_url()?>";
}
</script>
