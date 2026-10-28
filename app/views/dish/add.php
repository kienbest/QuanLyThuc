
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm món ăn</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <h3 class="text-center text-uppercase text-success mt-3 mb-3">
            Thêm món ăn
        </h3>

        <form action="?controller=dish&action=store" method="post">
            <div class="mb-3">
                <label for="ma_nguoi_dung" class="form-label">Mã người dùng</label>
                <input type="number" class="form-control"
                    id="ma_nguoi_dung" name="ma_nguoi_dung"
                    placeholder="Nhập mã người dùng" required>
            </div>

            <div class="mb-3">
                <label for="ten_mon_an" class="form-label">Tên món ăn</label>
                <input type="text" class="form-control"
                    id="ten_mon_an" name="ten_mon_an"
                    placeholder="Nhập tên món ăn" required>
            </div>

            <div class="mb-3">
                <label for="nguyen_lieu" class="form-label">Nguyên liệu</label>
                <textarea class="form-control"
                    id="nguyen_lieu" name="nguyen_lieu"
                    placeholder="Nhập nguyên liệu" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="cach_che_bien" class="form-label">Cách chế biến</label>
                <textarea class="form-control"
                    id="cach_che_bien" name="cach_che_bien"
                    placeholder="Nhập cách chế biến" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary" name="btn_create">
                Thêm món ăn
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
