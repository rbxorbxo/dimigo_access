<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          외출 신청 현황
          <small>
            <?php
            $date = new DateTime('now', new DateTimeZone('Asia/Seoul'));
            echo $date->format('Y-m-d');
            ?>
          </small>
        </h1>
      </div>
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped">
            <thead>
              <tr>
                <th style="width: 70px;">승인 여부</th>
                <th style="width: 70px;">외출 사유</th>
                <th style="width: 55px;">외출</th>
                <th style="width: 55px;">귀교</th>
                <th>비고</th>
                <th style="width: 130px;">수정/삭제</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($requests as $req) {
                ?>
                <tr>
                  <td><?= $req->status == 1 ? "승인됨" : ($req->status == -1 ? "거절됨" : "대기중") ?></td>
                  <td><?= $req->form ?></td>
                  <td><?= $req->start_time ?></td>
                  <td><?= $req->end_time ?></td>
                  <td class="text-left"><?= $req->comment ?></td>
                  <td>
                    <a href="<?= $req->status == 0 ? site_url('request/edit/'.$req->idx) : '#" onclick="return false' ?>"
                      class="btn btn-warning"
                      <?= $req->status == 0 ? "" : "disabled" ?>>
                      수정
                    </a>
                    <a href="#" onclick="deleteRequest(<?=$req->idx?>)" class="btn btn-danger" <?= $req->status != 1 ? "" : "disabled" ?>>
                      삭제
                    </a>
                  </td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
<script>
function deleteRequest(idx) {
  if (confirm("정말 삭제하시겠습니까?\n삭제한 이후에는 복구가 불가능합니다."))
  location.href = "<?=site_url('request/delete')?>/" + idx;
}
</script>
