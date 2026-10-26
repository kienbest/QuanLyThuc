<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .auth-card { max-width: 450px; margin: 50px auto; }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="card auth-card shadow-sm border-0">
            <div class="card-body p-4">
                <h3 class="text-center text-uppercase text-success mb-4">Đăng ký</h3>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger py-2"><?= $error ?></div>
                <?php endif; ?>

                <form action="<?= DOMAIN ?>public/?controller=user&action=handleRegister" method="POST">
                    <div class="mb-3">
                        <label for="ho_ten" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="ho_ten" name="ho_ten" required>
                    </div>

                    <div class="mb-3">
                        <label for="ten_dang_nhap" class="form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="ten_dang_nhap" name="ten_dang_nhap" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="mat_khau" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="mat_khau" name="mat_khau" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100 mt-2">Đăng ký</button>
                </form>

                <div class="text-center mt-3">
                    <small>Đã có tài khoản? <a href="<?= DOMAIN ?>public/?controller=user&action=login" class="text-success fw-bold">Đăng nhập</a></small>
                </div>
            </div>
        </div>
    </div>
</body>
</html>