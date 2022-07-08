<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "cart_db";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
// $nomor        = "";
$nama       = "";
$komentar   = "";
$rating     = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from review where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from review where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    // $nomor       = $r1['nomor'];
    $nama       = $r1['nama'];
    $komentar   = $r1['komentar'];
    $rating     = $r1['rating'];

    if ($nomor == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])){  //untuk create
    $nama       = $_POST['nama'];
    $komentar   = $_POST['komentar'];
    $rating     = $_POST['rating'];

    if ($nama && $komentar && $rating) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update review set nama='$nama',komentar = '$komentar',rating='$rating' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into review(nama,komentar,rating) values ('$nama','$komentar','$rating')";
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

$result = mysqli_query($koneksi, "SELECT * FROM resto
        inner join review on(resto.id = review.id)");
        $totalreview = mysqli_query($koneksi, "SELECT count(id) as review FROM review")->fetch_array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>
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
        <p>Total review : <?php echo $totalreview['review'] ?></p>
            <div class="card-header">
                Kolom Review
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");
                }
                ?>
                <form action="" method="POST">
                    <!-- <div class="mb-3 row">
                        <label for="nomor" class="col-sm-2 col-form-label">NOMOR</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nomor" name="nomor" value="<?php echo $nomor ?>">
                        </div>
                    </div> -->
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="komentar" class="col-sm-2 col-form-label">Komentar</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="komentar" name="komentar" value="<?php echo $komentar ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="rating" class="col-sm-2 col-form-label">Rating</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="rating" id="rating">
                                <option value="">- Berikan Rating -</option>
                                <option value="1" <?php if ($rating == "1") echo "selected" ?>>1</option>
                                <option value="2" <?php if ($rating == "2") echo "selected" ?>>2</option>
                                <option value="3" <?php if ($rating == "3") echo "selected" ?>>3</option>
                                <option value="4" <?php if ($rating == "4") echo "selected" ?>>4</option>
                                <option value="5" <?php if ($rating == "5") echo "selected" ?>>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Review
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <!-- <th scope="col">NOMOR</th> -->
                            <th scope="col">Nama</th>
                            <th scope="col">Komentar</th>
                            <th scope="col">Rating</th>
                            <!-- <th scope="col">Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from review order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            // $nomor      = $r2['nomor'];
                            $nama       = $r2['nama'];
                            $komentar   = $r2['komentar'];
                            $rating     = $r2['rating'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <!-- <td scope="row"><?php echo $nomor ?></td> -->
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $komentar ?></td>
                                <td scope="row"><?php echo $rating ?></td>
                                <td scope="row">
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

        <section class="daftar-riwayat">
        <table class="table table-bordered">
            <thead>
                <tr class="tabel-header">
                    <th colspan="2" class="nama-tabel">review</th>
                </tr>
                <tr class="kolom">
                    <th>Nama</th>
                    <th>rating</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($tabel = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $tabel['name'] . "</td>";
                    echo "<td>" . $tabel['rating'] . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
    </div>
</body>

</html>