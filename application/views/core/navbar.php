<!-- Header -->
<div id="header">

  <div class="top">

    <?php
    if (empty($this->session->userdata('userid'))) {
      ?>
      <div id="logo">
        <span class="image avatar48"><img src="/assets/images/profile.png"></span>
        <h1 id="title"><a href="<?=site_url('auth/login')?>">로그인</a></h1>

      </div>
      <?php
    } else {
      ?>
      <div id="logo">
        <span class="image avatar48"><img src="<?= empty($this->session->userdata('userphoto')) ? '/assets/images/profile.png' : 'http://api.dimigo.org/user_photo/'.$this->session->userdata('userphoto')?>"></span>
        <h1 id="title">
          <?php
          echo $this->session->userdata('username');
          if ($this->session->userdata('usertype') == "T")
          echo "<span style='font-size: 0.65em; color: rgba(160, 160, 160, 1); margin-left: 3px;'>선생님</span>";
          ?>
        </h1>
        <p><a href="<?=site_url('auth/logout')?>">로그아웃</a></p>
      </div>
      <?php
    }
    ?>

    <!-- Nav -->
    <nav id="nav">
      <ul>
        <li id="mainpage"><a href="<?=site_url('/')?>"><span class="icon fa-home">Main Page</span></a></li>
        <?php
        if ($this->session->userdata('usertype') == "S") {
          ?>
          <li id="request"><a href="<?=site_url('request')?>"><span class="icon fa-question">Request</span></a></li>
          <?php
        } else if ($this->session->userdata('usertype') == "T") {
          ?>
          <li id="manage"><a href="<?=site_url('manage')?>"><span class="icon fa-sign-in">Manage</span></a></li>
          <?php
        }
        ?>
        <li id="search_serial"><a href="<?=site_url('search/serial')?>"><span class="icon fa-search">Search - Serial</span></a></li>
        <li id="search_name"><a href="<?=site_url('search/name')?>"><span class="icon fa-search">Search - Name</span></a></li>
      </ul>
    </nav>

  </div>

  <!--div class="bottom">

    <ul class="icons">
      <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
      <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
      <li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
      <li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
      <li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
    </ul>

  </div-->

</div>
