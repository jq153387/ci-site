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
}
