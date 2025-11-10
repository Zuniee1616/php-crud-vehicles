<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];

    $target = 'uploads/' . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO vehicles (brand, model, year, price, image)
                VALUES ('$brand', '$model', '$year', '$price', '$image')";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php');
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    } else {
        echo 'Gagal upload gambar!';
    }
}
?>

<h2>Tambah Kendaraan Baru</h2>
<form method="POST" enctype="multipart/form-data">
  Brand: <input type="text" name="brand" required><br><br>
  Model: <input type="text" name="model" required><br><br>
  Tahun: <input type="number" name="year" required><br><br>
  Harga: <input type="number" step="0.01" name="price" required><br><br>
  Gambar: <input type="file" name="image" required><br><br>
  <button type="submit" name="submit">Simpan</button>
</form>

<br>
<a href="index.php">← Kembali</a>
