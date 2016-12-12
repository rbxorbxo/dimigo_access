<div id="main">

  <!-- Intro -->
  <section id="top" class="one dark cover">
    <div class="container">

      <?php
      if ($this->session->userdata('usertype') != "T") {
        ?>
        <header>
          <h2 class="alt">디미고 <strong>외출 관리</strong> 시스템</h2>
          <p>
            나가고는 싶은데 외출 신청은 번거롭고,<br>
            신청하러 갔는데 선생님이 안 계시고...
          </p>
          <p>
            이젠 온라인으로 신청하세요!
          </p>
        </header>

        <footer>
          <a href="<?=site_url('request')?>" class="button scrolly">외출 신청하기</a>
        </footer>
        <?php
      } else {
        ?>
        <header>
          <h2 class="alt">디미고 <strong>외출 관리</strong> 시스템</h2>
          <p>
            외출증 하나하나 쓰기도 귀찮고,<br>
            감독하다 보면 누가 외출인지도 모르겠고...
          </p>
          <p>
            이젠 온라인으로 관리하세요!
          </p>
        </header>

        <footer>
          <a href="<?=site_url('manage')?>" class="button scrolly">외출 관리하기</a>
        </footer>
        <?php
      }
      ?>

    </div>
  </section>

  <section class="two">
    <div class="container">

      <header>
        <h2>공지사항</h2>
      </header>

      <ul id="notice">
        <li>
          본 시스템을 통한 외출 신청은 당일 오전 8시 ~ 오후 6시까지 가능합니다.
        </li>
        <li>
          디미고인 아이디로 로그인하여 사용합니다.
        </li>
        <li>
          외출 신청을 하면 담임선생님과 학년부장 선생님께서 보시고 적절한 기준에 따라 승인/거부를 결정합니다.
          외출이 승인되면 시리얼 넘버가 발급되고, 이를 조회하는 것으로 간단히 외출 정보를 열람할 수 있습니다.
        </li>
        <li>
          거부 사유 또한 작성 가능합니다. 이는 필수는 아니며, 선생님의 재량에 따라 작성하시면 됩니다.
        </li>
        <li>
          학생의 경우 외출 신청 페이지를 이용 가능하며, 자신이 신청한 외출 목록을 조회/수정 가능합니다.
        </li>
        <li>
          선생님의 경우 외출 관리 페이지를 이용 가능하며, 모든 학생들의 외출 정보를 조회 및 승인/거부하실 수 있습니다.
        </li>
      </ul>

    </div>
  </section>

</div>
