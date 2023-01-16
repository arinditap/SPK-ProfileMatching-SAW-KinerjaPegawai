<?php
    $conn = mysqli_connect("localhost", "root", "", "spk");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home | SPK Profile Matching</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="fontAwesome/css/fontawesome.min.css">
        <link rel="stylesheet" href="fontAwesome/css/all.min.css">
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
        <div class="sidebar">
            <div class="logo-details">
                <i class='bx bxs-shield icon'></i>
                <div class="logo_name">SPK Profile Matching</div>
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
            <div class="header">SISTEM PENDUKUNG KEPUTUSAN PENILAIAN KINERJA TENAGA PENGAJAR
                    <br>SDN GUYUNG 2
            </div>
            <ul>
                <li>
                    <div class='box-index'>
                        <div class="title">ALTERNATIF</div>
                        <div class="form">
                                <?php 
                            $q = "SELECT * FROM data_alternatif";
                            $k = mysqli_query($conn, $q);
                            $j = mysqli_num_rows($k); 
                            ?>
                            <b> <?php echo $j; ?></b>
                        </div>
                    </div>
                </li>
                <li>
                    <div class='box-index'>
                        <div class="title">KRITERIA</div>
                        <?php 
                            $q = "SELECT * FROM data_kriteria";
                            $k = mysqli_query($conn, $q);
                            $j = mysqli_num_rows($k); 
                            ?>
                            <b> <?php echo $j; ?></b>
                        </div> 
                    </div>
                </li>
                <li>
                    <div class='box-index'>
                        <div class="title">SUBKRITERIA</div>
                        <div class="form">
                                <?php 
                            $q = "SELECT * FROM data_subkriteria";
                            $k = mysqli_query($conn, $q);
                            $j = mysqli_num_rows($k); 
                            ?>
                            <b> <?php echo $j; ?></b>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="text">
                <p>
                    Sistem ini membantu dalam mengambil keputusan pada penilaian tenaga pengajar di SDN Guyung 2.
                    Penilaian dilakukan dengan menggunakan 2 metode Profile Matching dan metode SAW.
                </p>
                <p>
                    Langkah-langkah yang dilakukan dalam penilaian menggunakan metode Profile Matching:
                    <br>1. Melakukan pembobotan
                    <br>2. Menghitung Core Factor dan Secondary Factor berdasarkan pengelompokkannya
                    <br>3. Menghitung Nilai Total berdasarkan persentase Core Factor dan Secondary Factor yang diperkirakan berpengaruh 
                    terhadap kinerja tiap alternatif 
                    <br>4. Perankingan berdasarkan Nilai Total menggunakan rumus yang ada
                </p>
                <p>
                    Langkah-langkah yang dilakukan dalam penilaian menggunakan metode SAW:
                    <br>1. Menentukan kriteria yang akan dijadikan acuan dalam penilaian (sudah ada dalam database subkriteria)
                    <br>2. Menentukan bobot untuk masing-masing kriteria (sudah ada dalam database subkriteria) 
                    <br>3. Melakukan normalisasi matriks keputusan dengan melakukan proses perbandingan pada semua nilai alternative yang ada
                    <br>4. Menghitung nilai preferensi untuk tiap alternatif
                </p>
            </div>
            
        </section>
        <section class= "footer">
            <p>&copy; 2021 L200180058| Arindita Prihastama</p>
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