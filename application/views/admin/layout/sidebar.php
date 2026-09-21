<?php $current_uri = $this->uri->segment(2); ?>
<!-- Sidebar -->
<nav id="sidebar">
    <div class="sidebar-header">
        <div class="logo-badge"><i class="fa-solid fa-screwdriver-wrench"></i></div>
        <div>
            <h5 class="mb-0 fw-bold text-white">CellPhone Doctor</h5>
            <small class="text-white-50" style="font-size: 0.72rem; letter-spacing: 0.5px;">BLOG & SEO ADMIN</small>
        </div>
    </div>

    <ul class="sidebar-menu">
        <li class="menu-title">Main</li>
        <li>
            <a href="<?php echo base_url('admin/dashboard'); ?>" class="<?php echo ($current_uri == 'dashboard' || empty($current_uri)) ? 'active' : ''; ?>">
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </a>
        </li>

        <li class="menu-title">Blog Articles</li>
        <li>
            <a href="<?php echo base_url('admin/posts'); ?>" class="<?php echo ($current_uri == 'posts') ? 'active' : ''; ?>">
                <i class="fa-solid fa-newspaper"></i> All Blog Posts
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/create_post'); ?>" class="<?php echo ($current_uri == 'create_post') ? 'active' : ''; ?>">
                <i class="fa-solid fa-circle-plus"></i> Write New Post
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/categories'); ?>" class="<?php echo ($current_uri == 'categories' || $current_uri == 'edit_category') ? 'active' : ''; ?>">
                <i class="fa-solid fa-tags"></i> Categories
            </a>
        </li>

        <li class="menu-title">Quick Links</li>
        <li>
            <a href="<?php echo base_url(); ?>" target="_blank">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> View Public Blog
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/logout'); ?>" class="text-danger">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
            </a>
        </li>
    </ul>
</nav>

<!-- Main Content Wrapper -->
<div id="content">
    <!-- Top Navbar -->
    <div class="top-navbar">
        <button type="button" id="sidebarCollapse" class="btn btn-light btn-sm border">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="d-flex align-items-center gap-3">
            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                <i class="fa-solid fa-circle-dot me-1"></i> SEO Engine Active
            </span>
            <div class="dropdown">
                <button class="btn btn-light btn-sm border dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-user-shield text-primary"></i>
                    <span class="fw-semibold"><?php echo html_escape($this->session->userdata('admin_name') ? $this->session->userdata('admin_name') : 'Admin'); ?></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                    <li><a class="dropdown-item" href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa-solid fa-gauge me-2 text-muted"></i> Dashboard</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="<?php echo base_url('admin/logout'); ?>"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Alert Flash Messages -->
    <div class="px-4 pt-3">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-3" role="alert">
                <i class="fa-solid fa-circle-check me-2 fs-5"></i>
                <div><?php echo $this->session->flashdata('success'); ?></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-3" role="alert">
                <i class="fa-solid fa-circle-exclamation me-2 fs-5"></i>
                <div><?php echo $this->session->flashdata('error'); ?></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
    </div>
