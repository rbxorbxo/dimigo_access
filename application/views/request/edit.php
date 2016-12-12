<div id="main">

  <section class="two">
    <div class="container">

      <header>
        <h2 class="text-left" style="padding-left: 10px; padding-right: 10px;">
          외출 정보 수정
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
        <form method="post" action="<?=site_url('request/edit/'.$original->idx)?>" role="form">
          <div class="form-group">
            <h3 class="text-left">외출 사유</h3>
            <?php
            foreach ($reasons as $reason) {
              if ($reason->form_idx != 1) {
                ?>
                <label class="form-group form-control">
                  <input type="radio" name="reason" value="<?=$reason->form_idx?>" <?= $reason->form == $original->form ? "checked" : "" ?>> <?=$reason->form?>
                </label>
                <?php
              }
            }
            ?>
            <label class="form-group form-control">
              <input type="radio" name="reason" value="1" <?= $original->form == "기타" ? "checked" : "" ?>> 기타
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
            <textarea class="form-control" name="comment" placeholder="자유롭게 작성해 주세요"><?=str_ireplace('<br>', '', empty(set_value('comment')) ? $original->comment : set_value('comment'))?></textarea>
          </div>
          <div class="form-group text-right">
            <input type="submit" class="btn btn-primary" value="수정하기">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
