<?php
// app/views/dish/index.php
/** @var mixed $dishes */

// Kiểm tra trạng thái đăng nhập từ session thực tế của bạn

// app/views/dish/index.php
/** @var mixed $dishes */

$isLoggedIn = !empty($_SESSION['user']);

$userName = $_SESSION['user']['ho_ten']
    ?? $_SESSION['user']['name']
    ?? $_SESSION['ho_ten']
    ?? '';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Danh sách món ăn - Quản lý thực đơn</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" 
        rel="stylesheet"
    >
</head>

<body>

    <!-- Thanh điều hướng -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container">

            <a class="navbar-brand fw-bold text-success"
               href="<?= DOMAIN ?>public/">
                Quản lý thực đơn
            </a>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto align-items-center">

                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?= DOMAIN ?>public/?controller=home&action=index">
                            Tổng quan
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?= DOMAIN ?>public/?controller=menu&action=index">
                            Lập thực đơn
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active"
                           href="<?= DOMAIN ?>public/?controller=dish&action=index">
                            Món ăn
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?= DOMAIN ?>public/?controller=menu&action=history">
                            Tra cứu thực đơn
                        </a>
                    </li>
                    <?php if (!empty($isLoggedIn)): ?>
                        <!-- Khi ĐÃ ĐĂNG NHẬP: Hiển thị "Xin chào, [Tên]" và nút "Đăng xuất" đúng mẫu -->
                        <li class="nav-item">
                            <span class="nav-link text-success fw-bold">Xin chào, <?= htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') ?></span>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="nav-link text-danger"
                               href="<?= DOMAIN ?>public/?controller=user&action=logout">
                                Đăng xuất
                            </a>
                        </li>
                    <?php else: ?>
                        <!-- Khi CHƯA ĐĂNG NHẬP: Hiển thị Đăng nhập và Đăng ký -->
                        <li class="nav-item">
                            <a class="nav-link"
                               href="<?= DOMAIN ?>public/?controller=user&action=login">
                                Đăng nhập
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                               href="<?= DOMAIN ?>public/?controller=user&action=register">
                                Đăng ký
                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4 mb-5">

        <!-- Tiêu đề: Danh sách món ăn căn giữa -->
        <h3 class="text-center text-uppercase text-success mt-3 mb-4">
            Danh sách món ăn
        </h3>

        <!-- Nút Thêm món ăn căn lề phải phía trên bảng -->
        <div class="d-flex justify-content-end mb-3">
            <a href="<?= DOMAIN ?>public/?controller=dish&action=add" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Thêm món ăn
            </a>
        </div>

        <!-- Bảng danh sách món ăn -->
        <div class="table-responsive mb-4">
            <table class="table table-bordered table-striped align-middle">

                <thead class="table-light">
                    <tr>
                        <th scope="col" style="width: 60px;" class="text-center">STT</th>
                        <th scope="col" style="width: 130px;" class="text-center">Mã người dùng</th>
                        <th scope="col" style="width: 25%;">Tên món ăn</th>
                        <th scope="col">Nguyên liệu</th>
                        <th scope="col">Cách chế biến</th>
                        <th scope="col" style="width: 140px;" class="text-center">Thao tác</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($dishes)): ?>

                        <?php foreach ($dishes as $index => $dish): ?>
                            <tr>
                                <th scope="row" class="text-center">
                                    <?= $index + 1 ?>
                                </th>

                                <td class="text-center">
                                    <?= htmlspecialchars((string)($dish->getMaNguoiDung() ?? '')) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($dish->getTenMonAn() ?? '') ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($dish->getNguyenLieu() ?? '') ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($dish->getCachCheBien() ?? '') ?>
                                </td>

                                <td class="text-center">
                                    <a href="<?= DOMAIN ?>public/?controller=dish&action=edit&id=<?= urlencode((string)$dish->getMaMonAn()) ?>" 
                                       class="btn btn-primary btn-sm me-1">
                                        Sửa
                                    </a>
                                    <a href="<?= DOMAIN ?>public/?controller=dish&action=delete&id=<?= urlencode((string)$dish->getMaMonAn()) ?>" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa món ăn này không?');">
                                        Xóa
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="6" class="text-center py-4">
                                Chưa có món ăn nào trong hệ thống.
                            </td>
                        </tr>

                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>