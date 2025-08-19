<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ Nộp Bài Tập</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #fff9e6; /* vàng nhạt */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 30px;
            color: #333;
        }

        .btn {
            display: block;
            background-color: #ffc107; /* vàng tươi */
            color: #333333;
            padding: 14px;
            margin: 12px 0;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #e0a800; /* vàng đậm hơn khi hover */
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Nộp Bài Tập - Môn Lập Trình Web</h1>
        <a class="btn" href="bai1.php">Bài 1: Xem bài</a>
        <a class="btn" href="bai2.php">Bài 2: Xem bài</a>
        <a class="btn" href="bai3.php">Bài 3: Xem bài</a>
        <a class="btn" href="gethost.php">gethost: Xem bài</a>
    </div>

</body>
</html>

