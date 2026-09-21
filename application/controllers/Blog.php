<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Blog_model');
        $this->load->helper(array('url', 'text'));
        $this->load->library('pagination');
    }

    // -------------------------------------------------------------
    // BLOG HOME LISTING
    // -------------------------------------------------------------

    public function index($offset = 0) {
        $search = $this->input->get('q');
        $limit  = 6;

        $total_posts = $this->Blog_model->get_total_posts('published', null, $search);
        $posts       = $this->Blog_model->get_posts($limit, $offset, 'published', null, $search);
        $categories  = $this->Blog_model->get_categories();

        // Pagination Config
        $config['base_url']    = base_url('page');
        $config['total_rows']  = $total_posts;
        $config['per_page']    = $limit;
        $config['uri_segment'] = 2;
        $config['full_tag_open']   = '<ul class="pagination justify-content-center">';
        $config['full_tag_close']  = '</ul>';
        $config['num_tag_open']    = '<li class="page-item">';
        $config['num_tag_close']   = '</li>';
        $config['cur_tag_open']    = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']   = '</span></li>';
        $config['next_tag_open']   = '<li class="page-item">';
        $config['next_tag_close']  = '</li>';
        $config['prev_tag_open']   = '<li class="page-item">';
        $config['prev_tag_close']  = '</li>';
        $config['attributes']      = array('class' => 'page-link');

        $this->pagination->initialize($config);

        // SEO Meta Data
        $data['seo'] = array(
            'meta_title'       => 'Expert Mobile Repair Guides & Phone Care Tips | The CellPhone Doctor',
            'meta_description' => 'Read certified technician guides on mobile screen replacement, battery health, water damage rescue and smartphone maintenance across Tamil Nadu.',
            'meta_keywords'    => 'phone repair tips, screen replacement guides, battery health fix, water damaged phone repair, mobile doctor blog',
            'canonical_url'    => base_url(),
            'og_image'         => base_url('assets/images/blog-banner.jpg'),
            'og_type'          => 'website'
        );

        $data['posts']       = $posts;
        $data['categories']  = $categories;
        $data['pagination']  = $this->pagination->create_links();
        $data['search_query']= $search;
        $data['total_posts'] = $total_posts;

        $this->load->view('blog/header', $data);
        $this->load->view('blog/index', $data);
        $this->load->view('blog/footer', $data);
    }

    // -------------------------------------------------------------
    // SINGLE BLOG ARTICLE (HIGH SEO VALUE)
    // -------------------------------------------------------------

    public function post($slug = '') {
        if (empty($slug)) {
            redirect('blog');
        }

        $post = $this->Blog_model->get_post_by_slug($slug);

        if (!$post || $post['status'] !== 'published') {
            show_404();
        }

        // Increment view count
        $this->Blog_model->increment_views($post['id']);

        $related_posts = $this->Blog_model->get_related_posts($post['category_id'], $post['id'], 3);
        $categories    = $this->Blog_model->get_categories();

        // Image URL resolution
        $image_url = !empty($post['featured_image']) 
            ? base_url($post['featured_image']) 
            : 'https://thecellphonedoctor.com/images/default-blog.jpg';

        // Canonical URL resolution
        $canonical = !empty($post['canonical_url']) 
            ? $post['canonical_url'] 
            : base_url('post/' . $post['slug']);

        // SEO Meta Data
        $data['seo'] = array(
            'meta_title'       => !empty($post['meta_title']) ? $post['meta_title'] : $post['title'] . ' | The CellPhone Doctor',
            'meta_description' => !empty($post['meta_description']) ? $post['meta_description'] : $post['excerpt'],
            'meta_keywords'    => $post['meta_keywords'],
            'canonical_url'    => $canonical,
            'og_image'         => $image_url,
            'og_type'          => 'article',
            'author'           => $post['author'],
            'published_time'   => date('c', strtotime($post['created_at'])),
            'modified_time'    => date('c', strtotime($post['updated_at']))
        );

        $data['post']          = $post;
        $data['related_posts'] = $related_posts;
        $data['categories']    = $categories;

        $this->load->view('blog/header', $data);
        $this->load->view('blog/post', $data);
        $this->load->view('blog/footer', $data);
    }

    // -------------------------------------------------------------
    // CATEGORY ARCHIVES
    // -------------------------------------------------------------

    public function category($slug = '', $offset = 0) {
        if (empty($slug)) {
            redirect('/');
        }

        $category = $this->Blog_model->get_category_by_slug($slug);
        if (!$category) {
            show_404();
        }

        $limit       = 6;
        $total_posts = $this->Blog_model->get_total_posts('published', $category['id']);
        $posts       = $this->Blog_model->get_posts($limit, $offset, 'published', $category['id']);
        $categories  = $this->Blog_model->get_categories();

        $data['seo'] = array(
            'meta_title'       => $category['name'] . ' Guides & Repair Tips | The CellPhone Doctor',
            'meta_description' => !empty($category['description']) ? $category['description'] : 'Browse expert repair articles and maintenance guides for ' . $category['name'] . '.',
            'meta_keywords'    => strtolower($category['name']) . ', phone repair, mobile service guides',
            'canonical_url'    => base_url('category/' . $category['slug']),
            'og_image'         => base_url('assets/images/blog-banner.jpg'),
            'og_type'          => 'website'
        );

        $data['category']    = $category;
        $data['posts']       = $posts;
        $data['categories']  = $categories;
        $data['total_posts'] = $total_posts;

        $this->load->view('blog/header', $data);
        $this->load->view('blog/index', $data);
        $this->load->view('blog/footer', $data);
    }
}
