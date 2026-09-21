<div class="container-fluid px-4 py-3">
    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h3 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif;">Manage Blog Posts</h3>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Create, optimize and publish SEO-targeted repair articles.</p>
        </div>
        <a href="<?php echo base_url('admin/create_post'); ?>" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="fa-solid fa-circle-plus"></i>
            <span>Add New Post</span>
        </a>
    </div>

    <!-- Filters Bar -->
    <div class="card p-3 mb-4">
        <form method="GET" action="<?php echo base_url('admin/posts'); ?>" class="row g-2 align-items-center">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="Search by title, keyword..." value="<?php echo html_escape($filter_search); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-select">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>" <?php echo ($filter_cat == $cat['id']) ? 'selected' : ''; ?>>
                            <?php echo html_escape($cat['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="published" <?php echo ($filter_status == 'published') ? 'selected' : ''; ?>>Published</option>
                    <option value="draft" <?php echo ($filter_status == 'draft') ? 'selected' : ''; ?>>Draft</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-secondary w-100">Filter</button>
                <?php if (!empty($filter_search) || !empty($filter_cat) || !empty($filter_status)): ?>
                    <a href="<?php echo base_url('admin/posts'); ?>" class="btn btn-outline-danger" title="Clear Filters"><i class="fa-solid fa-xmark"></i></a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Posts Table -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th style="width: 70px;">Thumbnail</th>
                        <th>Title & SEO Slug</th>
                        <th>Category</th>
                        <th>SEO Health</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th>Created</th>
                        <th class="text-end" style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($posts)): ?>
                        <?php foreach ($posts as $idx => $post): ?>
                            <tr>
                                <td class="text-muted"><?php echo $idx + 1; ?></td>
                                <td>
                                    <?php if (!empty($post['featured_image'])): ?>
                                        <img src="<?php echo base_url($post['featured_image']); ?>" class="rounded" style="width: 54px; height: 54px; object-fit: cover;" alt="">
                                    <?php else: ?>
                                        <div class="rounded bg-light d-flex align-items-center justify-content-center text-muted border" style="width: 54px; height: 54px;">
                                            <i class="fa-solid fa-image"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?php echo html_escape($post['title']); ?></div>
                                    <small class="text-muted d-block font-monospace" style="font-size: 0.78rem;">
                                        /blog/<?php echo html_escape($post['slug']); ?>
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-secondary border">
                                        <?php echo html_escape(!empty($post['category_name']) ? $post['category_name'] : 'General'); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php 
                                        $has_seo = !empty($post['meta_title']) && !empty($post['meta_description']);
                                    ?>
                                    <?php if ($has_seo): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle" title="Meta Title & Description set">
                                            <i class="fa-solid fa-check me-1"></i> Optimized
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle" title="Missing custom meta tags">
                                            <i class="fa-solid fa-triangle-exclamation me-1"></i> Partial
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($post['status'] == 'published'): ?>
                                        <span class="badge bg-success text-white">Published</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary text-white">Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="fw-semibold text-muted"><i class="fa-solid fa-eye me-1"></i><?php echo number_format($post['views']); ?></span>
                                </td>
                                <td>
                                    <small class="text-muted"><?php echo date('M d, Y', strtotime($post['created_at'])); ?></small>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?php echo base_url($post['slug']); ?>" target="_blank" class="btn btn-outline-secondary" title="View Public Page">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </a>
                                        <a href="<?php echo base_url('admin/edit_post/' . $post['id']); ?>" class="btn btn-outline-primary" title="Edit Article">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="<?php echo base_url('admin/delete_post/' . $post['id']); ?>" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this blog post? This action cannot be undone.');" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-magnifying-glass fs-2 mb-2 d-block"></i>
                                No articles found. <a href="<?php echo base_url('admin/create_post'); ?>">Create your first blog article</a>.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
