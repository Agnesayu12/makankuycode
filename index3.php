<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>MAKAN KUY</h1>
  <p>Makan Kuy News !!</p> 
</div>
  
<div class="container">
  <div class="row">

    <?php
        include("konek.php");
        $sql = "SELECT * FROM artikel";
        $hasil = mysqli_query($konek, $sql);

        $jmlArtikel = mysqli_num_rows($hasil);
        if ($jmlArtikel > 0){
            while($row = mysqli_fetch_assoc($hasil)){
            }
        }
            
        

    ?>

    <div class="col-sm-4">
      <h3>RICHEESE FACTORY</h3>
      <p>YEAY!! HARI INI Kalian masih bisa nikmati Promo Merdeka Richeese Factory dengan harga spesial mulai dari Rp. 27.273,-.</p>
      <p>Udah gitu, Bisa tambah menu lain favorit kamu juga, kayak : Fire Burst, Potato Pompom, atau Richoco Ice Cream Cup</p>
    </div>



    <div class="col-sm-4">
      <h3>KOPI KENANGAN</h3>
      <p>Yang ditunggu-tunggu telah tiba! Selamat Hari Mantan Nasional! ADA PROMO BELI 2 GRATIS 2 dan CASHBACK 100% LOH!</p>
      <p>Mari kita rayakan hari ini Ulang Tahun Kopi Kenangan yang ke-3 dan #TerimaKasihMantan untuk semua Kenangan indahnyaaa!</p>
    </div>
    <div class="col-sm-4">
      <h3>ICHIBAN SUSHI</h3>        
      <p>Siap-Siap! Hari ini PROMO YANG SATU INI BALIK LAGI!</p>
      <p>Makan PAKET MERDEKA ICHIBAN SUSHI CUMA Rp. 17RIBU aja!
Pakai lagi kartu BRI kamu buat makan+minum berdua jadi cuma 17ribuan aja lho!.</p>
    </div>
  </div>
</div>

</body>
</html>
