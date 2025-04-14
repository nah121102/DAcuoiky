<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f0f8ff;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        h2 {
            color: #007bff;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">➕ Thêm sản phẩm mới</h2>

    <a href="product_list.php" class="btn btn-secondary mb-3">⬅️ Quay lại danh sách</a>

    <div class="card p-4">
        <form id="productForm">
            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Giá</label>
                <input type="number" id="price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Danh mục</label>
                <select id="category_id" class="form-control" required>
                    <option value="1">📱 Điện thoại</option>
                    <option value="2">💻 Laptop</option>
                    <option value="3">🎧 Phụ kiện</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">✅ Thêm sản phẩm</button>
        </form>

        <div id="message" class="mt-3 text-center"></div>
    </div>
</div>

<script>
$(document).ready(function() {
    $("#productForm").submit(function(e) {
        e.preventDefault();

        let productData = {
            name: $("#name").val(),
            price: $("#price").val(),
            category_id: $("#category_id").val()
        };

        $.ajax({
            url: "../routes/product_api.php",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(productData),
            success: function(response) {
                console.log("Phản hồi từ API:", response);
                if (response.success) {
                    $("#message").html("<div class='alert alert-success'>✅ Thêm sản phẩm thành công!</div>");
                    $("#productForm")[0].reset();
                } else {
                    $("#message").html("<div class='alert alert-danger'>❌ Lỗi khi thêm sản phẩm vao gio hang!</div>");
                }
            },
            error: function(xhr, status, error) {
                console.error("Lỗi AJAX:", status, error);
                $("#message").html("<div class='alert alert-danger'>❌ Không thể thêm sản phẩm thanh cong!</div>");
            }
        });
    });
});
</script>

</body>
</html>
