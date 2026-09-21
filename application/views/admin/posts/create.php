<div class="container-fluid px-4 py-3">
    <!-- Breadcrumb & Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1" style="font-size: 0.85rem;">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/posts'); ?>">Blog Posts</a></li>
                    <li class="breadcrumb-item active">New Article</li>
                </ol>
            </nav>
            <h3 class="fw-bold mb-0" style="font-family: 'Poppins', sans-serif;">Write New Blog Post</h3>
        </div>
        <a href="<?php echo base_url('admin/posts'); ?>" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Posts
        </a>
    </div>

    <form method="POST" action="<?php echo base_url('admin/create_post'); ?>" enctype="multipart/form-data">
        <div class="row g-4">
            <!-- Left Column: Main Content -->
            <div class="col-lg-8">
                <!-- Basic Content Card -->
                <div class="card p-4 mb-4">
                    <h5 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-file-lines me-2 text-primary"></i> Article Content</h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Article Title <span class="text-danger">*</span></label>
                        <input type="text" id="post_title" name="title" class="form-control form-control-lg" placeholder="e.g. 5 Common Mobile Display Issues and How to Fix Them" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">SEO URL Slug</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted" style="font-size: 0.85rem;">/blog/</span>
                            <input type="text" id="post_slug" name="slug" class="form-control" placeholder="5-common-mobile-display-issues">
                        </div>
                        <small class="text-muted">Auto-generated from title. Uses lowercase letters and hyphens for clean Google indexing.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Short Summary / Excerpt</label>
                        <textarea name="excerpt" rows="2" class="form-control" placeholder="Brief summary of the article (used in blog cards & preview snippets)..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Full Article Body <span class="text-danger">*</span></label>
                        <textarea name="content" class="summernote" required></textarea>
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
                            <div class="text-muted" style="font-size: 0.8rem;" id="serp_url">https://thecellphonedoctor.com > blog > ...</div>
                            <div class="text-primary fw-semibold" style="font-size: 1.1rem; font-family: arial, sans-serif; cursor: pointer;" id="serp_title">Your Article Title Will Appear Here | The CellPhone Doctor</div>
                            <div class="text-secondary" style="font-size: 0.85rem; line-height: 1.4;" id="serp_desc">Your meta description will appear here in Google search snippet. Keep it between 120-160 characters for maximum click-through rate.</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label class="form-label fw-semibold">Meta Title</label>
                            <small class="text-muted"><span id="meta_title_count">0</span> / 60 characters</small>
                        </div>
                        <input type="text" id="meta_title" name="meta_title" class="form-control" placeholder="Target keyword-focused title for Google">
                        <small class="text-muted">Recommended: 50-60 characters. If empty, the article title is used automatically.</small>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label class="form-label fw-semibold">Meta Description</label>
                            <small class="text-muted"><span id="meta_desc_count">0</span> / 160 characters</small>
                        </div>
                        <textarea id="meta_description" name="meta_description" rows="3" class="form-control" placeholder="Compelling summary designed to entice searchers to click from Google results..."></textarea>
                        <small class="text-muted">Recommended: 140-160 characters. Appears directly underneath your title in Google search results.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Meta Keywords</label>
                        <input type="text" name="meta_keywords" class="form-control" placeholder="phone screen repair, samsung display replacement, iphone battery fix, mobile doctor">
                        <small class="text-muted">Separate multiple target search keywords with commas.</small>
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-semibold">Canonical URL</label>
                        <input type="url" id="canonical_url" name="canonical_url" class="form-control" placeholder="https://thecellphonedoctor.com/blog/article-slug">
                        <small class="text-muted">Prevents duplicate content penalties. Auto-populated as: <span id="canonical_preview" class="fw-semibold text-primary">https://thecellphonedoctor.com/blog/...</span></small>
                    </div>
                </div>
            </div>

            <!-- Right Column: Settings & Publish Box -->
            <div class="col-lg-4">
                <!-- Publish Action Box -->
                <div class="card p-3 mb-4 sticky-top" style="top: 20px; z-index: 10;">
                    <h6 class="fw-bold mb-3"><i class="fa-solid fa-paper-plane me-2 text-primary"></i> Publish Settings</h6>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 0.85rem;">Publish Status</label>
                        <select name="status" class="form-select">
                            <option value="published" selected>Published (Visible to all & Google)</option>
                            <option value="draft">Draft (Save privately)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 0.85rem;">Author</label>
                        <input type="text" name="author" class="form-control" value="The CellPhone Doctor Team">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 0.85rem;">Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>"><?php echo html_escape($cat['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold" style="font-size: 0.85rem;">Featured Image</label>
                        <input type="file" name="featured_image" id="featured_image_input" class="form-control" accept="image/*">
                        <small class="text-muted d-block mt-1">Recommended: 1200x630 (optimal for Google & social sharing). Max 5MB.</small>
                        
                        <div id="image_preview_box" class="mt-2 text-center d-none">
                            <img id="image_preview" src="" class="img-fluid rounded border" style="max-height: 160px;" alt="">
                        </div>
                    </div>

                    <hr class="my-3">

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <span>Save & Publish Article</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Live SERP Preview Script
    document.addEventListener('DOMContentLoaded', function () {
        const titleInput = document.getElementById('post_title');
        const metaTitleInput = document.getElementById('meta_title');
        const metaDescInput = document.getElementById('meta_description');
        const slugInput = document.getElementById('post_slug');
        const imgInput = document.getElementById('featured_image_input');

        function updateSerp() {
            const title = metaTitleInput.value.trim() || titleInput.value.trim() || 'Your Article Title Will Appear Here';
            const desc = metaDescInput.value.trim() || 'Your meta description will appear here in Google search snippet. Keep it between 120-160 characters for maximum click-through rate.';
            const slug = slugInput.value.trim() || '...';

            document.getElementById('serp_title').textContent = title + (title.includes('CellPhone Doctor') ? '' : ' | The CellPhone Doctor');
            document.getElementById('serp_desc').textContent = desc;
            document.getElementById('serp_url').textContent = 'https://thecellphonedoctor.com > blog > ' + slug;
        }

        titleInput.addEventListener('input', updateSerp);
        metaTitleInput.addEventListener('input', updateSerp);
        metaDescInput.addEventListener('input', updateSerp);
        slugInput.addEventListener('input', updateSerp);

        // Image Preview
        if (imgInput) {
            imgInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('image_preview').src = e.target.result;
                        document.getElementById('image_preview_box').classList.remove('d-none');
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
