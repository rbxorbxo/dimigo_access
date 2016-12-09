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
                <th style="width: 100px;">승인 여부</th>
                <th style="width: 100px;">외출 사유</th>
                <th style="width: 80px;">외출</th>
                <th style="width: 80px;">귀교</th>
                <th>비고</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($data as $req) {
                ?>
                <tr>
                  <td>승인됨</td>
                  <td><?= $req->form ?></td>
                  <td><?= $req->start_time ?></td>
                  <td><?= $req->end_time ?></td>
                  <td class="text-left"><?= $req->comment ?></td>
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
