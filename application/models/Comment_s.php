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

	function find_comments($limit = null, $offset = 0, $published = true)
	{
		$this->db->select('*');
		if ($published) {
			$array = array('published =' => 1, 'class_id =' => "");
		} else {
			$array = array('class_id =' => "");
		}
		//$this->db->where('class_id', null);
		$this->db->where($array);
		$this->db->or_where('class_id is null');
		$this->db->limit($limit, $offset);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get($this->table);
		//print_r($this->db->last_query());
		return $query->result_array();
	}
	function find_one_comments($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get($this->table);
		//print_r($this->db->last_query());
		return $query->result_array();
	}
	function find_review($id, $published = true)
	{
		$this->db->select('*');
		$this->db->where('class_id', $id);
		if ($published) {
			$this->db->where('published', 1);
		}

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
		print_r($this->db->last_query());
	}
	function create_review($data)
	{
		$post['writer'] = $data['writer'];
		$post['content'] = $data['content'];
		$date = new DateTime(null, new DateTimeZone('Asia/Taipei'));
		$post['news_date'] = $date->format('Y-m-d H:i:s');
		$post['email'] = (isset($data['email'])) ? $data['email'] : "";
		$post['published'] = $data['published'];
		$post['class_id'] = $data['class_id'];

		$this->db->insert($this->table, $post);
		$insert_id = $this->db->insert_id();
		// print_r($this->db->last_query());
		return  $insert_id;
	}

	function create_photo($post)
	{
		$data['product_id'] = $post['id'];
		$data['url'] = $post['image'];
		$date = new DateTime(null, new DateTimeZone('Asia/Taipei'));
		$data['created'] = $date->format('Y-m-d H:i:s');

		$this->db->insert("photo1", $data);
	}
	function update($data)
	{
		$post['writer'] = $data['writer'];
		$post['content'] = $data['content'];
		$post['published'] = $data['published'];

		$this->db->where('id', $data['id']);
		$this->db->update($this->table, $post);
	}

	function delete($id)
	{

		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
	function delete_photo($data)
	{
		if (!empty($data)) {
			$this->db->where_in('id', $data);
			$this->db->delete("photo1");
		}
	}
	// function find_by_id($id)
	// {
	// 	$this->db->where('id', $id);
	// 	return $this->db->get($this->table, 1)->row_array();
	// }
}
