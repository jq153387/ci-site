<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Albums extends CI_Model
{

	var $table = 'product_class';
	var $product = 'product';
	var $product_class = 'product_class';
	var $photo = 'photo';
	// Constructor
	function __construct()
	{
		parent::__construct();
	}

	function find($id = null)
	{
		$this->db->select('product_class.*,product.name as subname,product.id as subname_id,photo.url');
		$this->db->join('product', 'product.sub_class_id = product_class.id', 'right');
		$this->db->join('photo', 'photo.product_id = product.id', 'right');

		if ($id != null) {
			$this->db->where('product_class.id', $id);
		}
		$this->db->order_by('photo.id', 'desc');
		$query = $this->db->get($this->table);
		//print_r($this->db->last_query());
		return $query->result_array();
	}
	function find_product($id = null)
	{
		$this->db->select('product.*');

		if ($id != null) {
			$this->db->where('product.sub_class_id', $id);
		}
		$this->db->order_by('product.sort', 'ASC');
		$query = $this->db->get($this->product);
		//print_r($this->db->last_query());
		return $query->result_array();
	}
	function find_product_class($id = null)
	{
		$this->db->select('*');

		if ($id != null) {
			$this->db->where('product_class.id', $id);
		}
		$this->db->order_by('.product_class.sort', 'ASC');
		$query = $this->db->get($this->product_class);
		return $query->result_array();
	}
	function find_photo($id = null)
	{
		$this->db->select('photo.*');

		if ($id != null) {
			$this->db->where('photo.product_id', $id);
		}
		$this->db->order_by('photo.id', 'DESC');
		$query = $this->db->get($this->photo);
		//print_r($this->db->last_query());
		return $query->result_array();
	}

	function create($post)
	{
		$data['product_id'] = $post['product'];
		$data['url'] = $post['image'];
		$date = new DateTime(null, new DateTimeZone('Asia/Taipei'));
		$data['created'] = $date->format('Y-m-d H:i:s');
		$this->db->insert($this->photo, $data);
	}

	// function update($post, $id)
	// {
	// 	$post['slug'] = url_title($post['title'], '-', true);
	// 	$post['body'] = trim(preg_replace('/\s\s+/', ' ', $post['body']));
	// 	$this->db->where('id', $id);
	// 	$this->db->update($this->table, $post);
	// }

	function delete($data)
	{
		if (!empty($data)) {
			$this->db->where_in('id', $data);
			$this->db->delete($this->photo);
		}
	}

	// function find_by_id($id)
	// {
	// 	$this->db->where('id', $id);
	// 	return $this->db->get($this->table, 1)->row_array();
	// }
}
