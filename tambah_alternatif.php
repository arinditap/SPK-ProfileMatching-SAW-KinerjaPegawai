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
            <div class="header">Tambah Data Alternatif</div>
            <div class='content'>
                <div class='wrapper'>
                    <div class='title'>Masukkan Data Alternatif</div>
                    <form class='form' method='POST' action='tambah_alternatif.php' onSubmit="return validasi()">
                            <div class='input_field'>
                                <label>ID</label>
                                <input type='number' class='input' name='id_karyawan' required oninvalid="this.setCustomValidity('Harus diisi')" oninput="setCustomValidity('')">
                            </div>
                            <div class='input_field'>
                                <label>Nama</label>
                                <input type='text' class='input' name='nama_karyawan'required oninvalid="this.setCustomValidity('Harus diisi')" oninput="setCustomValidity('')">
                            </div>
                            <div class='title'>Nilai</div>
                            <div class='input_field'>
                                <label>Tugas Utama</label>
                                <input type="hidden" name="faktor" value="1">
                                <input type='text' class='input' name='nilai[]' required oninvalid="this.setCustomValidity('Harus diisi')" oninput="setCustomValidity('')">
                            </div>
                            <div class='input_field'>
                                <label>Tugas Penunjang</label>
                                <input type="hidden" name="faktor" value="2">
                                <input type='text' class='input' name='nilai[]' required oninvalid="this.setCustomValidity('Harus diisi')" oninput="setCustomValidity('')">
                            </div>
                            <div class='input_field'>
                                <label>Orientasi</label>
                                <input type="hidden" name="faktor" value="3">
                                <input type='text' class='input' name='nilai[]' required oninvalid="this.setCustomValidity('Harus diisi')" oninput="setCustomValidity('')">
                            </div>
                            <div class='input_field'>
                                <label>Integritas</label>
                                <input type="hidden" name="faktor" value="4">
                                <input type='text' class='input' name='nilai[]' required oninvalid="this.setCustomValidity('Harus diisi')" oninput="setCustomValidity('')">
                            </div>
                            <div class='input_field'>
                                <label>Komitmen</label>
                                <input type="hidden" name="faktor" value="5">
                                <input type='text' class='input' name='nilai[]' required oninvalid="this.setCustomValidity('Harus diisi')" oninput="setCustomValidity('')">
                            </div>
                            <div class='input_field'>
                                <label>Disiplin</label>
                                <input type="hidden" name="faktor" value="6">
                                <input type='text' class='input' name='nilai[]' required oninvalid="this.setCustomValidity('Harus diisi')" oninput="setCustomValidity('')">
                            </div>
                            <div class='input_field'>
                                <label>Kerjasama</label>
                                <input type="hidden" name="faktor" value="7">
                                <input type='text' class='input' name='nilai[]' required oninvalid="this.setCustomValidity('Harus diisi')" oninput="setCustomValidity('')">
                            </div>
                            <div class='input_field'>
                                <input type='submit' class='btn' value='Masukkan' name='submit'>
                            </div>
                    </form>
                    <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'spk');
                        error_reporting(E_ALL ^ E_NOTICE);
                        $id_karyawan = $_POST['id_karyawan'];
                        $nama_karyawan = $_POST['nama_karyawan'];
                        $nilai = $_POST['nilai'];
                        $submit = $_POST['submit'];
                        $input[0] = "INSERT INTO data_alternatif(id_karyawan, nama_karyawan) VALUE ('$id_karyawan', '$nama_karyawan')";
                        $input[1] = "INSERT INTO data_sample(id_sample, karyawan, faktor, nilai) VALUE ('', '$id_karyawan', '1', '$nilai[0]')";
                        $input[2] = "INSERT INTO data_sample(id_sample, karyawan, faktor, nilai) VALUE ('', '$id_karyawan', '2', '$nilai[1]')";
                        $input[3] = "INSERT INTO data_sample(id_sample, karyawan, faktor, nilai) VALUE ('', '$id_karyawan', '3', '$nilai[2]')";
                        $input[4] = "INSERT INTO data_sample(id_sample, karyawan, faktor, nilai) VALUE ('', '$id_karyawan', '4', '$nilai[3]')";
                        $input[5] = "INSERT INTO data_sample(id_sample, karyawan, faktor, nilai) VALUE ('', '$id_karyawan', '5', '$nilai[4]')";
                        $input[6] = "INSERT INTO data_sample(id_sample, karyawan, faktor, nilai) VALUE ('', '$id_karyawan', '6', '$nilai[5]')";
                        $input[7] = "INSERT INTO data_sample(id_sample, karyawan, faktor, nilai) VALUE ('', '$id_karyawan', '7', '$nilai[6]')";
                        if($submit){
                            if($id_karyawan==''){
                                echo "<br>Please fill this out!";
                            }elseif($nama_karyawan==''){
                                echo "<br>Please fill this out!";
                            }else{
                                foreach($input as $i){
                                    mysqli_query($conn, $i);
                                }
                                echo "<script>
                                alert('Data berhasil ditambahkan');
                                document.location='data_alternatif.php';
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