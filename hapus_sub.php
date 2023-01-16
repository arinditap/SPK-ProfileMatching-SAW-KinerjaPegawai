<?php
    $conn = mysqli_connect("localhost", "root", "", "spk");
    $id = $_GET['id'];
    $hapus = "DELETE FROM data_subkriteria WHERE id_sub = '$id'";
    mysqli_query($conn, $hapus);
    echo "<script>alert('data berhasil dihapus');document.location.href='data_subkriteria.php';</script>";
?>