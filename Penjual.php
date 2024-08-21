<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Total Harga Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group button {
            padding: 10px 15px;
            background-color: #667BC;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .result {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Hitung Total Harga Buku</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="jumlahBuku">Jumlah Buku:</label>
            <input type="number" id="jumlahBuku" name="jumlahBuku" min="1" required>
        </div>
        <div class="form-group">
            <button type="submit" style="background-color:blue">Hitung Harga</button>
        </div>
    </form>

    <?php

    function hitungTotalHarga($jumlahBuku) {
        $eksemplarPerBuku = 10;
        $hargaPerEksemplar = 5000;
        $jumlahEksemplar = $jumlahBuku * $eksemplarPerBuku;
        $totalHarga = 0;
        $diskonTotal = 0;

        if ($jumlahEksemplar <= 100) {
            // Tidak ada diskon
            $totalHarga = $jumlahEksemplar * $hargaPerEksemplar;
            $diskonTotal = 0;
        } elseif ($jumlahEksemplar <= 200) {
            // 100 eksemplar pertama diskon 5%
            $harga100Pertama = 100 * $hargaPerEksemplar * 0.95;
            $diskon100Pertama = 100 * $hargaPerEksemplar * 0.05;

            // Sisanya diskon 15%
            $jumlahSisa = $jumlahEksemplar - 100;
            $hargaSisa = $jumlahSisa * $hargaPerEksemplar * 0.85;
            $diskonSisa = $jumlahSisa * $hargaPerEksemplar * 0.15;

            $totalHarga = $harga100Pertama + $hargaSisa;
            $diskonTotal = $diskon100Pertama + $diskonSisa;
        } else {
            // 100 eksemplar pertama diskon 7%
            $harga100Pertama = 100 * $hargaPerEksemplar * 0.93;
            $diskon100Pertama = 100 * $hargaPerEksemplar * 0.07;

            // 100 eksemplar kedua diskon 17%
            $harga100Kedua = 100 * $hargaPerEksemplar * 0.83;
            $diskon100Kedua = 100 * $hargaPerEksemplar * 0.17;

            // Sisanya diskon 27%
            $jumlahSisa = $jumlahEksemplar - 200;
            $hargaSisa = $jumlahSisa * $hargaPerEksemplar * 0.73;
            $diskonSisa = $jumlahSisa * $hargaPerEksemplar * 0.27;

            $totalHarga = $harga100Pertama + $harga100Kedua + $hargaSisa;
            $diskonTotal = $diskon100Pertama + $diskon100Kedua + $diskonSisa;
        }

        return [$totalHarga, $diskonTotal];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $jumlahBuku = intval($_POST['jumlahBuku']);
        list($totalHarga, $diskonTotal) = hitungTotalHarga($jumlahBuku);

        echo "<div class='result'>";
        echo "<p>Jumlah buku yang dibeli: $jumlahBuku buku / (setara dengan " . ($jumlahBuku * 10) . " eksemplar)</p>";
        echo "<p>Total harga yang harus dibayar: Rp. " . number_format($totalHarga, 0, ',', '.') . "</p>";
        echo "<p>Total diskon yang didapat: Rp. " . number_format($diskonTotal, 0, ',', '.') . "</p>";
        echo "</div>";
    }

    ?>
</div>

</body>
</html>
