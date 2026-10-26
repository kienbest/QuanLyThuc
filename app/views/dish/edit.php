
<?php

/** @var Dish $dish */

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin món ăn</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        form {
            width: 30%;
            margin: auto;
        }

        button {
            margin-top: 10px;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="text-center text-uppercase text-success mt-3 mb-3">Cập nhật thông tin món ăn</h3>

        <form action="?controller=dish&action=update" method="post">

            <input type="hidden" name="ma_mon_an" value="<?= $dish->getMaMonAn(); ?>">

            <div class="mb-3">
                <label for="ma_nguoi_dung" class="form-label">Mã người dùng</label>
                <input type="number" class="form-control" id="ma_nguoi_dung" name="ma_nguoi_dung" value="<?= $dish->getMaNguoiDung(); ?>">
            </div>

            <div class="mb-3">
                <label for="ten_mon_an" class="form-label">Tên món ăn</label>
                <input type="text" class="form-control" id="ten_mon_an" name="ten_mon_an" value="<?= $dish->getTenMonAn(); ?>">
            </div>

            <div class="mb-3">
                <label for="nguyen_lieu" class="form-label">Nguyên liệu</label>
                <textarea class="form-control" id="nguyen_lieu" name="nguyen_lieu" rows="3"><?= $dish->getNguyenLieu(); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="cach_che_bien" class="form-label">Cách chế biến</label>
                <textarea class="form-control" id="cach_che_bien" name="cach_che_bien" rows="4"><?= $dish->getCachCheBien(); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary" name="btn_update">Cập nhật</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
