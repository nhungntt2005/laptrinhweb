<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <title>Form Sách - GET và POST</title>
  <style>
    .nav-buttons {
      margin-top: 20px;
    }

    .home-button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #3498db;
      color: white;
      text-decoration: none;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .home-button:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>
  <h1>Thông Tin Sách</h1>

  <form id="bookForm">
    <label for="title">Tên sách:</label>
    <input type="text" id="title" name="title" required /><br /><br />

    <label for="author">Tác giả:</label>
    <input type="text" id="author" name="author" required /><br /><br />

    <label for="publisher">Nhà xuất bản:</label>
    <input type="text" id="publisher" name="publisher" required /><br /><br />

    <label for="year">Năm xuất bản:</label>
    <input type="number" id="year" name="year" required /><br /><br />

    <button type="button" onclick="sendGet()">Gửi bằng GET</button>
    <button type="button" onclick="sendPost()">Gửi bằng POST</button>
  </form>

  <h2>Dữ liệu đã gửi:</h2>
  <pre id="output">Chưa có dữ liệu nào được gửi.</pre>

  <div class="nav-buttons">
    <a class="home-button" href="index.php">🏠 Quay lại trang chủ</a>
  </div>

  <script>
    function getFormData() {
      return {
        title: document.getElementById("title").value,
        author: document.getElementById("author").value,
        publisher: document.getElementById("publisher").value,
        year: document.getElementById("year").value,
      };
    }

    function formatDataLines(data) {
      return (
        "Tên sách: " + data.title + "\n" +
        "Tác giả: " + data.author + "\n" +
        "Nhà xuất bản: " + data.publisher + "\n" +
        "Năm xuất bản: " + data.year
      );
    }

    function sendGet() {
      const data = getFormData();
      document.getElementById("output").textContent =
        "Gửi bằng GET:\n" + formatDataLines(data);
    }

    function sendPost() {
      const data = getFormData();
      document.getElementById("output").textContent =
        "Gửi bằng POST:\n" + formatDataLines(data);
    }
  </script>
</body>
</html>
