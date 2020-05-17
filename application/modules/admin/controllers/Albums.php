<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Albums extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->allow_group_access(array('admin'));
        $this->data['content_title'] = "相簿";
        $this->data['content_title_sub'] = "";
        $this->data['parent_menu'] = 'albums';
    }

    public function index()
    {

        $this->load_admin('albums/index');
    }

    public function add()
    {

        $this->load_admin('posts/add');
    }

    public function edit($id = null)
    {
    }
}
