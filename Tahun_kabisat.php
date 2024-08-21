<?php
for ($i = 1600; $i <= 2024; $i++) {
    if (($i % 400 == 0) || ($i % 100 != 0 && $i % 4 == 0)) {
        echo "$i, ";
    } else if ($i == 1700 || $i == 1800) {
        echo "$i (bukan tahun kabisat), ";
    } else {
        echo "$i, ";
    }
}
?>
