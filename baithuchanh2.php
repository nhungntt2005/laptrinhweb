<?php
session_start();

// Lấy dữ liệu từ session (lấy cái mảng form_data đã lưu ở bài 1)
$formData = isset($_SESSION["form_data"]) ? $_SESSION["form_data"] : null;

// Lấy email từ cookie
$emailFromCookie = isset($_COOKIE["user_email"]) ? $_COOKIE["user_email"] : "";
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Bài 2 - Hiển thị thông tin từ session và cookie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f0f0f0;
        }
        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        img {
            max-width: 300px;
            margin-top: 10px;
        }
        p {
            font-size: 16px;
            color: #555;
        }
        .btn-home {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #f5b740;
            color: #333;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        .btn-home:hover {
            background-color: #d29e23;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Thông tin đã nhập (lấy từ session và cookie)</h2>

    <?php if ($formData): ?>
        <p><strong>Họ và tên:</strong> <?= htmlspecialchars($formData["first_name"] . " " . $formData["last_name"]) ?></p>
        <p><strong>Email (session):</strong> <?= htmlspecialchars($formData["email"]) ?></p>
        <p><strong>Email (cookie):</strong> <?= htmlspecialchars($emailFromCookie) ?></p>
        <p><strong>Mã hóa đơn (Invoice ID):</strong> <?= htmlspecialchars($formData["invoice"]) ?></p>
        <p><strong>Thanh toán cho:</strong> <?= htmlspecialchars(implode(", ", $formData["payfor"])) ?></p>
        <p><strong>Thông tin thêm:</strong> <?= nl2br(htmlspecialchars($formData["info"])) ?></p>

        <?php if ($formData["uploadOk"] && file_exists($formData["file"])): ?>
            <p><strong>Ảnh hóa đơn đã upload:</strong></p>
            <img src="<?= htmlspecialchars($formData["file"]) ?>" alt="Uploaded Receipt">
        <?php else: ?>
            <p><strong>Chưa có ảnh hóa đơn hoặc upload thất bại.</strong></p>
        <?php endif; ?>
    <?php else: ?>
        <p>Chưa có dữ liệu session nào. Vui lòng điền thông tin ở <a href="baithuchanh1.php">Bài Thực Hành 1</a> trước.</p>
    <?php endif; ?>

    <!-- Nút quay lại trang chủ -->
    <a href="index.php" class="btn-home">← Quay lại Trang Chủ</a>
</div>
</body>
</html>
