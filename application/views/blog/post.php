<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb" style="font-size: 0.88rem;">
            <li class="breadcrumb-item"><a href="<?php echo base_url('blog'); ?>" class="text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i> Blog</a></li>
            <?php if (!empty($post['category_slug'])): ?>
                <li class="breadcrumb-item"><a href="<?php echo base_url('blog/category/' . $post['category_slug']); ?>" class="text-decoration-none text-muted"><?php echo html_escape($post['category_name']); ?></a></li>
            <?php endif; ?>
            <li class="breadcrumb-item active text-dark text-truncate" style="max-width: 380px;" aria-current="page"><?php echo html_escape($post['title']); ?></li>
        </ol>
    </nav>

    <div class="row g-5">
        <!-- Main Article Column -->
        <div class="col-lg-8">
            <article class="bg-white p-4 p-md-5 rounded-4 border">
                <!-- Category Badge -->
                <?php if (!empty($post['category_slug'])): ?>
                    <a href="<?php echo base_url('blog/category/' . $post['category_slug']); ?>" class="blog-badge mb-3">
                        <?php echo html_escape($post['category_name']); ?>
                    </a>
                <?php endif; ?>

                <!-- Article Main H1 (SEO Cornerstone) -->
                <h1 class="display-6 fw-bold mb-3" style="line-height: 1.3; color: var(--dark-navy);">
                    <?php echo html_escape($post['title']); ?>
                </h1>

                <!-- Meta Header Info -->
                <div class="d-flex flex-wrap align-items-center gap-3 py-3 my-3 border-top border-bottom text-muted" style="font-size: 0.88rem;">
                    <span class="d-flex align-items-center gap-1">
                        <i class="fa-solid fa-user-gear text-primary"></i>
                        <span class="fw-medium text-dark"><?php echo html_escape($post['author']); ?></span>
                    </span>
                    <span>•</span>
                    <span class="d-flex align-items-center gap-1">
                        <i class="fa-regular fa-calendar text-muted"></i>
                        <span><?php echo date('F d, Y', strtotime($post['created_at'])); ?></span>
                    </span>
                    <span>•</span>
                    <span class="d-flex align-items-center gap-1">
                        <i class="fa-regular fa-eye text-muted"></i>
                        <span><?php echo number_format($post['views']); ?> Reads</span>
                    </span>
                </div>

                <!-- Featured Image (Google Image SEO) -->
                <?php if (!empty($post['featured_image'])): ?>
                    <div class="my-4">
                        <img src="<?php echo base_url($post['featured_image']); ?>" class="img-fluid rounded-4 w-100 shadow-sm" style="max-height: 440px; object-fit: cover;" alt="<?php echo html_escape($post['title']); ?>">
                    </div>
                <?php endif; ?>

                <!-- Full Article Content -->
                <div class="post-content mt-4">
                    <?php echo $post['content']; ?>
                </div>

                <!-- High-Converting Callout Box -->
                <div class="cta-repair-box text-center mt-5">
                    <span class="badge bg-white text-primary px-3 py-1 mb-2 fw-bold text-uppercase">Certified Service Guarantee</span>
                    <h3 class="fw-bold text-white mb-2">Need Professional Repair For Your Device?</h3>
                    <p class="text-white-50 mx-auto mb-4" style="max-width: 580px; font-size: 0.98rem;">
                        Don't risk permanent damage with uncertified repairs. The CellPhone Doctor offers 100% genuine parts, transparent pricing, and instant doorstep or store pickup.
                    </p>
                    <a href="https://thecellphonedoctor.com" class="btn btn-light text-primary fw-bold px-4 py-2 fs-6 shadow-sm">
                        <i class="fa-solid fa-calendar-check me-2"></i> Book Your Repair in 60 Seconds
                    </a>
                </div>

                <!-- Social Share Buttons -->
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 pt-4 border-top mt-4">
                    <span class="fw-bold text-secondary" style="font-size: 0.95rem;">
                        <i class="fa-solid fa-share-nodes me-2 text-primary"></i> Share this repair guide:
                    </span>
                    <?php 
                        $share_url   = urlencode($seo['canonical_url']);
                        $share_title = urlencode($post['title']);
                    ?>
                    <div class="d-flex gap-2">
                        <a href="https://api.whatsapp.com/send?text=<?php echo $share_title; ?>%20<?php echo $share_url; ?>" target="_blank" class="btn btn-sm btn-success text-white px-3 fw-semibold">
                            <i class="fa-brands fa-whatsapp me-1"></i> WhatsApp
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" target="_blank" class="btn btn-sm btn-primary px-3 fw-semibold" style="background-color: #1877f2; border-color: #1877f2;">
                            <i class="fa-brands fa-facebook-f me-1"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?text=<?php echo $share_title; ?>&url=<?php echo $share_url; ?>" target="_blank" class="btn btn-sm btn-dark px-3 fw-semibold">
                            <i class="fa-brands fa-x-twitter me-1"></i> X / Twitter
                        </a>
                    </div>
                </div>
            </article>

            <!-- Related Articles Section -->
            <?php if (!empty($related_posts)): ?>
                <div class="mt-5">
                    <h4 class="fw-bold mb-4" style="color: var(--dark-navy);">
                        <i class="fa-solid fa-layer-group me-2 text-primary"></i> Related Repair Guides
                    </h4>
                    <div class="row g-4">
                        <?php foreach ($related_posts as $rel): ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="blog-card">
                                    <a href="<?php echo base_url('blog/post/' . $rel['slug']); ?>">
                                        <?php if (!empty($rel['featured_image'])): ?>
                                            <img src="<?php echo base_url($rel['featured_image']); ?>" class="blog-card-img" style="height: 150px;" alt="<?php echo html_escape($rel['title']); ?>">
                                        <?php else: ?>
                                            <div class="blog-card-img bg-light d-flex align-items-center justify-content-center text-muted" style="height: 150px;">
                                                <i class="fa-solid fa-mobile-screen fs-2 text-secondary"></i>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                    <div class="p-3">
                                        <h6 class="fw-bold mb-2">
                                            <a href="<?php echo base_url('blog/post/' . $rel['slug']); ?>" class="text-decoration-none text-dark">
                                                <?php echo html_escape(character_limiter($rel['title'], 55)); ?>
                                            </a>
                                        </h6>
                                        <small class="text-muted"><?php echo date('M d, Y', strtotime($rel['created_at'])); ?></small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 90px;">
                <!-- Fast Booking Card -->
                <div class="card p-4 text-white mb-4" style="background: linear-gradient(135deg, #032042 0%, #1A8EE0 100%); border-radius: 18px;">
                    <span class="badge bg-white text-primary w-auto align-self-start px-2 py-1 mb-3 fw-bold">DOORSTEP PICKUP</span>
                    <h5 class="fw-bold text-white mb-2">Got a Broken Smartphone?</h5>
                    <p class="text-white-50 mb-3" style="font-size: 0.88rem;">
                        Our certified technicians fix displays, batteries, cameras & motherboards with warranty.
                    </p>
                    <a href="https://thecellphonedoctor.com" class="btn btn-light text-primary fw-bold w-100 py-2">
                        Book Repair Now
                    </a>
                </div>

                <!-- Categories -->
                <div class="card p-4">
                    <h6 class="fw-bold mb-3 pb-2 border-bottom"><i class="fa-solid fa-tags me-2 text-primary"></i> Browse Topics</h6>
                    <ul class="list-unstyled mb-0">
                        <?php foreach ($categories as $cat): ?>
                            <li class="mb-2">
                                <a href="<?php echo base_url('blog/category/' . $cat['slug']); ?>" class="d-flex justify-content-between align-items-center text-decoration-none text-secondary py-1 px-2 rounded">
                                    <span class="fw-medium"><?php echo html_escape($cat['name']); ?></span>
                                    <span class="badge bg-light text-muted border"><?php echo $cat['total_posts']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
