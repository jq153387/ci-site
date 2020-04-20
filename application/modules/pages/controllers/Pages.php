<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends MY_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('Post');
	}
	public function about()
	{
		$this->data['page_title'] = '鑽戒、鑽石推薦';
		$this->load_theme('pages/about');
	}
	public function contact()
	{
		$this->data['page_title'] = '服務據點';
		$this->load_theme('pages/contact');
	}
	public function mail()
	{
		$this->data['page_title'] = '聯絡我們';
		$this->load_theme('pages/mail');
	}
	public function sendmail()
	{
		$this->load->library('email'); //加載CI的email類

		$this->form_validation->set_rules('username', '姓名', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('phone', '行動電話', 'required|regex_match[/^[0-9]{10}$/]');
		$data = $_POST;
		//google captch
		$captcha = $_POST['g-recaptcha-response'];
		$secretKey = "6Lf5O-sUAAAAABkMn_iWIcv1AG_zpzoz40jvzYK2";
		$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
		$response = file_get_contents($url);
		$responseKeys = json_decode($response, true);
		if ($this->form_validation->run() == true && $responseKeys["success"]) {
			//以下設置Email內容
			$this->email->from('service@citiar.com', 'tsj-diamond.com');
			$this->email->to('jq153387@gmail.com');
			$this->email->subject('TSJ聯絡我們 ' . $data['username'] . ' 資訊');
			$send_content = array(
				'姓名:' . $data['username'],
				'電話:' . $data['tel'],
				'行動電話:' . $data['phone'],
				'信箱:' . $data['email'],
				'內容:' . $data['content'],
				'資訊提供經由網站 www.tsj-diamond.com'
			);
			$this->email->message(implode("<br/>", $send_content));
			//$this->email->attach('application\controllers\1.jpeg'); //相對於index.php的路徑
			if ($this->email->send()) {
				$this->session->set_flashdata('message', 'TSJ感謝您，聯絡資訊已成功送出，我們將盡快與您聯繫。');
				$this->mail();
			} else {
				show_error($this->email->print_debugger()); //返回包含郵件內容的字符串，包括EMAIL頭和EMAIL正文。用於調試。
			}
		} else {
			if (!$responseKeys["success"]) {
				$this->session->set_flashdata('error', '抱歉！驗證碼不成功，請勾選我不是機器人。');
			}
			$this->mail();
			//redirect('/comments/add', 'refresh');
		}
	}
}
