<div class="container-fluid px-4 py-3">
    <!-- Breadcrumb & Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1" style="font-size: 0.85rem;">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/posts'); ?>">Blog Posts</a></li>
                    <li class="breadcrumb-item active">Edit Article</li>
                </ol>
            </nav>
            <h3 class="fw-bold mb-0" style="font-family: 'Poppins', sans-serif;">Edit Blog Post</h3>
        </div>
        <div class="d-flex gap-2">
            <a href="<?php echo base_url('post/' . $post['slug']); ?>" target="_blank" class="btn btn-outline-primary btn-sm">
                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> View Live
            </a>
            <a href="<?php echo base_url('admin/posts'); ?>" class="btn btn-outline-secondary btn-sm">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Posts
            </a>
        </div>
    </div>

    <form method="POST" action="<?php echo base_url('admin/edit_post/' . $post['id']); ?>" enctype="multipart/form-data">
        <div class="row g-4">
            <!-- Left Column: Main Content -->
            <div class="col-lg-8">
                <!-- Basic Content Card -->
                <div class="card p-4 mb-4">
                    <h5 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-file-lines me-2 text-primary"></i> Article Content</h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Article Title <span class="text-danger">*</span></label>
                        <input type="text" id="post_title" name="title" class="form-control form-control-lg" value="<?php echo html_escape($post['title']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">SEO URL Slug</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted" style="font-size: 0.85rem;">/blog/</span>
                            <input type="text" id="post_slug" name="slug" class="form-control" value="<?php echo html_escape($post['slug']); ?>" data-touched="true">
                        </div>
                        <small class="text-muted">Slug is used in your permanent URL. Changes will alter the link.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Short Summary / Excerpt</label>
                        <textarea name="excerpt" rows="2" class="form-control"><?php echo html_escape($post['excerpt']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Full Article Body <span class="text-danger">*</span></label>
                        <textarea name="content" class="summernote" required><?php echo $post['content']; ?></textarea>
                    </div>
                </div>

                <!-- Dedicated SEO Optimizer Card -->
                <div class="card p-4 mb-4" style="border-left: 4px solid var(--primary);">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">
                                <i class="fa-solid fa-magnifying-glass-chart me-2 text-primary"></i> Google SEO Settings
                            </h5>
                            <small class="text-muted">Optimize title, meta tags and canonical URL to rank on Google 1st Page</small>
                        </div>
                        <span class="seo-badge"><i class="fa-solid fa-shield-halved me-1"></i> Google Ready</span>
                    </div>

                    <!-- Live Google Search Result Preview -->
                    <div class="p-3 mb-4 rounded-3 bg-light border">
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 0.8px;">Google Search Preview (SERP)</small>
                        <div class="mt-2">
                            <div class="text-muted" style="font-size: 0.8rem;" id="serp_url">https://thecellphonedoctor.com > blog > <?php echo html_escape($post['slug']); ?></div>
                            <div class="text-primary fw-semibold" style="font-size: 1.1rem; font-family: arial, sans-serif; cursor: pointer;" id="serp_title"><?php echo html_escape(!empty($post['meta_title']) ? $post['meta_title'] : $post['title']); ?></div>
                            <div class="text-secondary" style="font-size: 0.85rem; line-height: 1.4;" id="serp_desc"><?php echo html_escape(!empty($post['meta_description']) ? $post['meta_description'] : $post['excerpt']); ?></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label class="form-label fw-semibold">Meta Title</label>
                            <small class="text-muted"><span id="meta_title_count"><?php echo strlen($post['meta_title']); ?></span> / 60 characters</small>
                        </div>
                        <input type="text" id="meta_title" name="meta_title" class="form-control" value="<?php echo html_escape($post['meta_title']); ?>">
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label class="form-label fw-semibold">Meta Description</label>
                            <small class="text-muted"><span id="meta_desc_count"><?php echo strlen($post['meta_description']); ?></span> / 160 characters</small>
                        </div>
                        <textarea id="meta_description" name="meta_description" rows="3" class="form-control"><?php echo html_escape($post['meta_description']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Meta Keywords</label>
                        <input type="text" name="meta_keywords" class="form-control" value="<?php echo html_escape($post['meta_keywords']); ?>" placeholder="phone repair, screen fix, battery replacement">
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-semibold">Canonical URL</label>
                        <input type="url" id="canonical_url" name="canonical_url" class="form-control" value="<?php echo html_escape($post['canonical_url']); ?>">
                    </div>
                </div>
            </div>

            <!-- Right Column: Settings & Publish Box -->
            <div class="col-lg-4">
                <div class="card p-3 mb-4 sticky-top" style="top: 20px; z-index: 10;">
                    <h6 class="fw-bold mb-3"><i class="fa-solid fa-paper-plane me-2 text-primary"></i> Save Changes</h6>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 0.85rem;">Publish Status</label>
                        <select name="status" class="form-select">
                            <option value="published" <?php echo ($post['status'] == 'published') ? 'selected' : ''; ?>>Published (Live)</option>
                            <option value="draft" <?php echo ($post['status'] == 'draft') ? 'selected' : ''; ?>>Draft (Hidden)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 0.85rem;">Author</label>
                        <input type="text" name="author" class="form-control" value="<?php echo html_escape($post['author']); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 0.85rem;">Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>" <?php echo ($post['category_id'] == $cat['id']) ? 'selected' : ''; ?>>
                                    <?php echo html_escape($cat['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold" style="font-size: 0.85rem;">Featured Image</label>
                        <?php if (!empty($post['featured_image'])): ?>
                            <div class="mb-2 text-center">
                                <img src="<?php echo base_url($post['featured_image']); ?>" class="img-fluid rounded border" style="max-height: 140px;" alt="">
                                <small class="text-muted d-block mt-1">Current Image</small>
                            </div>
                        <?php endif; ?>
                        <input type="file" name="featured_image" id="featured_image_input" class="form-control" accept="image/*">
                        <small class="text-muted d-block mt-1">Upload new image to replace current.</small>
                    </div>

                    <hr class="my-3">

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Update Article</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
