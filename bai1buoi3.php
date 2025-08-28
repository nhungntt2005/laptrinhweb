<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cơ sở dữ liệu quản lý nhân sự (MySQL)</title>
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
        /* Nút quay lại */
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
    <h1>Cơ sở dữ liệu quản lý nhân sự (MySQL)</h1>
    <pre><code class="sql">
-- ===============================
-- CƠ SỞ DỮ LIỆU QUẢN LÝ NHÂN SỰ (MySQL)
-- ===============================

-- 1) Tạo cơ sở dữ liệu và sử dụng
DROP DATABASE IF EXISTS nhanvien_db;
CREATE DATABASE nhanvien_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE nhanvien_db;

-- 2) Tạo bảng
CREATE TABLE phongban (
    ma_phong INT PRIMARY KEY AUTO_INCREMENT,
    ten_phong VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE chucvu (
    ma_chucvu INT PRIMARY KEY AUTO_INCREMENT,
    ten_chucvu VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE nhanvien (
    ma_nv INT PRIMARY KEY AUTO_INCREMENT,
    ho VARCHAR(50) NOT NULL,
    ten VARCHAR(50) NOT NULL,
    ma_phong INT NOT NULL,
    ma_chucvu INT NOT NULL,
    CONSTRAINT fk_nv_pb FOREIGN KEY (ma_phong) REFERENCES phongban(ma_phong),
    CONSTRAINT fk_nv_cv FOREIGN KEY (ma_chucvu) REFERENCES chucvu(ma_chucvu)
);

-- 3) Thêm dữ liệu mẫu
INSERT INTO phongban (ma_phong, ten_phong) VALUES
(1, 'Nhân sự'),
(2, 'Marketing'),
(3, 'Công nghệ thông tin'),
(4, 'Tài chính'),
(5, 'Vận hành');

INSERT INTO chucvu (ma_chucvu, ten_chucvu) VALUES
(1, 'Quản lý'),
(2, 'Nhân viên'),
(3, 'Thực tập sinh'),
(5, 'Giám đốc'); -- cố tình bỏ qua id 4 giống ví dụ

INSERT INTO nhanvien (ma_nv, ho, ten, ma_phong, ma_chucvu) VALUES
(1, 'Nguyễn', 'An', 1, 1),
(2, 'Trần', 'Bình', 2, 2),
(3, 'Lê', 'Chi', 3, 3),
(4, 'Phạm', 'Dung', 4, 2),
(5, 'Hoàng', 'Đạt', 3, 3);

-- 4) Các truy vấn

-- 1. Tất cả nhân viên kèm phòng ban và chức vụ
SELECT nv.ho, nv.ten, pb.ten_phong, cv.ten_chucvu
FROM nhanvien nv
JOIN phongban pb ON nv.ma_phong = pb.ma_phong
JOIN chucvu cv ON nv.ma_chucvu = cv.ma_chucvu;

-- 2. Tất cả tên phòng ban
SELECT ten_phong FROM phongban;

-- 3. Nhân viên có mã = 3
SELECT nv.ho, nv.ten, pb.ten_phong, cv.ten_chucvu
FROM nhanvien nv
JOIN phongban pb ON nv.ma_phong = pb.ma_phong
JOIN chucvu cv ON nv.ma_chucvu = cv.ma_chucvu
WHERE nv.ma_nv = 3;

-- 4. Nhân viên thuộc phòng Nhân sự
SELECT nv.ho, nv.ten, cv.ten_chucvu, pb.ten_phong
FROM nhanvien nv
JOIN phongban pb ON nv.ma_phong = pb.ma_phong
JOIN chucvu cv ON nv.ma_chucvu = cv.ma_chucvu
WHERE pb.ten_phong = 'Nhân sự';

-- 5. Nhân viên có chức vụ Quản lý
SELECT nv.ho, nv.ten, pb.ten_phong
FROM nhanvien nv
JOIN phongban pb ON nv.ma_phong = pb.ma_phong
JOIN chucvu cv ON nv.ma_chucvu = cv.ma_chucvu
WHERE cv.ten_chucvu = 'Quản lý';

-- 6. Số lượng nhân viên theo từng phòng ban
SELECT pb.ten_phong, COUNT(nv.ma_nv) AS tong_nhanvien
FROM phongban pb
LEFT JOIN nhanvien nv ON pb.ma_phong = nv.ma_phong
GROUP BY pb.ten_phong;

-- 7. Chức vụ của nhân viên có mã = 2
SELECT cv.ten_chucvu
FROM nhanvien nv
JOIN chucvu cv ON nv.ma_chucvu = cv.ma_chucvu
WHERE nv.ma_nv = 2;

-- 8. Nhân viên có họ bắt đầu bằng 'N'
SELECT nv.ho, nv.ten, pb.ten_phong, cv.ten_chucvu
FROM nhanvien nv
JOIN phongban pb ON nv.ma_phong = pb.ma_phong
JOIN chucvu cv ON nv.ma_chucvu = cv.ma_chucvu
WHERE nv.ho LIKE 'N%';

-- 9. Phòng ban và nhân viên có chức vụ Quản lý
SELECT pb.ten_phong, nv.ho, nv.ten
FROM nhanvien nv
JOIN phongban pb ON nv.ma_phong = pb.ma_phong
JOIN chucvu cv ON nv.ma_chucvu = cv.ma_chucvu
WHERE cv.ten_chucvu = 'Quản lý';

-- 10. Số lượng nhân viên theo phòng ban (giảm dần)
SELECT pb.ten_phong, COUNT(nv.ma_nv) AS tong_nhanvien
FROM phongban pb
LEFT JOIN nhanvien nv ON pb.ma_phong = nv.ma_phong
GROUP BY pb.ten_phong
ORDER BY tong_nhanvien DESC;

-- 11. Chức vụ của nhân viên 'Phạm Dung'
SELECT cv.ten_chucvu
FROM nhanvien nv
JOIN chucvu cv ON nv.ma_chucvu = cv.ma_chucvu
WHERE nv.ho = 'Phạm' AND nv.ten = 'Dung';

-- 12. Nhân viên trong các phòng ban có tên bắt đầu bằng 'M'
SELECT nv.ho, nv.ten, pb.ten_phong
FROM nhanvien nv
JOIN phongban pb ON nv.ma_phong = pb.ma_phong
WHERE pb.ten_phong LIKE 'M%';

-- 13. Nhân viên có chức vụ Giám đốc (nếu có)
SELECT nv.ho, nv.ten, pb.ten_phong
FROM nhanvien nv
JOIN phongban pb ON nv.ma_phong = pb.ma_phong
JOIN chucvu cv ON nv.ma_chucvu = cv.ma_chucvu
WHERE cv.ten_chucvu = 'Giám đốc';

-- 14. Nhân viên thuộc phòng Công nghệ thông tin hoặc Tài chính
SELECT nv.ho, nv.ten, pb.ten_phong, cv.ten_chucvu
FROM nhanvien nv
JOIN phongban pb ON nv.ma_phong = pb.ma_phong
JOIN chucvu cv ON nv.ma_chucvu = cv.ma_chucvu
WHERE pb.ten_phong IN ('Công nghệ thông tin', 'Tài chính');

-- 15. Phòng ban có nhiều nhân viên nhất
SELECT pb.ten_phong, COUNT(nv.ma_nv) AS tong_nhanvien
FROM phongban pb
LEFT JOIN nhanvien nv ON pb.ma_phong = nv.ma_phong
GROUP BY pb.ten_phong
ORDER BY tong_nhanvien DESC
LIMIT 1;
    </code></pre>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/languages/sql.min.js"></script>
    <script>hljs.highlightAll();</script>
</body>
</html>
