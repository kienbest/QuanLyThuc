
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lập thực đơn</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            background: white;
        }

        h3 {
            font-size: 35px;
            margin-top: 28px;
        }

        .dish {
            padding: 8px 0;
            display: flex;
            justify-content: space-between;
        }

        .delete-btn {
            color: red;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <!-- Thanh điều hướng -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container">

            <a class="navbar-brand fw-bold text-success"
               href="<?= DOMAIN ?>public/"> Quản lý thực đơn </a>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link active" href="<?= DOMAIN ?>public/?controller=home&action=index"> Tổng quan </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?= DOMAIN ?>public/?controller=menu&action=index"> Lập thực đơn </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= DOMAIN ?>public/?controller=dish&action=index"> Món ăn </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?= DOMAIN ?>public/?controller=menu&action=history"> Tra cứu thực đơn </a>
                    </li>

                    <?php if (isset($_SESSION['user'])): ?>
                        <!-- Khi đã đăng nhập: Hiện lời chào và nút Đăng xuất -->
                        <li class="nav-item">
                            <span class="nav-link text-success fw-bold">Xin chào, <?= htmlspecialchars($_SESSION['user']['ho_ten'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?= DOMAIN ?>public/?controller=user&action=logout">Đăng xuất</a>
                        </li>

                    <?php else: ?>
                        <!-- Khi chưa đăng nhập: Giữ nguyên 2 nút Đăng nhập và Đăng ký -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?= DOMAIN ?>public/?controller=user&action=login">Đăng nhập</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= DOMAIN ?>public/?controller=user&action=register">Đăng ký</a>
                        </li>
                    <?php endif; ?>


                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        <h3 class="text-center text-success mb-4">Lập thực đơn</h3>
        <h5 class="mb-3">Lập thực đơn theo ngày</h5>

        <form action="?controller=menu&action=store" method="POST">

            <div class="row mb-4">
                <div class="col-md-8">
                    <label class="form-label">Chọn ngày</label>
                    <input type="date" name="ngay_an" class="form-control"
                        value="<?= $ngayAn ?>"
                        onchange="location.href='?controller=menu&action=index&ngay_an='+this.value"
                        required>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-success">Lưu thực đơn</button>
                </div>
            </div>

            <div class="row">

                <!-- Bữa sáng -->
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-header bg-warning-subtle fw-bold">
                            Bữa sáng
                        </div>
                        <div class="card-body">
                            <select name="thuc_don[Sang]" class="form-select mb-3">
                                <option value="">Chọn món ăn</option>
                                <?php foreach ($monAn as $mon) { ?>
                                    <option value="<?= $mon['ma_mon_an'] ?>">
                                        <?= $mon['ten_mon_an'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php foreach ($thucDon as $td) {
                                if ($td['bua_an'] == 'Sang') { ?>
                                    <div class="dish">
                                        <span><?= $td['ten_mon_an'] ?></span>
                                        <a class="delete-btn" href="?controller=menu&action=delete&id=<?= $td['ma_thuc_don'] ?>&ngay_an=<?= urlencode($ngayAn) ?>">
                                            <i class="bi bi-x-lg"></i>
                                        </a>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                    </div>
                </div>

                <!-- Bữa trưa -->
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-header bg-success-subtle fw-bold">
                            Bữa trưa
                        </div>
                        <div class="card-body">
                            <select name="thuc_don[Trua]" class="form-select mb-3">
                                <option value="">Chọn món ăn</option>
                                <?php foreach ($monAn as $mon) { ?>
                                    <option value="<?= $mon['ma_mon_an'] ?>">
                                        <?= $mon['ten_mon_an'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php foreach ($thucDon as $td) {
                                if ($td['bua_an'] == 'Trua') { ?>
                                    <div class="dish">
                                        <span><?= $td['ten_mon_an'] ?></span>
                                        <a class="delete-btn" href="?controller=menu&action=delete&id=<?= $td['ma_thuc_don'] ?>&ngay_an=<?= urlencode($ngayAn) ?>">
                                            <i class="bi bi-x-lg"></i>
                                        </a>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                    </div>
                </div>

                <!-- Bữa tối -->
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-header bg-primary-subtle fw-bold">
                            Bữa tối
                        </div>
                        <div class="card-body">
                            <select name="thuc_don[Toi]" class="form-select mb-3">
                                <option value="">Chọn món ăn</option>
                                <?php foreach ($monAn as $mon) { ?>
                                    <option value="<?= $mon['ma_mon_an'] ?>">
                                        <?= $mon['ten_mon_an'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php foreach ($thucDon as $td) {
                                if ($td['bua_an'] == 'Toi') { ?>
                                    <div class="dish">
                                        <span><?= $td['ten_mon_an'] ?></span>
                                        <a class="delete-btn" href="?controller=menu&action=delete&id=<?= $td['ma_thuc_don'] ?>&ngay_an=<?= urlencode($ngayAn) ?>">
                                            <i class="bi bi-x-lg"></i>
                                        </a>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

</body>
</html>
