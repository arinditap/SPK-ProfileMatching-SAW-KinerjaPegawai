<?php
    $conn = mysqli_connect("localhost", "root", "", "spk");
    $id = $_GET['id'];
    $sql = "SELECT * FROM data_alternatif, data_subkriteria, data_sample WHERE data_alternatif.id_karyawan=
    data_sample.karyawan AND data_subkriteria.id_sub = data_sample.faktor AND data_sample.karyawan='$id' ORDER BY data_subkriteria.id_sub";
    $hasil = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Nilai  | SPK Profile Matching</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="fontAwesome/css/fontawesome.min.css">
        <link rel="stylesheet" href="fontAwesome/css/all.min.css">
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
        <div class="sidebar">
            <div class="logo-details">
                <i class='bx bxs-shield icon'></i>
                <div class="logo_name">SDN Guyung 2</div>
                <i class='bx bx-menu' id="btn" ></i>
            </div>
            <ul class="nav-list">
                <li>
                    <a href="index.php">
                        <i class='bx bx-grid-alt'></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>
                <li>
                    <a href="data_alternatif.php">
                        <i class='bx bx-user' ></i>
                        <span class="links_name">Alternatif</span>
                    </a>
                    <span class="tooltip">Alternatif</span>
                </li>
                <li>
                    <a href="data_kriteria.php">
                        <i class='bx bx-library'></i>
                        <span class="links_name">Kriteria</span>
                    </a>
                    <span class="tooltip">Kriteria</span>
                </li>
                <li>
                    <a href="data_subkriteria.php">
                        <i class='bx bx-list-ul'></i>
                        <span class="links_name">Sub Kriteria</span>
                    </a>
                    <span class="tooltip">Sub Kriteria</span>
                </li>
                <li>
                    <a href="hasil.php">
                        <i class='bx bx-clipboard'></i>
                        <span class="links_name">Perhitungan</span>
                    </a>
                    <span class="tooltip">Perhitungan</span>
                </li>
            </ul>
        </div>
        <section class="home-section">
            <div class="header">Edit Nilai</div>
            <div class='content'>
                <div class='wrapper'>
                    <form class='form' method='POST' action='edit_nilai.php'>
                    <?php 
                    $s = "SELECT * FROM data_alternatif WHERE id_karyawan='$id'";
                    $h = mysqli_query($conn, $s);
                    while($d=  mysqli_fetch_array($h)){ ?>
                    <div class='title'>
                        <center><label><?= $d[1]?></label></center>
                    </div>
                    <?php }; ?>
                    <?php 
                    while($data = mysqli_fetch_array($hasil)){ ?>
                            <div class='input_field'>
                                <label><?= $data[4]?></label>
                                <input type='text' class='input' name='nilai[]' required value="<?= $data[12]?>">
                                <input type="hidden" name="id" value="<?= $id ?>">
                            </div>
                    <?php   } ?>
                        <div class='input_field'>
                            <input type='submit' class='btn' value='Edit' name='edit'>
                        </div>
                </form>
                <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'spk');
                    error_reporting(E_ALL ^ E_NOTICE);
                    $sub = $_POST['sub']; //var_dump($sub);
                    $nilai = $_POST['nilai']; //var_dump($nilai);
                    $edit = $_POST['edit'];
                    $id = $_POST['id'];
                    $update[0] = "UPDATE data_sample SET nilai = '$nilai[0]' WHERE karyawan='$id' AND faktor='1'";
                    $update[1] = "UPDATE data_sample SET nilai = '$nilai[1]' WHERE karyawan='$id' AND faktor='2'";
                    $update[2] = "UPDATE data_sample SET nilai = '$nilai[2]' WHERE karyawan='$id' AND faktor='3'";
                    $update[3] = "UPDATE data_sample SET nilai = '$nilai[3]' WHERE karyawan='$id' AND faktor='4'";
                    $update[4] = "UPDATE data_sample SET nilai = '$nilai[4]' WHERE karyawan='$id' AND faktor='5'";
                    $update[5] = "UPDATE data_sample SET nilai = '$nilai[5]' WHERE karyawan='$id' AND faktor='6'";
                    $update[6] = "UPDATE data_sample SET nilai = '$nilai[6]' WHERE karyawan='$id' AND faktor='7'";
                    if($edit){
                        if($nilai==''){
                            echo "<br>Please fill this out!";
                        }else{
                            foreach($update as $i){
                                mysqli_query($conn, $i);
                            }
                            echo "
                            <script language script='javascript'>
                            document.location='edit_nilai.php?id=$id';
                            alert('Data berhasil dimasukkan');
                            </script>";
                        }
                    } 
                ?>
            </div>
        </section>
        <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        let searchBtn = document.querySelector(".bx-search");

        closeBtn.addEventListener("click", ()=>{
            sidebar.classList.toggle("open");
            menuBtnChange();//calling the function(optional)
        });

        searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
            sidebar.classList.toggle("open");
            menuBtnChange(); //calling the function(optional)
        });

        // following are the code to change sidebar button(optional)
        function menuBtnChange() {
        if(sidebar.classList.contains("open")){
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
        }else {
            closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
        }
        }
        </script>
    </body>
</html>