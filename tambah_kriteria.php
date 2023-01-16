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
            <div class="header">Tambah Data Kriteria</div>
            <div class='content'>
                <div class='wrapper'>
                    <div class='title'>Masukkan Data Kriteria</div>
                    <form class='form' method='POST' action='tambah_kriteria.php' onSubmit="return validasi()">
                            <div class='input_field'>
                                <label>ID</label>
                                <input type='text' class='input' name='id_aspek' required oninvalid="this.setCustomValidity('Harus diisi')" oninput="setCustomValidity('')">
                            </div>
                            <div class='input_field'>
                                <label>Nama Kriteria</label>
                                <input type='text' class='input' name='nama_aspek' required oninvalid="this.setCustomValidity('Harus diisi')" oninput="setCustomValidity('')">
                            </div>
                            <div class='input_field'>
                                <label>Bobot Kriteria [%]</label>
                                <input type='text' class='input' name='bobot' required oninvalid="this.setCustomValidity('Harus diisi')" oninput="setCustomValidity('')">
                            </div>
                            <div class='input_field'>
                                <label>Persentase CF [%]</label>
                                <input type='text' class='input' name='bobot_core' required oninvalid="this.setCustomValidity('Harus diisi')" oninput="setCustomValidity('')">
                            </div>
                            <div class='input_field'>
                                <label>Persentase SF [%]</label>
                                <input type='text' class='input' name='bobot_secondary' required oninvalid="this.setCustomValidity('Harus diisi')" oninput="setCustomValidity('')">
                            </div>
                            <div class='input_field'>
                                <input type='submit' class='btn' value='Masukkan' name='submit' >
                            </div>
                    </form>
                    <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'spk');
                        error_reporting(E_ALL ^ E_NOTICE);
                        $id_aspek = $_POST['id_aspek'];
                        $nama_aspek = $_POST['nama_aspek'];
                        $bobot = $_POST['bobot'];
                        $bobot_core = $_POST['bobot_core'];
                        $bobot_secondary = $_POST['bobot_secondary'];
                        $submit = $_POST['submit'];
                        $input = "INSERT INTO data_kriteria(id_aspek, nama_aspek, bobot, bobot_core, bobot_secondary) VALUE ('$id_aspek', 
                        '$nama_aspek', '$bobot', '$bobot_core', '$bobot_secondary')";
                        if($submit){
                            if($id_aspek==''){
                                echo "<br>Please fill this out!";
                            }elseif($nama_aspek==''){
                                echo "<br>Please fill this out!";
                            }elseif($bobot==''){
                                echo "<br>Please fill this out!";
                            }elseif($bobot_core==''){
                                echo "<br>Please fill this out!";
                            }elseif($bobot_secondary==''){
                                echo "<br>Please fill this out!";
                            }else{
                                mysqli_query($conn, $input);
                                echo "<script language script='javascript'>
                                alert('Data berhasil ditambahkan');
                                document.location='data_kriteria.php';
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