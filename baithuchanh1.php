<?php
session_start(); // Bắt đầu session

// Xử lý khi người dùng submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST["first_name"]);
    $lastName  = htmlspecialchars($_POST["last_name"]);
    $email     = htmlspecialchars($_POST["email"]);
    $invoice   = htmlspecialchars($_POST["invoice_id"]);
    $payFor    = isset($_POST["payfor"]) ? $_POST["payfor"] : [];
    $info      = htmlspecialchars($_POST["info"]);

    // Xử lý upload ảnh
    $uploadOk = 0;
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);

    $target_file = $target_dir . basename($_FILES["receipt"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (isset($_FILES["receipt"]) && $_FILES["receipt"]["error"] == 0) {
        if ($_FILES["receipt"]["size"] <= 1048576 && 
           in_array($imageFileType, ["jpg","jpeg","png","gif"])) {
            move_uploaded_file($_FILES["receipt"]["tmp_name"], $target_file);
            $uploadOk = 1;
        }
    }

    // Lưu vào session
    $_SESSION["form_data"] = [
        "first_name" => $firstName,
        "last_name"  => $lastName,
        "email"      => $email,
        "invoice"    => $invoice,
        "payfor"     => $payFor,
        "info"       => $info,
        "uploadOk"   => $uploadOk,
        "file"       => $target_file
    ];

    // Lưu email vào cookie trong 1 ngày
    setcookie("user_email", $email, time() + 86400, "/"); 

    // Reload lại trang để tránh resubmit form
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

// Lấy dữ liệu từ session nếu có
$formData = isset($_SESSION["form_data"]) ? $_SESSION["form_data"] : null;
$emailFromCookie = isset($_COOKIE["user_email"]) ? $_COOKIE["user_email"] : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Receipt Upload Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f9f9f9;
        }
        .form-box {
            background: #fff;
            padding: 20px;
            max-width: 700px;
            margin: auto;
            border: 1px solid #ddd;
            border-radius: 6px;
        }
        h2 {
            text-align: center;
        }
        .row {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }
        .row input {
            width: 100%;
            padding: 8px;
        }
        .checkboxes {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            margin-bottom: 20px;
            gap: 8px;
        }
        .file-box {
            border: 2px dashed #ccc;
            text-align: center;
            padding: 30px;
            margin-bottom: 15px;
        }
        textarea {
            width: 100%;
            padding: 8px;
        }
        button {
            background: black;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        .result-box {
            margin-top: 40px;
        }
        /* Nút quay về trang chủ */
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
<div class="form-box">
    <h2>Payment Receipt Upload Form</h2>
    <form method="post" enctype="multipart/form-data">
        <!-- Name + Email -->
        <div class="row">
            <input type="text" name="first_name" placeholder="First Name" 
                   value="<?= $formData["first_name"] ?? "" ?>" required>
            <input type="text" name="last_name" placeholder="Last Name" 
                   value="<?= $formData["last_name"] ?? "" ?>" required>
        </div>
        <div class="row">
            <input type="email" name="email" placeholder="Email" 
                   value="<?= $formData["email"] ?? $emailFromCookie ?>" required>
            <input type="text" name="invoice_id" placeholder="Invoice ID" 
                   value="<?= $formData["invoice"] ?? "" ?>" required>
        </div>

        <!-- Pay For -->
        <label>Pay For</label>
        <div class="checkboxes">
            <?php
            $options = ["15K"=>"15K Category","35K"=>"35K Category","55K"=>"55K Category","75K"=>"75K Category",
                        "116K"=>"116K Category","ShuttleOne"=>"Shuttle One Way","ShuttleTwo"=>"Shuttle Two Ways",
                        "Cap"=>"Training Cap Merchandise","Tshirt"=>"Compressport T-Shirt",
                        "Buf"=>"Buf Merchandise","Other"=>"Other"];
            foreach ($options as $val => $label) {
                $checked = ($formData && in_array($val, $formData["payfor"])) ? "checked" : "";
                echo "<label><input type='checkbox' name='payfor[]' value='$val' $checked> $label</label>";
            }
            ?>
        </div>

        <!-- Upload -->
        <label>Please upload your payment receipt:</label>
        <div class="file-box">
            <input type="file" name="receipt" accept="image/*">
            <p>jpg, jpeg, png, gif (1MB max.)</p>
        </div>

        <!-- Info -->
        <label>Additional Information</label>
        <textarea name="info" rows="4"><?= $formData["info"] ?? "" ?></textarea>

        <!-- Submit -->
        <br><br>
        <button type="submit">Submit</button>
    </form>
</div>

<?php if ($formData): ?>
    <div class="form-box result-box">
        <h2>Thông tin bạn đã nhập</h2>
        <p><strong>Name:</strong> <?= $formData["first_name"] . " " . $formData["last_name"] ?></p>
        <p><strong>Email:</strong> <?= $formData["email"] ?></p>
        <p><strong>Invoice ID:</strong> <?= $formData["invoice"] ?></p>
        <p><strong>Pay For:</strong> <?= implode(", ", $formData["payfor"]) ?></p>
        <p><strong>Additional Info:</strong> <?= $formData["info"] ?></p>
        <?php if ($formData["uploadOk"]): ?>
            <p><strong>Ảnh đã upload:</strong></p>
            <img src="<?= $formData["file"] ?>" alt="Receipt" width="200">
        <?php else: ?>
            <p><strong>Không upload được ảnh hoặc chưa chọn ảnh!</strong></p>
        <?php endif; ?>

        <!-- Nút quay lại trang chủ -->
        <a href="index.php" class="btn-home">← Quay lại Trang Chủ</a>
    </div>
<?php endif; ?>
</body>
</html>
