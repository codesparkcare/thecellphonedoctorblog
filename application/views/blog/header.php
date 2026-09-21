<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary SEO Meta Tags -->
    <title><?php echo html_escape($seo['meta_title']); ?></title>
    <meta name="description" content="<?php echo html_escape($seo['meta_description']); ?>">
    <?php if (!empty($seo['meta_keywords'])): ?>
    <meta name="keywords" content="<?php echo html_escape($seo['meta_keywords']); ?>">
    <?php endif; ?>
    <link rel="canonical" href="<?php echo html_escape($seo['canonical_url']); ?>">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="author" content="<?php echo isset($seo['author']) ? html_escape($seo['author']) : 'The CellPhone Doctor'; ?>">

    <!-- Open Graph / Facebook / WhatsApp Meta Tags -->
    <meta property="og:type" content="<?php echo isset($seo['og_type']) ? $seo['og_type'] : 'website'; ?>">
    <meta property="og:url" content="<?php echo html_escape($seo['canonical_url']); ?>">
    <meta property="og:title" content="<?php echo html_escape($seo['meta_title']); ?>">
    <meta property="og:description" content="<?php echo html_escape($seo['meta_description']); ?>">
    <meta property="og:site_name" content="The CellPhone Doctor">
    <?php if (!empty($seo['og_image'])): ?>
    <meta property="og:image" content="<?php echo html_escape($seo['og_image']); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <?php endif; ?>
    <?php if (isset($seo['published_time'])): ?>
    <meta property="article:published_time" content="<?php echo $seo['published_time']; ?>">
    <meta property="article:modified_time" content="<?php echo $seo['modified_time']; ?>">
    <?php endif; ?>

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo html_escape($seo['canonical_url']); ?>">
    <meta name="twitter:title" content="<?php echo html_escape($seo['meta_title']); ?>">
    <meta name="twitter:description" content="<?php echo html_escape($seo['meta_description']); ?>">
    <?php if (!empty($seo['og_image'])): ?>
    <meta name="twitter:image" content="<?php echo html_escape($seo['og_image']); ?>">
    <?php endif; ?>

    <!-- Schema.org JSON-LD Structured Data for Google Rich Snippets -->
    <?php if (isset($post)): ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BlogPosting",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?php echo html_escape($seo['canonical_url']); ?>"
      },
      "headline": "<?php echo addslashes($post['title']); ?>",
      "description": "<?php echo addslashes($seo['meta_description']); ?>",
      <?php if (!empty($post['featured_image'])): ?>
      "image": "<?php echo base_url($post['featured_image']); ?>",
      <?php endif; ?>
      "author": {
        "@type": "Organization",
        "name": "The CellPhone Doctor",
        "url": "https://thecellphonedoctor.com"
      },
      "publisher": {
        "@type": "Organization",
        "name": "The CellPhone Doctor",
        "logo": {
          "@type": "ImageObject",
          "url": "https://thecellphonedoctor.com/images/logo.png"
        }
      },
      "datePublished": "<?php echo date('c', strtotime($post['created_at'])); ?>",
      "dateModified": "<?php echo date('c', strtotime($post['updated_at'])); ?>"
    }
    </script>
    <?php else: ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "The CellPhone Doctor",
      "url": "https://thecellphonedoctor.com",
      "logo": "https://thecellphonedoctor.com/images/logo.png",
      "sameAs": []
    }
    </script>
    <?php endif; ?>

    <!-- Fonts & Core Styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #1A8EE0;
            --primary-dark: #0f6bb1;
            --dark-navy: #032042;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --bg-light: #f8fafc;
            --border-color: #e2e8f0;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            background-color: var(--bg-light);
            line-height: 1.65;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            color: var(--dark-navy);
            font-weight: 700;
        }

        /* Top Bar & Navbar */
        .site-header {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #1A8EE0 0%, #0052cc 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 22px;
            box-shadow: 0 4px 12px rgba(26, 142, 224, 0.35);
        }

        .brand-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--dark-navy);
            margin: 0;
            letter-spacing: -0.3px;
        }

        .brand-sub {
            font-size: 0.72rem;
            color: var(--primary);
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
            display: block;
        }

        .nav-link {
            font-weight: 600;
            color: #334155;
            font-size: 0.95rem;
            padding: 8px 16px !important;
            transition: color 0.2s;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary);
        }

        .btn-book-now {
            background: var(--primary);
            color: #ffffff;
            font-weight: 700;
            border-radius: 10px;
            padding: 10px 22px;
            font-size: 0.92rem;
            border: none;
            transition: all 0.2s;
            box-shadow: 0 4px 14px rgba(26, 142, 224, 0.35);
        }

        .btn-book-now:hover {
            background: var(--primary-dark);
            color: #ffffff;
            transform: translateY(-1px);
        }

        /* Hero Banner */
        .blog-hero {
            background: linear-gradient(135deg, #032042 0%, #0a3d7c 100%);
            color: #ffffff;
            padding: 60px 0 50px;
            position: relative;
            overflow: hidden;
        }

        .blog-hero::after {
            content: '';
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(26, 142, 224, 0.2) 0%, transparent 70%);
            border-radius: 50%;
        }

        /* Blog Card */
        .blog-card {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .blog-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 30px rgba(3, 32, 66, 0.08);
            border-color: #cbd5e1;
        }

        .blog-card-img {
            height: 220px;
            width: 100%;
            object-fit: cover;
        }

        .blog-badge {
            background: #eff6ff;
            color: var(--primary);
            font-weight: 700;
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
            text-decoration: none;
        }

        .blog-card-title {
            font-size: 1.15rem;
            line-height: 1.4;
            margin: 12px 0 8px;
        }

        .blog-card-title a {
            color: var(--dark-navy);
            text-decoration: none;
            transition: color 0.2s;
        }

        .blog-card-title a:hover {
            color: var(--primary);
        }

        /* Single Post Article */
        article.post-content {
            font-size: 1.08rem;
            line-height: 1.8;
            color: #334155;
        }

        article.post-content h2 {
            font-size: 1.65rem;
            margin-top: 36px;
            margin-bottom: 16px;
            color: var(--dark-navy);
            border-left: 4px solid var(--primary);
            padding-left: 14px;
        }

        article.post-content h3 {
            font-size: 1.35rem;
            margin-top: 28px;
            margin-bottom: 14px;
            color: var(--dark-navy);
        }

        article.post-content ul, article.post-content ol {
            margin-bottom: 24px;
            padding-left: 24px;
        }

        article.post-content li {
            margin-bottom: 8px;
        }

        article.post-content img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 20px 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        }

        /* CTA Box */
        .cta-repair-box {
            background: linear-gradient(135deg, #032042 0%, #1A8EE0 100%);
            border-radius: 18px;
            color: #ffffff;
            padding: 36px 30px;
            margin: 45px 0;
            box-shadow: 0 14px 28px rgba(3, 32, 66, 0.15);
        }
    </style>
</head>
<body>

    <!-- Header Navigation -->
    <header class="site-header">
        <div class="container py-2">
            <div class="d-flex justify-content-between align-items-center">
                <a href="<?php echo base_url('blog'); ?>" class="header-brand">
                    <div class="brand-icon">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </div>
                    <div>
                        <h1 class="brand-title">The CellPhone Doctor</h1>
                        <span class="brand-sub">Hospital For Sick Mobile • Repair Blog</span>
                    </div>
                </a>

                <nav class="d-none d-lg-flex align-items-center gap-1">
                    <a href="https://thecellphonedoctor.com" class="nav-link">Main App</a>
                    <a href="<?php echo base_url('blog'); ?>" class="nav-link active">Blog Guides</a>
                    <a href="<?php echo base_url('blog/category/screen-replacement'); ?>" class="nav-link">Screen Repair</a>
                    <a href="<?php echo base_url('blog/category/battery-charging'); ?>" class="nav-link">Battery</a>
                    <a href="<?php echo base_url('blog/category/water-damage-repair'); ?>" class="nav-link">Water Damage</a>
                </nav>

                <div class="d-flex align-items-center gap-2">
                    <a href="https://thecellphonedoctor.com" class="btn btn-book-now d-flex align-items-center gap-2">
                        <i class="fa-solid fa-calendar-check"></i>
                        <span>Book Repair Now</span>
                    </a>
                </div>
            </div>
        </div>
    </header>
