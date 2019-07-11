<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="icon" href="<?php echo base_url("assets/img/Logo Puri.png") ?>">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Daftar Lowongan | PT Puri Makmur Lestari</title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url();?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url();?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <style media="screen">
    a div img {
      width: 80px;
    }
  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url();?>user">
        <div class="sidebar-brand-icon ">
          <img src="<?= base_url();?>assets/img/Logo Puri.png" alt="logo_pt_puri">
        </div>
        <div class="sidebar-brand-text mx-3"></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url();?>Admin_Puri">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading" style="color: black;">
        User
      </div>

      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-id-card"></i>
          <span>Profile</span></a>
          <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-id-card"></i>
            <span>Edit Profile</span></a>
      </li>
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading" style="color: black;">
        Menu Loker
      </div>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url();?>Admin_Puri/lowongan">
          <i class= "fas fa-briefcase"></i>
          <span>Manage Loker</span></a>
      </li>

      <!-- Heading -->
      <div class="sidebar-heading" style="color: black;">
        Menu Pelamar
      </div>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url();?>Admin_Puri/Excel_Export">
          <i class= "fas fa-briefcase"></i>
          <span>Data Pelamar</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
    <!-- Divider -->


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-gradient-danger  topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-white-600 small" style="font-weight: bold;"><?= $user['name'];?></span>
                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image'];?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Akun
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url('Auth/logout');?>" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Data Pelamar Pekerjaan</h1>

          <div class="row">
            <div class="col-lg-6">
              <?= $this->session->flashdata('message');?>
            </div>
          </div>

          <!-- Pendaftaran Lowongan -->
        	<div class="container">
        		<div class="col-12 konten" style="background-color: white;">
        			<form action="<?php echo site_url(); ?>/User/editDataPelamarC" method="POST" enctype="multipart/form-data">

        				<!-- Formulir pendaftaran Lowongan Pekerjaan -->
        				<!-- <p class="text-center">Formulir pendaftaran Lowongan Pekerjaan</p> -->
                <input type="hidden" name="id_pelamar" value="<?= $list['id_pelamar'] ?>">

        				<!--Form input Posisi-->
        				<div class="form-group row">
        				    <label for="posisi" class="col-sm-2 col-form-label">Posisi</label>
        				    <div class="col-sm-10">
        				      <input type="text" class="form-control" name="posisi" value="<?= $list['posisi'] ?>" readonly>
        				    </div>
        			  	</div>
        				<!-- Form input nama lengkap -->
        				<div class="form-group row">
        				    <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
        				    <div class="col-sm-10">
        				      <input type="text" class="form-control" name="nama" value="<?= $list['nama'] ?>" readonly>
        				    </div>
        			  	</div>
        				<!-- Form input tempat lahir -->
        			  	<div class="form-group row">
        				    <label for="tmpt_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
        				    <div class="col-sm-10">
        				      <input type="text" class="form-control" name="tmpt_lahir" value="<?= $list['tmpt_lahir'] ?>" readonly>
        				    </div>
        			  	</div>
        				<!-- Form input tanggal lahir -->
        			  	<div class="form-group row">
        				    <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
        				    <div class="col-sm-10">
        				      <input type="date" class="form-control" name="tgl_lahir" value="<?= $list['tgl_lahir'] ?>" readonly>
        				    </div>
        			  	</div>
        			  	<!-- Form input alamat -->
        				<div class="form-group row">
        				    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
        				    <div class="col-sm-10">
        				      	<input type="text" class="form-control" name="alamat" placeholder="Alamat"value="<?= $list['alamat'] ?>" readonly>
        				    </div>
        				</div>
                <!-- Form input agama -->
              <div class="form-group row">
                  <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" name="agama" value="<?= $list['agama'] ?>" readonly>
                  </div>
              </div>
        				<!-- Form input pendidikan terakhir -->
                <fieldset class="form-group">
                  <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Pendidikan Terakhir</legend>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="pendidikan" id="pendidikan1" value="D3" readonly>
                        <label class="form-check-label" for="pendidikan1">D3</label>
                      </div>
                      <div class="form-check">
                          <input class="form-check-input" type="radio" name="pendidikan" id="pendidikan2" value="S1" readonly>
                          <label class="form-check-label" for="pendidikan2">S1</label>
                      </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="pendidikan" id="pendidikan3" value="S2" checked readonly>
                          <label class="form-check-label" for="pendidikan3">S2</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pendidikan" id="pendidikan4" value="S3" readonly>
                            <label class="form-check-label" for="pendidikan4">S3</label>
                        </div>
                      </div>
                  </div>
              </fieldset>
              <!-- Form input Universitas -->
              <div class="form-group row">
                  <label for="nomor" class="col-sm-2 col-form-label">Universitas</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="universitas" value="<?php echo $list['universitas']; ?>" readonly>
                  </div>
                </div>
                <!-- Form input Jurusan -->
                <div class="form-group row">
                    <label for="nomor" class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="jurusan" value="<?php echo $list['jurusan']; ?>" readonly>
                    </div>
                  </div>
        				<!-- Form input email -->
        				<div class="form-group row">
        				    <label for="email" class="col-sm-2 col-form-label">Email</label>
        				    <div class="col-sm-10">
        				      	<input type="email" class="form-control" name="email" value="<?php echo $list['email']; ?>" readonly>
        				    </div>
        				</div>
        				<!-- Form input nomor hp -->
        				<div class="form-group row">
        				    <label for="nomor" class="col-sm-2 col-form-label">Nomor HP</label>
        				    <div class="col-sm-10">
        				      <input type="number" class="form-control" name="nomor" value="<?php echo $list['nomor']; ?>" readonly>
        				    </div>
        			  	</div>
        				<!-- Form input jenis kelamin -->
                <fieldset class="form-group">
        				    <div class="row">
        				      	<legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
        				     	<div class="col-sm-10">
        				        	<div class="form-check">
        						        <input class="form-check-input" type="radio" name="gender" id="gender" value="Laki-laki" checked readonly>
        						        <label class="form-check-label" for="gender">Laki - Laki</label>
        				        	</div>
        				        	<div class="form-check">
        					          	<input class="form-check-input" type="radio" name="gender" id="gender" value="Perempuan" readonly>
        					          	<label class="form-check-label" for="gender">Perempuan</label>
        				        	</div>
        				      	</div>
        				    </div>
        				</fieldset>
                <!-- Form input status -->
        				<fieldset class="form-group">
        				    <div class="row">
        				      	<legend class="col-form-label col-sm-2 pt-0">Status</legend>
        				     	<div class="col-sm-10">
        				        	<div class="form-check">
        						        <input class="form-check-input" type="radio" name="status" id="status" value="Lajang" checked readonly>
        						        <label class="form-check-label" for="status">Lajang</label>
        				        	</div>
        				        	<div class="form-check">
        					          	<input class="form-check-input" type="radio" name="status" id="status" value="Menikah" readonly>
        					          	<label class="form-check-label" for="status">Menikah</label>
        				        	</div>
        				      </div>
        				    </div>
        				</fieldset>
                <!-- Form input Foto -->
                <div class="row">
                  <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                  <div class="col-sm-10">
                    <div class="custom-file">
                      <img src="<?= base_url('uploads/pelamar/') . $list['foto'];?>" style="width: 100px; height: 150px;"><br>
                    </div>
                  </div>
                </div><br><br><br>
                <!-- Form input CV -->
                <div class="row">
                  <label for="cv" class="col-sm-2 col-form-label">CV</label>
                  <div class="col-sm-10">
                    <div class="custom-file">
                      <button type="button" name="button" class="btn"><a href='<?= base_url('uploads/pelamar/') . $list['cv'];?>'> File PDF </a></button>
                    </div>
                  </div>
                </div><br>
                <!-- Validasi pendaftaran -->
                <div class="form-group row">
                    <div class="col-sm-10">
                      <button type="button" class="btn btn-primary">Done</button>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#masukkandatabaru">
                        Change Status
                      </button>
                    </div>
                </div>
                <br>
              </form>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; PT Puri Makmur Lestari 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Modal Tambahkan Pelanggan -->
  <div class="modal fade" id="masukkandatabaru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Masukkan Data Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url() ?>Admin_Puri/tambahStatusPelamar" method="POST">
            <!-- <input type="hidden" name="id_pelamar" value="SP<?= str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT); ?>"> -->
            <div class="form-group">
              <label for="id_pelanggan">Nama Pelamar</label>
              <input type="text" class="form-control" id="nama" name="nama" value="<?= $list['nama'] ?>" readonly>
            </div>
            <hr/>
            <div class="form-group">
              <label for="hasil">Status Pelamar</label>
              <select class="form-control" id="hasil" name="hasil">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <a class="btn btn-primary" href="<?= base_url('Admin_Puri/saveStatus');?>">Save</a>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url('Auth/logout');?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url();?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url();?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url();?>assets/js/sb-admin-2.min.js"></script>
  <script>
    $('.custom-file-input').on('change', function() {
      let filename = $(this).val().split('\\').pop();
      $(this).next('.custom-file-label').addClass("selected").html(filename);
    });
  </script>
</body>
</html>
