<?php

@include 'configure.php';

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_descript = $_POST['product_descript'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_descript) || empty($product_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO resto(name, descript, image) VALUES('$product_name', '$product_descript', '$product_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'restoran berhasil ditambah';
      }else{
         $message[] = 'tdak dapat menambah restoran';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM resto WHERE id = $id");
   header('location:page.php');
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>daftar restoran</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

   <link rel="stylesheet" type="text/css" href="../Online-Shop/css/style.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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
   

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
   
<div class="container">

   <div class="admin-product-form-container">
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>Tambah Restoran Baru</h3>
         <input type="text" placeholder="enter resto name" name="product_name" class="box">
         <input type="text" placeholder="enter resto address" name="product_descript" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="add resto">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM resto");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>resto image</th>
            <th>resto name</th>
            <th>resto descript</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['descript']; ?></td>
            <td>
               <a href="update.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
               <a href="page.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>


</body>
</html>