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
	public function sendMAIL($data)
	{
		$this->load->library('email'); //加載CI的email類
		$this->email->from('service@mybells.tw', 'tsj-diamond.com');
		// $to_mails = array('tsj4c@ms59.hinet.net', 'huang19711127@gmail.com', 'tim@otaku66.com', 'wenwen0212@gmail.com');
		// $this->email->to($to_mails);
		$this->email->to('jq153387@gmail.com');
		$this->email->subject('等待審核:TSJ好友推薦 ' . $data['username'] . ' 留言');
		$send_content = array(
			$data['username'] . '留言於TSJ好友推薦，等待您至網站後台審核結果。',
			'暱稱:' . $data['username'],
			'信箱:' . $data['email'],
			'內容:' . $data['content'],
			'資訊提供經由網站 www.tsj-diamond.com'
		);
		$this->email->message(implode("<br/>", $send_content));
		if ($data['image'] != "") {
			$this->email->attach($data['image_url']); //相對於index.php的路徑
		}
		if (!$this->email->send()) {
			show_error($this->email->print_debugger()); //返回包含郵件內容的字符串，包括EMAIL頭和EMAIL正文。用於調試。
		}
	}
	public function add()
	{
		$this->form_validation->set_rules('username', '暱稱', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$data = $_POST;
		//google captch
		$captcha = $_POST['g-recaptcha-response'];
		$secretKey = "6Lf5O-sUAAAAABkMn_iWIcv1AG_zpzoz40jvzYK2";
		$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
		$response = file_get_contents($url);
		$responseKeys = json_decode($response, true);
		if ($this->form_validation->run() == true && $responseKeys["success"]) {

			print_r($_FILES['file']);
			//upload image
			// $image_name = '';

			// if ($_FILES['file']['name'] != "") {
			// 	$config['upload_path'] = './assets/uploads/';
			// 	$config['allowed_types'] = 'gif|jpg|png|jpeg|jpe';
			// 	$this->load->library('upload', $config);
			// 	if (!$this->upload->do_upload('file')) {
			// 		$error = array('error' => $this->upload->display_errors());
			// 	} else {
			// 		$upload_data = $this->upload->data();
			// 		$image_name = $upload_data['file_name'];
			// 		echo 'fff';
			// 	}
			// }
			$data['image'] = "";
			if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
				$upload_path = "./assets/uploads/";
				$newFileName = explode(".", $_FILES['file']['name']);
				$filename = time() . "-" . rand(00, 99) . "." . end($newFileName);
				$filename_new = time() . "-" . rand(00, 99) . "_new." . end($newFileName);
				$config['file_name'] = $filename;
				$config['upload_path'] = $upload_path;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload', $config);
				echo "ddd";
				if ($this->upload->do_upload('file')) {
					//Image Resizing 
					echo "resiazing";
					$config1['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config1['new_image'] =  './assets/uploads/' . $filename_new;
					$config1['maintain_ratio'] = true; //等比
					$config1['width'] = 800;
					$config1['height'] = 800;
					$this->load->library('image_lib', $config1);
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('error', $this->image_lib->display_errors('', ''));
					}
					unlink($config1['source_image']); //remove source image
					$data['image'] = $filename_new;
					$data['image_url'] = $config1['new_image'];
				} else {
					$this->session->set_flashdata('error', $this->upload->display_errors());
				}
			}
			$this->sendMAIL($data);
			$this->session->set_flashdata('message', '成功送出留言。（需等待審核，TSJ將盡速處理你的留言，謝謝你。）');
			$this->index($data['page']);
		} else {
			if (!$responseKeys["success"]) {
				$this->session->set_flashdata('error', '抱歉！驗證碼不成功，請勾選我不是機器人。');
			}
			$this->index($data['page']);
			//redirect('/comments/add', 'refresh');
		}
	}
	// public function album_photo($slug)
	// {
	// 	header('Content-Type: application/json');
	// 	echo json_encode(array('json' => $this->Albums->find_photo($slug)));
	// }
}
