<div class="container-fluid px-4 py-3">
    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h3 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif;">Blog Dashboard</h3>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Overview of published articles, SEO reach, and category insights.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?php echo base_url('admin/create_post'); ?>" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                <span>Write New Article</span>
            </a>
            <a href="<?php echo base_url(); ?>" target="_blank" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                <span>Live Blog</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card p-3 h-100">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem;">Total Posts</span>
                        <h2 class="fw-bold mb-0 mt-1"><?php echo $stats['total_posts']; ?></h2>
                        <small class="text-muted"><?php echo $stats['published_posts']; ?> published</small>
                    </div>
                    <div class="p-3 rounded-3 bg-primary-subtle text-primary fs-3">
                        <i class="fa-solid fa-newspaper"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card p-3 h-100">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem;">Total Views</span>
                        <h2 class="fw-bold mb-0 mt-1"><?php echo number_format($stats['total_views']); ?></h2>
                        <small class="text-success"><i class="fa-solid fa-arrow-trend-up"></i> Organic Reach</small>
                    </div>
                    <div class="p-3 rounded-3 bg-success-subtle text-success fs-3">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card p-3 h-100">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem;">Drafts</span>
                        <h2 class="fw-bold mb-0 mt-1"><?php echo $stats['draft_posts']; ?></h2>
                        <small class="text-muted">Unpublished</small>
                    </div>
                    <div class="p-3 rounded-3 bg-warning-subtle text-warning fs-3">
                        <i class="fa-solid fa-file-pen"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card p-3 h-100">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem;">Categories</span>
                        <h2 class="fw-bold mb-0 mt-1"><?php echo $stats['total_categories']; ?></h2>
                        <small class="text-muted">Active Topics</small>
                    </div>
                    <div class="p-3 rounded-3 bg-info-subtle text-info fs-3">
                        <i class="fa-solid fa-tags"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Posts Section -->
    <div class="card">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold"><i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i> Recently Published Articles</h5>
            <a href="<?php echo base_url('admin/posts'); ?>" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 60px;">Image</th>
                        <th>Article Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th>Date</th>
                        <th class="text-end" style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($recent_posts)): ?>
                        <?php foreach ($recent_posts as $post): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($post['featured_image'])): ?>
                                        <img src="<?php echo base_url($post['featured_image']); ?>" class="rounded" style="width: 50px; height: 50px; object-fit: cover;" alt="">
                                    <?php else: ?>
                                        <div class="rounded bg-light d-flex align-items-center justify-content-center text-muted" style="width: 50px; height: 50px;">
                                            <i class="fa-solid fa-image"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?php echo html_escape($post['title']); ?></div>
                                    <small class="text-muted text-truncate d-inline-block" style="max-width: 320px;">
                                        /blog/<?php echo html_escape($post['slug']); ?>
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-secondary border">
                                        <?php echo html_escape(!empty($post['category_name']) ? $post['category_name'] : 'Uncategorized'); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($post['status'] == 'published'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle">Published</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle">Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td><i class="fa-solid fa-eye text-muted me-1"></i> <?php echo number_format($post['views']); ?></td>
                                <td><small class="text-muted"><?php echo date('M d, Y', strtotime($post['created_at'])); ?></small></td>
                                <td class="text-end">
                                    <a href="<?php echo base_url('post/' . $post['slug']); ?>" target="_blank" class="btn btn-sm btn-light border text-primary" title="View Article">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                    <a href="<?php echo base_url('admin/edit_post/' . $post['id']); ?>" class="btn btn-sm btn-light border text-secondary" title="Edit Article">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-folder-open fs-2 mb-2 d-block"></i>
                                No blog articles created yet. Click <strong>"Write New Article"</strong> above to publish your first SEO guide!
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
