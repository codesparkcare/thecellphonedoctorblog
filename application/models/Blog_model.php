<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // -------------------------------------------------------------
    // POSTS METHODS
    // -------------------------------------------------------------

    public function get_posts($limit = null, $offset = 0, $status = null, $category_id = null, $search = null) {
        $this->db->select('blog_posts.*, blog_categories.name as category_name, blog_categories.slug as category_slug');
        $this->db->from('blog_posts');
        $this->db->join('blog_categories', 'blog_categories.id = blog_posts.category_id', 'left');

        if (!empty($status)) {
            $this->db->where('blog_posts.status', $status);
        }
        if (!empty($category_id)) {
            $this->db->where('blog_posts.category_id', $category_id);
        }
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('blog_posts.title', $search);
            $this->db->or_like('blog_posts.content', $search);
            $this->db->or_like('blog_posts.meta_keywords', $search);
            $this->db->group_end();
        }

        $this->db->order_by('blog_posts.created_at', 'DESC');

        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get()->result_array();
    }

    public function get_total_posts($status = null, $category_id = null, $search = null) {
        $this->db->from('blog_posts');

        if (!empty($status)) {
            $this->db->where('status', $status);
        }
        if (!empty($category_id)) {
            $this->db->where('category_id', $category_id);
        }
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('title', $search);
            $this->db->or_like('content', $search);
            $this->db->or_like('meta_keywords', $search);
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }

    public function get_post_by_slug($slug) {
        $this->db->select('blog_posts.*, blog_categories.name as category_name, blog_categories.slug as category_slug');
        $this->db->from('blog_posts');
        $this->db->join('blog_categories', 'blog_categories.id = blog_posts.category_id', 'left');
        $this->db->where('blog_posts.slug', $slug);
        return $this->db->get()->row_array();
    }

    public function get_post_by_id($id) {
        $this->db->select('blog_posts.*, blog_categories.name as category_name, blog_categories.slug as category_slug');
        $this->db->from('blog_posts');
        $this->db->join('blog_categories', 'blog_categories.id = blog_posts.category_id', 'left');
        $this->db->where('blog_posts.id', $id);
        return $this->db->get()->row_array();
    }

    public function insert_post($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->insert('blog_posts', $data);
        return $this->db->insert_id();
    }

    public function update_post($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        return $this->db->update('blog_posts', $data);
    }

    public function delete_post($id) {
        // Retrieve image to delete from disk
        $post = $this->get_post_by_id($id);
        if (!empty($post['featured_image'])) {
            $image_path = FCPATH . $post['featured_image'];
            if (file_exists($image_path) && is_file($image_path)) {
                @unlink($image_path);
            }
        }
        $this->db->where('id', $id);
        return $this->db->delete('blog_posts');
    }

    public function increment_views($id) {
        $this->db->where('id', $id);
        $this->db->set('views', 'views+1', FALSE);
        $this->db->update('blog_posts');
    }

    public function get_related_posts($category_id, $exclude_id, $limit = 3) {
        $this->db->select('blog_posts.*, blog_categories.name as category_name');
        $this->db->from('blog_posts');
        $this->db->join('blog_categories', 'blog_categories.id = blog_posts.category_id', 'left');
        $this->db->where('blog_posts.status', 'published');
        $this->db->where('blog_posts.id !=', $exclude_id);
        if (!empty($category_id)) {
            $this->db->where('blog_posts.category_id', $category_id);
        }
        $this->db->order_by('blog_posts.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    // -------------------------------------------------------------
    // API FOR FLUTTER WEB
    // -------------------------------------------------------------

    public function get_latest_posts_api($limit = 3) {
        $this->db->select('id, title, slug, excerpt, featured_image, canonical_url, views, created_at');
        $this->db->from('blog_posts');
        $this->db->where('status', 'published');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    // -------------------------------------------------------------
    // CATEGORIES METHODS
    // -------------------------------------------------------------

    public function get_categories() {
        $this->db->select('blog_categories.*, COUNT(blog_posts.id) as total_posts');
        $this->db->from('blog_categories');
        $this->db->join('blog_posts', 'blog_posts.category_id = blog_categories.id AND blog_posts.status = "published"', 'left');
        $this->db->group_by('blog_categories.id');
        $this->db->order_by('blog_categories.name', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_category_by_slug($slug) {
        $this->db->where('slug', $slug);
        return $this->db->get('blog_categories')->row_array();
    }

    public function get_category_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('blog_categories')->row_array();
    }

    public function insert_category($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('blog_categories', $data);
        return $this->db->insert_id();
    }

    public function update_category($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('blog_categories', $data);
    }

    public function delete_category($id) {
        $this->db->where('id', $id);
        return $this->db->delete('blog_categories');
    }

    // -------------------------------------------------------------
    // SLUG GENERATOR (SEO FRIENDLY)
    // -------------------------------------------------------------

    public function create_unique_slug($title, $id = null) {
        // Convert title to URL safe string
        $slug = preg_replace('~[^\pL\d]+~u', '-', $title);
        $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
        $slug = preg_replace('~[^-\w]+~', '', $slug);
        $slug = trim($slug, '-');
        $slug = preg_replace('~-+~', '-', $slug);
        $slug = strtolower($slug);

        if (empty($slug)) {
            $slug = 'post-' . time();
        }

        // Ensure uniqueness
        $original_slug = $slug;
        $counter = 1;

        while (true) {
            $this->db->where('slug', $slug);
            if ($id !== null) {
                $this->db->where('id !=', $id);
            }
            $count = $this->db->count_all_results('blog_posts');

            if ($count == 0) {
                break;
            }

            $slug = $original_slug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
