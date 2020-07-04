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
                    "filename" => $item['url'],
                    "src" => "/" . $url,
                    "width" => $width,
                    "height" => $height,
                    "author" => "Leon",
                    "caption" => "love",
                    "createdat" => $item['created'],
                    "likes" => "0",
                    "id" => $item['id'],
                    "product_id" => $item['product_id'],
                    "selected" => false
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
    public function delete()
    {
        $data = $_POST;
        $ids = [];
        $upload_path = "assets/uploads/";
        foreach ($data['deletphoto'] as $key => $value) {
            array_push($ids, $value["id"]);
            echo FCPATH . $upload_path . $value['filename'];
            unlink(FCPATH . $upload_path . $value['filename']); //remove source image
        }
        $this->Albums->delete($ids);
    }
    public function uploadImage()
    {
        $data = $_POST;
        $data['image'] = "";
        // Count total files
        //print_r($_FILES['files']);
        if (isset($_FILES['files']) && !empty($_FILES['files']['name'])) {
            $countfiles = count($_FILES['files']['name']);
            for ($i = 0; $i < $countfiles; $i++) {

                if (!empty($_FILES['files']['name'][$i])) {
                    $upload_path = "./assets/uploads/";
                    $newFileName = explode(".", $_FILES['files']['name'][$i]);
                    $filename = time() . "-" . rand(00, 99) . "." . end($newFileName);
                    $filename_new = time() . "-" . rand(00, 99) . "_new." . end($newFileName);
                    $_FILES['file']['name'] = $filename;
                    $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['files']['size'][$i];


                    $config['file_name'] = $filename;
                    $config['upload_path'] = $upload_path;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $this->load->library('upload', $config);
                    //echo "ddd";
                    if ($this->upload->do_upload('file')) {

                        //Image Resizing 
                        $config1[$i]['source_image'] = $this->upload->upload_path . $this->upload->file_name;
                        $config1[$i]['new_image'] =  './assets/uploads/' . $filename_new;
                        $config1[$i]['maintain_ratio'] = true; //等比
                        //echo $config1['new_image'];
                        $config1[$i]['width'] = 1024;
                        $config1[$i]['height'] = 1024;
                        $this->load->library('image_lib');
                        $this->image_lib->initialize($config1[$i]);

                        if (!$this->image_lib->resize()) {
                            $this->session->set_flashdata('error', $this->image_lib->display_errors('', ''));
                        }
                        $this->image_lib->clear();
                        echo $config1[$i]['source_image'];
                        unlink($config1[$i]['source_image']); //remove source image
                        $data['image'] = $filename_new;
                        $data['image_url'] = $config1[$i]['new_image'];
                        $this->Albums->create($data);
                    } else {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
            }
        }
    }
}
