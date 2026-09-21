<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Blog_model');
    }

    public function latest_blogs() {
        // Enable CORS for Flutter Web
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json; charset=UTF-8");

        if ($this->input->method() === 'options') {
            exit(0);
        }

        $limit = (int)$this->input->get('limit');
        if ($limit <= 0 || $limit > 20) {
            $limit = 3;
        }

        $posts = $this->Blog_model->get_latest_posts_api($limit);

        // Format image URLs and post URLs
        foreach ($posts as &$p) {
            $p['featured_image_url'] = !empty($p['featured_image']) ? base_url($p['featured_image']) : null;
            $p['public_url']         = base_url('blog/post/' . $p['slug']);
            if (empty($p['canonical_url'])) {
                $p['canonical_url']  = 'https://thecellphonedoctor.com/blog/' . $p['slug'];
            }
        }

        echo json_encode(array(
            'status' => true,
            'count'  => count($posts),
            'data'   => $posts
        ), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}
