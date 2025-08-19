<?php require 'ham.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Máy Tính Đơn Giản</title>
    <style>
        .home-button {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .home-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<form method="post">
    <p>Chọn phép tính:</p>
    <input type="radio" name="pheptinh" value="cong" checked> Cộng
    <input type="radio" name="pheptinh" value="tru"> Trừ
    <input type="radio" name="pheptinh" value="nhan"> Nhân
    <input type="radio" name="pheptinh" value="chia"> Chia
    <input type="radio" name="pheptinh" value="songuyento"> Số nguyên tố?
    <input type="radio" name="pheptinh" value="sochan"> Số chẵn?
    <br><br>

    Số thứ nhất: <input type="number" name="so1" required>
    <br><br>
    Số thứ hai: <input type="number" name="so2">
    <br><br>

    <input type="submit" value="Tính">
</form>

<!-- Nút quay về trang chủ -->
<a href="index.php" class="home-button">Trang chủ</a>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $so1 = $_POST["so1"];
    $so2 = isset($_POST["so2"]) ? $_POST["so2"] : 0;
    $pheptinh = $_POST["pheptinh"];

    echo "<h3>Kết quả:</h3>";

    switch ($pheptinh) {
        case "cong": echo "Kết quả: " . tong($so1, $so2); break;
        case "tru": echo "Kết quả: " . hieu($so1, $so2); break;
        case "nhan": echo "Kết quả: " . tich($so1, $so2); break;
        case "chia":
            if ($so2 == 0) {
                echo "Lỗi: Không thể chia cho 0.";
            } else {
                echo "Kết quả: " . thuong($so1, $so2);
            }
            break;
        case "songuyento": 
            echo laSoNguyenTo($so1) ? "$so1 là số nguyên tố" : "$so1 không phải là số nguyên tố"; 
            break;
        case "sochan":
            echo laSoChan($so1) ? "$so1 là số chẵn" : "$so1 là số lẻ"; 
            break;
    }
}
?>

</body>
</html>
