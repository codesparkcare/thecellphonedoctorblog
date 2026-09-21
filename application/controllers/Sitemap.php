<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Blog_model');
        $this->load->helper('url');
    }

    /**
     * Generate dynamic XML Sitemap for search engines
     */
    public function index() {
        $posts = $this->Blog_model->get_posts(null, 0, 'published');
        $categories = $this->Blog_model->get_categories();

        $data['posts'] = $posts;
        $data['categories'] = $categories;

        $this->output
            ->set_content_type('application/xml')
            ->set_header('Cache-Control: public, max-age=3600')
            ->set_output($this->load->view('sitemap', $data, TRUE));
    }
}
