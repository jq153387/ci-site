<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comments extends My_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->allow_group_access(array('admin'));
		$this->load->model('Comment_s');
	}

	public function index($page = null)
	{
		$config['base_url'] = site_url('admin/comments');
		$config['total_rows'] = count($this->Comment_s->find_comments(null, 0, false));
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
		$this->data['comments'] = $this->Comment_s->find_comments($config['per_page'], $config['start'], false);
		foreach ($this->data['comments'] as $key => $item) {
			$review = $this->Comment_s->find_review($item['id']);
			$this->data['comments'][$key]['review_count'] = count($review);
		}
		$this->data['page_config'] = $config;
		$this->data['pagination'] = $this->bootstrap_pagination($config);
		//echo print_r($this->data, true);
		$this->load_admin('comments/index');
		//$this->load_theme('comments/index');
	}
	public function edit($id)
	{
		$this->data['comment'] = $this->Comment_s->find_one_comments($id)[0];
		$this->data['comment']['photo'] = $this->Comment_s->find_photo($id);
		//echo  '<pre style="background-color:white;">' . print_r($item, true) . '</pre>';
		//echo $item['class_id'];
		$review = $this->Comment_s->find_review($id, false);
		$this->data['comment']['review'] = $review;
		//echo  '<pre style="background-color:white;">' . print_r($review, true) . '</pre>';
		foreach ($review as $key2 => $value) {
			$this->data['comment']['review'][$key2]['photo'] = $this->Comment_s->find_photo($value['id']);
		}
		$this->load_admin('comments/edit');
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
		$this->form_validation->set_rules('writer', '暱稱', 'trim|required|xss_clean');
		$data = $_POST;
		if ($this->form_validation->run() == true) {

			//print_r($_FILES['file']);
			if ($data["id"] != "") {
				//print_r($data);
				$this->Comment_s->update($data);
			} else {
				$data["id"] = $this->Comment_s->create_review($data);
			}
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
				//echo "ddd";
				if ($this->upload->do_upload('file')) {
					//Image Resizing 
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
					$this->Comment_s->create_photo($data);
				} else {
					$this->session->set_flashdata('error', $this->upload->display_errors());
				}
			}

			$this->session->set_flashdata('message', '成功完成。');
			if ($data['class_id'] == "") {
				redirect('/admin/comments/' . $data['comment_id'], 'refresh');
			} else {
				redirect('/admin/comments/edit/' . $data['comment_id'], 'refresh');
			}

			//$this->index($data['page']);
		} else {
			$this->session->set_flashdata('error', '失敗。（需填寫作者）');
			if ($data['class_id'] == "") {
				redirect('/admin/comments/' . $data['comment_id'], 'refresh');
			} else {
				redirect('/admin/comments/edit/' . $data['comment_id'], 'refresh');
			}
		}
	}
	public function add_review()
	{
		header('Content-Type: application/json');
		$this->form_validation->set_rules('review_name', '暱稱', 'required');
		$this->form_validation->set_rules('review_mail', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('review_message', '留言內容', 'required');
		if (!$this->form_validation->run()) {
			$errors = validation_errors();
			echo json_encode(['error' => $errors]);
		} else {
			// To who are you wanting with input value such to insert as
			echo json_encode(['success' => '成功送出留言。（需等待審核，TSJ將盡速處理你的留言，謝謝你)', 'data' => $_POST]);
			// Then pass $data  to Modal to insert bla bla!!
		}
	}
	public function com_dispaly()
	{
		header('Content-Type: application/json');
		print_r($_POST);
		$this->Comment_s->com_dispaly($_POST);
		// echo json_encode(array('json' => $this->Albums->find_photo($slug)));
	}
	public function delete($str = null)
	{
		$data = explode("-", $str);
		$id = $data[0];
		if (!empty($id)) {
			$this->Comment_s->delete($id);
			$this->session->set_flashdata('message', message_box('已刪除', 'success'));
			redirect('admin/comments/' . $data[1]);
		} else {
			$this->session->set_flashdata('message', message_box('無效的 id', 'danger'));
			redirect('admin/comments/index');
		}
	}
	public function delete_edit($str = null)
	{
		$data = explode("-", $str);
		$id = $data[0];
		if (!empty($id)) {
			$this->Comment_s->delete($id);
			$this->session->set_flashdata('message', message_box('已刪除2', 'success'));
			if ($data[1] == $id) {
				redirect('admin/comments/index');
			} else {
				redirect('admin/comments/edit/' . $data[1]);
			}
		} else {
			$this->session->set_flashdata('message', message_box('無效的 id', 'danger'));
			redirect('admin/comments/index');
		}
	}
	public function delete_photo()
	{
		$data = $_GET;
		$id = $data["id"];
		$ids = [$id];
		$upload_path = "assets/uploads/";
		echo FCPATH . $upload_path . $data["name"];
		unlink(FCPATH . $upload_path . $data["name"]); //remove source image
		$this->Comment_s->delete_photo($ids);
		if ($data["id"] != $data["parent_id"]) {
			redirect('admin/comments/edit/' . $data["parent_id"]);
		} else {
			redirect('admin/comments/');
		}
	}
}
