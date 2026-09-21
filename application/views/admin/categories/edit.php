<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1" style="font-size: 0.85rem;">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/categories'); ?>">Categories</a></li>
                    <li class="breadcrumb-item active">Edit Category</li>
                </ol>
            </nav>
            <h3 class="fw-bold mb-0" style="font-family: 'Poppins', sans-serif;">Edit Category</h3>
        </div>
        <a href="<?php echo base_url('admin/categories'); ?>" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Categories
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-pen-to-square me-2 text-primary"></i> Edit Category Details</h5>
                <form method="POST" action="<?php echo base_url('admin/edit_category/' . $category['id']); ?>">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="<?php echo html_escape($category['name']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" rows="3" class="form-control"><?php echo html_escape($category['description']); ?></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        <a href="<?php echo base_url('admin/categories'); ?>" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
