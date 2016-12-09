<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          외출 정보 수정
        </h1>
        <ol class="breadcrumb">
          <li class="active">
            <i class="fa fa-dashboard"></i> Dashboard
          </li>
        </ol>
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

    <div class="row">
      <div class="col-lg-12">
        <form method="post" action="<?=site_url('request/edit/'.$original->idx)?>" role="form">
          <div class="form-group">
            <h3 class="text-left">외출 사유</h3>
            <?php
            print_r($original);
            foreach ($reasons as $reason) {
              if ($reason->id != 0) {
                ?>
                <label class="form-group form-control">
                  <input type="radio" name="reason" value="<?=$reason->id?>" <?= $reason->form == $original->form ? "checked" : "" ?>> <?=$reason->form?>
                </label>
                <?php
              }
            }
            ?>
            <label class="form-group form-control">
              <input type="radio" name="reason" value="0" <?= $original->form == "기타" ? "checked" : "" ?>> 기타
            </label>
          </div>
          <div class="form-group">
            <h3 class="text-left">외출 시간</h3>
            <div class="col-sm-5" style="padding-left: 0">
              <input type="time" class="form-control" name="start" value="<?=empty(set_value('start')) ? $original->start_time : set_value('start')?>">
            </div>
            <div class="col-sm-2 text-center">
              ~
            </div>
            <div class="col-sm-5" style="padding-right: 0">
              <input type="time" class="form-control" name="end" value="<?=empty(set_value('end')) ? $original->end_time : set_value('end')?>">
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="form-group">
            <h3 class="text-left">코멘트</h3>
            <textarea class="form-control" name="comment" placeholder="자유롭게 작성해 주세요"><?=empty(set_value('comment')) ? $original->comment : set_value('comment')?></textarea>
          </div>
          <div class="form-group text-right">
            <input type="submit" class="btn btn-primary" value="수정하기">
          </div>
        </form>
      </div>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->