<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan - RumahHub</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background-color: #f4f6f9; color: #333; }
        
        .top-navbar { background: #fff; padding: 15px 40px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .logo-area { display: flex; align-items: center; gap: 10px; font-weight: 700; color: #1e3a8a; font-size: 20px; }
        .logo-area img.logo { height: 35px; }
        .nav-links-top { display: flex; gap: 20px; list-style: none; }
        .nav-links-top a { text-decoration: none; color: #4b5563; font-weight: 500; }
        .nav-links-top a.active, .nav-links-top a:hover { color: #1e3a8a; border-bottom: 2px solid #1e3a8a; padding-bottom: 2px; }

        .main-container { max-width: 1200px; margin: 40px auto; padding: 0 20px; display: grid; grid-template-columns: 260px 1fr; gap: 30px; }
        
        .sidebar { background: #fff; padding: 25px 20px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); height: fit-content; }
        .admin-profile { display: flex; align-items: center; gap: 12px; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #e5e7eb; }
        .admin-profile img { width: 45px; height: 45px; border-radius: 50%; object-fit: cover; }
        .admin-info h4 { font-size: 14px; color: #111827; }
        .admin-info span { font-size: 12px; color: #6b7280; }
        
        .sidebar-menu { display: flex; flex-direction: column; gap: 8px; }
        .sidebar-menu a { display: flex; align-items: center; gap: 12px; padding: 12px 15px; text-decoration: none; color: #4b5563; font-size: 14px; font-weight: 500; border-radius: 8px; transition: 0.2s; }
        .sidebar-menu a img { width: 20px; height: 20px; object-fit: contain; }
        .sidebar-menu a.active, .sidebar-menu a:hover { background-color: #eff6ff; color: #1e3a8a; }

        .content-card { background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
        .content-header h2 { font-size: 20px; color: #111827; margin-bottom: 6px; }
        .content-header p { font-size: 13px; color: #6b7280; margin-bottom: 25px; }

        .table-toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .search-box { padding: 8px 15px; border: 1px solid #d1d5db; border-radius: 6px; width: 220px; font-size: 13px; outline: none; }
        
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 14px; }
        th { background-color: #f9fafb; color: #374151; padding: 12px 15px; font-weight: 600; border-bottom: 1px solid #e5e7eb; }
        td { padding: 14px 15px; border-bottom: 1px solid #e5e7eb; color: #4b5563; }
        
        .btn { padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 500; cursor: pointer; border: none; text-decoration: none; display: inline-block; }
        .btn-detail { background-color: #2563eb; color: white; margin-right: 5px; }
        .btn-edit { background-color: #d97706; color: white; }
        .btn-delete { background-color: #dc2626; color: white; margin-left: 5px; }
        .btn:hover { opacity: 0.9; }
    </style>
</head>
<body>

    <header class="top-navbar">
        <div class="logo-area">
            <img src="../assets/logo.png" alt="Logo" class="logo">
            <span>RUMAHHUB</span>
        </div>
        <nav class="nav-links-top">
            <a href="../index.html">Home</a>
            <a href="../dashboard.html">Dashboard</a>
            <a href="../login.html" id="linkLogout">Keluar (Logout)</a>
        </nav>
    </header>

    <main class="main-container">
        <aside class="sidebar">
            <div class="admin-profile">
                <img src="../assets/icon_profile.png" alt="Profile">
                <div class="admin-info">
                    <h4>Selamat datang,</h4>
                    <span>Admin!</span>
                </div>
            </div>
            <div class="sidebar-menu">
                <a href="../daftar_properti/daftarproperti.html" class="menu-item">
                    <img src="../assets/icon_daftar_properti.png" alt="Icon"> Daftar Properti
                </a>
                <a href="../favorit.html" class="menu-item">
                    <img src="../assets/icon_favorit.png" alt="Icon"> Favorit
                </a>
                <a href="pesanan.html" class="menu-item active">
                    <img src="../assets/icon_pesanan.png" alt="Icon"> Pesanan
                </a>
                <a href="../pengaturan.html" class="menu-item">
                    <img src="../assets/icon_pengaturan.png" alt="Icon"> Pengaturan
                </a>
            </div>
        </aside>

        <section class="content-card">
            <div class="content-header">
                <h2>Dashboard Data Pesanan & Transaksi</h2>
                <p id="infoStatusServer">Kelola data transaksi dan pemesanan properti pengguna.</p>
            </div>

            <div class="table-toolbar">
                <!-- Event 1: Form Submit Event untuk Filter Pencarian -->
                <form id="formCari" style="display: flex; gap: 8px;">
                    <input type="text" id="inputCari" class="search-box" placeholder="Cari nama/ID transaksi...">
                    <button type="submit" class="btn btn-detail">Cari</button>
                </form>
                <span id="notifCopy" style="font-size: 12px; color: #2563eb; font-weight: 500;"></span>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No ID (Salin/Copy)</th>
                        <th>Nama Pemesan</th>
                        <th>Properti Dipilih</th>
                        <th>Tanggal Transaksi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="id-trx" style="cursor: pointer; font-weight: 600;">TRX-001</td>
                        <td>Budi Santoso</td>
                        <td>Green Valley Residence</td>
                        <td>06 Oktober 2026</td>
                        <td><span id="status-TRX-001" style="color: green; font-weight: bold;">Selesai</span></td>
                        <td>
                            <button class="btn btn-edit" onclick="ubahStatusLansung('TRX-001')">Edit Status</button>
                            <button class="btn btn-delete" onclick="hapusPesanan(this, 'TRX-001')">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="id-trx" style="cursor: pointer; font-weight: 600;">TRX-002</td>
                        <td>Siti Rahma</td>
                        <td>Royal Sky Apartment</td>
                        <td>07 Oktober 2026</td>
                        <td><span id="status-TRX-002" style="color: orange; font-weight: bold;">Pending</span></td>
                        <td>
                            <button class="btn btn-edit" onclick="ubahStatusLansung('TRX-002')">Edit Status</button>
                            <button class="btn btn-delete" onclick="hapusPesanan(this, 'TRX-002')">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <!-- SCRIPT JAVASCRIPT REVISI PESANAN -->
    <script>

        // 1. POPUP BOX 1: Prompt Box saat Edit Status
        function ubahStatusLansung(idTrx) {
            // POPUP 1: PROMPT BOX
            let statusBaru = prompt("Masukkan status transaksi baru untuk " + idTrx + " (Contoh: Selesai, Pending, Batal):", "Selesai");
            
            if (statusBaru && statusBaru.trim() !== "") {
                const elemStatus = document.getElementById("status-" + idTrx);
                if (elemStatus) {
                    elemStatus.innerText = statusBaru;
                    elemStatus.style.color = (statusBaru.toLowerCase() === "selesai") ? "green" : "orange";
                }

                // Web Storage (Local Storage)
                if (typeof(Storage) !== "undefined") {
                    localStorage.setItem("status_" + idTrx, statusBaru);
                }
            }
        }

        // 2. POPUP BOX 2: Confirm Box saat Hapus Pesanan
        function hapusPesanan(button, idTrx) {
            // POPUP 2: CONFIRM BOX
            let konfirmasi = confirm("Apakah Anda yakin ingin menghapus data transaksi " + idTrx + " secara permanen?");
            if (konfirmasi) {
                let baris = button.parentNode.parentNode;
                baris.remove();
                
                // Web Storage (Session Storage)
                if (typeof(Storage) !== "undefined") {
                    sessionStorage.setItem("lastDeleted", idTrx);
                }
            }
        }


        // 3. MULTIPLE EVENTS (EVENT TERBARU)

        // EVENT 1: submit Event pada Form Pencarian
        const formCari = document.getElementById("formCari");
        formCari.addEventListener("submit", function(e) {
            e.preventDefault(); // Mencegah reload halaman
            let keyword = document.getElementById("inputCari").value;
            alert("Memproses pencarian data pesanan untuk: \"" + keyword + "\"");
        });

        // EVENT 2: copy Event (Mendeteksi saat pengguna menyalin No ID Transaksi)
        const elemenID = document.querySelectorAll(".id-trx");
        elemenID.forEach(item => {
            item.addEventListener("copy", function() {
                const notifCopy = document.getElementById("notifCopy");
                notifCopy.innerText = "✓ No. ID disalin ke clipboard!";
                setTimeout(() => {
                    notifCopy.innerText = "";
                }, 2000);
            });
        });


        // 4. ASYNCHRONOUS, PROMISE & FETCH API
        window.addEventListener("load", function() {
            // Promise Async
            new Promise((resolve) => {
                setTimeout(() => {
                    resolve("Data transaksi terbaru berhasil disinkronkan.");
                }, 800);
            }).then(pesan => {
                console.log(pesan);
            });
        });

        fetch('https://jsonplaceholder.typicode.com/posts/1')
            .then(res => res.json())
            .then(data => {
                document.getElementById("infoStatusServer").innerText = "Sistem Server: Online & Terhubung (Database Aktif)";
            })
            .catch(() => {
                document.getElementById("infoStatusServer").innerText = "Gagal terhubung ke server utama.";
            });
    </script>
</body>
</html>