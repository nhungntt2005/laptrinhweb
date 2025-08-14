<?php require 'ham.php'; ?>
<form method="post">
    Chọn phép tính:
    <input type="radio" name="pheptinh" value="cong" checked> Cộng
    <input type="radio" name="pheptinh" value="tru"> Trừ
    <input type="radio" name="pheptinh" value="nhan"> Nhân
    <input type="radio" name="pheptinh" value="chia"> Chia
    <input type="radio" name="pheptinh" value="songuyento"> Số nguyên tố?
    <input type="radio" name="pheptinh" value="sochan"> Số chẵn?
    <br><br>
    Số thứ nhất: <input type="number" name="so1" required>
    <br>
    Số thứ hai: <input type="number" name="so2">
    <br><br>
    <input type="submit" value="Tính">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $so1 = $_POST["so1"];
    $so2 = $_POST["so2"];
    $pheptinh = $_POST["pheptinh"];

    switch ($pheptinh) {
        case "cong": echo "Kết quả: " . tong($so1, $so2); break;
        case "tru": echo "Kết quả: " . hieu($so1, $so2); break;
        case "nhan": echo "Kết quả: " . tich($so1, $so2); break;
        case "chia": echo "Kết quả: " . thuong($so1, $so2); break;
        case "songuyento": 
            echo laSoNguyenTo($so1) ? "$so1 là số nguyên tố" : "$so1 không phải số nguyên tố"; 
            break;
        case "sochan":
            echo laSoChan($so1) ? "$so1 là số chẵn" : "$so1 là số lẻ"; 
            break;
    }
}
?>