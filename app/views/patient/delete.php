<?php
if (!isset($patient)) {
    $patient = new Patient('', '', '','');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Xóa học sinh</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container">

    <h3 class="text-center text-uppercase text-danger mt-3 mb-3">
        Xác nhận xóa học sinh
    </h3>

    <div class="alert alert-warning">
        Bạn có chắc chắn muốn xóa bệnh nhân
        <strong><?= $patient->getMaSv(); ?></strong>
        không?
    </div>

    <form method="POST" action="<?= DOMAIN.'public/?controller=patient&action=destroy' ?>">

        <input
            type="hidden"
            name="tensv"
            value="<?= $patient->getTenSv(); ?>"
        >

        <button
            type="submit"
            class="btn btn-danger"
        >
            Xác nhận xóa
        </button>

        <a
            href="<?= DOMAIN.'public/' ?>"
            class="btn btn-secondary"
        >
            Hủy
        </a>

    </form>

</div>

</body>

</html>