<?php
    $conn = mysqli_connect("localhost", "root", "", "spk");
    $id = $_GET['id'];
    $hapus = "DELETE FROM data_kriteria WHERE id_aspek = '$id'";
    mysqli_query($conn, $hapus);
    echo "<script>alert('data berhasil dihapus');document.location.href='data_kriteria.php';</script>";
?>