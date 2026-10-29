<?php
// app/views/dish/index.php
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7f5;
            font-family: Arial, sans-serif;
        }

        /* Thanh Navigation đồng bộ với trang Tổng quan */
        .navbar-custom {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
            padding: 8px 0;
        }

        .navbar-custom .container-fluid {
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 12px;
            padding-right: 12px;
        }

        .navbar-brand-custom {
            color: #198754 !important;
            font-weight: 700;
            font-size: 1.25rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            white-space: nowrap;
            padding: 5px 0;
        }

        .nav-link-custom {
            color: #212529;
            text-decoration: none;
            padding: 8px;
            font-size: 1rem;
            font-weight: 400;
            white-space: nowrap;
        }

        .nav-link-custom.active {
            color: #212529;
        }

        .nav-link-custom:hover {
            color: #198754;
        }

        .nav-user {
            color: #198754 !important;
            font-weight: 700;
        }

        .nav-logout {
            color: #b94a48 !important;
        }

        .nav-logout:hover {
            color: #dc3545 !important;
        }

        .container {
            max-width: 1250px;
            margin-top: 25px;
            margin-bottom: 40px;
        }

        /* Khung chứa bảng */
        .card-box {
            background-color: #ffffff;
            border-radius: 4px;
            border: 1px solid #dee2e6;
            box-shadow: none;
            margin-bottom: 20px;
            overflow: hidden;
        }

        /* Tiêu đề danh sách món ăn */
        .card-box-header {
            background-color: #ffffff;
            padding: 12px 16px;
            border-bottom: 1px solid #dee2e6;
            font-weight: 600;
            color: #198754;
            font-size: 1.2rem;
            text-align: center;
            position: relative;
        }

        /* Nút Thêm món ăn */
        .card-box-header .btn-add-absolute {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.875rem;
        }

        .card-box-body {
            padding: 16px;
        }

        /* Bảng đồng bộ với trang Tổng quan */
        .table {
            font-family: Arial, sans-serif;
            font-size: 0.9rem;
            color: #212529;
            margin-bottom: 1rem;
            border-color: #dee2e6;
        }

        .table thead th {
            background-color: #f8f9fa;
            color: #212529;
            font-weight: 700;
            font-size: 0.9rem;
            border-color: #dee2e6;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
            padding: 9px 8px;
        }

        .table tbody td {
            color: #212529;
            font-size: 0.9rem;
            font-weight: 400;
            vertical-align: middle;
            padding: 9px 8px;
            border-color: #dee2e6;
        }

        .table tbody tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        .table tbody tr:nth-child(odd) td {
            background-color: #ffffff;
        }

        .table tbody tr:hover td {
            background-color: #e9ecef;
        }

        .table tbody td.text-muted,
        .table tbody td.text-secondary {
            color: #212529 !important;
        }

        .action-column {
            text-align: center;
            white-space: nowrap;
            width: 130px;
        }

        /* Nút Sửa */
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

        /* Nút Xóa */
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
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom navbar-custom">
    <div class="container-fluid">

        <a class="navbar-brand-custom"
           href="<?= DOMAIN ?>public/">
            Quản lý thực đơn
        </a>

        <div class="navbar-nav ms-auto align-items-center">

            <a class="nav-link-custom"
               href="<?= DOMAIN ?>public/?controller=home&action=index">
                Tổng quan
            </a>

            <a class="nav-link-custom"
               href="<?= DOMAIN ?>public/?controller=menu&action=index">
                Lập thực đơn
            </a>

            <a class="nav-link-custom active"
               href="<?= DOMAIN ?>public/?controller=dish&action=index">
                Món ăn
            </a>

            <a class="nav-link-custom"
               href="<?= DOMAIN ?>public/?controller=menu&action=history">
                Tra cứu thực đơn
            </a>

            <?php
            $tenNguoiDung = $_SESSION['ho_ten']
                ?? $_SESSION['user']['ho_ten']
                ?? 'Người dùng';
            ?>

            <span class="nav-link-custom nav-user">
                Chào <?= htmlspecialchars($tenNguoiDung, ENT_QUOTES, 'UTF-8') ?>
            </span>

            <a class="nav-link-custom nav-logout"
               href="<?= DOMAIN ?>public/?controller=user&action=logout">
                Đăng xuất
            </a>

        </div>
    </div>
</nav>

<!-- 2. NỘI DUNG CHÍNH -->
<div class="container">
    <div class="card-box">

        <!-- Tiêu đề danh sách món ăn -->
        <div class="card-box-header">
            <span>Danh sách món ăn</span>

            <a href="?controller=dish&action=add"
               class="btn btn-success btn-sm px-3 fw-semibold btn-add-absolute">
                <i class="bi bi-plus-lg"></i> Thêm món ăn
            </a>
        </div>

        <div class="card-box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-3">
                    <thead>
                        <tr>
                            <th style="width: 60px;" class="text-center">STT</th>
                            <th style="width: 120px;" class="text-center">Mã người dùng</th>
                            <th style="width: 22%;">Tên món ăn</th>
                            <th style="width: 28%;">Nguyên liệu</th>
                            <th>Cách chế biến</th>
                            <th class="action-column">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if (!empty($dishes)): ?>
                        <?php $stt = 1; foreach ($dishes as $dish): ?>
                            <tr>
                                <td class="text-center">
                                    <?= $stt++ ?>
                                </td>

                                <td class="text-center">
                                    <?= htmlspecialchars((string)$dish->getMaNguoiDung()) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($dish->getTenMonAn()) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($dish->getNguyenLieu() ?? '') ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($dish->getCachCheBien() ?? '') ?>
                                </td>

                                <td class="action-column">
                                    <a href="?controller=dish&action=edit&id=<?= urlencode((string)$dish->getMaMonAn()) ?>"
                                       class="btn-edit me-1">
                                        Sửa
                                    </a>

                                    <a href="?controller=dish&action=delete&id=<?= urlencode((string)$dish->getMaMonAn()) ?>"
                                       class="btn-delete"
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa món ăn này không?');">
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
                            <li class="page-item disabled">
                                <a class="page-link text-secondary" href="#">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                            </li>

                            <li class="page-item active">
                                <a class="page-link bg-success border-success text-white" href="#">
                                    1
                                </a>
                            </li>

                            <li class="page-item disabled">
                                <a class="page-link text-secondary" href="#">
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
