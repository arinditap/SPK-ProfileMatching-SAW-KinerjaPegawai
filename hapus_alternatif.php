<?php
    $conn = mysqli_connect("localhost", "root", "", "spk");
    $id = $_GET['id'];
    $hapus[0] = "DELETE FROM data_alternatif WHERE id_karyawan = '$id'";
    $hapus[1] = "DELETE FROM data_sample WHERE karyawan = '$id'";
    foreach($hapus as $h){
        mysqli_query($conn, $h);
    }
    echo "<script>alert('Data berhasil dihapus');document.location.href='data_alternatif.php';</script>";
?>