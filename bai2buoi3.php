<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cơ sở dữ liệu quản lý sách (MySQL)</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/atom-one-dark.min.css">
  <style>
    body {
      font-family: Consolas, monospace;
      background-color: #282c34;
      color: #abb2bf;
      padding: 20px;
    }
    pre {
      padding: 20px;
      border-radius: 8px;
      overflow-x: auto;
      font-size: 14px;
      line-height: 1.5;
      max-height: 90vh;
    }
    h1 {
      color: #61dafb;
      margin-bottom: 20px;
    }
    .btn-back {
      display: inline-block;
      margin-bottom: 20px;
      padding: 10px 15px;
      background-color: #61dafb;
      color: #282c34;
      text-decoration: none;
      font-weight: bold;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }
    .btn-back:hover {
      background-color: #21a1f1;
    }
  </style>
</head>
<body>

  <a href="index.php" class="btn-back">← Quay lại trang chủ</a>
  <h1>Cơ sở dữ liệu quản lý sách (MySQL)</h1>

  <pre><code class="sql">
-- DROP + Tạo lại database (UTF8)
DROP DATABASE IF EXISTS quanly_sach;
CREATE DATABASE IF NOT EXISTS quanly_sach
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE quanly_sach;

-- Tạo bảng TacGia
CREATE TABLE TacGia (
    ma_tacgia INT AUTO_INCREMENT PRIMARY KEY,
    ten_tacgia VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

-- Tạo bảng NhaXuatBan
CREATE TABLE NhaXuatBan (
    ma_nxb INT AUTO_INCREMENT PRIMARY KEY,
    ten_nxb VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

-- Tạo bảng Sach
CREATE TABLE Sach (
    ma_sach INT AUTO_INCREMENT PRIMARY KEY,
    cuon_sach VARCHAR(200) NOT NULL,
    ma_tacgia INT,
    ma_nxb INT,
    nam_xuatban INT,
    FOREIGN KEY (ma_tacgia) REFERENCES TacGia(ma_tacgia),
    FOREIGN KEY (ma_nxb) REFERENCES NhaXuatBan(ma_nxb)
) ENGINE=InnoDB;

-- Thêm dữ liệu vào TacGia (gom vào 1 INSERT)
INSERT INTO TacGia (ten_tacgia) VALUES
('J.K. Rowling'),
('Harper Lee'),
('George Orwell'),
('Jane Austen'),
('F. Scott Fitzgerald'),
('Tina Seelig');

-- Thêm dữ liệu vào NhaXuatBan (gom vào 1 INSERT)
INSERT INTO NhaXuatBan (ten_nxb) VALUES
('NXB A'),
('NXB B'),
('NXB C'),
('NXB D'),
('NXB E'),
('NXB F');

-- Thêm dữ liệu vào Sach (gom vào 1 INSERT)
INSERT INTO Sach (cuon_sach, ma_tacgia, ma_nxb, nam_xuatban) VALUES
('Harry Potter và Hòn Đá Phù Thủy', 1, 1, 1997),
('Giết Con Chim Nhại', 2, 2, 1960),
('1984', 3, 3, 1949),
('Kiêu Hãnh và Định Kiến', 4, 4, 1813),
('Đại Gia Gatsby', 5, 5, 1925),
('Nếu tôi biết được khi còn 20', 6, 6, 2011);

-- ==========================
-- Các truy vấn kiểm tra
-- ==========================

-- 1. Lấy danh sách tất cả sách
SELECT * FROM Sach;

-- 2. Lấy danh sách tất cả tác giả
SELECT * FROM TacGia;

-- 3. Lấy thông tin sách '1984'
SELECT * FROM Sach WHERE cuon_sach = '1984';

-- 4. Sách của tác giả 'Harper Lee'
SELECT s.* FROM Sach s
JOIN TacGia t ON s.ma_tacgia = t.ma_tacgia
WHERE t.ten_tacgia = 'Harper Lee';

-- 5. Sách của NXB 'NXB D'
SELECT s.* FROM Sach s
JOIN NhaXuatBan n ON s.ma_nxb = n.ma_nxb
WHERE n.ten_nxb = 'NXB D';

-- 6. Tên tác giả của 'Kiêu Hãnh và Định Kiến'
SELECT t.ten_tacgia FROM TacGia t
JOIN Sach s ON t.ma_tacgia = s.ma_tacgia
WHERE s.cuon_sach = 'Kiêu Hãnh và Định Kiến';

-- 7. Tên sách và năm xuất bản của NXB 'NXB A'
SELECT s.cuon_sach, s.nam_xuatban FROM Sach s
JOIN NhaXuatBan n ON s.ma_nxb = n.ma_nxb
WHERE n.ten_nxb = 'NXB A';

-- 8. Giả sử '1984' thuộc Khoa học viễn tưởng -> kiểm tra xuất bản sau 1950
SELECT * FROM Sach
WHERE cuon_sach = '1984' AND nam_xuatban > 1950;

-- 9. Đếm sách theo NXB
SELECT n.ten_nxb, COUNT(s.ma_sach) AS so_luong_sach
FROM NhaXuatBan n
LEFT JOIN Sach s ON n.ma_nxb = s.ma_nxb
GROUP BY n.ten_nxb;

-- 10. Đếm sách theo tác giả (giảm dần)
SELECT t.ten_tacgia, COUNT(s.ma_sach) AS so_luong_sach
FROM TacGia t
LEFT JOIN Sach s ON t.ma_tacgia = s.ma_tacgia
GROUP BY t.ten_tacgia
ORDER BY so_luong_sach DESC;

-- 11. Tên tác giả và tổng sách xuất bản sau 1900
SELECT t.ten_tacgia, COUNT(s.ma_sach) AS tong_sach
FROM TacGia t
JOIN Sach s ON t.ma_tacgia = s.ma_tacgia
WHERE s.nam_xuatban > 1900
GROUP BY t.ten_tacgia;

-- 12. Sách bắt đầu bằng 'Đại Gia'
SELECT s.cuon_sach, n.ten_nxb
FROM Sach s
JOIN NhaXuatBan n ON s.ma_nxb = n.ma_nxb
WHERE s.cuon_sach LIKE 'Đại Gia%';

-- 13. Sách xuất bản sau 1950 và tên tác giả
SELECT s.cuon_sach, t.ten_tacgia
FROM Sach s
JOIN TacGia t ON s.ma_tacgia = t.ma_tacgia
WHERE s.nam_xuatban > 1950;

-- 14. Sách có tựa kết thúc bằng 'Con Chim Nhại'
SELECT s.cuon_sach, n.ten_nxb
FROM Sach s
JOIN NhaXuatBan n ON s.ma_nxb = n.ma_nxb
WHERE s.cuon_sach LIKE '%Con Chim Nhại';

-- 15. Sách xuất bản sau 2000
SELECT s.cuon_sach, t.ten_tacgia
FROM Sach s
JOIN TacGia t ON s.ma_tacgia = t.ma_tacgia
WHERE s.nam_xuatban > 2000;
  </code></pre>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/languages/sql.min.js"></script>
  <script>hljs.highlightAll();</script>
</body>
</html>
