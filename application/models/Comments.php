<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comments extends CI_Model
{

	var $table = 'product_class';
	var $product = 'product';
	var $photo = 'photo';
	// Constructor
	function __construct()
	{
		parent::__construct();
	}

	function find($id)
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
	function find_product($id)
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
	function find_photo($id)
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
