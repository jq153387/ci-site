<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comment_s extends CI_Model
{

	var $table = 'comments';
	var $photo = 'photo1';
	// Constructor
	function __construct()
	{
		parent::__construct();
	}

	function find_comments($limit = null, $offset = 0)
	{
		$this->db->select('*');
		$array = array('published =' => 1, 'class_id =' => "");
		//$this->db->where('class_id', null);
		$this->db->where($array);
		$this->db->or_where('class_id is null');
		$this->db->limit($limit, $offset);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get($this->table);
		//print_r($this->db->last_query());
		return $query->result_array();
	}
	function find_review($id)
	{
		$this->db->select('*');
		$this->db->where('class_id', $id);
		$this->db->where('published', 1);

		$this->db->order_by('id', 'desc');
		$query = $this->db->get($this->table);
		//print_r($this->db->last_query());
		return $query->result_array();
	}
	function find_photo($id)
	{
		$this->db->select('*');

		if ($id != null) {
			$this->db->where('product_id', $id);
		}
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get($this->photo);
		//print_r($this->db->last_query());
		return $query->result_array();
	}
	function com_dispaly($post)
	{
		$data['published'] = $post['published'];
		$this->db->where('id', $post['id']);
		$this->db->update($this->table, $data);
	}
	// function create($post)
	// {
	// 	$post['slug'] = url_title($post['title'], '-', true);
	// 	$post['body'] = trim(preg_replace('/\s\s+/', ' ', $post['body']));
	// 	$this->db->insert($this->table, $post);
	// }

	// function update($post, $id)
	// {
	// 	$post['slug'] = url_title($post['title'], '-', true);
	// 	$post['body'] = trim(preg_replace('/\s\s+/', ' ', $post['body']));
	// 	$this->db->where('id', $id);
	// 	$this->db->update($this->table, $post);
	// }

	// function delete($id)
	// {
	// 	$this->db->where('id', $id);
	// 	$this->db->delete($this->table);
	// }

	// function find_by_id($id)
	// {
	// 	$this->db->where('id', $id);
	// 	return $this->db->get($this->table, 1)->row_array();
	// }
}
