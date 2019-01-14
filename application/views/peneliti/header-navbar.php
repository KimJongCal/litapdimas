
  <!-- Main Header -->
  <header class="main-header">
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?=base_url('index.php/Peneliti/Dashboard')?>">LITAPDIMAS</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="<?=base_url('index.php/Peneliti/Dashboard')?>" role="button">Dashboard </span></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bantuan <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?=base_url('index.php/Peneliti/Pengajuan')?>">Pengajuan Proposal</a></li>
              <li><a href="<?=base_url('index.php/Peneliti/ProposalGanda')?>">Registrasi Proposal Ganda</a></li>
              <li><a href="<?=base_url('index.php/Peneliti/Pengumuman')?>">Pengumuman Hasil Penilaian</a></li>
            </ul>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?=base_url('assets/dist/img/avatar.png');?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?=$this->session->userdata('nama')?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?=base_url('assets/dist/img/avatar.png');?>" class="img-circle" alt="User Image">
                <?php if($this->session->userdata('level') == 3){
                  $level = "PENELITI";
                } ?>
                <p>
                  <?=$this->session->userdata('nama')?> - <?=$level?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?=base_url('index.php/Login/Logout');?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      </div>
    </nav>
  </header>