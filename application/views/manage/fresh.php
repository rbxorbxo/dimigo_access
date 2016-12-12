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
                <th style="width: 120px;">일련번호</th>
                <th style="width:150px;">승인/거부</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($data as $req) {
                ?>
                <tr>
                  <td><?= $req->status == 2 ? "승인됨" : ($req->status < 0 ? "거부됨" : "대기중") ?></td>
                  <td><?= $req->form ?></td>
                  <td><?= $req->start_time ?></td>
                  <td><?= $req->end_time ?></td>
                  <td class="text-left"><?= $req->comment ?></td>
                  <td><?= $req->serial ?></td>

                  <td>
                    <a class="btn btn-primary" href="<?=site_url('/manage/Insert_admit/'.$req->idx);?>">승인</a>
                    <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#reject<?=$req->idx?>">거부</a>
                  </td>
                </tr>

                <div class="modal fade" id="reject<?=$req->idx?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">거부</h4>
                      </div>
                      <form method="post" action="<?=site_url('manage/Insert_reject').'/'.$req->idx?>">
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="message-text" class="control-label">거부 이유:</label>
                            <input type="text" class="form-control" name="comment" id="comment">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <input type="submit" class="btn btn-danger" value="거부">
                          <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
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
