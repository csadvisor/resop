<?php

Class Score extends Model {

	public $rating_id 	= "";
	public $proj_id 	= "";
	public $prof_id		= "";
	public $stud_id		= "";
	public $score		= "";
	public $topmatch	= "";
	
	function load_score($proj_id, $stud_id){
		$query = $this->db->query("SELECT * FROM student_ratings WHERE proj_id='$proj_id' AND user_id='$stud_id'");
		if($query->num_rows() >0){
			$result = $query->row();
			$this->rating_id 	= $result->rating_id;
			$this->proj_id 		= $result->proj_id;
			$this->prof_id 		= $result->prof_id;
			$this->stud_id		= $result->stud_id;
			$this->score		= $result->score;
			$this->topmatch		= $result->topmatch;
		}
		return $this;
	}
	
	function update(){
		$query = $this->db->query("SELECT * FROM student_ratings WHERE proj_id='".$this->proj_id."' AND stud_id='".$this->stud_id."'");
		echo $query->num_rows();
		if($query->num_rows() == 0){
			unset($this->rating_id);
			$this->db->insert('student_ratings', $this);
			return "Score saved.";
		}else{
			$this->db->update('student_ratings', $this, array('proj_id' => $this->proj_id, 'stud_id' => $this->stud_id));
			return "Score updated.";
		}
		
	}


 
}

?>