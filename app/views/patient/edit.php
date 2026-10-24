<!DOCTYPE html>

<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sinh viên</title>

<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
>

</head>

<body>

<div class="container">

<h3 class="text-center text-uppercase text-success mt-3 mb-3">
    Sửa sinh viên
</h3>

<?php if ($patient === null) { ?>

    <div class="alert alert-warning" role="alert">
        Không tìm thấy sinh viên cần sửa.
    </div>

    <a href="<?= DOMAIN . 'public/' ?>" class="btn btn-secondary">
        Quay lại
    </a>

<?php } else { ?>

    <form method="POST" action="<?= DOMAIN . 'public/?controller=patient&action=update' ?>">

        <div class="mb-3">
            <label class="form-label">Mã sinh viên</label>

            <input
                type="text"
                name="masv"
                class="form-control"
                value="<?= htmlspecialchars((string) $patient->getMaSv(), ENT_QUOTES, 'UTF-8') ?>"
                readonly
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Tên sinh viên</label>

            <input
                type="text"
                name="tensv"
                class="form-control"
                value="<?= htmlspecialchars((string) $patient->getTenSv(), ENT_QUOTES, 'UTF-8') ?>"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Lớp</label>

            <input
                type="text"
                name="lop"
                class="form-control"
                value="<?= htmlspecialchars((string) $patient->getLop(), ENT_QUOTES, 'UTF-8') ?>"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Khoa</label>

            <input
                type="text"
                name="khoa"
                class="form-control"
                value="<?= htmlspecialchars((string) $patient->getKhoa(), ENT_QUOTES, 'UTF-8') ?>"
                required
            >
        </div>

        <button type="submit" class="btn btn-success">
            Cập nhật
        </button>

        <a href="<?= DOMAIN . 'public/' ?>" class="btn btn-secondary">
            Quay lại
        </a>

    </form>

<?php } ?>

</div>

</body>
</html>