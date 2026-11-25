<?php
session_start();

// Cek apakah user sudah login atau belum
if (!isset($_SESSION['user_rumahhub'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - RumahHub</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="navbar">
        <div class="logo-container">
            <img src="assets/logo.png" alt="Logo" class="logo">
            <span class="brand-title">RUMAHHUB</span>
        </div>
        <nav class="nav-links">
            <a href="index.php">Home</a>
            <a href="dashboard.php" class="active">Dashboard</a>
            <!-- Tombol Keluar diarahkan ke logout.php untuk menghapus session -->
            <a href="logout.php" id="btnKeluar">Keluar (Logout)</a>
        </nav>
    </header>

    <main class="main-container">
        <div class="dashboard-container">
            <!-- Sidebar Navigasi -->
            <aside class="sidebar">
                <div class="user-profile">
                    <img src="assets/icon_profile.png" alt="Profile" id="fotoAdmin">
                    <div>
                        <h4>Selamat datang,</h4>
                        <!-- Menampilkan nama pengguna yang sedang login dari Session PHP -->
                        <span><?php echo htmlspecialchars($_SESSION['user_rumahhub']); ?></span>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <a href="properti/properti.php" class="menu-item">
                        <img src="assets/icon_daftar_properti.png" alt="Icon"> Daftar Properti
                    </a>
                    <a href="favorit.php" class="menu-item">
                        <img src="assets/icon_favorit.png" alt="Icon"> Favorit
                    </a>
                    <a href="pesanan/pesanan.php" class="menu-item">
                        <img src="assets/icon_pesanan.png" alt="Icon"> Pesanan
                    </a>
                    <a href="pengaturan.php" class="menu-item">
                        <img src="assets/icon_pengaturan.png" alt="Icon"> Pengaturan
                    </a>
                </div>
            </aside>

            <!-- Konten Utama Dashboard -->
            <section class="dashboard-content">
                <div class="dashboard-header">
                    <h2>Dashboard Utama RumahHub</h2>
                    <p>Kelola sistem dan preferensi tampilan dashboard secara interaktif.</p>
                </div>

                <div class="table-card" style="padding: 25px;">
                    <h3>Pengaturan Mode & Quick Action:</h3>
                    
                    <!-- Event 1: Change Event pada Dropdown Tema -->
                    <div style="margin: 15px 0;">
                        <label for="pilihTema" style="font-weight: 500;">Pilih Mode Tampilan Dashboard: </label>
                        <select id="pilihTema" style="padding: 6px 12px; border-radius: 6px; border: 1px solid #cbd5e0;">
                            <option value="light">Mode Terang (Default)</option>
                            <option value="dark">Mode Gelap (Dark Mode)</option>
                        </select>
                    </div>

                    <!-- Filter / Quick Action -->
                    <button id="btnBukaCatatan" style="padding: 8px 16px; background: #3182ce; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 500;">+ Tambah Catatan Admin</button>
                    
                    <div id="kotakCatatan" style="margin-top: 15px; padding: 12px; background: #e2e8f0; border-radius: 6px; display: none;">
                        <b>Catatan Tersimpan:</b> <span id="teksCatatan">-</span>
                    </div>

                    <p id="infoServer" style="margin-top: 20px; font-size: 0.85rem; color: #4a5568;"></p>
                </div>
            </section>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 RumahHub - Katalog Hunian & Properti</p>
    </footer>

    <!-- SCRIPT JAVASCRIPT REVISI DASHBOARD -->
    <script>
    
        // 1. POPUP BOX 1: Prompt Box untuk Tambah Catatan Admin
 
        const btnBukaCatatan = document.getElementById("btnBukaCatatan");
        btnBukaCatatan.addEventListener("click", function() {
            // POPUP 1: PROMPT BOX
            let catatan = prompt("Masukkan catatan pengingat harian Admin:", "Periksa berkas pengajuan properti hari ini");
            
            if (catatan && catatan.trim() !== "") {
                document.getElementById("kotakCatatan").style.display = "block";
                document.getElementById("teksCatatan").innerText = catatan;

                // Web Storage (Session Storage)
                if (typeof(Storage) !== "undefined") {
                    sessionStorage.setItem("catatanAdmin", catatan);
                }
            }
        });


     
        // 2. MULTIPLE EVENTS (EVENT TERBARU)

        // EVENT 1: change Event (Mengubah tema tampilan secara langsung)
        const pilihTema = document.getElementById("pilihTema");

        function terapkanTema(mode) {
            const container = document.querySelector(".dashboard-container");
            const card = document.querySelector(".table-card");
            const judul = document.querySelector(".dashboard-header h2");
            const catatanBox = document.getElementById("kotakCatatan");
            const infoServer = document.getElementById("infoServer");

            if (mode === "dark") {
                container.style.backgroundColor = "#2d3748";
                container.style.color = "#ffffff";
                if (card) {
                    card.style.backgroundColor = "#1a202c";
                    card.style.color = "#f7fafc";
                }
                if (judul) {
                    judul.style.color = "#ffffff";
                }
                if (catatanBox) {
                    catatanBox.style.backgroundColor = "#4a5568";
                    catatanBox.style.color = "#ffffff";
                }
                if (infoServer) {
                    infoServer.style.color = "#cbd5e0";
                }
            } else {
                container.style.backgroundColor = "#ffffff";
                container.style.color = "#333333";
                if (card) {
                    card.style.backgroundColor = "#ffffff";
                    card.style.color = "#333333";
                }
                if (judul) {
                    judul.style.color = "";
                }
                if (catatanBox) {
                    catatanBox.style.backgroundColor = "#e2e8f0";
                    catatanBox.style.color = "#1a202c";
                }
                if (infoServer) {
                    infoServer.style.color = "#4a5568";
                }
            }
        }

        pilihTema.addEventListener("change", function() {
            let mode = this.value;
            terapkanTema(mode);

            // Web Storage (Local Storage)
            if (typeof(Storage) !== "undefined") {
                localStorage.setItem("temaDashboard", mode);
            }
        });

        // EVENT 2: click Event dengan POPUP BOX 2 (Confirm Box untuk Logout)
        const btnKeluar = document.getElementById("btnKeluar");
        btnKeluar.addEventListener("click", function(e) {
            // POPUP 2: CONFIRM BOX
            let yakin = confirm("Apakah Anda yakin ingin keluar dari Dashboard Admin?");
            if (!yakin) {
                e.preventDefault(); // Batalkan navigasi jika diklik Cancel
            }
        });

        // EVENT 3: contextmenu Event (Mencegah atau memberikan konfirmasi klik kanan pada foto profil)
        const fotoAdmin = document.getElementById("fotoAdmin");
        fotoAdmin.addEventListener("contextmenu", function(e) {
            e.preventDefault(); // Mencegah menu konteks bawaan browser
            alert("Akses opsi foto profil dikunci oleh Sistem Keamanan RumahHub!");
        });


        // 3. ASYNCHRONOUS, PROMISE & FETCH API

        // Load awal data dari Web Storage & Promise
        window.addEventListener("load", function() {
            // Cek session storage catatan & local storage tema
            if (typeof(Storage) !== "undefined") {
                let savedNote = sessionStorage.getItem("catatanAdmin");
                if (savedNote) {
                    document.getElementById("kotakCatatan").style.display = "block";
                    document.getElementById("teksCatatan").innerText = savedNote;
                }

                let savedTheme = localStorage.getItem("temaDashboard");
                if (savedTheme) {
                    pilihTema.value = savedTheme;
                    terapkanTema(savedTheme);
                }
            }

            // Simulasi Promise Async
            new Promise((resolve) => {
                setTimeout(() => {
                    resolve("Status Server: Aktif & Terhubung");
                }, 1000);
            }).then(msg => {
                document.getElementById("infoServer").innerText = msg;
            });
        });

        // Fetch API
        fetch('https://jsonplaceholder.typicode.com/users/1')
            .then(res => res.json())
            .then(data => console.log("Fetch Server Berhasil:", data.name))
            .catch(err => console.error(err));
    </script>
</body>
</html>