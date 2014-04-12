<?php

//** Called as : function faculty($page = "", $proj_id = "") **//

		$projdata = "";
		
		//Not a faculty, deny priviledges
		if($this->User->admin != "1" && $this->User->type != "faculty"){
			$data['title'] = "ResOp :: Faculty :: Access Denied";
			$view = 'curis/faculty/denied';
			
		/**Project Edit/View Section**/
		}else if($page == "projects"){
			
			
			if(isset($_POST['Action']) ){
				//Delete all projects!
				if($_POST['Action'] =="Delete All Projects"){
					$user_id = $this->User->user_id;
					$projects = $this->db->query("SELECT proj_id FROM projects WHERE prof_id = '$user_id' AND save = '0'")->result();
					foreach($projects as $row){
						$this->db->query("DELETE FROM matches WHERE proj_id ='$row->proj_id'");
						$this->db->query("DELETE FROM project_applications WHERE proj_id ='$row->proj_id'");
					}
					$this->db->query("DELETE FROM projects WHERE prof_id = '$user_id' AND save = '0'");
				//Delete this project
				}else if($_POST['Action'] =="Delete project"){
					$proj_id = $_POST['proj_id'];
					$this->db->query("DELETE FROM matches WHERE proj_id ='$proj_id'");
					$this->db->query("DELETE FROM project_applications WHERE proj_id ='$proj_id'");
					$this->db->query("DELETE FROM projects WHERE  proj_id ='$proj_id'");	
				//overall faculty capacity changed => update
				}else if(isset($_POST['Action']) && $_POST['Action'] =="Save Capacity") {
					$capacity = $_POST['capacity'];
					$user_id = $this->User->user_id;
					$this->db->query("UPDATE users SET fac_capacity=$capacity WHERE user_id=$user_id");
					$vdata['projects'] = $this->getprojects($this->User->user_id);
					$data['title'] = "ResOp :: Faculty :: Your Projects";
					$view = 'curis/faculty/projects';
				//Project edited, save changes and return to all projects page
				}else if($_POST['Action'] =="Save") {
					$this->updateproject($proj_id);
				}
				$vdata['projects'] = $this->getprojects($this->User->user_id);
				$data['title'] = "ResOp :: Faculty :: Your Projects";
				$view = 'curis/faculty/projects';
				
			//No project selected, display all of the user's projects
			}else if($proj_id == ""){
				$vdata['projects'] = $this->getprojects($this->User->user_id);
				$data['title'] = "ResOp :: Faculty :: Your Projects";
				$view = 'curis/faculty/projects';
				
			//show the selected project
			} else {
				$vdata['project'] = $this->loadproject($proj_id);
					
				//Project selected, display specific project
				if($this->User->user_id == $vdata['project']->prof_id ){
					$data['title'] = "ResOp :: Faculty :: Your Projects :: ". $vdata['project']->title;
					$view = 'curis/faculty/editproject';
					$vdata['enabled'] = $this->fac_edit_proj;
				
				//Display home page if they're trying to edit a project they don't own
				} else {
					$data['title'] = "ResOp :: Faculty";
					$query = $this->db->query("SELECT html FROM dyn_pages WHERE view = 'faculty.home'");
					$vdata['html'] = $query->row()->html;
					$view = 'curis/faculty/home';
				}
			}
			
		/**Project Adding Section**/	
		} else if($page == "addproject"){
			//if project editing is enabled
			if($this->fac_edit_proj == 1){
				//New project added, save changes and return to projects page
				if(isset($_POST['Action']) && $_POST['Action'] =="Save") {
					$this->updateproject();
					$vdata['projects'] = $this->getprojects($this->User->user_id);
					$data['title'] = "ResOp :: Faculty :: Your Projects";
					$view = 'curis/faculty/projects';
				}else if(isset($_POST['Action']) && $_POST['Action'] =="Save Capacity") {
					$this->faculty("projects");
					return;
				}else if(isset($_POST['Action']) && $_POST['Action'] =="Delete project") {
					$this->faculty("projects");
					return;
				//Display new project page
				} else {
					$data['title'] = "ResOp :: Faculty :: Add Project";
					$view = 'curis/faculty/addproject';
				}
			//project editing is disabled
			} else{
				$data['title'] = "ResOp :: Faculty :: Add Project Disabled";
				$view = 'curis/disabled';
			}
			
		/**Applications Section**/
		//pulls all applications for the faculty's projects and displays them
		} else if ($page == "applications"){ 
			$query = $this->db->query("SELECT * FROM projects WHERE prof_id='".$this->User->user_id."'");
			$projects = $query->result();
			//for each project, pull the applications
			foreach ($projects as $project):
				$pquery = $this->db->query("SELECT project_applications.*, users.name FROM project_applications, users WHERE project_applications.proj_id='$project->proj_id' AND users.user_id = project_applications.user_id");//AND users.matched!='1'");
				$project->applications = $pquery->result();
				endforeach;
			$vdata['projects'] = $projects;
			$data['title'] = "ResOp :: Faculty :: View Applications";
			$view = 'curis/faculty/applications';
		
		//Displays all the information relevant to a specific application
		} else if ($page == "application"){
			//the faculty member has updated their rating
		/*	if(isset($_POST['Action']) && $_POST['Action'] == "Save"){
				$this->updaterating();
				//redirect back to applications view
				$this->faculty("applications");
				return;
			//the faculty member has selected this application for pre-matching
			}else*/ if(isset($_POST['Action']) && $_POST['Action'] == "Save"){
				$sunetid = $_POST['sunetid'];
				$proj_id = $_POST['proj_id'];
				$rationale = $_POST['decision_rational'];
				$accept_status = $_POST['accept_status'];
				$this->db->query("UPDATE project_applications SET accept_status='$accept_status', rationale='$rationale' WHERE proj_id='$proj_id'");
				//$this->db->query("INSERT INTO matches (sunetid, proj_id) VALUES ('$sunetid', '$proj_id')");
				//$this->db->query("UPDATE users SET matched = '1' WHERE sunetid = '$sunetid'");
				
				$this->faculty("applications");
				return;
			//display the application data
			} else {
				$query = $this->db->query("SELECT * FROM project_applications WHERE app_id='$proj_id'");
				$vdata['application'] = $query->row();
				$query = $this->db->query("SELECT * FROM users WHERE user_id='".$vdata['application']->user_id."'");
				$vdata['user'] = $query->row();
				$vdata['prof_id'] = $this->User->user_id;
				
				$data['title'] = "ResOp :: Faculty :: Applications :: ". $vdata['application']->proj_title." :: ".$vdata['user']->name;
				$view = 'curis/faculty/application';
				$vdata['rate_enabled'] = $this->fac_rate_stud;
			}	
			
		/**Matching Display Section**/	
		} else if($page=="matches"){	
			$query = $this->db->query("SELECT * FROM projects WHERE prof_id='".$this->User->user_id."'");
			$projects = $query->result();
			foreach ($projects as $project):
				$pquery = $this->db->query("SELECT accepted, sunetid FROM matches WHERE proj_id = '$project->proj_id'");
				$project->matches = $pquery->result();
				endforeach;
			$vdata['projects'] = $projects;
			$data['title'] = "ResOp :: Faculty :: View Matches";
			$view = 'curis/faculty/matches';	
			
		/** Assistants Section **/
		} else if ($page == "assistants") {
			if($this->fac_assn_asst == "1"){
				//add specified assistant
				if(isset($_POST['Action']) && $_POST['Action'] == "Add")
					$this->db->insert('assistants', array( 'fac_id'=>$this->User->user_id, 'sunetid'=>$_POST['sunetid']));
				//remove specified assistant
				else if (isset($_POST['Action']) && $_POST['Action'] == "Remove")
					$this->db->delete('assistants', array('sunetid'=>$_POST['sunetid']));
				//display all assistants
				$vdata['assistants'] = $this->db->query("SELECT * FROM assistants WHERE fac_id='".$this->User->user_id."'")->result();	
				$data['title'] = "ResOp :: Faculty :: Assistants";
				$view = 'curis/faculty/assistants';
			//feature disabled
			} else {
				$data['title'] = "ResOp :: Faculty :: Assistants [Disabled]";
				$view = 'curis/disabled';
			}
			
		/**Home Section**/
		} else {
			$data['title'] = "ResOp :: Faculty";
			$query = $this->db->query("SELECT html FROM dyn_pages WHERE view = 'faculty.home'");
			$vdata['html'] = $query->row()->html;
			$view = 'curis/faculty/home';
		}
		$user_id = $this->User->user_id;
		$query = $this->db->query("SELECT COUNT(app_id) as num_apps FROM project_applications WHERE prof_id = '$user_id' AND accept_status=0");
		$num_apps = $query->row()->num_apps;
		$app_link = 'Applications ';
		if($num_apps>0) $app_link = $app_link . '(' . $num_apps . ')';
		//Array of all links to be displayed in the sidebar
		$links = array(
		 	'ResOp Home' => $this->urlroot,
		 	'Faculty Home' => $this->urlroot . "/faculty",
		 	'Projects' => $this->urlroot ."/faculty/projects",
		 	$app_link => $this->urlroot ."/faculty/applications"		 	
          );
        //Hide the following links if the appropriate permissions are not set
       // if($this->fac_see_matches ==1) $links['Matches'] = $this->urlroot ."/faculty/matches";
        if($this->fac_assn_asst ==1) $links['Assistants'] = $this->urlroot ."/faculty/assistants";
        if($this->fac_edit_proj ==1) $links['+ Add Project'] = $this->urlroot ."/faculty/addproject";
        
        $vdata['User'] = $this->User;
        $sidebarData['links'] = $links;
		$this->displayHeader($data);
		$this->displaySidebar($sidebarData);
		
		$this->load->view($view, $vdata);
		
		$this->displayFooter($data);
?>