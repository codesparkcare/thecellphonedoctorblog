<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | CellPhone Doctor Blog</title>
    
    <!-- Google Fonts & Bootstrap 5 -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #032042 0%, #0a3d7c 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            max-width: 440px;
            width: 100%;
            overflow: hidden;
        }

        .login-header {
            background: #032042;
            padding: 32px 24px;
            text-align: center;
            color: #ffffff;
        }

        .logo-icon-lg {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #1A8EE0 0%, #0056b3 100%);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin-bottom: 14px;
            box-shadow: 0 6px 16px rgba(26, 142, 224, 0.4);
        }

        .form-control {
            padding: 12px 16px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: #1A8EE0;
            box-shadow: 0 0 0 4px rgba(26, 142, 224, 0.15);
        }

        .btn-login {
            background: #1A8EE0;
            color: #ffffff;
            font-weight: 700;
            padding: 12px;
            border-radius: 10px;
            font-size: 1rem;
            width: 100%;
            border: none;
            transition: all 0.2s;
        }

        .btn-login:hover {
            background: #1272b5;
            color: #ffffff;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <div class="logo-icon-lg">
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </div>
            <h4 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif;">The CellPhone Doctor</h4>
            <p class="text-white-50 mb-0" style="font-size: 0.85rem;">Blog & SEO Admin Portal</p>
        </div>

        <div class="p-4 p-sm-5">
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show text-sm py-2 px-3 mb-4" role="alert">
                    <i class="fa-solid fa-circle-exclamation me-1"></i> <?php echo $this->session->flashdata('error'); ?>
                    <button type="button" class="btn-close py-2" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo base_url('admin/login'); ?>">
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary" style="font-size: 0.85rem;">Username or Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-user"></i></span>
                        <input type="text" name="username" class="form-control border-start-0" placeholder="admin" required autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold text-secondary" style="font-size: 0.85rem;">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="password" class="form-control border-start-0" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fa-solid fa-right-to-bracket me-2"></i> Log In to Dashboard
                </button>
            </form>
        </div>
    </div>
</body>
</html>
