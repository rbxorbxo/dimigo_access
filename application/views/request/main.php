<div id="main">

  <section class="two">
    <div class="container">

      <header>
        <h2 class="text-left" style="padding-left: 10px; padding-right: 10px;">외출 신청</h2>
      </header>

    </div>
  </section>

  <div class="container">

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-comments fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge"><?=$num?></div>
                <div>My requests!</div>
              </div>
            </div>
          </div>
          <a href="<?=site_url('request/show')?>">
            <div class="panel-footer">
              <span class="pull-left">View Details</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
    </div><!-- /.row -->
  </div>

  <section class="two">
    <div class="container">

      <header>
        <h2 class="text-left" style="padding-left: 10px; padding-right: 10px;">신청하기</h2>
      </header>

    </div>
  </section>

  <div class="container">

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
        <form method="post" action="<?=site_url('request/add')?>" role="form">
          <div class="form-group">
            <h3 class="text-left">외출 사유</h3>
            <?php
            foreach ($reasons as $reason) {
              if ($reason->form_idx != 1) {
                ?>
                <label class="form-group form-control">
                  <input type="radio" name="reason" value="<?=$reason->form_idx?>"> <?=$reason->form?>
                </label>
                <?php
              }
            }
            ?>
            <label class="form-group form-control">
              <input type="radio" name="reason" value="1"> 기타
            </label>
          </div>
          <div class="form-group">
            <h3 class="text-left">외출 시간</h3>
            <div class="col-sm-5" style="padding: 0">
              <input type="time" class="form-control" name="start" value="<?=empty(set_value('start')) ? "18:30" : set_value('start')?>">
            </div>
            <div class="col-sm-2 text-center">
              ~
            </div>
            <div class="col-sm-5" style="padding: 0">
              <input type="time" class="form-control" name="end" value="<?=empty(set_value('end')) ? "19:40" : set_value('end')?>">
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="form-group">
            <h3 class="text-left">코멘트</h3>
            <textarea class="form-control" name="comment" placeholder="자유롭게 작성해 주세요" value="<?=set_value('comment')?>"></textarea>
          </div>
          <div class="form-group text-right">
            <input type="submit" class="btn btn-primary" value="신청하기">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
