<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "cart_db";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$nama        = "";
$metode       = "";
$status     = "";
$total         = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from pembayaran where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from pembayaran where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nama       = $r1['nama'];
    $metode       = $r1['metode'];
    $status     = $r1['status'];
    $total         = $r1['total'];

    if ($nomor == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $nama       = $_POST['nama'];
    $metode       = $_POST['metode'];
    $status     = $_POST['status'];
    $total         = $_POST['total'];

    if ($nama && $metode && $status && $total) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update pembayaran set nama = '$nama',metode='$metode',status = '$status',total ='$total' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into pembayaran(nama,metode,status,total) values ('$nama','$metode','$status','$total')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../Online-Shop/css/style.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<div class="medsos">
		<div class="container">
			<ul>
				<li><a href="#"><i class="fab fa-facebook"></i></a></li>
				<li><a href="#"><i class="fab fa-instagram"></i></a></li>
				<li><a href="#"><i class="fab fa-youtube"></i></a></li>
			</ul>
		</div>
	</div>
	<header>
		<div class="container">
		<h1><a href="index.html"></a>MAKAN KUY</h1>
		<ul>
        <li class="active"><a href="index.html">HOME</a></li>
        <li><a href="../resto/page.php">RESTORAN</a></li>
			<li><a href="../rewiew/review.php">REVIEW</a></li>
			<li><a href="../pelanggan/index2.php">PELANGGAN</a></li>
			<li><a href="../data/index.php">KARYAWAN</a></li>
			<li><a href="../admin_page.php">PRODUK</a></li>
			<li><a href="../pembayaran/bayar.php">PEMBAYARAN</a></li>
		</ul>
		</div>
	</header>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Data Pembayaran
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    // header("refresh:5;url=index.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    // header("refresh:5;url=index.php");
                }
                ?>
                <form action="" method="POST">
                  
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="metode" class="col-sm-2 col-form-label">Metode Pembayaran</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="metode" name="metode" value="<?php echo $metode ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="status" class="col-sm-2 col-form-label">Status Pembayaran</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="status" name="status" value="<?php echo $status ?>">
                        </div>
                    </div>                    
                        <div class="mb-3 row">
                        <label for="total" class="col-sm-2 col-form-label">Total</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="total" name="total" value="<?php echo $total ?>">
                        </div>
                    </div>

                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Pelanggan
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Metode Pembayaran</th>
                            <th scope="col">Status Pembayaran</th>
                            <th scope="col">Total</th>
                            <!-- <th scope="col">Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from pembayaran order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $nama       = $r2['nama'];
                            $metode     = $r2['metode'];
                            $status     = $r2['status'];
                            $total      = $r2['total'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $metode ?></td>
                                <td scope="row"><?php echo $status ?></td>
                                <td scope="row"><?php echo $total ?></td>
                             
                                    <!-- <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a> -->
                                    <!-- <a href="index.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>             -->
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</body>

</html>