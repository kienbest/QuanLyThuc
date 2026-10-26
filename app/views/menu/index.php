
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
            background-color: white;
        }

        .card {
            height: 100%;
        }

        .card-header {
            font-weight: bold;
        }

        .dish {
            padding: 8px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .delete-btn {
            color: red;
            text-decoration: none;
        }
        
        h3 {
            font-size: 35px;
            margin-top: 28px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container">

            <a class="navbar-brand fw-bold text-success"
               href="<?= DOMAIN ?>public/">
                Menu Daily
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar"
                aria-controls="mainNavbar"
                aria-expanded="false"
                aria-label="Mở thanh điều hướng"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link active"
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
                        <a class="nav-link"
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
                           value="<?= htmlspecialchars($ngayAn) ?>" required>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-success">Lưu thực đơn</button>
                </div>
            </div>

            <div class="row">

                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-header bg-warning-subtle">
                            <i class="bi bi-sun"></i> Bữa sáng
                        </div>

                        <div class="card-body">
                            <select name="thuc_don[Sang]" class="form-select mb-3">
                                <option value="">-- Chọn món ăn --</option>
                                <?php foreach ($monAn as $mon) { ?>
                                    <option value="<?= $mon['ma_mon_an'] ?>">
                                        <?= htmlspecialchars($mon['ten_mon_an']) ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <?php foreach ($thucDon as $td) {
                                if ($td['bua_an'] == 'Sang') { ?>
                                    <div class="dish">
                                        <span><?= htmlspecialchars($td['ten_mon_an']) ?></span>
                                        <a class="delete-btn"
                                           href="?controller=menu&action=delete&id=<?= $td['ma_thuc_don'] ?>&ngay_an=<?= urlencode($ngayAn) ?>">
                                            <i class="bi bi-x-lg"></i>
                                        </a>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-header bg-success-subtle">
                            <i class="bi bi-brightness-high"></i> Bữa trưa
                        </div>

                        <div class="card-body">
                            <select name="thuc_don[Trua]" class="form-select mb-3">
                                <option value="">-- Chọn món ăn --</option>
                                <?php foreach ($monAn as $mon) { ?>
                                    <option value="<?= $mon['ma_mon_an'] ?>">
                                        <?= htmlspecialchars($mon['ten_mon_an']) ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <?php foreach ($thucDon as $td) {
                                if ($td['bua_an'] == 'Trua') { ?>
                                    <div class="dish">
                                        <span><?= htmlspecialchars($td['ten_mon_an']) ?></span>
                                        <a class="delete-btn"
                                           href="?controller=menu&action=delete&id=<?= $td['ma_thuc_don'] ?>&ngay_an=<?= urlencode($ngayAn) ?>">
                                            <i class="bi bi-x-lg"></i>
                                        </a>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-header bg-primary-subtle">
                            <i class="bi bi-moon"></i> Bữa tối
                        </div>

                        <div class="card-body">
                            <select name="thuc_don[Toi]" class="form-select mb-3">
                                <option value="">-- Chọn món ăn --</option>
                                <?php foreach ($monAn as $mon) { ?>
                                    <option value="<?= $mon['ma_mon_an'] ?>">
                                        <?= htmlspecialchars($mon['ten_mon_an']) ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <?php foreach ($thucDon as $td) {
                                if ($td['bua_an'] == 'Toi') { ?>
                                    <div class="dish">
                                        <span><?= htmlspecialchars($td['ten_mon_an']) ?></span>
                                        <a class="delete-btn"
                                           href="?controller=menu&action=delete&id=<?= $td['ma_thuc_don'] ?>&ngay_an=<?= urlencode($ngayAn) ?>">
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
