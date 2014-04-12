<?php

class Project extends Model{

	public $proj_id		='';
	public $title		='';
	public $researchfield ='';
	public $secondfield	='';
	public $thirdfield  ='';
	public $url			='';
	public $description	='';
	public $prof		='';
	public $prof_email	='';
	public $background	='';
	public $capacity	='';
	public $prof_id		='';
	public $prof_sunetid='';
	public $degree_program ='';
	public $incentives='';
	public $views = '';

	
	function load_project($proj_id){
		$query = $this->db->query("SELECT * FROM projects WHERE proj_id = '$proj_id'");
		if($query->num_rows() >0){
			$result = $query->row();
			$this->proj_id 		= $proj_id;
			$this->title 		= $result->title;
			$this->researchfield = $result->researchfield;
			$this->secondfield 	= $result->secondfield;
			$this->thirdfield	= $result->thirdfield;
			$this->url			= $result->url;
			$this->description	= stripslashes($result->description);
			$this->prof			= $result->prof;
			$this->prof_email	= $result->prof_email;
			$this->background	= stripslashes($result->background);
			$this->capacity		= $result->capacity;
			$this->prof_id		= $result->prof_id;
			$this->prof_sunetid	= $result->prof_sunetid;
			$this->degree_program = $result->degree_program;
			$this->incentives = $result->incentives;
			$this->views= $result->views;
		}
	}
		
		function update(){
		$query = $this->db->query("SELECT title FROM projects WHERE proj_id='$this->proj_id'");
		if($query->num_rows() == 0)
			$this->db->insert('projects', $this);
		else
			$this->db->update('projects', $this, array('proj_id' => $this->proj_id));
	}
}
?>
	
	