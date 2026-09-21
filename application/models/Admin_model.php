<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function login($username_or_email, $password) {
        $this->db->group_start();
        $this->db->where('username', $username_or_email);
        $this->db->or_where('email', $username_or_email);
        $this->db->group_end();
        $admin = $this->db->get('blog_admins')->row_array();

        if ($admin && password_verify($password, $admin['password'])) {
            return $admin;
        }
        return false;
    }

    public function get_admin($id) {
        $this->db->where('id', $id);
        return $this->db->get('blog_admins')->row_array();
    }

    public function get_dashboard_stats() {
        $stats = array();

        $stats['total_posts'] = $this->db->count_all('blog_posts');

        $this->db->where('status', 'published');
        $stats['published_posts'] = $this->db->count_all_results('blog_posts');

        $this->db->where('status', 'draft');
        $stats['draft_posts'] = $this->db->count_all_results('blog_posts');

        $stats['total_categories'] = $this->db->count_all('blog_categories');

        $this->db->select_sum('views');
        $query = $this->db->get('blog_posts')->row_array();
        $stats['total_views'] = !empty($query['views']) ? (int)$query['views'] : 0;

        return $stats;
    }

    public function update_password($id, $new_password) {
        $hash = password_hash($new_password, PASSWORD_BCRYPT);
        $this->db->where('id', $id);
        return $this->db->update('blog_admins', array('password' => $hash));
    }
}
