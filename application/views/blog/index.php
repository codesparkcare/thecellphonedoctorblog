<!-- Hero Section -->
<section class="blog-hero">
    <div class="container text-center position-relative" style="z-index: 2;">
        <?php if (isset($category)): ?>
            <span class="badge bg-light text-primary px-3 py-2 mb-3 fw-bold text-uppercase" style="letter-spacing: 1px;">
                <i class="fa-solid fa-tag me-1"></i> Category
            </span>
            <h2 class="display-6 fw-bold text-white mb-2"><?php echo html_escape($category['name']); ?></h2>
            <p class="lead text-white-50 mx-auto" style="max-width: 650px; font-size: 1.05rem;">
                <?php echo html_escape(!empty($category['description']) ? $category['description'] : 'Expert repair guides and troubleshooting tips for ' . $category['name']); ?>
            </p>
        <?php else: ?>
            <span class="badge bg-primary-subtle text-white px-3 py-2 mb-3 fw-bold text-uppercase border border-white-50" style="letter-spacing: 1px;">
                <i class="fa-solid fa-sparkles me-1"></i> Certified Technician Insights
            </span>
            <h2 class="display-5 fw-bold text-white mb-2">Smartphone Repair Guides & Tips</h2>
            <p class="lead text-white-50 mx-auto mb-4" style="max-width: 680px; font-size: 1.1rem;">
                Learn how to troubleshoot screen cracks, battery drain, water damage and motherboard faults from Tamil Nadu’s #1 smartphone repair experts.
            </p>

            <!-- Search Bar -->
            <div class="mx-auto" style="max-width: 520px;">
                <form method="GET" action="<?php echo base_url('blog'); ?>" class="input-group input-group-lg shadow-sm">
                    <input type="text" name="q" class="form-control border-0 ps-4" placeholder="Search display, battery, water damage..." value="<?php echo html_escape($search_query); ?>" style="border-radius: 12px 0 0 12px; font-size: 0.95rem;">
                    <button class="btn btn-primary px-4 fw-bold" type="submit" style="border-radius: 0 12px 12px 0;">
                        <i class="fa-solid fa-magnifying-glass me-1"></i> Search
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Main Listing Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Articles Grid -->
            <div class="col-lg-8">
                <?php if (!empty($search_query)): ?>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="text-muted mb-0">Search results for: <span class="fw-bold text-dark">"<?php echo html_escape($search_query); ?>"</span> (<?php echo $total_posts; ?> found)</h5>
                        <a href="<?php echo base_url('blog'); ?>" class="btn btn-sm btn-outline-secondary">Clear Search</a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($posts)): ?>
                    <div class="row g-4">
                        <?php foreach ($posts as $post): ?>
                            <div class="col-md-6">
                                <div class="blog-card">
                                    <a href="<?php echo base_url('blog/post/' . $post['slug']); ?>">
                                        <?php if (!empty($post['featured_image'])): ?>
                                            <img src="<?php echo base_url($post['featured_image']); ?>" class="blog-card-img" alt="<?php echo html_escape($post['title']); ?>" loading="lazy">
                                        <?php else: ?>
                                            <div class="blog-card-img bg-light d-flex align-items-center justify-content-center text-muted">
                                                <i class="fa-solid fa-mobile-screen fs-1 text-secondary"></i>
                                            </div>
                                        <?php endif; ?>
                                    </a>

                                    <div class="p-4 d-flex flex-column flex-grow-1">
                                        <div>
                                            <?php if (!empty($post['category_slug'])): ?>
                                                <a href="<?php echo base_url('blog/category/' . $post['category_slug']); ?>" class="blog-badge">
                                                    <?php echo html_escape($post['category_name']); ?>
                                                </a>
                                            <?php endif; ?>

                                            <h3 class="blog-card-title">
                                                <a href="<?php echo base_url('blog/post/' . $post['slug']); ?>">
                                                    <?php echo html_escape($post['title']); ?>
                                                </a>
                                            </h3>

                                            <p class="text-muted mb-3" style="font-size: 0.92rem; line-height: 1.55;">
                                                <?php echo html_escape(character_limiter($post['excerpt'], 110)); ?>
                                            </p>
                                        </div>

                                        <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center" style="font-size: 0.8rem; color: #64748b;">
                                            <span><i class="fa-regular fa-calendar me-1"></i> <?php echo date('M d, Y', strtotime($post['created_at'])); ?></span>
                                            <span><i class="fa-regular fa-eye me-1"></i> <?php echo number_format($post['views']); ?> views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Pagination -->
                    <?php if (!empty($pagination)): ?>
                        <div class="mt-5">
                            <?php echo $pagination; ?>
                        </div>
                    <?php endif; ?>

                <?php else: ?>
                    <div class="text-center py-5 bg-white rounded-4 border p-5">
                        <i class="fa-solid fa-newspaper fs-1 text-muted mb-3"></i>
                        <h4 class="fw-bold">No articles found</h4>
                        <p class="text-muted">Check back soon for new troubleshooting guides and repair tutorials.</p>
                        <a href="<?php echo base_url('blog'); ?>" class="btn btn-primary mt-2">View All Articles</a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 90px;">
                    <!-- Categories Widget -->
                    <div class="card p-4 mb-4">
                        <h5 class="fw-bold mb-3 pb-2 border-bottom"><i class="fa-solid fa-tags me-2 text-primary"></i> Repair Topics</h5>
                        <ul class="list-unstyled mb-0">
                            <?php foreach ($categories as $cat): ?>
                                <li class="mb-2">
                                    <a href="<?php echo base_url('blog/category/' . $cat['slug']); ?>" class="d-flex justify-content-between align-items-center text-decoration-none text-secondary py-1 px-2 rounded hover-bg">
                                        <span class="fw-medium"><i class="fa-solid fa-angle-right me-2 text-muted" style="font-size: 0.8rem;"></i> <?php echo html_escape($cat['name']); ?></span>
                                        <span class="badge bg-light text-muted border"><?php echo $cat['total_posts']; ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Fast Booking Callout Card -->
                    <div class="card p-4 text-white" style="background: linear-gradient(135deg, #032042 0%, #1A8EE0 100%); border-radius: 18px;">
                        <span class="badge bg-white text-primary w-auto align-self-start px-2 py-1 mb-3 fw-bold">FAST DOORSTEP SERVICE</span>
                        <h4 class="fw-bold text-white mb-2">Phone Screen Broken or Battery Draining?</h4>
                        <p class="text-white-50 mb-3" style="font-size: 0.9rem;">
                            Get genuine spares with up to 6 months warranty. Free diagnostic and pickup across Chennai and Tamil Nadu.
                        </p>
                        <a href="https://thecellphonedoctor.com" class="btn btn-light text-primary fw-bold w-100 py-2">
                            <i class="fa-solid fa-bolt me-1"></i> Book Phone Repair Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
