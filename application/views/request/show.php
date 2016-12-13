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
                <th style="width: 80px;">승인 여부</th>
                <th style="width: 80px;">외출 사유</th>
                <th style="width: 55px;">외출</th>
                <th style="width: 55px;">귀교</th>
                <th>비고</th>
                <th style="width: 120px;">일련번호</th>
                <th style="width: 130px;">수정/삭제</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (count($requests)) {
                foreach ($requests as $req) {
                  ?>
                  <tr>
                    <td><?= $req->status == 2 ? "승인됨" : ($req->status < 0 ? "거부됨" : "대기중") ?></td>
                    <td><?= $req->form ?></td>
                    <td><?= $req->start_time ?></td>
                    <td><?= $req->end_time ?></td>
                    <td class="text-left"><?= $req->comment ?></td>
                    <td><?= $req->serial ?></td>
                    <td>
                      <a href="<?= $req->status == 0 ? site_url('request/edit/'.$req->idx) : '#' ?>"
                        class="btn btn-warning"
                        <?= $req->status > 0 ? "disabled" : "" ?>
                        <?= $req->status < 0 ? "onclick='alert(\"$req->reject_comment\")'" : "" ?>>
                        <?= $req->status < 0 ? "사유" : "수정" ?>
                      </a>
                      <a href="#" onclick="deleteRequest(<?=$req->idx?>)" class="btn btn-danger"
                        <?= $req->status > 0 ? "disabled" : "" ?>>
                        삭제
                      </a>
                    </td>
                  </tr>
                  <?php
                }
              } else {
                ?>
                <tr>
                  <td colspan="7" class="text-center">찾으시는 데이터가 존재하지 않습니다.</td>
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
function deleteRequest(idx) {
  if (confirm("정말 삭제하시겠습니까?\n삭제한 이후에는 복구가 불가능합니다."))
  location.href = "<?=site_url('request/delete')?>/" + idx;
}
</script>
