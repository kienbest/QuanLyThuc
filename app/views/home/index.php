
<?php
/** @var mixed $totalDishes */
/** @var mixed $todayMenuCount */
/** @var mixed $totalMenuDays */
/** @var string $selectedDate */
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quản lý thực đơn quán theo ngày</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
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

    <div class="container mt-4 mb-5">

        <!-- Tiêu đề -->
        <h3 class="text-center text-uppercase text-success mt-3 mb-4">
            Tổng quan thực đơn
        </h3>

        <!-- Thực đơn hôm nay -->
        <h5 class="mb-3">Thực đơn hôm nay</h5>

        <div class="table-responsive mb-4">
            <table class="table table-bordered table-striped align-middle">

                <thead class="table-light">
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Bữa ăn</th>
                        <th scope="col">Tên món ăn</th>
                        <th scope="col">Nguyên liệu</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($todayMenu)): ?>

                        <?php foreach ($todayMenu as $index => $item): ?>
                            <tr>
                                <th scope="row">
                                    <?= $index + 1 ?>
                                </th>

                                <td>
                                    <?= ($mealNames[$item['bua_an']] ?? $item['bua_an']) ?>
                                </td>

                                <td>
                                    <?= ($item['ten_mon_an']) ?>
                                </td>

                                <td>
                                    <?= ($item['nguyen_lieu'] ?? '') ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="4" class="text-center">
                                Hôm nay chưa có thực đơn.
                            </td>
                        </tr>

                    <?php endif; ?>
                </tbody>

            </table>
        </div>

        <!-- Lịch sử lập thực đơn -->
        <h5 class="mb-3">Lịch sử lập thực đơn</h5>

        <form
            method="GET"
            action="<?= DOMAIN ?>public/"
            class="row g-3 align-items-end mb-3"
        >

            <input type="hidden" name="controller" value="home">
            <input type="hidden" name="action" value="index">

            <div class="col-md-4">
                <label for="date" class="form-label">
                    Chọn ngày cần tra cứu
                </label>

                <input
                    type="date"
                    id="date"
                    name="date"
                    class="form-control"
                    value="<?= ($selectedDate) ?>"
                    required
                >
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-success">
                    Tra cứu
                </button>
            </div>

        </form>

        <p class="mb-2">
            Kết quả ngày:
            <strong>
                <?= date('d/m/Y', strtotime($selectedDate)) ?>
            </strong>
        </p>

        <div class="table-responsive mb-4">
            <table class="table table-bordered table-striped align-middle">

                <thead class="table-light">
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Bữa ăn</th>
                        <th scope="col">Tên món ăn</th>
                        <th scope="col">Cách chế biến</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($historyMenu)): ?>

                        <?php foreach ($historyMenu as $index => $item): ?>
                            <tr>
                                <th scope="row">
                                    <?= $index + 1 ?>
                                </th>

                                <td>
                                    <?= ($mealNames[$item['bua_an']] ?? $item['bua_an']) ?>
                                </td>

                                <td>
                                    <?= ($item['ten_mon_an']) ?>
                                </td>

                                <td>
                                    <?= ($item['cach_che_bien'] ?? '') ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="4" class="text-center">
                                Không có thực đơn trong ngày này.
                            </td>
                        </tr>

                    <?php endif; ?>
                </tbody>

            </table>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
