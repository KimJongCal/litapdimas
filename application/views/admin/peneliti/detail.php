<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin - LITAPDIMAS</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Icon -->
        <link href="<?=base_url('assets/images/logo.png'); ?>" rel="icon" type="image/x-icon" />
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?=base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?=base_url('assets/dist/css/AdminLTE.min.css');?>">
        <link rel="stylesheet" href="<?=base_url('assets/dist/css/skins/skin-green.min.css');?>">
    </head>
    <body class="hold-transition skin-green sidebar-mini">
        <?php
            function word_count($data){
                if(str_word_count($data) <= 0){
                    return "0 Kata";
                }else{
                    return (str_word_count($data)-2)." Kata";
                }
            }
        ?>
        <div class="wrapper">
            <?php $this->load->view('admin/header-navbar');?>
            <?php $this->load->view('admin/header-sidebar');?>
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Peneliti
                        <small><i>Detail</i></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-gears"></i> Peneliti</a></li>
                        <li class="active"><i>Detail</i></li>
                    </ol>
                </section>
                <section class="content">
                    <?php if (!empty($this->session->flashdata('type_message'))) { ?>
                        <div class="alert alert-<?=$this->session->flashdata('type_message')?> alert-dismissible text-center" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?=$this->session->flashdata('message');?>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Data Peneliti</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table">
                                        <tr>
                                            <td>ID Peneliti</td>
                                            <td> : </td>
                                            <td><?=$tbPeneliti->id_peneliti?></td>
                                        </tr>
                                        <tr>
                                            <td>NIDN</td>
                                            <td> : </td>
                                            <td><?=$tbPeneliti->nidn?></td>
                                        </tr>
                                        <tr>
                                            <td>NIP</td>
                                            <td> : </td>
                                            <td><?=$tbPeneliti->nip?></td>
                                        </tr>
                                        <tr>
                                            <td>Fungsional</td>
                                            <td> : </td>
                                            <td><?=$tbPenelitiFungsional->fungsional?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td> : </td>
                                            <td><?=$tbPeneliti->nama?></td>
                                        </tr>
                                        <tr>
                                            <td>Tempat/Tanggal Lahir</td>
                                            <td> : </td>
                                            <td><?=$tbPeneliti->tempat?> / <?=$tbPeneliti->tgl_lhr?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td> : </td>
                                            <td><?=$tbPeneliti->alamat?></td>
                                        </tr>
                                        <tr>
                                            <td>Satuan Kerja</td>
                                            <td> : </td>
                                            <td><?=$tbPenelitiSatker->satker?></td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan</td>
                                            <td> : </td>
                                            <td><?=$tbPeneliti->jabatan?></td>
                                        </tr>
                                        <tr>
                                            <td>Pangkat / Golongan</td>
                                            <td> : </td>
                                            <td><?=$tbPenelitiPangkat->pangkat_gol?></td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan Fungsional</td>
                                            <td> : </td>
                                            <td><?=$tbPenelitiJabFungsional->jab_fungsional?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td> : </td>
                                            <td><?=$tbPeneliti->email?></td>
                                        </tr>
                                        <tr>
                                            <td>No. HP</td>
                                            <td> : </td>
                                            <td><?=$tbPeneliti->hp?></td>
                                        </tr>
                                        <tr>
                                            <td>Bidang Ilmu</td>
                                            <td> : </td>
                                            <td><?=$tbPenelitiBidangIlmu->bidang_ilmu?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Data Users Peneliti</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped">
                                        <?php if($tbPenelitiUsers->status_aktivasi=="0"){
                                            $aktivasi = "BELUM AKTIVASI";
                                            } else if($tbPenelitiUsers->status_aktivasi=="1"){
                                            $aktivasi = "SUDAH AKTIVASI";
                                        } ?>
                                        <thead>
                                        <tr>
                                            <td>Username</td>
                                            <td> : </td>
                                            <td><?=$tbPenelitiUsers->username?></td>
                                        </tr>
                                        <tr>
                                            <td>Status Aktivasi</td>
                                            <td> : </td>
                                            <td><?=$aktivasi?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Data Buku Peneliti</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Judul</th>
                                            <th>Penerbit</th>
                                            <th>ISBN</th>
                                            <th>Tahun</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no=1; foreach($tbPenelitiBuku as $value): ?>
                                        <tr>
                                            <td><?=$no++?></td>
                                            <td><?=$value->judul?></td>
                                            <td><?=$value->penerbit?></td>
                                            <td><?=$value->isbn?></td>
                                            <td><?=$value->tahun?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Data Jurnal Peneliti</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Judul</th>
                                            <th>Nama Jurnal</th>
                                            <th>Volume</th>
                                            <th>URL</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no=1; foreach($tbPenelitiJurnal as $value): ?>
                                        <tr>
                                            <td><?=$no++?></td>
                                            <td><?=$value->judul?></td>
                                            <td><?=$value->nama_jurnal?></td>
                                            <td><?=$value->volume?></td>
                                            <td><a href="<?=$value->url?>" class="btn btn-primary">Buka</a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Data Pendidikan Peneliti</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Jenjang</th>
                                            <th>Nama PT</th>
                                            <th>Program Studi</th>
                                            <th>Tahun</th>
                                            <th>Ijazah</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no=1; foreach($tbPenelitiPendidikan as $value): ?>
                                        <tr>
                                            <td><?=$no++?></td>
                                            <td><?=$value->jenjang?></td>
                                            <td><?=$value->nama_pt?></td>
                                            <td><?=$value->program_studi?></td>
                                            <td><?=$value->tahun?></td>
                                            <td><a href="<?=$value->ijazah?>" class="btn btn-primary">Buka</a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Data Berkas Peneliti</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table">
                                        <tr>
                                            <td>KTP</td>
                                            <td> : </td>
                                            <td>
                                                <a class="btn btn-primary btn-flat" href="<?=base_url('uploads/'.$tbPenelitiBerkas->ktp)?>" targer="_blank">Lihat</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>SK PNS Dosen</td>
                                            <td> : </td>
                                            <td>
                                                <a class="btn btn-primary btn-flat" href="<?=base_url('uploads/'.$tbPenelitiBerkas->sk_pns_dosen)?>" targer="_blank">Lihat</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>SK Jabatan Fungsional</td>
                                            <td> : </td>
                                            <td>
                                                <a class="btn btn-primary btn-flat" href="<?=base_url('uploads/'.$tbPenelitiBerkas->sk_jab_fungsional)?>" targer="_blank">Lihat</a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php $this->load->view('admin/footer'); ?>
        </div>

        <!-- REQUIRED JS SCRIPTS -->
        <!-- jQuery 2.2.3 -->
        <script src="<?=base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
        <!-- DataTables -->
        <script src="<?=base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
        <script src="<?=base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
        <!-- SlimScroll -->
        <script src="<?=base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js')?>"></script>
        <!-- FastClick -->
        <script src="<?=base_url('assets/plugins/fastclick/fastclick.js')?>"></script>
        <!-- AdminLTE App -->
        <script src="<?=base_url('assets/dist/js/app.min.js');?>"></script>
        <!-- page script -->
        <script>
          $(function () {
            $('#bidangilmu').DataTable({
              "paging": true,
              "lengthChange": true,
              "searching": true,
              "ordering": true,
              "info": true,
              "autoWidth": true
            });
          });
        </script>
        <script type="text/javascript">
          $('#tambah_tooltip').tooltip();
        </script>
    </body>
</html>
