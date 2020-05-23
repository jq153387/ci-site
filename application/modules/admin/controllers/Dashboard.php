<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->data['content_title'] = "Dashboard";
	}

	public function index()
	{
		//redirect('admin/posts');
		$this->data['welcome'] = '歡迎來到管理系統';
		$this->data['page_title'] = "Dashboard";
		$this->load_admin('/dashboard/index');
	}
}
