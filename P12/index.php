<?php
include 'db.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$countSql = "SELECT COUNT(*) AS total FROM vehicles WHERE brand LIKE '%$search%' OR model LIKE '%$search%'";
$countResult = mysqli_query($conn, $countSql);
$countRow = mysqli_fetch_assoc($countResult);
$total = $countRow['total'];
$pages = ceil($total / $limit);

$sql = "SELECT * FROM vehicles WHERE brand LIKE '%$search%' OR model LIKE '%$search%' LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);
?>

<h2>Data Kendaraan</h2>
<form method="GET">
  <input type="text" name="search" placeholder="Cari brand atau model..." value="<?php echo $search; ?>">
  <button type="submit">Search</button>
</form>

<a href="add.php">+ Tambah Kendaraan Baru</a>
<br><br>

<table border="1" cellpadding="10">
  <tr>
    <th>ID</th>
    <th>Brand</th>
    <th>Model</th>
    <th>Tahun</th>
    <th>Harga</th>
    <th>Gambar</th>
    <th>Aksi</th>
  </tr>

  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
  <tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['brand']; ?></td>
    <td><?php echo $row['model']; ?></td>
    <td><?php echo $row['year']; ?></td>
    <td>Rp <?php echo number_format($row['price'], 2, ',', '.'); ?></td>
    <td>
      <?php if ($row['image']) { ?>
        <img src="uploads/<?php echo $row['image']; ?>" width="80">
      <?php } else { echo 'Tidak ada gambar'; } ?>
    </td>
    <td>
      <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> | 
      <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin hapus data ini?')">Delete</a>
    </td>
  </tr>
  <?php } ?>
</table>

<br>
<?php for ($i = 1; $i <= $pages; $i++) { ?>
  <a href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>">[<?php echo $i; ?>]</a>
<?php } ?>
