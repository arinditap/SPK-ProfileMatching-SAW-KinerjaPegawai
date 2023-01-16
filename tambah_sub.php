<?php
    $conn = mysqli_connect("localhost", "root", "", "spk");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Data Alternatif | SPK Profile Matching</title>
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
        <section class = "home-section">
            <div class="header">Tambah Data Subkriteria</div>
            <div class='content'>
                <div class='wrapper'>
                    <div class='title'>Masukkan Data SubKriteria</div>
                    <form class='form' method='POST' action='tambah_sub.php' onSubmit="return validasi()">
                            <div class='input_field'>
                                <label>ID SubKriteria</label>
                                <input type='text' class='input' name='id_sub'>
                            </div>
                            <div class='input_field'>
                                <label>Kriteria</label>
                                <select class='input' name='kriteria'>
                                    <option disabled selected>Pilih</option>
                                    <?php 
                                        $q = "SELECT * FROM data_kriteria";
                                        $k = mysqli_query($conn, $q);
                                        while($d = mysqli_fetch_row($k)){ ?>
                                        <option value='<?=$d[0]?>'><?=$d[1]?></option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class='input_field'>
                                <label>Nama Sub Kriteria</label>
                                <input type='text' class='input' name='nama_sub'>
                            </div>
                            <div class='input_field'>
                                <label>Jenis Faktor</label>
                                <input type='radio' class='radio' name='jenis' value='C'>Core Factor
                                <input type='radio' class='radio' name='jenis' value='S'>Secondary Factor
                            </div>
                            <div class='input_field'>
                                <label>Nilai Target PM</label>
                                <input type='text' class='input' name='bobot_standar_pm' placeholder='1-5'>
                            </div>                            
                            <div class='input_field'>
                                <label>Bobot Standar SAW (W)</label>
                                <input type='text' class='input' name='bobot_standar_saw' placeholder='0-1'>
                            </div>
                            <div class='input_field'>
                                <label>Atribut</label>
                                <input type='radio' class='radio' name='jns_saw' value='Benefit'>Benefit &nbsp
                                <input type='radio' class='radio' name='jns_saw' value='Cost'>Cost
                            </div>
                            <div class='input_field'>
                                <input type='submit' class='btn' value='Masukkan' name='submit'>
                            </div>
                    </form>
                    <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'spk');
                        error_reporting(E_ALL ^ E_NOTICE);
                        $id_sub = $_POST['id_sub'];
                        $kriteria = $_POST['kriteria'];
                        $nama_sub = $_POST['nama_sub'];
                        $jenis = $_POST['jenis'];
                        $bobot_pm = $_POST['bobot_standar_pm'];
                        $bobot_saw = $_POST['bobot_standar_saw'];
                        $jns_saw = $_POST['jns_saw'];
                        $submit = $_POST['submit'];
                        $input = "INSERT INTO data_subkriteria(id_sub, kriteria, nama_sub, bobot_standar_pm, bobot_standar_saw, jenis, 
                        jns_saw) VALUES ('$id_sub', '$kriteria', '$nama_sub', '$bobot_pm', '$bobot_saw', '$jenis', '$jns_saw') ";
                        if($submit){
                            if($id_sub==''){
                                echo "<br>Please fill this out!";
                            }else{
                                mysqli_query($conn, $input);
                                echo "<script>
                                alert('Data berhasil dimasukkan');
                                document.location='data_subkriteria.php';
                                </script>";
                            }
                        }
                    ?>
                </div>
            </div>
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