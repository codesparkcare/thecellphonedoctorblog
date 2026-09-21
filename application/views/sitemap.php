<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">

    <!-- Main Website Home -->
    <url>
        <loc><?php echo (strpos(base_url(), 'thecellphonedoctor.com') !== false) ? 'https://thecellphonedoctor.com/' : 'http://localhost/'; ?></loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <!-- Blog Home Page -->
    <url>
        <loc><?php echo base_url(); ?></loc>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>

    <!-- Categories -->
    <?php if (!empty($categories)): ?>
        <?php foreach ($categories as $cat): ?>
    <url>
        <loc><?php echo base_url('category/' . $cat['slug']); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Published Blog Articles (Clean Direct Slugs) -->
    <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
    <url>
        <loc><?php echo base_url($post['slug']); ?></loc>
        <lastmod><?php echo date('c', strtotime(!empty($post['updated_at']) ? $post['updated_at'] : $post['created_at'])); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
        <?php if (!empty($post['featured_image'])): ?>
        <image:image>
            <image:loc><?php echo base_url($post['featured_image']); ?></image:loc>
            <image:title><?php echo htmlspecialchars($post['title'], ENT_XML1, 'UTF-8'); ?></image:title>
        </image:image>
        <?php endif; ?>
    </url>
        <?php endforeach; ?>
    <?php endif; ?>

</urlset>
