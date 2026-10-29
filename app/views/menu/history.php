<?php

/** @var string $selectedDate */
/** @var array $selectedMenu */
/** @var array $history */
/** @var array $mealNames */
/** @var int $page */
/** @var int $totalPages */

// Hàm rút gọn để in dữ liệu an toàn (chống XSS)
function h($text)
{
    return htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8');
}

// Icon + màu cho từng bữa ăn
$mealStyles = [
    'Sang' => ['icon' => '☀️', 'class' => 'bg-warning-subtle'],
    'Trua' => ['icon' => '🌤️', 'class' => 'bg-success-subtle'],
    'Toi'  => ['icon' => '🌙', 'class' => 'bg-primary-subtle']
];

$baseUrl = DOMAIN . 'public/?controller=menu&action=history';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tra cứu thực đơn</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body>

    <!-- Thanh điều hướng -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container">

            <a class="navbar-brand fw-bold text-success"
                href="<?= DOMAIN ?>public/">
                Quản lý thực đơn
            </a>

            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto">

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
                        <a class="nav-link"
                            href="<?= DOMAIN ?>public/?controller=dish&action=index">
                            Món ăn
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active"
                            href="<?= $baseUrl ?>">
                            Tra cứu thực đơn
                        </a>
                    </li>

                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <span class="nav-link text-success fw-bold">Xin chào, <?= htmlspecialchars($_SESSION['user']['ho_ten'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?= DOMAIN ?>public/?controller=user&action=logout">Đăng xuất</a>
                        </li>
                    <?php else: ?>
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

    <div class="container mt-4 mb-5">

        <h3 class="text-center text-uppercase text-success mt-3 mb-4">
            Tra cứu thực đơn
        </h3>

        <!-- Form chọn ngày -->
        <form method="GET" action="<?= DOMAIN ?>public/" class="row g-3 align-items-end mb-4">

            <input type="hidden" name="controller" value="menu">
            <input type="hidden" name="action" value="history">

            <div class="col-md-4">
                <label for="date" class="form-label">Chọn ngày</label>
                <input
                    type="date"
                    id="date"
                    name="date"
                    class="form-control"
                    value="<?= h($selectedDate) ?>"
                    required>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Xem</button>
            </div>

        </form>

        <!-- Thực đơn của ngày được chọn -->
        <h5 class="mb-3">
            Thực đơn ngày <?= h(date('d/m/Y', strtotime($selectedDate))) ?>
        </h5>

        <div class="row g-3 mb-4">
            <?php foreach ($mealNames as $key => $name): ?>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-header fw-bold <?= $mealStyles[$key]['class'] ?>">
                            <?= $mealStyles[$key]['icon'] ?> <?= h($name) ?>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($selectedMenu[$key])): ?>
                                <?php foreach ($selectedMenu[$key] as $dishName): ?>
                                    <div><?= h($dishName) ?></div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <span class="text-muted">Chưa có món</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Lịch sử thực đơn -->
        <h5 class="mb-3">Lịch sử thực đơn</h5>

        <div class="table-responsive mb-3">
            <table class="table table-bordered table-striped align-middle">

                <thead class="table-light">
                    <tr>
                        <th scope="col">Ngày</th>
                        <th scope="col">Bữa sáng</th>
                        <th scope="col">Bữa trưa</th>
                        <th scope="col">Bữa tối</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($history)): ?>

                        <?php foreach ($history as $date => $meals): ?>
                            <tr>
                                <td>
                                    <a href="<?= $baseUrl ?>&date=<?= h($date) ?>">
                                        <?= h(date('d/m/Y', strtotime($date))) ?>
                                    </a>
                                </td>

                                <?php foreach ($mealNames as $key => $name): ?>
                                    <td>
                                        <?= !empty($meals[$key]) ? h(implode(', ', $meals[$key])) : '—' ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="4" class="text-center">
                                Chưa có lịch sử thực đơn.
                            </td>
                        </tr>

                    <?php endif; ?>
                </tbody>

            </table>
        </div>

        <!-- Phân trang (giữ nguyên ngày đang chọn) -->
        <?php if ($totalPages > 1): ?>
            <nav>
                <ul class="pagination justify-content-end">

                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link"
                            href="<?= $baseUrl ?>&date=<?= h($selectedDate) ?>&page=<?= $page - 1 ?>">
                            &laquo;
                        </a>
                    </li>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link"
                                href="<?= $baseUrl ?>&date=<?= h($selectedDate) ?>&page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link"
                            href="<?= $baseUrl ?>&date=<?= h($selectedDate) ?>&page=<?= $page + 1 ?>">
                            &raquo;
                        </a>
                    </li>

                </ul>
            </nav>
        <?php endif; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>