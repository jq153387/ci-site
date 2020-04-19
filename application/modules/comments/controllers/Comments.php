<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comments extends My_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Comment_s');
	}

	public function index($page = null)
	{
		$config['base_url'] = site_url('guestbook/');
		$config['total_rows'] = count($this->Comment_s->find_comments(null, 0));
		$config['per_page'] = 10;
		$config['page'] = $page;
		//$config['nums'] = $config['per_page'] * 10; //每頁顯示項目數量

		//$config["uri_segment"] = 8;
		$config['use_page_numbers'] = TRUE;
		//$config['total_pages'] = 
		$config['num_links'] = ceil($config['total_rows'] / $config['per_page']);; //頁碼連線數
		if ($page == null) { //假如$page未設置
			$page = 1; //則在此設定起始頁數
		} else {
			$page = intval($page); //確認頁數只能夠是數值資料
		}
		$config['start'] = ($page - 1) * $config['per_page']; //每一頁開始的資料序號
		//echo "kjoijoij" . $this->uri->segment(3);
		$this->data['comments'] = $this->Comment_s->find_comments($config['per_page'], $config['start']);

		foreach ($this->data['comments'] as $key => $item) {
			$this->data['comments'][$key]['photo'] = $this->Comment_s->find_photo($item['id']);
			//echo  '<pre style="background-color:white;">' . print_r($item, true) . '</pre>';
			//echo $item['class_id'];
			$review = $this->Comment_s->find_review($item['id']);
			$this->data['comments'][$key]['comments_review'] = $review;
			//echo  '<pre style="background-color:white;">' . print_r($review, true) . '</pre>';
			foreach ($review as $key2 => $value) {
				$this->data['comments'][$key]['comments_review'][$key2]['photo'] = $this->Comment_s->find_photo($value['id']);
			}
		}
		$this->data['page_config'] = $config;
		$this->data['pagination'] = $this->bootstrap_pagination($config);
		//echo print_r($this->data, true);
		$this->load_theme('comments/index');
	}
	public function add()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$data = $_POST;
		$captcha = $_POST['g-recaptcha-response'];
		$secretKey = "6Lf5O-sUAAAAABkMn_iWIcv1AG_zpzoz40jvzYK2";
		$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
		$response = file_get_contents($url);
		$responseKeys = json_decode($response, true);


		if ($this->form_validation->run() == true && $responseKeys["success"]) {

			print_r($data);
			//$this->load->view('login');
		} else {
			if (!$responseKeys["success"]) {
				$this->session->set_flashdata('message', '抱歉！驗證碼不成功，請勾選我不是機器人。');
			}
			$this->index($data['page']);
		}
	}
	// public function album_photo($slug)
	// {
	// 	header('Content-Type: application/json');
	// 	echo json_encode(array('json' => $this->Albums->find_photo($slug)));
	// }
}
