<?php 

class User extends Model {
	
	public $user_id			= '';
	public $name			= '';
	public $sunetid			= '';
	public $type			= '';
	public $email			= '';
	public $webpage			= '';
	public $interestarea 	= '';
	public $major			= '';
	public $gpa				= '';
//	public $graduating		= '';
//	public $majorwhen		= '';
//	public $coterm			= '';
	public $year			= '';
	public $transcript		= '';
	public $resume			= '';
	public $matched			= '';
	public $admin			= '';
	public $assistantto		= '';
	public $fac_capacity	= '';
	public $namelf			= '';
	
	function User()
	{
		parent::Model();
	}
	
	function populate_by_sunet($sunetid){
		$query = $this->db->query("SELECT * FROM users WHERE sunetid = '$sunetid'");
		if($query->num_rows() > 0){
			$result = $query->row();
			//$this = $result;
			$this->user_id		= $result->user_id;
			$this->name			= $result->name;
			$this->namelf		= $result->namelf;
			$this->sunetid		= $result->sunetid;
			$this->type			= $result->type;
			$this->email		= $result->email;
			$this->webpage		= $result->webpage;
			$this->interestarea = $result->interestarea;
			$this->major		= $result->major;
			$this->gpa			= $result->gpa;
			$this->graduating	= $result->graduating;
			$this->majorwhen	= $result->majorwhen;
			$this->coterm		= $result->coterm;
			$this->year			= $result->year;
			$this->transcript	= $result->transcript;
			$this->resume		= $result->resume;
			$this->matched		= $result->matched;
			$this->admin		= $result->admin;
			$this->assistantto	= $result->assistantto;
			$this->fac_capacity = $result->fac_capacity;

		}
	}
	
	function populate_by_user_id($user_id){
		$query = $this->db->query("SELECT * FROM users WHERE user_id = '$user_id'");
		if($query->num_rows() > 0){
			$result = $query->row();
			$this->user_id		= $result->user_id;
			$this->name			= $result->name;
			$this->namelf		= $result->namelf;
			$this->sunetid		= $result->sunetid;
			$this->type			= $result->type;
			$this->email		= $result->email;
			$this->webpage		= $result->webpage;
			$this->interestarea = $result->interestarea;
			$this->major		= $result->major;
			$this->gpa			= $result->gpa;
			$this->graduating	= $result->graduating;
			$this->majorwhen	= $result->majorwhen;
			$this->coterm		= $result->coterm;
			$this->year			= $result->year;
			$this->transcript	= $result->transcript;
			$this->resume		= $result->resume;
			$this->matched		= $result->matched;
			$this->admin		= $result->admin;
			$this->assistantto	= $result->assistantto;
			$this->fac_capacity = $result->fac_capacity;
			
		}
	}
	
	function insert(){
		if($this->sunetid != ""){
			$query = $this->db->query("SELECT * FROM users WHERE user_id='$this->user_id'");
			if($query->num_rows() == 0)
				$this->db->insert('users', $this);
		}
	}
	
}

?>