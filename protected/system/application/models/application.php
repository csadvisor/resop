<?php

class Application extends Model{

	public $app_id		='';
	public $proj_id		='';
	public $proj_prof	='';
	public $proj_title	='';
	public $user_id 	='';
	//public $score		='';
	public $statement	='';
	//public $topmatch	='';
	public $prof_id		='';
//	public $fac_rating1	='';
//	public $fac_rating2	='';
//	public $fac_rating3	='';
//	public $fac_topmatch='';
	public $student_sunetid='';
	public $rationale= '';
	
	function load_application($proj_id, $user_id){
		$query = $this->db->query("SELECT * FROM project_applications WHERE proj_id='$proj_id' AND user_id='$user_id'");
		if($query->num_rows() >0){
			$result = $query->row();
			$this->app_id 		= $result->app_id;
			$this->proj_id 		= $result->proj_id;
			$this->proj_prof 	= $result->proj_prof;
			$this->proj_title 	= $result->proj_title;
			$this->user_id		= $result->user_id;
//			$this->score		= $result->score;
			$this->statement	= stripslashes($result->statement);
//			$this->topmatch		= $result->topmatch;
			$this->prof_id		= $result->prof_id;
			$this->rationale = $result->rationale;
//			$this->fac_rating1	= $result->fac_rating1;
//			$this->fac_rating2	= $result->fac_rating2;
//			$this->fac_rating3	= $result->fac_rating3;
//			$this->fac_topmatch	= $result->fac_topmatch;
			$this->student_sunetid= $result->student_sunetid;
		}
		return $this;
	}
	
	function delete_application($app_id){
		$query = $this->db->query("DELETE FROM project_applications WHERE app_id='$app_id'");
	}
	
	function update(){
		$query = $this->db->query("SELECT * FROM project_applications WHERE app_id='$this->app_id'");
		if($query->num_rows() == 0)
			$this->db->insert('project_applications', $this);
		else
			$this->db->update('project_applications', $this, array('app_id' => $this->app_id));
	}
}
?>
	
	