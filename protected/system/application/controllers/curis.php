<?php

/**
	The Curis controller is the central logic of the ResOp website.
	This controller file is invoked by default, or by the URL /protected/index.php/curis .  the next slash is the invoked function, and any following slashes are parameters: /protected/index.php/curis/function/param1/param2

**/

class Curis extends Controller {
	//base URL for links
	protected $urlroot = "/resop/protected/index.php/curis";
	
	//global settings variables - boolean (0 or 1)
	protected $fac_edit_proj;
	protected $fac_assn_asst;
	protected $fac_rate_stud;
	protected $fac_see_matches;
	protected $stud_edit_prof;
	protected $stud_see_proj;
	protected $stud_apply;
	protected $stud_accept;
	protected $login_link;
	
	//Constructor
	function Curis()
       {
            parent::Controller();
            $this->authenticate();
            $this->loadsettings();
       }
	
	/**
	 * Grab the user's information from WebAuth and load any stored info from 
	 * the database.
	 */
	function authenticate(){
		include 'authentication.php';
	}
	
	/**
	 * Load the global settings from the database.
	 */
	function loadsettings(){
		$query = $this->db->query("SELECT * FROM global_settings");
		if($query->num_rows() != 1)
			echo'there was a problem loading site settings from the database.';
		$settings = $query->row();
		$this->fac_edit_proj = $settings->fac_edit_proj;
		$this->fac_assn_asst = $settings->fac_assn_asst;
		$this->fac_rate_stud = $settings->fac_rate_stud;
		$this->fac_see_matches = $settings->fac_see_matches;
		$this->stud_edit_prof = $settings->stud_edit_prof;
		$this->stud_see_proj = $settings->stud_see_proj;
		$this->stud_apply = $settings->stud_apply;
		$this->stud_accept = $settings->stud_accept;
		$this->login_link = $settings->login_link;
	}
	
	/*
******	SECTION: Display Functions: control which views to present and what data to pass them
	 */
			
	/*
		Landing: Displays the splash front page, anyone can view unauthenticated
	*/
	 
	function landing()
	{
		$query = $this->db->query("SELECT html FROM dyn_pages WHERE view = 'landing'");
		$vdata['html'] = $query->row()->html;
		$data['title'] = "Stanford CS Research Opportunities";
		$links = ($this->login_link=="1")?array("Login"=>$this->urlroot):array();
		$sidebarData['links'] = $links;
		
		$this->displayHeader($data);
		$this->displaySidebar($sidebarData);
		
		$this->load->view('curis/landing', $vdata);
		
		$this->displayFooter($data);
	}
	
	/*
		Index: Displays the homepage.  Authentication required
	*/
	
	function index()
	{
		$data['title'] = "Computer Science Research Opportunities - Welcome!";
		$query = $this->db->query("SELECT html FROM dyn_pages WHERE view = 'home'");
		$vdata['html'] = $query->row()->html;
		if($this->User->type=="student" || $this->User->admin=="1")
			$links['Student'] = $this->urlroot . "/student";
		if($this->User->type=="faculty" || $this->User->admin=="1")
               $links['Faculty'] = $this->urlroot . "/faculty";
        if($this->User->admin=="1")
               $links['Admin'] = $this->urlroot . "/admin";
    if($this->User->type != "faculty"	&& $this->User->type != "student"
    		&& $this->User->admin!="1")
               $links = $links = array("No user privileges for user type: '".
				       $this->User->type."'" =>$this->urlroot);
      
		$sidebarData['links'] = $links;
		
		$this->displayHeader($data);
		$this->displaySidebar($sidebarData);
		
		$this->load->view('curis/home', $vdata);
		
		$this->displayFooter();
	}	
	
	
	/*
	  	Student: Controls all the student pages.  Authentication required.
	 */
	
	function student($page = "", $proj_id = ""){
		include 'student.php';
	}
	
	/*
	  	Faculty: Controls all the faculty pages.  Authentication required.
	 */
		
	function faculty($page = "", $proj_id = ""){
		include 'faculty.php';
	}
	
	/*
	  	Admin: Controls all the admin pages.  Authentication required.
	 */
	
	function admin($page = "", $user_id = "", $proj_id = ""){
		include 'admin.php';
	}
	
	/*
	 	Functions for loading the frame
	 */
	function displayHeader($title)
	{
		$this->load->view('curis/header', $title);
	}
	
	function displaySidebar($sidebarData)
	{
		$this->load->view('curis/sidebar', $sidebarData);
	}
	
	function displayFooter()
	{
		$this->load->view('curis/footer');	
	}
	
/*********************
	End Display Section
	*******************/
	
/***********************
	Data Loading
	*******************/
	
	 function getprojects($userid = ""){
		if($userid =="")
			$sqlquery = "SELECT proj_id, title, researchfield, secondfield, thirdfield, prof,views FROM projects ORDER BY researchfield, prof_id";
		else $sqlquery = "SELECT proj_id, title, researchfield, secondfield, thirdfield, prof, views FROM projects WHERE prof_id = '$userid' ORDER BY researchfield";
		$query = $this->db->query($sqlquery);
		if($query->num_rows() > 0)
			return $query->result();
	}
	
	function loadproject($proj_id){
		$this->load->model('Project');
		$this->Project->load_project($proj_id);
		return $this->Project;
	}
	
	function loadApplication($proj_id){
		$this->load->model('Application');
		$this->Application->load_application($proj_id, $this->User->user_id);
		return $this->Application;
	}
	
/************************
	Data Updating
	*********************/

	function updatepage($pagename){
		$success = $this->db->update('dyn_pages', array('html' => $_POST['html']), array( 'view' => $pagename));
		if($success)
			return "Page saved successfully.";
		else 
			return "There was an error updating the page.";
	}
	
	/*
		updateuser is used from several vantage points, so it checks
		to see if some less common fields are specified before copying
		them into the data object.
	*/
	function updateuser($user_id, &$message = ""){ 
		$this->load->model('User', 'User_other');
		$this->User_other->populate_by_user_id($user_id);
		$this->User_other->name = $_POST['name'];
		if(isset($_POST['sunetid'])) $this->User_other->sunetid = $_POST['sunetid'];
		if(isset($_POST['type'])) $this->User_other->type = $_POST['type'];
		$this->User_other->email = $_POST['email'];

		$this->User_other->webpage =$_POST['webpage'];
		$this->User_other->interestarea = $_POST['interestarea'];
		$this->User_other->major = ($_POST['major'] == "other") ? $_POST['major_typed'] : $_POST['major'];
		$this->User_other->gpa = $_POST['gpa'];
		//$this->User_other->graduating = $_POST['graduating'];
		//$this->User_other->majorwhen = $_POST['majorwhen'];
		//$this->User_other->coterm = $_POST['coterm'];
		$this->User_other->year = (isset($_POST['year'])?$_POST['year']:"");
		$this->uploadFiles($message);
				
		if(isset($_POST['admin'])) $this->User_other->admin = $_POST['admin'];
		if(isset($_POST['matched'])) $this->User_other->matched = $_POST['matched'];
		if(isset($_POST['assistantto'])) $this->User_other->assistantto = $_POST['assistantto'];
		
		//if the user is new, insert
		if($user_id == "") $this->User_other->insert(); 
		//otherwise update
		else $this->db->update('users', $this->User_other, array( 'user_id' => $user_id));
		//if updating the logged in user, copy changes into the live copy
		if($user_id == $this->User->user_id){
			$this->User = $this->User_other;
		}
	}
	
	//Updates the application from the student side
	function updateApplication($proj_id){
		$this->load->model('Application');
		$this->Application->proj_id = $proj_id;
		$this->Application->user_id = $this->User->user_id;
		$this->Application->student_sunetid = $this->User->sunetid;
		//$this->Application->score = $_POST['score'];
		$this->Application->statement = $_POST['statement'];
		$query = $this->db->query("SELECT prof, prof_id, title FROM projects WHERE proj_id='$proj_id' ");
		//foreach should run once, loading additional details out of the db
		foreach ($query->result() as $row){
			$this->Application->proj_prof = $row->prof;
			$this->Application->proj_title = $row->title;
			$this->Application->prof_id = $row->prof_id;
		}
		
		$this->Application->update();
	}
	
	//Updates the application from the faculty side
	/*function updaterating(){
		$this->load->model('Application');
		$this->Application->load_application($_POST['proj_id'], $_POST['stud_id']);
		$app_stage = $this->db->query("SELECT app_stage FROM global_settings LIMIT 1")->row()->app_stage;
		if($app_stage == 1) $this->Application->fac_rating1 = $_POST['score'];
		else if($app_stage == 2) $this->Application->fac_rating2 = $_POST['score'];
		else  $this->Application->fac_rating3 = $_POST['score'];
		return $this->Application->update();
	}*/
	
	//Update a project, either as the professor or as the administrator
	function updateproject($proj_id = "", $original_prof_id = ""){
		$this->load->model('Project');
		$this->Project->title = $_POST['title'];
		$this->Project->researchfield = ($_POST['researchfield'] == "other") ? $_POST['researchfield_typed'] : $_POST['researchfield'];
		$this->Project->secondfield = ($_POST['secondfield'] == "other") ? $_POST['secondfield_typed'] : $_POST['secondfield'];
		$this->Project->thirdfield = ($_POST['thirdfield'] == "other") ? $_POST['thirdfield_typed'] : $_POST['thirdfield'];
		$this->Project->url = $_POST['url'];
		$this->Project->description = addslashes($_POST['description']);
		$this->Project->prof = $_POST['prof'];
		$this->Project->prof_email = $_POST['prof_email'];
		//$this->Project->spring_prep = addslashes($_POST['spring_prep']);
		$this->Project->background = addslashes($_POST['background']);
		$this->Project->capacity = $_POST['capacity'];
		$this->Project->degree_program = $_POST['degree_program'];
		$sum = 0;
		if (isset($_POST['RAship']))$sum += 1;
		if (isset($_POST['hourly']))$sum += 2;
		if (isset($_POST['credit']))$sum+=4;
		/*if (isset($_POST['RAship'])){
			sum = sum+1;
		}*/
		//if(isset($_POST['hourly'])) sum+=2;
		//if(isset($_POST['credit'])) sum+=4;
		$this->Project->incentives = $sum;
		
		if($original_prof_id == ""){
			$this->Project->prof_id = $this->User->user_id;
			$this->Project->prof_sunetid = $this->User->sunetid;
		}else 
			$this->Project->prof_id = $original_prof_id;
		$this->Project->proj_id = $proj_id;

		$this->Project->update();
	}
	
/**
	Delete Profile - clears a user profile
	**/
	function deleteprofile($user_id){
		$this->load->model('User', 'User_todelete');
		$this->User_todelete->populate_by_user_id($user_id);
		$this->User_todelete->webpage = '';
		$this->User_todelete->interestarea = '';
		$this->User_todelete->major = '';
		$this->User_todelete->gpa = '';
		$this->User_todelete->graduating = '0';
		$this->User_todelete->majorwhen = '0';
		$this->User_todelete->coterm = '0';
		$this->User_todelete->year = '';
		$this->User_todelete->transcript = '';
		$this->User_todelete->resume = '';
		$this->db->update('users', $this->User_todelete, array('user_id' => $user_id));
		$this->authenticate();
	}
	
	
	/**
		Upload Files - loads a pdf or txt file into the uploads folder
	**/
	function uploadFiles(&$message){
		$config['upload_path'] = '/var/www/html/resop/protected/uploads';
		$config['allowed_types'] = 'pdf|txt';
		$config['max_size']	= '20000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);
	
		if($this->upload->do_upload('transcript')){
			if($this->User_other->transcript != "") unlink(strstr($this->User_other->transcript, 'uploads'));
			$message .= 'Transcript successfully uploaded <br>';
			$dataArray = $this->upload->data();
			$this->User_other->transcript = '/resop/protected/uploads/' . $dataArray['raw_name']. $dataArray['file_ext'];
		}
		
		if($this->upload->do_upload('resume')) {
			if($this->User_other->resume != "") unlink(strstr($this->User_other->resume, 'uploads'));
			$message .= 'Resume successfully uploaded <br>';
			$dataArray = $this->upload->data();
			$this->User_other->resume = '/resop/protected/uploads/' . $dataArray['raw_name'] . $dataArray['file_ext'];
		}
	}
	
	/**builds an array of the unique research field values from the 
	   three research field columns in the database. **/
	function fieldFilters(){
		$result=$this->db->query("SELECT DISTINCT researchfield FROM projects")->result();
		foreach($result as $row):
			$array[] = $row->researchfield;
		endforeach;
		$result=$this->db->query("SELECT DISTINCT secondfield FROM projects")->result();
		foreach($result as $row):
			$array[] = $row->secondfield;
		endforeach;
		$result=$this->db->query("SELECT DISTINCT thirdfield FROM projects")->result();
		foreach($result as $row):
			$array[] = $row->thirdfield;
		endforeach;
		return isset($array)?array_unique($array):"";
	}
	
	
	/**
		Archives all the database and associates timestamp with it
	**/
	function archive(){
		$timestamp = date('Y M d g:ia');
		$result=$this->db->query("SELECT * FROM assistants")->result();
		foreach($result as $row){
			$row->timestamp = $timestamp;
			$this->db->insert('archive_assistants', $row);
		}
		$result=$this->db->query("SELECT * FROM dyn_pages")->result();
		foreach($result as $row){
			$row->timestamp = $timestamp;
			$this->db->insert('archive_dyn_pages', $row);
		}
		$result=$this->db->query("SELECT * FROM matches")->result();
		foreach($result as $row){
			$row->timestamp = $timestamp;
			$this->db->insert('archive_matches', $row);
		}
		$result=$this->db->query("SELECT * FROM projects")->result();
		foreach($result as $row){
			$row->timestamp = $timestamp;
			$this->db->insert('archive_projects', $row);
		}
		$result=$this->db->query("SELECT * FROM project_applications")->result();
		foreach($result as $row){
			$row->timestamp = $timestamp;
			$this->db->insert('archive_project_applications', $row);
		}
		$result=$this->db->query("SELECT * FROM users")->result();
		foreach($result as $row){
			$row->timestamp = $timestamp;
			$this->db->insert('archive_users', $row);
		}
	}
}
	
?>