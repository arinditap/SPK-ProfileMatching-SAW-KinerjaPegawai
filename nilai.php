<?php
    $conn = mysqli_connect("localhost", "root", "", "spk2");
    $id = $_GET['id'];
    $sql = "SELECT * FROM dt_altern, dt_sub, dt_sample WHERE dt_altern.id_altern=dt_sample.alt AND dt_sub.id_sub = 
    dt_sample.sub AND dt_sample.alt='$id'";
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
                    <?php while($data = mysqli_fetch_array($hasil)){ ?>
                        <div class='input_field'>
                            <label>ID Alternatif</label>
                            <label><?= $data[1]?></label>
                        </div>
                        <div class='input_field'>
                            <label><?= $data[4]?></label>
                            <input type='text' class='input' name='nilai' required value="<?= $data[12]?>">
                        </div>
                        <?php } ?>
                        <div class='input_field'>
                            <input type='submit' class='btn' value='Edit' name='edit'>
                        </div>
                </form>
                <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'spk');
                    error_reporting(E_ALL ^ E_NOTICE);
                    $nilai = $_POST['nilai'];
                    $edit = $_POST['edit'];
                    $update = "UPDATE data_sample SET nilai = '$nilai' WHERE data_subkriteria.id_sub = data_sample.faktor'";
                    if($edit){
                        if($nilai==''){
                            echo "<br>Please fill this out!";
                        }else{
                            mysqli_query($conn, $update);
                            echo "<script language script='javascript'>
                            alert('Data berhasil dimasukkan');
                            document.location='data_alternatif.php';
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