 <!-- Panggil file header -->
<?php include "header.php"; ?>

<?php 

//Uji Jika tombol simpan di klik
if (isset($_POST['bsimpan'])) {
    $tgl = date('Y-m-d');
    
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
    $alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES);
    $tujuan = htmlspecialchars($_POST['tujuan'], ENT_QUOTES);
    $nope = htmlspecialchars($_POST['nope'], ENT_QUOTES);

    //query simpan data
    $simpan = mysqli_query($koneksi, "INSERT INTO 'ttamu' VALUES('', '$tgl', '$nama', '$alamat', '$tujuan', '$nope')");

    //uji jika simpan berhasil
    if ($simpan) {
        echo "<script>alert('Simpan data sukses, Terima kasih...!');
               document.location='?'</script>";
    }
    else {
        echo "<script>alert('Simpan data GAGAL!!!');
               document.location='?'</script>";
    }
}

?>


 <!-- Head -->
       <div class="head text-center">
        <br><br><img class="col-mt-4" src="assets/img/logo1.png" width="100"></br></br>
        <h2 class="text-white"> Sistem Informasi e-Buku Tamu <h2> 
       </div>
       
    <div class="row mt-3">
        <div class="col-lg-7 mb-3">
            <div class="card shadow bg-gradient-light">
                <div class="card-body">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Identitas Pengunjung</h1>
                            </div>
                            <form class="user" method="POST" action="">
                                
                            <div class="form-group">
                                <input type="text" class="form-control
                                form-control-user" name="nama" placeholder="Nama Pengunjung" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control
                                form-control-user" name="alamat" placeholder="Asal/Alamat/Instansi" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control
                                form-control-user" name="tujuan" placeholder="Tujuan Pengunjung" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control
                                form-control-user" name="nope" placeholder="No.hp Pengunjung" required>
                            </div>

                            <button type="submit" nama= "bsimpan" class="btn btn-primary btn-user btn-block">Simpan Data</button>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="#"> By : Halnan | 2022 - <?= date('Y') ?> </a>
                            </div>
                        </div>
            </div>
        </div>

        <div class="col-lg-5 mb-3"> 
            <div class="card shadow">
                <div class="card-body">
                   <div class="text-center">
                     <h1 class="h4 text-gray-900 mb-4">Statistik Pengunjung</h1>
                   </div>
                   <?php
                   // deklarasi tanggal

                   //tanggal sekarang
                   $tgl_sekarang = date('Y-m-d');

                   //tanggal kemarin
                   $kemarin = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));

                   //6hari sebelum tanggal sekarang
                   $seminggu = date('Y-m-d h:i:s', strtotime('-1 week +1 day', strtotime($tgl_sekarang)));

                   $sekarang = date('Y-m-d h:i:s');

                   //sebulan
                   $bulan_ini = date('m');

                   //querry data pengunjung
                   $tgl_sekarang = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM ttamu where tanggal like '%$tgl_sekarang%'"));

                    $kemarin = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM ttamu where tanggal like '%$kemarin%'"));

                    $seminggu = mysqli_fetch_array(mysqli_query(
                        $koneksi,
                        "SELECT count(*) FROM ttamu where tanggal BETWEEN '$seminggu' and '$sekarang'"));

                    $sebulan = mysqli_fetch_array(mysqli_query(
                        $koneksi,
                    "SELECT count(*) FROM ttamu where month(tanggal) = '$bulan_ini'"));

                    $keseluruhan = mysqli_fetch_array(mysqli_query(
                        $koneksi,
                    "SELECT count(*) FROM ttamu"));

                   ?>

                   <table class="table table-bordered">
                    <tr>
                        <td>Hari ini</td>
                        <td>:<?= $tgl_sekarang[0]?></td>
                    </tr>
                    <tr>
                        <td>Kemarin</td>
                        <td>:<?= $kemarin[0]?></td>
                    </tr>

                    <tr>
                        <td>Minggu ini</td>
                        <td>:<?= $seminggu[0]?></td>
                    </tr>

                    <tr>
                        <td>Bulan ini</td>
                        <td>:<?= $sebulan[0]?></td>
                    </tr>
                    <tr>
                        <td>Keseluruhan</td>
                        <td>:<?= $keseluruhan[0]?></td>
                    </tr>
                   </table>
                </div>
            </div>
        </div>
       </div>

                           <!-- DataTales Example -->
                           <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung Hari Ini [<?=date('d-m-Y') ?>] </h6>
                        </div>
                        <div class="card-body">

                        <a href="rekapitulasi.php" class="btn btn-success mb-3"><i class="fa fa-table"></i> Rekapitulasi Pengunjung </a>
                        <a href="logout.php" class="btn btn-danger mb-3"><i class="fa fa-sign-out-alt"></i> Logout </a>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No. </th>
                                            <th>Tanggal</th>
                                            <th>Nama Pengunjung</th>
                                            <th>Asal/Alamat/Instansi</th>
                                            <th>Tujuan</th>
                                            <th>No.hp</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>No. </th>
                                            <th>Tanggal</th>
                                            <th>Nama Pengunjung</th>
                                            <th>Asal/Alamat/Instansi</th>
                                            <th>Tujuan</th>
                                            <th>No.hp</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $tgl = date('Y-m-d');
                                        $tampil = mysqli_query($koneksi, "SELECT * FROM ttamu where tanggal like '%$tgl%' order by id desc");
                                        $no = 1;
                                        while ($data = mysqli_fetch_array($tampil)) {
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data['tanggal']?></td>
                                            <td><?= $data['nama']?></td>
                                            <td><?= $data['alamat']?></td>
                                            <td><?= $data['tujuan']?></td>
                                            <td><?= $data['nope']?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

<!-- Panggil file header -->
<?php include "footer.php"; ?>

