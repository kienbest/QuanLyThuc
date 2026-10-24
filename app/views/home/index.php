<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sinh viên</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <?php
    function e($value) {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
    ?>

    <div class="container">
        <h3 class="text-center text-uppercase text-success mt-3 mb-3">
            Quản lý sinh viên
        </h3>

        <a href="?controller=dish&action=add" class="btn btn-success">
            Thêm
        </a>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Mã sinh viên</th>
                    <th scope="col">Tên sinh viên</th>
                    <th scope="col">Lớp</th>
                    <th scope="col">Khoa</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">Xóa</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($dishes)): ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            Chưa có dữ liệu sinh viên.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($dishes as $dish): ?>
                        <?php $dishId = $dish->getMaSv(); ?>

                        <tr>
                            <th scope="row"><?= e($dish->getMaSv()) ?></th>
                            <td><?= e($dish->getTenSv()) ?></td>
                            <td><?= e($dish->getLop()) ?></td>
                            <td><?= e($dish->getKhoa()) ?></td>

                            <td>
                                <a href="<?= DOMAIN ?>public/?controller=dish&action=edit&MaSv=<?= e($dishId) ?>">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>

                            <td>
                                <a href="<?= DOMAIN ?>public/?controller=dish&action=delete&MaSv=<?= e($dishId) ?>"
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
