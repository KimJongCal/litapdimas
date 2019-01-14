<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=base_url('assets/dist/img/avatar.png');?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?=$this->session->userdata('nama');?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header text-center">LITAPDIMAS</li>
            <li><a href="<?=base_url('Dashboard');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

            <!-- Proposal -->
            <li class="treeview">
                <a href="#"><i class="fa fa-folder">&nbsp;</i>
                    <span>Proposal</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url('index.php/Admin/Proposal/');?>"><i class="fa fa-circle-o"></i>Masuk</a></li>
                    <li><a href="<?=base_url('index.php/Admin/Proposal/Diterima');?>"><i class="fa fa-circle-o"></i>Diterima</a></li>
                </ul>
            </li>

            <!-- Peneliti -->
            <li class="treeview">
                <a href="#"><i class="fa fa-folder">&nbsp;</i>
                    <span>Peneliti</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url('index.php/Admin/Peneliti/');?>"><i class="fa fa-circle-o"></i>Semua</a></li>
                </ul>
            </li>

            <!-- Statistik -->
            <li class="treeview">
                <a href="#"><i class="fa fa-folder">&nbsp;</i>
                    <span>Statistik</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url('index.php/Admin/Statistik/Proposal');?>"><i class="fa fa-circle-o"></i>Proposal</a></li>
                    <li><a href="<?=base_url('index.php/Admin/Statistik/Peneliti');?>"><i class="fa fa-circle-o"></i>Peneliti</a></li>
                </ul>
            </li>

            <!-- Master -->
            <li class="treeview">
                <a href="#"><i class="fa fa-folder">&nbsp;</i>
					<span>Master Data</span>
                    <span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
					<li><a href="<?=base_url('index.php/Admin/Master/BidangIlmu/');?>"><i class="fa fa-circle-o"></i>Bidang Ilmu</a></li>
					<li><a href="<?=base_url('index.php/Admin/Master/Kluster/');?>"><i class="fa fa-circle-o"></i>Kluster</a></li>
                    <li><a href="<?=base_url('index.php/Admin/Master/Fungsional/');?>"><i class="fa fa-circle-o"></i>Fungsional</a></li>
                    <li><a href="<?=base_url('index.php/Admin/Master/JabatanFungsional/');?>"><i class="fa fa-circle-o"></i>Jabatan Fungsional</a></li>
                    <li><a href="<?=base_url('index.php/Admin/Master/Pangkat/');?>"><i class="fa fa-circle-o"></i>Pangkat/Golongan</a></li>
                    <li><a href="<?=base_url('index.php/Admin/Master/Satker/');?>"><i class="fa fa-circle-o"></i>Satuan Kerja</a></li>
					<li><a href="<?=base_url('index.php/Admin/Users/');?>"><i class="fa fa-circle-o"></i>Users</a></li>
				</ul>
            </li>

            <li><a href="<?=base_url('index.php/Auth/Logout');?>"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
        </ul>
    </section>
</aside>