<?php
class Home_model extends CI_Model {

	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}

	public function CountCategoryBookList($category_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_book');
		$this->db->where('book_status', '1');
		if(!empty($category_id)){
			$this->db->where('category_id', $category_id);
		}
		$query = $this->db->get();	
		return $query->num_rows() ;
	} 

    public function getCategoryBookList($category_id,$limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_book');
		$this->db->where('book_status', '1');
		if(!empty($category_id)){
			$this->db->where('category_id', $category_id);
		}
		$this->db->limit($limit,$offset);
		$query = $this->db->get();	
		return $query->result() ;
	} 

	public function CountAuthorsBookList($authors_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_book');
		$this->db->where('book_status', '1');
		if(!empty($authors_id)){
			$this->db->where('authors_id', $authors_id);
		}
		$query = $this->db->get();	
		return $query->num_rows() ;
	} 

    public function getAuthorsBookList($authors_id,$limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_book');
		$this->db->where('book_status', '1');
		if(!empty($authors_id)){
			$this->db->where('authors_id', $authors_id);
		}
		$this->db->limit($limit,$offset);
		$query = $this->db->get();	
		return $query->result() ;
	} 

	public function CountPublishersBookList($publishers_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_book');
		$this->db->where('book_status', '1');
		if(!empty($publishers_id)){
			$this->db->where('publishers_id', $publishers_id);
		}
		$query = $this->db->get();	
		return $query->num_rows() ;
	} 

    public function getPublishersBookList($publishers_id,$limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_book');
		$this->db->where('book_status', '1');
		if(!empty($publishers_id)){
			$this->db->where('publishers_id', $publishers_id);
		}
		$this->db->limit($limit,$offset);
		$query = $this->db->get();	
		return $query->result() ;
	} 

	public function CountSeriesBookList($series_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_book');
		$this->db->where('book_status', '1');
		if(!empty($series_id)){
			$this->db->where('series_id', $series_id);
		}
		$query = $this->db->get();	
		return $query->num_rows() ;
	} 

    public function getSeriesBookList($series_id,$limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_book');
		$this->db->where('book_status', '1');
		if(!empty($series_id)){
			$this->db->where('series_id', $series_id);
		}
		$this->db->limit($limit,$offset);
		$query = $this->db->get();	
		return $query->result() ;
	} 

	public function CountBookList()
	{
		$this->db->select('*');
		$this->db->from('tbl_book');
		$this->db->where('book_status', '1');
		$query = $this->db->get();	
		return $query->num_rows() ;
	} 

    public function getBookList($limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_book');
		$this->db->where('book_status', '1');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();	
		return $query->result() ;
	} 

	public function CountTopRatedBookList()
	{
		$this->db->select('*');
		$this->db->from('tbl_book');
		$this->db->where('book_status', '1');
		$this->db->order_by('book_top_rating DESC');
		$query = $this->db->get();	
		return $query->num_rows() ;
	} 

    public function getTopRatedBookList($limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_book');
		$this->db->where('book_status', '1');
		$this->db->order_by('book_top_rating DESC');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();	
		return $query->result() ;
	} 

    public function getSumofReview($book_id)
	{
		$this->db->select('SUM(book_review) as book_review');
		$this->db->from('tbl_book_review');
		$this->db->where('book_id', $book_id);
		$query = $this->db->get();	
		return $query->row() ;
	} 

	public function CountReviewList($book_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_book_review');
		$this->db->where('book_review_status', '1');
		$this->db->where('book_id', $book_id);
		$this->db->order_by('book_review_id DESC');
		$query = $this->db->get();	
		return $query->num_rows() ;
	} 

    public function getReviewList($limit,$offset, $book_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_book_review');
		$this->db->where('book_review_status', '1');
		$this->db->where('book_id', $book_id);
		$this->db->order_by('book_review_id DESC');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();	
		return $query->result() ;
	} 

}

?>