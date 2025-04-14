<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Danh sách sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #e3f2fd;
        }
        .container {
            max-width: 900px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        h2 {
            color: #0d6efd;
            font-weight: bold;
        }
        .btn-primary, .btn-warning, .btn-danger {
            border-radius: 6px;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-warning:hover {
            background-color: #d39e00;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .table {
            border-radius: 8px;
            overflow: hidden;
        }
        thead {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">📦 Danh sách sản phẩm</h2>

    <div class="card p-4">
        <a href="product_form.php" class="btn btn-primary mb-3">➕ Thêm sản phẩm</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody id="productTable">
                <tr>
                    <td colspan="4" class="text-center text-info">⏳ Đang tải dữ liệu...</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    function loadProducts() {
        $.ajax({
            url: "../routes/product_api.php",
            type: "GET",
            dataType: "json",
            success: function(response) {
                console.log("Dữ liệu nhận được:", response);
                let rows = "";
                if (response.length > 0) {
                    response.forEach(product => {
                        rows += `
                            <tr>
                                <td>${product.id}</td>
                                <td>${product.name}</td>
                                <td>${product.price} VND</td>
                                <td>
                                    <a href="product_form.php?id=${product.id}" class="btn btn-warning btn-sm">✏️ Sửa</a>
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="${product.id}">🗑️ Xóa</button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    rows = "<tr><td colspan='4' class='text-center text-warning'>⚠️ Không có sản phẩm nào.</td></tr>";
                }
                $("#productTable").html(rows);
            },
            error: function(xhr, status, error) {
                console.error("Lỗi AJAX:", status, error);
                $("#productTable").html("<tr><td colspan='4' class='text-center text-danger'>❌ Không thể tải dữ liệu!</td></tr>");
            }
        });
    }

    loadProducts();

    $(document).on("click", ".delete-btn", function() {
        let id = $(this).data("id");
        if (confirm("Bạn có chắc muốn xóa sản phẩm này không?")) {
            $.ajax({
                url: `../routes/product_api.php?id=${id}`,
                type: "DELETE",
                success: function(response) {
                    console.log("Phản hồi từ API:", response);
                    alert("🗑️ Xóa thành công!");
                    loadProducts();
                },
                error: function(xhr, status, error) {
                    console.error("Lỗi khi xóa:", status, error);
                    alert("❌ Xóa thất bại!");
                }
            });
        }
    });
});
</script>
</body>
</html>
