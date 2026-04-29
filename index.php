<?php
require_once 'koneksi.php';

$message = '';
$nama = '';
$nomor = '';
$tanggal = '';
$waktu = '';
$warna = '#f9a8d4';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, trim($_POST['nama'] ?? ''));
    $nomor = mysqli_real_escape_string($conn, trim($_POST['nomor'] ?? ''));
    $tanggal = mysqli_real_escape_string($conn, trim($_POST['tanggal'] ?? ''));
    $waktu = mysqli_real_escape_string($conn, trim($_POST['waktu'] ?? ''));
    $warna = mysqli_real_escape_string($conn, trim($_POST['warna'] ?? '#f9a8d4'));

    if ($nama === '') {
        $message = 'Nama harus diisi dulu ya!';
    } else {
        $insertSql = "INSERT INTO form_data (nama, nomor, tanggal, waktu, warna) VALUES ('$nama', '$nomor', '$tanggal', '$waktu', '$warna')";
        if (mysqli_query($conn, $insertSql)) {
            $message = 'Data berhasil disimpan ke database.';
            $nama = '';
            $nomor = '';
            $tanggal = '';
            $waktu = '';
            $warna = '#f9a8d4';
        } else {
            $message = 'Gagal menyimpan data: ' . mysqli_error($conn);
        }
    }
}

$result = mysqli_query($conn, 'SELECT * FROM form_data ORDER BY id DESC');
$rows = $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reva Dwi Nurrahma</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="petal petal-1"></div>
    <div class="petal petal-2"></div>
    <div class="petal petal-3"></div>
    <div class="petal petal-4"></div>
    <div class="petal petal-5"></div>

    <header class="site-header">
        <div class="header-inner">
            <span class="header-deco">*</span>
            <h1 class="site-title">Reva Dwi Nurrahma</h1>
            <span class="header-deco">*</span>
        </div>
        <p class="site-subtitle">My Sweet Little Page</p>
    </header>

    <main class="container">

        <?php if ($message): ?>
            <div class="message-box"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <section class="headings-section card">
            <h2 class="section-label">Typography</h2>
            <h1>Heading 1</h1>
            <h2>Heading 2</h2>
            <h3>Heading 3</h3>
            <h4>Heading 4</h4>
            <h5>Heading 5</h5>
            <h6>Heading 6</h6>
        </section>

        <section class="image-section card">
            <h2 class="section-label">Gallery</h2>
            <div class="img-wrapper">
                <img src="gambarkucing.JPG" alt="Gallery Image" width="300">
            </div>
        </section>

        <section class="article-section card">
            <aside class="sidebar">
                <p> aku baru belajar web ketika masuk ummi</p>
            </aside>

            <article>
                <h2>Ini Artikel</h2>
                <p>menurut saya genre film horror adalah genre terburuh</p>
                <h3>Subjudul</h3>
                <p>soal nya kebanyakan gimmik dan jumpscare gk jelas</p>
            </article>
        </section>

        <section class="form-section card">
            <h2 class="section-label">Formulir</h2>
            <form action="" method="post">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($nama) ?>" placeholder="Masukkan nama kamu...">
                    </div>

                    <div class="form-group">
                        <label for="nomor">Nomor</label>
                        <input type="number" id="nomor" name="nomor" value="<?= htmlspecialchars($nomor) ?>" placeholder="Masukkan nomor...">
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" value="<?= htmlspecialchars($tanggal) ?>">
                    </div>

                    <div class="form-group">
                        <label for="waktu">Waktu</label>
                        <input type="time" id="waktu" name="waktu" value="<?= htmlspecialchars($waktu) ?>">
                    </div>

                    <div class="form-group">
                        <label for="warna">Warna Favorit</label>
                        <input type="color" id="warna" name="warna" value="<?= htmlspecialchars($warna) ?>">
                    </div>
                </div>

                <button type="submit" class="btn-submit">Kirim</button>
            </form>
        </section>

        <section class="table-section card">
            <h2 class="section-label">Data Tabel</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nomor</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Warna</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($rows) > 0): ?>
                            <?php foreach ($rows as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['nama']) ?></td>
                                    <td><?= htmlspecialchars($row['nomor']) ?></td>
                                    <td><?= htmlspecialchars($row['tanggal']) ?></td>
                                    <td><?= htmlspecialchars($row['waktu']) ?></td>
                                    <td><span class="color-swatch" style="background: <?= htmlspecialchars($row['warna']) ?>;"></span> <?= htmlspecialchars($row['warna']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="no-data">Belum ada data. Submit form untuk menambahkan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    <footer class="site-footer">
        <div class="footer-deco">- - -</div>
        <p>&copy; By <span class="footer-name">Deffa Haidar</span></p>
        <div class="footer-deco">- - -</div>
    </footer>

<script src="script.js"></script>

</body>
</html>
