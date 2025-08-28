<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Trang Chủ Nộp Bài Tập</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #fff9e6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        h1 {
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 30px;
            color: #333;
        }
        .btn {
            display: block;
            width: 100%;
            background-color: #f5b740;
            color: #333;
            padding: 14px 0;
            margin: 10px 0;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #d29e23;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Nộp Bài Tập - Môn Lập Trình Web</h1>
        <a class="btn" href="bai1.php">Bài 1: Xem bài</a>
        <a class="btn" href="bai2.php">Bài 2: Xem bài</a>
        <a class="btn" href="bai3.php">Bài 3: Xem bài</a>
        <a class="btn" href="baithuchanh1.php">Bài Thực Hành 1: Xem bài</a>
        <a class="btn" href="baithuchanh2.php">Bài Thực Hành 2: Xem bài</a>
        <a class="btn" href="gethost.php">Gethost: Xem bài</a>
        <a class="btn" href="uploads/">Thư mục Uploads</a>
    </div>
</body>
</html>
