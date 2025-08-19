<?php
// Tạo dữ liệu mẫu
$books = [];
for ($i = 1; $i <= 100; $i++) {
    $books[] = [
        'tensach' => "Tensach{$i}",
        'noidung' => "Noidung{$i}"
    ];
}

// Số dòng mỗi trang
$rowsPerPage = 10;

// Trang hiện tại (nếu không có thì mặc định là 1)
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;

// Tính tổng số trang
$totalRows = count($books);
$totalPages = ceil($totalRows / $rowsPerPage);

// Giới hạn trang hiện tại không vượt quá tổng số trang
if ($currentPage > $totalPages) $currentPage = $totalPages;

// Xác định vị trí bắt đầu
$start = ($currentPage - 1) * $rowsPerPage;

// Cắt mảng theo số dòng mỗi trang
$currentBooks = array_slice($books, $start, $rowsPerPage);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Danh sách sách</title>
    <style>
        table { border-collapse: collapse; width: 50%; margin: 20px auto; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .pagination { text-align: center; margin-top: 20px; }
        .pagination a {
            padding: 5px 10px;
            border: 1px solid #ccc;
            margin: 0 2px;
            text-decoration: none;
        }
        .pagination a.active {
            background-color: #007bff;
            color: white;
        }
        .home-button {
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px 0;
            text-align: center;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .home-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Danh sách sách</h2>

<!-- Nút quay lại trang chủ -->
<a href="index.php" class="home-button">Trang chủ</a>

<table>
    <tr>
        <th>STT</th>
        <th>Tên sách</th>
        <th>Nội dung sách</th>
    </tr>
    <?php
    $stt = $start + 1;
    foreach ($currentBooks as $book) {
        echo "<tr>";
        echo "<td>{$stt}</td>";
        echo "<td>{$book['tensach']}</td>";
        echo "<td>{$book['noidung']}</td>";
        echo "</tr>";
        $stt++;
    }
    ?>
</table>

<div class="pagination">
    <?php
    // Nút lùi về
    if ($currentPage > 1) {
        echo '<a href="?page=' . ($currentPage - 1) . '">Prev</a>';
    }

    // Hiển thị số trang
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            echo '<a class="active" href="?page=' . $i . '">' . $i . '</a>';
        } else {
            echo '<a href="?page=' . $i . '">' . $i . '</a>';
        }
    }

    // Nút tiến tới
    if ($currentPage < $totalPages) {
        echo '<a href="?page=' . ($currentPage + 1) . '">Next</a>';
    }
    ?>
</div>

</body>
</html>
