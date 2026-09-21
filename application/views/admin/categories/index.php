<div class="container-fluid px-4 py-3">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif;">Blog Categories</h3>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Organize repair articles and service guides into search-friendly topics.</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Add Category Form -->
        <div class="col-md-4">
            <div class="card p-4">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-circle-plus me-2 text-primary"></i> Add Category</h5>
                <form method="POST" action="<?php echo base_url('admin/categories'); ?>">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Screen Replacement" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" rows="3" class="form-control" placeholder="Short description of this category for SEO..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fa-solid fa-plus me-1"></i> Save Category
                    </button>
                </form>
            </div>
        </div>

        <!-- Categories Table -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0">Existing Categories (<?php echo count($categories); ?>)</h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Category Name</th>
                                <th>Slug</th>
                                <th>Articles</th>
                                <th class="text-end" style="width: 120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $i => $cat): ?>
                                    <tr>
                                        <td class="text-muted"><?php echo $i + 1; ?></td>
                                        <td>
                                            <div class="fw-bold text-dark"><?php echo html_escape($cat['name']); ?></div>
                                            <small class="text-muted"><?php echo html_escape($cat['description']); ?></small>
                                        </td>
                                        <td><span class="badge bg-light text-secondary border">/<?php echo html_escape($cat['slug']); ?></span></td>
                                        <td><span class="badge bg-primary-subtle text-primary"><?php echo $cat['total_posts']; ?> posts</span></td>
                                        <td class="text-end">
                                            <div class="btn-group btn-group-sm">
                                                <a href="<?php echo base_url('admin/edit_category/' . $cat['id']); ?>" class="btn btn-outline-primary" title="Edit">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                                <a href="<?php echo base_url('admin/delete_category/' . $cat['id']); ?>" class="btn btn-outline-danger" onclick="return confirm('Delete this category?');" title="Delete">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No categories created yet.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
