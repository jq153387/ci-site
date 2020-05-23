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
    public function album_photo_class()
    {
        header('Content-Type: application/json');
        $find_product = $this->Albums->find_product();
        $find_product_class = $this->Albums->find_product_class();
        //print_r($find_product_class);
        $find_product_new = [];
        foreach ($find_product as $key => $value) {
            if ($value['sub_class_id'] == $find_product_class[0]['id']) {
                array_push($find_product_new, $value);
            }
        }
        // print_r($find_product_new);
        $find_photo = $this->Albums->find_photo($find_product_new[0]['id']);
        echo json_encode(array(
            "setProductClassID" => $find_product_class[0]['id'],
            "setProductID" => $find_product_new[0]['id'],
            "photo" => $this->album_photoToData($find_photo),
            "product_class" => $find_product_class,
            "product" => $find_product,
        ));
    }
    public function album_photoToData($data)
    {
        $find_photo_new = [];
        foreach ($data as $key => $item) {
            $url = "assets/uploads/" . $item['url'];
            if (is_file($url)) {
                list($width, $height, $type, $attr) = getimagesize($url);

                // echo "Image width " . $width;
                // echo "Image height " . $height;
                // echo "Image type " . $type;
                // echo "Attribute " . $attr;

                array_push($find_photo_new, array(
                    "src" => "/" . $url,
                    "width" => $width,
                    "height" => $height,
                    "author" => "Leon",
                    "caption" => "love",
                    "createdat" => $item['created'],
                    "likes" => "0",
                    "id" => $item['id'],
                    "product_id" => $item['product_id']
                ));
            }
        }
        return $find_photo_new;
    }
    public function album_photo()
    {
        header('Content-Type: application/json');
        $id = $_POST['id'];
        $find_photo = $this->Albums->find_photo($id);


        //$data = array("data" => $this->Albums->find_photo($id));
        //echo 'hello';
        echo json_encode(array(
            "photo" => $this->album_photoToData($find_photo)
        ));
    }
    public function add()
    {

        $this->load_admin('posts/add');
    }

    public function edit($id = null)
    {
    }
}
