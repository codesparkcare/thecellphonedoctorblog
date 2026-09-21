<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Blog_model');
        $this->load->library('session');
        $this->load->helper(array('url', 'form', 'text'));
    }

    // Helper: Guard protected methods
    private function _check_auth() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
    }

    // -------------------------------------------------------------
    // AUTHENTICATION
    // -------------------------------------------------------------

    public function login() {
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin/dashboard');
        }

        if ($this->input->method() === 'post') {
            $username = trim($this->input->post('username'));
            $password = trim($this->input->post('password'));

            if (empty($username) || empty($password)) {
                $this->session->set_flashdata('error', 'Please enter both username/email and password.');
                redirect('admin/login');
            }

            $admin = $this->Admin_model->login($username, $password);

            if ($admin) {
                $this->session->set_userdata(array(
                    'admin_logged_in' => TRUE,
                    'admin_id'        => $admin['id'],
                    'admin_username'  => $admin['username'],
                    'admin_name'      => $admin['name'],
                    'admin_email'     => $admin['email']
                ));
                $this->session->set_flashdata('success', 'Welcome back, ' . html_escape($admin['name']) . '!');
                redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid username/email or password.');
                redirect('admin/login');
            }
        }

        $this->load->view('admin/login');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('admin/login');
    }

    // -------------------------------------------------------------
    // DASHBOARD
    // -------------------------------------------------------------

    public function index() {
        $this->dashboard();
    }

    public function dashboard() {
        $this->_check_auth();

        $data['stats']        = $this->Admin_model->get_dashboard_stats();
        $data['recent_posts'] = $this->Blog_model->get_posts(5, 0);
        $data['page_title']   = 'Dashboard';

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/layout/footer');
    }

    // -------------------------------------------------------------
    // BLOG POSTS MANAGEMENT
    // -------------------------------------------------------------

    public function posts() {
        $this->_check_auth();

        $status      = $this->input->get('status');
        $category_id = $this->input->get('category_id');
        $search      = $this->input->get('search');

        $data['posts']       = $this->Blog_model->get_posts(null, 0, $status, $category_id, $search);
        $data['categories']  = $this->Blog_model->get_categories();
        $data['page_title']  = 'Manage Blog Posts';
        $data['filter_status'] = $status;
        $data['filter_cat']    = $category_id;
        $data['filter_search'] = $search;

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/posts/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function create_post() {
        $this->_check_auth();

        if ($this->input->method() === 'post') {
            $title       = trim($this->input->post('title'));
            $content     = $this->input->post('content');
            $category_id = $this->input->post('category_id');
            $status      = $this->input->post('status') ? $this->input->post('status') : 'published';
            $author      = $this->input->post('author') ? trim($this->input->post('author')) : 'The CellPhone Doctor Team';

            // Auto slug generation or manual
            $custom_slug = trim($this->input->post('slug'));
            $slug        = !empty($custom_slug) ? $this->Blog_model->create_unique_slug($custom_slug) : $this->Blog_model->create_unique_slug($title);

            // Excerpt: custom or auto generated from first 200 chars of content
            $excerpt = trim($this->input->post('excerpt'));
            if (empty($excerpt) && !empty($content)) {
                $excerpt = word_limiter(strip_tags($content), 30);
            }

            // SEO Fields
            $meta_title = trim($this->input->post('meta_title'));
            if (empty($meta_title)) {
                $meta_title = $title . ' | The CellPhone Doctor';
            }

            $meta_desc = trim($this->input->post('meta_description'));
            if (empty($meta_desc)) {
                $meta_desc = $excerpt;
            }

            $meta_keywords = trim($this->input->post('meta_keywords'));

            // Canonical URL (Default to live canonical pattern)
            $canonical_url = trim($this->input->post('canonical_url'));
            if (empty($canonical_url)) {
                $canonical_url = 'https://thecellphonedoctor.com/blog/' . $slug;
            }

            // Handle Image Upload
            $featured_image = '';
            if (!empty($_FILES['featured_image']['name'])) {
                $config['upload_path']   = './uploads/blogs/';
                $config['allowed_types'] = 'jpg|jpeg|png|webp|gif';
                $config['max_size']      = 5120; // 5MB
                $config['encrypt_name']  = TRUE;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('featured_image')) {
                    $upload_data    = $this->upload->data();
                    $featured_image = 'uploads/blogs/' . $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', 'Image upload error: ' . $this->upload->display_errors('', ''));
                    redirect('admin/create_post');
                }
            }

            $post_data = array(
                'title'            => $title,
                'slug'             => $slug,
                'excerpt'          => $excerpt,
                'content'          => $content,
                'featured_image'   => $featured_image,
                'category_id'      => !empty($category_id) ? (int)$category_id : null,
                'author'           => $author,
                'status'           => $status,
                'meta_title'       => $meta_title,
                'meta_description' => $meta_desc,
                'meta_keywords'    => $meta_keywords,
                'canonical_url'    => $canonical_url,
                'views'            => 0
            );

            $new_id = $this->Blog_model->insert_post($post_data);

            if ($new_id) {
                $this->session->set_flashdata('success', 'Blog article published successfully!');
                redirect('admin/posts');
            } else {
                $this->session->set_flashdata('error', 'Database error while saving blog post.');
                redirect('admin/create_post');
            }
        }

        $data['categories'] = $this->Blog_model->get_categories();
        $data['page_title'] = 'Create New Blog Post';

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/posts/create', $data);
        $this->load->view('admin/layout/footer');
    }

    public function edit_post($id) {
        $this->_check_auth();

        $post = $this->Blog_model->get_post_by_id($id);
        if (!$post) {
            $this->session->set_flashdata('error', 'Blog post not found.');
            redirect('admin/posts');
        }

        if ($this->input->method() === 'post') {
            $title       = trim($this->input->post('title'));
            $content     = $this->input->post('content');
            $category_id = $this->input->post('category_id');
            $status      = $this->input->post('status') ? $this->input->post('status') : 'published';
            $author      = $this->input->post('author') ? trim($this->input->post('author')) : 'The CellPhone Doctor Team';

            // Custom Slug or check uniqueness
            $custom_slug = trim($this->input->post('slug'));
            $slug        = !empty($custom_slug) ? $this->Blog_model->create_unique_slug($custom_slug, $id) : $post['slug'];

            $excerpt     = trim($this->input->post('excerpt'));
            $meta_title  = trim($this->input->post('meta_title'));
            $meta_desc   = trim($this->input->post('meta_description'));
            $meta_keywords = trim($this->input->post('meta_keywords'));
            $canonical_url = trim($this->input->post('canonical_url'));

            $update_data = array(
                'title'            => $title,
                'slug'             => $slug,
                'excerpt'          => $excerpt,
                'content'          => $content,
                'category_id'      => !empty($category_id) ? (int)$category_id : null,
                'author'           => $author,
                'status'           => $status,
                'meta_title'       => $meta_title,
                'meta_description' => $meta_desc,
                'meta_keywords'    => $meta_keywords,
                'canonical_url'    => $canonical_url
            );

            // Handle New Featured Image
            if (!empty($_FILES['featured_image']['name'])) {
                $config['upload_path']   = './uploads/blogs/';
                $config['allowed_types'] = 'jpg|jpeg|png|webp|gif';
                $config['max_size']      = 5120; // 5MB
                $config['encrypt_name']  = TRUE;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('featured_image')) {
                    $upload_data = $this->upload->data();
                    $update_data['featured_image'] = 'uploads/blogs/' . $upload_data['file_name'];

                    // Remove old image
                    if (!empty($post['featured_image'])) {
                        $old_path = FCPATH . $post['featured_image'];
                        if (file_exists($old_path) && is_file($old_path)) {
                            @unlink($old_path);
                        }
                    }
                } else {
                    $this->session->set_flashdata('error', 'Image upload error: ' . $this->upload->display_errors('', ''));
                    redirect('admin/edit_post/' . $id);
                }
            }

            $this->Blog_model->update_post($id, $update_data);
            $this->session->set_flashdata('success', 'Blog article updated successfully!');
            redirect('admin/posts');
        }

        $data['post']       = $post;
        $data['categories'] = $this->Blog_model->get_categories();
        $data['page_title'] = 'Edit Blog Post';

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/posts/edit', $data);
        $this->load->view('admin/layout/footer');
    }

    public function delete_post($id) {
        $this->_check_auth();

        $this->Blog_model->delete_post($id);
        $this->session->set_flashdata('success', 'Blog post deleted successfully.');
        redirect('admin/posts');
    }

    // -------------------------------------------------------------
    // CATEGORIES MANAGEMENT
    // -------------------------------------------------------------

    public function categories() {
        $this->_check_auth();

        if ($this->input->method() === 'post') {
            $name = trim($this->input->post('name'));
            $desc = trim($this->input->post('description'));

            if (!empty($name)) {
                $slug = url_title($name, 'dash', TRUE);
                $this->Blog_model->insert_category(array(
                    'name'        => $name,
                    'slug'        => $slug,
                    'description' => $desc
                ));
                $this->session->set_flashdata('success', 'Category added successfully!');
                redirect('admin/categories');
            }
        }

        $data['categories'] = $this->Blog_model->get_categories();
        $data['page_title'] = 'Manage Categories';

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/categories/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function edit_category($id) {
        $this->_check_auth();

        $cat = $this->Blog_model->get_category_by_id($id);
        if (!$cat) {
            redirect('admin/categories');
        }

        if ($this->input->method() === 'post') {
            $name = trim($this->input->post('name'));
            $desc = trim($this->input->post('description'));

            if (!empty($name)) {
                $slug = url_title($name, 'dash', TRUE);
                $this->Blog_model->update_category($id, array(
                    'name'        => $name,
                    'slug'        => $slug,
                    'description' => $desc
                ));
                $this->session->set_flashdata('success', 'Category updated successfully!');
                redirect('admin/categories');
            }
        }

        $data['category']   = $cat;
        $data['page_title'] = 'Edit Category';

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/categories/edit', $data);
        $this->load->view('admin/layout/footer');
    }

    public function delete_category($id) {
        $this->_check_auth();

        $this->Blog_model->delete_category($id);
        $this->session->set_flashdata('success', 'Category deleted.');
        redirect('admin/categories');
    }
}
