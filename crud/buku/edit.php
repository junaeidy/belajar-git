<html>
<head>
	<title>Edit Buku</title>
</head>
<style>
	.col{
		margin-top: 5px;
	}
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<?php
	include_once("connect.php");
	$isbn = $_GET['isbn'];

	$buku = mysqli_query($mysqli, "SELECT * FROM buku WHERE isbn='$isbn'");
    $penerbit = mysqli_query($mysqli, "SELECT * FROM penerbit");
    $pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang");
    $katalog = mysqli_query($mysqli, "SELECT * FROM katalog");

    while($buku_data = mysqli_fetch_array($buku))
    {
    	$judul = $buku_data['judul'];
    	$isbn = $buku_data['isbn'];
    	$tahun = $buku_data['tahun'];
    	$id_penerbit = $buku_data['id_penerbit'];
    	$id_pengarang = $buku_data['id_pengarang'];
    	$id_katalog = $buku_data['id_katalog'];
    	$qty_stok = $buku_data['qty_stok'];
    	$harga_pinjam = $buku_data['harga_pinjam'];
    }
?>
 
<body>
<div class="container">
    <h2>Form Edit Data Buku</h2>
    <form action="edit.php?isbn=<?php echo $isbn; ?>" method="post">
      <div class="row">
		<div class="col">
			<label for="isbn" class="form-label">ISBN</label>
			<input type="text" class="form-control" name="isbn" id="disabledInput" disabled value="<?php echo $isbn; ?>">
		</div>
      	<div class="col">
			<label for="judul" class="form-label">Judul</label>
			<input type="text" class="form-control" name="judul" value="<?php echo $judul; ?>">
      	</div>
	  </div>
	  <div class="row">
		<div class="col">
			<label for="tahun" class="form-label">Tahun</label>
			<input type="text" class="form-control" name="tahun" value="<?php echo $tahun; ?>">
		</div>
		<div class="col">
			<label for="pengarang" class="form-label">Pengarang</label>
			<select name="id_pengarang" class="form-control">
				<?php 
				    while($pengarang_data = mysqli_fetch_array($pengarang)) {         
				    	echo "<option ".($pengarang_data['id_pengarang'] == $id_pengarang ? 'selected' : '')." value='".$pengarang_data['id_pengarang']."'>".$pengarang_data['nama_pengarang']."</option>";
				    }
				?>
			</select>
		</div>
      </div>
	  
	  <div class="row">
	  <div class="col">
	  		<label for="penerbit" class="form-label">Penerbit</label>
				<select name="id_penerbit" class="form-control">
					<?php 
						while($penerbit_data = mysqli_fetch_array($penerbit)) {         
							echo "<option ".($penerbit_data['id_penerbit'] == $id_penerbit ? 'selected' : '')." value='".$penerbit_data['id_penerbit']."'>".$penerbit_data['nama_penerbit']."</option>";
				    	}
					?>			
				</select>
	  	</div>
		<div class="col">
			<label for="katalog" class="form-label">Katalog</label>
			<select name="id_katalog" class="form-control">
				<?php 
					while($katalog_data = mysqli_fetch_array($katalog)) {         
						echo "<option ".($katalog_data['id_katalog'] == $id_katalog ? 'selected' : '')." value='".$katalog_data['id_katalog']."'>".$katalog_data['nama_katalog']."</option>";
					}
				?>
			</select>
	  	</div>
	  </div>
	  <div class="row">
		<div class="col">
			<label for="qty_stok" class="form-label">Qty Stok</label>
			<input type="qty_stok" class="form-control" name="qty_stok" value="<?php echo $qty_stok; ?>">
		</div>
		<div class="col">
			<label for="harga_pinjam" class="form-label">Harga Pinjam</label>
			<input type="text" class="form-control" name="harga_pinjam" value="<?php echo $harga_pinjam; ?>">
		</div>
	  </div><br>
	  <input type="submit" class="btn btn-primary" name="update" value="Perbarui">
	  <a href="index.php" class="btn btn-success">Kembali</a>
	  
    </form>
  </div>
	
	<?php
	 
		// Check If form submitted, insert form data into users table.
		if(isset($_POST['update'])) {

			$isbn = $_GET['isbn'];
			$judul = $_POST['judul'];
			$tahun = $_POST['tahun'];
			$id_penerbit = $_POST['id_penerbit'];
			$id_pengarang = $_POST['id_pengarang'];
			$id_katalog = $_POST['id_katalog'];
			$qty_stok = $_POST['qty_stok'];
			$harga_pinjam = $_POST['harga_pinjam'];
			
			include_once("connect.php");

			$result = mysqli_query($mysqli, "UPDATE buku SET judul = '$judul', tahun = '$tahun', id_penerbit = '$id_penerbit', id_pengarang = '$id_pengarang', id_katalog = '$id_katalog', qty_stok = '$qty_stok', harga_pinjam = '$harga_pinjam' WHERE isbn = '$isbn';");
			
			header("Location:index.php");
		}
	?>
</body>
</html>