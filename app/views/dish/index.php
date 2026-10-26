<?php
// app/views/dish/index.php
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý món ăn - Menu Daily</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7f5;
            font-family: Arial, sans-serif;
        }

        /* Thanh Navigation phía trên */
        .navbar-custom {
            background-color: white;
            border-bottom: 1px solid #e0e0e0;
            padding: 10px 20px;
        }

        .navbar-brand-custom {
            color: #198754 !important;
            font-weight: bold;
            font-size: 1.15rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link-custom {
            color: #495057;
            text-decoration: none;
            padding: 5px 12px;
            font-size: 0.95rem;
        }

        .nav-link-custom.active, .nav-link-custom:hover {
            color: #198754;
        }

        .container {
            max-width: 1250px;
            margin-top: 25px;
            margin-bottom: 40px;
        }

        /* Khung Card bọc bảng */
        .card-box {
            background-color: white;
            border-radius: 8px;
            border: 1px solid #dcdcdc;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            margin-bottom: 20px;
            overflow: hidden;
        }

        /* Tiêu đề card: To hơn, đậm hơn, căn giữa tuyệt đối */
        .card-box-header {
            background-color: #f8f9fa;
            padding: 18px 20px;
            border-bottom: 1px solid #dcdcdc;
            font-weight: 700;
            color: #198754;
            font-size: 1.25rem;
            text-align: center;
            position: relative;
        }

        /* Đẩy nút "Thêm món ăn" sang góc phải */
        .card-box-header .btn-add-absolute {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }

        .card-box-body {
            padding: 20px;
        }

        .table thead th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
            vertical-align: middle;
            font-size: 0.9rem;
        }

        .table tbody td {
            vertical-align: middle;
            color: #333;
            font-size: 0.95rem;
        }

        .action-column {
            text-align: center;
            white-space: nowrap;
            width: 130px;
        }

        /* Nút Sửa và Xóa thu gọn dạng badge */
        .btn-edit {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 4px 14px;
            font-size: 0.85rem;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            font-weight: 500;
        }

        .btn-edit:hover {
            background-color: #0b5ed7;
            color: white;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 4px 14px;
            font-size: 0.85rem;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            font-weight: 500;
        }

        .btn-delete:hover {
            background-color: #bb2d3b;
            color: white;
        }
    </style>
</head>
<body>

<!-- 1. THANH ĐIỀU HƯỚNG TOP NAVBAR -->
<nav class="navbar navbar-expand navbar-custom">
    <div class="container-fluid px-3">
        <!-- Đã đổi màu biểu tượng và chữ Menu Daily sang màu xanh lá hài hòa -->
        <a class="navbar-brand-custom" href="#">
            <i class="bi bi-calendar-week text-success"></i> Menu Daily
        </a>
        <div class="navbar-nav me-auto ms-3">
            <a class="nav-link-custom" href="?controller=menu&action=index">Lập thực đơn</a>
            <a class="nav-link-custom active fw-semibold" href="?controller=dish&action=index">Món ăn</a>
            <a class="nav-link-custom" href="?controller=ingredient&action=index">Nguyên liệu</a>
            <a class="nav-link-custom" href="?controller=report&action=index">Tra cứu thực đơn</a>
        </div>
        <div class="navbar-nav ms-auto">
            <a class="nav-link-custom" href="#">
                <i class="bi bi-person-circle"></i> admin <i class="bi bi-chevron-down small"></i>
            </a>
        </div>
    </div>
</nav>

<!-- 2. NỘI DUNG CHÍNH -->
<div class="container">
    <div class="card-box">
        <!-- Tiêu đề bọc trong Card: Chữ to, in đậm, căn giữa tuyệt đối, nút thêm nằm góc phải -->
        <div class="card-box-header">
            <span><i class="bi bi-journal-text"></i> Danh sách món ăn</span>
            <a href="?controller=dish&action=add" class="btn btn-success btn-sm px-3 fw-semibold btn-add-absolute">
                <i class="bi bi-plus-lg"></i> Thêm món ăn
            </a>
        </div>

        <div class="card-box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-3">
                    <thead>
                        <tr>
                            <th style="width: 60px;" class="text-center">STT</th>
                            <th style="width: 120px;" class="text-center">Mã người dùng</th>
                            <th style="width: 22%;">Tên món ăn</th>
                            <th style="width: 28%;">Nguyên liệu chính</th>
                            <th>Cách chế biến</th>
                            <th class="action-column">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($dishes)): ?>
                        <?php $stt = 1; foreach ($dishes as $dish): ?>
                            <tr>
                                <td class="text-center text-muted fw-medium"><?= $stt++ ?></td>
                                <td class="text-center text-secondary"><?= htmlspecialchars((string)$dish->getMaNguoiDung()) ?></td>
                                <td class="fw-semibold"><?= htmlspecialchars($dish->getTenMonAn()) ?></td>
                                <td><?= htmlspecialchars($dish->getNguyenLieu() ?? '') ?></td>
                                <td><?= htmlspecialchars($dish->getCachCheBien() ?? '') ?></td>
                                <td class="action-column">
                                    <a href="?controller=dish&action=edit&id=<?= urlencode((string)$dish->getMaMonAn()) ?>" class="btn-edit me-1">
                                        Sửa
                                    </a>
                                    <a href="?controller=dish&action=delete&id=<?= urlencode((string)$dish->getMaMonAn()) ?>" class="btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa món ăn này không?');">
                                        Xóa
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Chưa có món ăn nào.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Phần tổng số món và phân trang phía dưới -->
            <div class="d-flex justify-content-between align-items-center pt-2">
                <div class="text-muted small">
                    Tổng: <strong><?= count($dishes ?? []) ?></strong> món ăn
                </div>
                <div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link text-secondary" href="#"><i class="bi bi-chevron-left"></i></a></li>
                            <li class="page-item active"><a class="page-link bg-success border-success text-white" href="#">1</a></li>
                            <li class="page-item disabled"><a class="page-link text-secondary" href="#"><i class="bi bi-chevron-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>