<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? html_escape($page_title) . ' | CellPhone Doctor Blog' : 'Blog Admin | The CellPhone Doctor'; ?></title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Summernote Lite WYSIWYG -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #1A8EE0;
            --primary-dark: #1272b5;
            --secondary: #64748b;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --dark: #0f172a;
            --sidebar-bg: #032042;
            --sidebar-header: #02152c;
            --sidebar-hover: #1A8EE0;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--gray-50);
            color: #334155;
            overflow-x: hidden;
        }

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
            min-height: 100vh;
        }

        #sidebar {
            min-width: 270px;
            max-width: 270px;
            background: var(--sidebar-bg);
            color: #fff;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
        }

        #sidebar.collapsed {
            margin-left: -270px;
        }

        .sidebar-header {
            padding: 22px 24px;
            background: var(--sidebar-header);
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-header .logo-badge {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #1A8EE0 0%, #0056b3 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            box-shadow: 0 4px 10px rgba(26, 142, 224, 0.4);
        }

        .sidebar-header h5 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            letter-spacing: -0.2px;
        }

        .sidebar-menu {
            padding: 15px 0;
            list-style: none;
            margin: 0;
        }

        .sidebar-menu li {
            padding: 4px 18px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            color: #94a3b8;
            padding: 11px 16px;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.2s;
            font-weight: 500;
            font-size: 0.92rem;
            gap: 12px;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: var(--sidebar-hover);
            color: #ffffff;
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(26, 142, 224, 0.35);
        }

        .sidebar-menu a i {
            width: 20px;
            text-align: center;
            font-size: 1.05rem;
        }

        .menu-title {
            color: #475569;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 16px 22px 6px;
            font-weight: 700;
        }

        #content {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .top-navbar {
            background: white;
            padding: 14px 28px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--gray-200);
        }

        .card {
            border: 1px solid var(--gray-200);
            border-radius: 14px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
            background: #fff;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            font-weight: 600;
            border-radius: 8px;
            padding: 8px 18px;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .seo-badge {
            background: #eff6ff;
            color: #1d4ed8;
            font-weight: 600;
            border: 1px solid #bfdbfe;
            border-radius: 6px;
            padding: 3px 8px;
            font-size: 0.75rem;
        }
    </style>
</head>
<body>
    <div class="wrapper">
