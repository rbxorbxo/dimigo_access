<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          외출 신청 현황
        </h1>
        <ol class="breadcrumb">
          <li class="active">
            <i class="fa fa-dashboard"></i> Dashboard
          </li>
        </ol>
      </div>
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped">
            <thead>
              <tr>
                <th style="width: 90px;">승인 여부</th>
                <th style="width: 80px;">외출 사유</th>
                <th style="width: 70px;">외출</th>
                <th style="width: 70px;">귀교</th>
                <th>비고</th>
                <th style="width:150px;"></th>
              </tr>
            </thead>
            <form name="manage" method="post" action="">
              <tbody>
                <?php
                foreach ($data as $req) {
                  ?>
                  <tr>
                    <td><?= $req->status == 1 ? "승인됨" : ($req->status == -1 ? "거절됨" : "대기중") ?></td>
                    <td><?= $req->form ?></td>
                    <td><?= $req->start_time ?></td>
                    <td><?= $req->end_time ?></td>
                    <td class="text-left"><?= $req->comment ?></td>

                    <?php
                    if ($req->status == 0) {
                      ?>
                      <td>
                        <a class="btn btn-primary" href="<?=site_url('/manage/Insert_admit/'.$req->idx);?>">수락</a>
                        <a type="button" class="btn btn-danger" href="<?=site_url('/manage/Insert_reject/'.$req->idx);?>">거절</a>
                      </td>
                      <?php
                    } else if ($req->status == -1) {
                      ?>
                      <td><button type="button" class="btn btn-danger">거절</button></td>
                      <?php
                    } else {
                      ?>
                      <td><button type="button" class="btn btn-success">승인</button></td>
                      <?php
                    }
                    ?>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </form>
          </table>
        </div>
      </div>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
