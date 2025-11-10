<?php
include 'db.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM vehicles WHERE id=$id"));

if (isset($_POST['update'])) {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = 'uploads/' . basename($image);

        if (!empty($data['image']) && file_exists('uploads/' . $data['image'])) {
            unlink('uploads/' . $data['image']);
        }

        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $query = "UPDATE vehicles SET brand='$brand', model='$model', year='$year', price='$price', image='$image' WHERE id=$id";
    } else {
        $query = "UPDATE vehicles SET brand='$brand', model='$model', year='$year', price='$price' WHERE id=$id";
    }

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>

<h2>Edit Data Kendaraan</h2>
<form method="POST" enctype="multipart/form-data">
  Brand: <input type="text" name="brand" value="<?php echo $data['brand']; ?>" required><br><br>
  Model: <input type="text" name="model" value="<?php echo $data['model']; ?>" required><br><br>
  Tahun: <input type="number" name="year" value="<?php echo $data['year']; ?>" required><br><br>
  Harga: <input type="number" step="0.01" name="price" value="<?php echo $data['price']; ?>" required><br><br>
  Gambar Sekarang: <br>
  <img src="uploads/<?php echo $data['image']; ?>" width="100"><br><br>
  Ganti Gambar (opsional): <input type="file" name="image"><br><br>
  <button type="submit" name="update">Update</button>
</form>

<br>
<a href="index.php">← Kembali</a>
