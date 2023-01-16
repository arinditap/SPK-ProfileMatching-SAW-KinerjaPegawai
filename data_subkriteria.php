<?php
    $conn = mysqli_connect("localhost", "root", "", "spk");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Data Sub Kriteria | SPK Profile Matching</title>
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
        <section class = "home-section">
            <div class="header">Data Subkriteria</div>
            <div class="text">
                <table class = 'content-table' border = '1' width = '98%'>
                    <tr>
                        <th align='center' width='10%'><b>No.</b></th>
                        <th align='center' width='15%'><b>Nama Kriteria</b></th>
                        <th align='center' width='15%'><b>Nama Sub Kriteria</b></th>
                        <th align='center' width='10%'><b>Jenis Faktor</b></th>
                        <th align='center' width='10%'><b>Nilai Target PM</b></th>
                        <th align='center' width='10%'><b>Bobot Standar SAW (W)</b></th>
                        <th align='center' width='10%'><b>Atribut</b></th>
                        <th align='center' width='10%'><!---<button><a href="tambah_sub.php"><i class="fas fa-plus-square"></i></a></button>--></th>
                    </tr>
                    <?php
                        $no = 1;
                        $cari = "SELECT * FROM data_kriteria, data_subkriteria WHERE data_kriteria.id_aspek = data_subkriteria.kriteria 
                        ORDER BY data_subkriteria.id_sub";
                        $hasil = mysqli_query($conn, $cari);
                        while($data = mysqli_fetch_row($hasil)){ 
                    ?>
                    <tr>
                        <td align='center'><?= $no++; ?></td>
                        <td align='center'><?= $data[1] ?></td>
                        <td align='center'><?= $data[8] ?></td>
                        <td align='center'><?= $data[11] ?></td>
                        <td align='center'><?= $data[9] ?></td>
                        <td align='center'><?= $data[10] ?></td>
                        <td align='center'><?= $data[12] ?></td>
                        <td>
                            <center>
                                <a href="edit_sub.php?id=<?= $data[6];?>"><i class="fas fa-edit"></i></a> |
                                <a href="hapus_sub.php?id=<?= $data[6];?>" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')"><i class="far fa-trash-alt"></i></a>
                            </center>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <table border='1' class="content-table">
                    <td>
                        Keterangan:</br><br>
                        <ul>
                            <li>PM = Profile Matching</li><br>
                            <li>SAW = Metode SAW</li><br>
                            <li>Nilai Target PM = Nilai target yang harus dicapai alternatif untuk perhitungan metode Profile Matching</li><br>
                            <li>Jenis Faktor C = Core, S = Secondary</li>
                        </ul>
                    </td>
                </table>
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