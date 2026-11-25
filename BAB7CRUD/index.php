<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RumahHub - Katalog Hunian & Properti</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="navbar">
        <div class="logo-container">
            <img src="assets/logo.png" alt="Logo" class="logo">
            <span class="brand-title">RUMAHHUB</span>
        </div>
        <nav class="nav-links">
            <a href="index.php" class="active">Home</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="login.php">Login</a>
        </nav>
    </header>
    <main class="main-container">
        <section class="hero-banner">
            <div class="hero-text">
                <h1 id="demo">Temukan Hunian Impian Anda Bersama RumahHub</h1>
                <p>Platform terpercaya untuk mencari rumah, apartemen, dan properti idaman dengan mudah dan cepat.</p>
            </div>
            <div class="hero-image">
                <img src="assets/banner_properti2.jpg" alt="Banner Properti">
            </div>
        </section>

        <section class="property-category">
            <h2>Kategori Properti Pilihan</h2>
            <p class="subtitle">Jelajahi berbagai pilihan properti terbaik untuk Anda.</p>

            <!-- Kontrol DOM Interaktif untuk Katalog -->
            <div style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center; margin-bottom: 18px; padding: 12px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px;">
                <input type="text" id="cariProperti" placeholder="Cari properti atau lokasi..." style="padding: 7px 12px; border: 1px solid #cbd5e0; border-radius: 6px; flex: 1; min-width: 180px;">

                <select id="filterKategori" style="padding: 7px 12px; border: 1px solid #cbd5e0; border-radius: 6px;">
                    <option value="all">Semua Kategori</option>
                    <option value="rumah">Rumah</option>
                    <option value="apartemen">Apartemen</option>
                    <option value="ruko">Ruko</option>
                </select>

                <button type="button" id="btnSorotUnggulan" style="padding: 7px 14px; background: #2b6cb0; color: #fff; border: none; border-radius: 6px; cursor: pointer;">
                    Sorot Rekomendasi
                </button>
            </div>

            <p id="infoJumlahTampil" style="font-size: 0.9rem; color: #4a5568; margin-bottom: 14px;"></p>

            <div class="card-grid" id="gridProperti">
                <div class="card" data-kategori="rumah" data-unggulan="true">
                    <img src="assets/rumah_minimalis.jpg" alt="Rumah Minimalis">
                    <div class="card-body">
                        <h3>Rumah Minimalis</h3>
                        <p>Nyaman, modern, dan strategis di area hunian.</p>
                    </div>
                </div>
                <div class="card" data-kategori="apartemen" data-unggulan="false">
                    <img src="assets/apartemen_modern.jpg" alt="Apartemen Modern">
                    <div class="card-body">
                        <h3>Apartemen Modern</h3>
                        <p>Fasilitas lengkap, hidup praktis dekat pusat kota.</p>
                    </div>
                </div>
                <div class="card" data-kategori="ruko" data-unggulan="true">
                    <img src="assets/ruko_komersial.jpg" alt="Ruko Komersial">
                    <div class="card-body">
                        <h3>Ruko Komersial</h3>
                        <p>Investasi terbaik di jalur ramai untuk usaha.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Elemen Toast / Snackbar -->
    <div id="toast">Notifikasi Sistem</div>

    <footer>
        <p>&copy; 2026 RumahHub - Katalog Hunian & Properti</p>
    </footer>

    <script>
        const inputCari = document.getElementById("cariProperti");
        const selectKategori = document.getElementById("filterKategori");
        const btnSorot = document.getElementById("btnSorotUnggulan");
        const infoJumlah = document.getElementById("infoJumlahTampil");
        const cards = document.querySelectorAll("#gridProperti .card");

        let modeSorot = false;

        // DOM 1 & DOM 2: Filter & pencarian real-time (ubah display style & teks info)
        function perbaruiKatalog() {
            const kataKunci = inputCari.value.trim().toLowerCase();
            const kategoriDipilih = selectKategori.value;
            let jumlahTerlihat = 0;

            cards.forEach((card) => {
                const teksCard = card.innerText.toLowerCase();
                const kategoriCard = card.getAttribute("data-kategori");

                const cocokKata = teksCard.includes(kataKunci);
                const cocokKategori = (kategoriDipilih === "all") || (kategoriCard === kategoriDipilih);

                if (cocokKata && cocokKategori) {
                    card.style.display = "";
                    jumlahTerlihat++;
                } else {
                    card.style.display = "none";
                }
            });

            infoJumlah.textContent = "Menampilkan " + jumlahTerlihat + " dari " + cards.length + " pilihan properti.";
        }

        // DOM 3: Toggle atribut & style highlight pada kartu rekomendasi
        btnSorot.addEventListener("click", function () {
            modeSorot = !modeSorot;

            cards.forEach((card) => {
                const isUnggulan = card.getAttribute("data-unggulan") === "true";
                if (modeSorot && isUnggulan) {
                    card.style.outline = "3px solid #3182ce";
                    card.setAttribute("data-tersorot", "true");
                } else {
                    card.style.outline = "";
                    card.setAttribute("data-tersorot", "false");
                }
            });

            btnSorot.textContent = modeSorot ? "Matikan Sorotan" : "Sorot Rekomendasi";
            tampilkanToast(modeSorot ? "Properti rekomendasi disorot" : "Sorotan dimatikan");
        });

        inputCari.addEventListener("input", perbaruiKatalog);
        selectKategori.addEventListener("change", perbaruiKatalog);

        function tampilkanToast(pesan) {
            const toast = document.getElementById("toast");
            if (!toast) return;
            toast.textContent = pesan;
            toast.className = "show";
            setTimeout(() => {
                toast.className = toast.className.replace("show", "");
            }, 2500);
        }

        perbaruiKatalog();
    </script>
</body>
</html>