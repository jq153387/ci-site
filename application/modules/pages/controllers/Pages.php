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
		//以下設置Email內容
		$this->email->from('service@tsj-diamond.com', 'tsj-diamond.com');
		$this->email->to('jq153387@gmail.com');
		$this->email->subject('Email Test');
		$this->email->message('<font color=red>Testing the email class.</font>');
		//$this->email->attach('application\controllers\1.jpeg'); //相對於index.php的路徑
		if ($this->email->send()) {
			echo 'Your email was sent, thanks chamil.';
		} else {
			show_error($this->email->print_debugger()); //返回包含郵件內容的字符串，包括EMAIL頭和EMAIL正文。用於調試。
		}
	}
}
