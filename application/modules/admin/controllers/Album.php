<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Album extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->allow_group_access(array('admin'));
        $this->load->model('Albums');
        $this->data['content_title'] = "相簿";
        $this->data['content_title_sub'] = "";
        $this->data['parent_menu'] = 'album';
    }

    public function index()
    {

        $this->load_admin('album/index');
    }
    /**api */
    public function album_photo()
    {
        header('Content-Type: application/json');
        //if the $_POST array is empty, check for $raw_input_stream / php://input
        // if (!$_POST) {
        //     $_POST = json_decode(file_get_contents("php://input"), true);
        // }
        $id = $_POST['id'];
        //$data = array("data" => $this->Albums->find_photo($id));
        //echo 'hello';
        echo json_encode($this->Albums->find_photo($id));
    }
    public function add()
    {

        $this->load_admin('posts/add');
    }

    public function edit($id = null)
    {
    }
}
