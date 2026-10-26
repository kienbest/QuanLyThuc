<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .auth-card { max-width: 420px; margin: 80px auto; }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="card auth-card shadow-sm border-0">
            <div class="card-body p-4">
                <h3 class="text-center text-uppercase text-success mb-4">Đăng nhập</h3>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger py-2"><?= $error ?></div>
                <?php endif; ?>

                <?php if (!empty($success)): ?>
                    <div class="alert alert-success py-2"><?= $success ?></div>
                <?php endif; ?>

                <form action="<?= DOMAIN ?>public/?controller=user&action=handleLogin" method="POST">
                    <div class="mb-3">
                        <label for="ten_dang_nhap" class="form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="ten_dang_nhap" name="ten_dang_nhap" required>
                    </div>

                    <div class="mb-3">
                        <label for="mat_khau" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="mat_khau" name="mat_khau" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100 mt-2">Đăng nhập</button>
                </form>

                <div class="text-center mt-3">
                    <small>Chưa có tài khoản? <a href="<?= DOMAIN ?>public/?controller=user&action=register" class="text-success fw-bold">Đăng ký ngay</a></small>
                </div>
            </div>
        </div>
    </div>
</body>
</html>