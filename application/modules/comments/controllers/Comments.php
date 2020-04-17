<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comments extends My_Controller
{

	public function __construct()
	{
		parent::__construct();
		//$this->load->model('Comments');
	}
	public function unique_multidim_array($array, $key)
	{
		$temp_array = array();
		$i = 0;
		$key_array = array();

		foreach ($array as $val) {
			if (!in_array($val[$key], $key_array)) {
				$key_array[$i] = $val[$key];
				$temp_array[$i] = $val;
			}
			$i++;
		}
		return $temp_array;
	}
	public function index($slug = null)
	{
		// $this->data['page_layout'] = 'single';
		// $this->data['album'] = $this->Albums->find($slug);
		// $this->data['slug'] = $slug;
		// $this->data['page_title'] = $this->data['album'][0]['name'];
		// $this->data['page_title_sub'] = $this->data['album'][0]['sub_name'];;
		// $this->data['album_subname'] = array_values($this->unique_multidim_array($this->data['album'], 'subname_id'));
		$this->load_theme('comments/index');
	}
	// public function album_sub($slug)
	// {
	// 	header('Content-Type: application/json');
	// 	echo json_encode(array('json' => $this->Albums->find_product($slug)));
	// }
	// public function album_photo($slug)
	// {
	// 	header('Content-Type: application/json');
	// 	echo json_encode(array('json' => $this->Albums->find_photo($slug)));
	// }
}
