<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="/">Dimigo Access</a>
  </div>

  <!-- Top Menu Items -->
  <ul class="nav navbar-right top-nav">

    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
      <ul class="dropdown-menu alert-dropdown">
        <li>
          <a href="#">박규태 <span class="label label-danger pull-right">병원</span></a>
        </li>
        <li>
          <a href="#">박규태 <span class="label label-primary pull-right">치킨</span></a>
        </li>
        <li class="divider"></li>
        <li>
          <a href="#">View All</a>
        </li>
      </ul>
    </li>

    <?php
    if (!empty($this->session->userdata('userid'))) {
      ?>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$this->session->userdata('username')?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li>
            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
          </li>
          <li>
            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
          </li>
          <li>
            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="<?=site_url('auth/logout')?>"><i class="fa fa-fw fa-power-off"></i> Logout</a>
          </li>
        </ul>
      </li>
      <?php
    } else {
      ?>
      <li class="dropdown" id="login">
        <a href="<?=site_url('auth/login')?>"><i class="fa fa-fw fa-user"></i> Login</a>
      </li>
      <?php
    }
    ?>
  </ul>

  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
      <li id="main">
        <a href="<?=site_url('/')?>"><i class="fa fa-fw fa-dashboard"></i> Main Page</a>
      </li>
      <li id="request">
        <a href="<?=site_url('request')?>"><i class="fa fa-fw fa-dashboard"></i> Request</a>
      </li>
      <li id="manage">
        <a href="<?=site_url('manage')?>"><i class="fa fa-fw fa-dashboard"></i> Manage</a>
      </li>
      <li>
        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
        <ul id="demo" class="collapse">
          <li>
            <a href="#">Dropdown Item</a>
          </li>
          <li>
            <a href="#">Dropdown Item</a>
          </li>
        </ul>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav><!-- Navigation -->
