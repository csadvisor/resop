<?php

//** Called as : function student($page = "", $proj_id = "") **//

		//Not a student, deny access
		//Users shouldn't get here without manually entering a URL.
		if($this->User->admin != "1" && $this->User->type != "student"){
			$data['title'] = "ResOp :: Students :: Access Denied";
			$view = 'curis/student/denied';
			
		/**Profile Section**/
		} else if($page == "profile"){
			//pass along the relevant global setting
			$vdata['enabled'] = $this->stud_edit_prof;
			$vdata['message'] = "";
			
			//User has been updated
			if(isset($_POST['Action']) && $_POST['Action'] == "Save"){
				$this->updateuser($this->User->user_id,$vdata['message']);
				$vdata['message'] .= "Profile successfully updated.<br>";
			//User wants to delete the profile
			}else if(isset($_POST['Action']) && $_POST['Action'] == "Delete"){
				$this->deleteprofile($this->User->user_id);
				$vdata['message'] = "Your profile details have been deleted.<br>";
			}
			//default - just show the profile, no action, no message
			$data['title'] = "ResOp :: Students :: Your Profile";
			$view = 'curis/student/profile';
			
		/**Project/Application Section**/
		} else if($page == "projects"){
			//Redirect to scores 
			if(isset($_POST['Action']) && $_POST['Action']=='Delete application'){
				$this->student("scores");
				return;
			}
			//if student viewing of projects is enabled
			else if($this->stud_see_proj == "1"){
				//No project selected, display all projects
				if($proj_id == ""){
					//if the filter is set, add SQL where restrictions
					if(isset($_POST['Action']) && $_POST['Action']="Filter"){
						if($_POST['faculty'] != "all" || $_POST['field'] != "all"){
							$whereclause = "WHERE ";
							if($_POST['faculty'] != "all" && $_POST['field'] != "all")
								$whereclause .= "prof='".$_POST['faculty']."' AND researchfield='".$_POST['field']."' OR secondfield='".$_POST['field']."' OR thirdfield='".$_POST['field']."'";
							else if ($_POST['faculty'] != "all")
								$whereclause .= "prof='".$_POST['faculty']."'";
							else
								$whereclause .= "researchfield='".$_POST['field']."' OR secondfield='".$_POST['field']."' OR thirdfield='".$_POST['field']."'";
						} else {
							$whereclause = "";
						}
						
						//load projects
						$vdata['prevfield'] = $_POST['field'];
						$vdata['prevprof'] = $_POST['faculty'];
						$vdata['projects'] = $this->db->query("SELECT proj_id, title, researchfield, secondfield, thirdfield, prof FROM projects ".$whereclause." ORDER BY researchfield, prof_id ")->result();
					}else{
						//load all projects
						$vdata['projects'] = $this->getprojects();
					}
					$data['title'] = "ResOp :: Students :: Projects";
					$view = 'curis/student/projects';
					
					
					$vdata['fields'] = $this->fieldFilters();
					$vdata['faculty'] = $this->db->query("SELECT DISTINCT prof FROM projects")->result();
					
				//Project selected, display specific project
				} else {
					//pass along relevant global setting
					$vdata['rate_enabled'] = $this->stud_apply;
					$vdata['application'] = $this->loadApplication($proj_id,$this->User->user_id);
					
					//Project application completed, save changes
					if(isset($_POST['Action']) && $_POST['Action'] == "Save"){
						$this->updateApplication($proj_id);
						$this->student('scores');
						return;
					}
					
					//Project appication deleted
					if(isset($_POST['Action']) && $_POST['Action'] == "Delete"){
						$app_id = $vdata['application']->app_id;
						$vdata['application']->delete_application($app_id);
						$this->student('scores');
						return;
					}
					//update view count
					$this->db->query("UPDATE projects SET views=views+1 WHERE proj_id=$proj_id");
					//load the project
					$vdata['project'] = $this->loadproject($proj_id);
					$data['title'] = "ResOp :: Students :: Projects :: ". $vdata['project']->title;
					$view = 'curis/student/projectdetails';
				}
			} else {
				$data['title'] = "ResOp :: Students :: Projects [Disabled]";
				$view = 'curis/disabled';
			}
		/**End Project Section*/
		
		/**View Scores Section**/
		} else if($page == "scores"){
			if(isset($_POST['Action']) && $_POST['Action']=='Delete application'){
			$app_id = $_POST['app_id'];
			$this->db->query("DELETE FROM project_applications WHERE app_id='$app_id' ");
			$vdata['message'] = "Successfully deleted application.";
			}
			$data['title'] = "ResOp :: Students :: My Applications";
			$user_id =$this->User->user_id;
			$query = $this->db->query("SELECT * FROM project_applications WHERE user_id='$user_id' ");
			$vdata['app'] = $query->result();
			$view = 'curis/student/scores';
		
		/**Acceptance Section**/
		} else if($page == "accept"){
			if($this->stud_accept == "1"){
				$query = $this->db->query("SELECT * FROM matches WHERE sunetid='".$this->User->sunetid."'");
				if($query->num_rows() >0){
					$data['title'] = "ResOp :: Students :: Accept Match";
					$view = 'curis/student/accept';
					$match = $query->row();
					if(isset($_POST['Action']) && $_POST['Action'] == "Submit"){
						$update['accepted'] = $_POST['accept'];
						if($_POST['accept'] == "yes"){
							$update['minority'] = $_POST['minority'];
							$update['gender'] = $_POST['gender'];
						}
						$query = $this->db->update('matches', $update, array('match_id' => $match->match_id));
						$vdata['message'] = "Thank you. Your response has been recorded.";
					
					//Uncomment to prevent users from changing their acceptances
					/*} else if($match->accepted != ""){
						if($match->accepted == "yes")
							$vdata['message'] = "You have already accepted this match.";
						else
							$vdata['message'] = "You have already declined this match."; */
					} else {
						$query = $this->db->query("SELECT title FROM projects WHERE proj_id='$match->proj_id'");
						$vdata['match'] = $match;
						$vdata['project_title'] = $query->row()->title;
					}
				} else {
					$data['title'] = "ResOp :: Students :: Accept Match";
					$view = 'curis/student/accept';
					$vdata['message'] = "Your match cannot be found.";
				}
			} else {
				$data['title'] = "ResOp :: Students :: Accept [Disabled]";
				$view = 'curis/disabled';
			}
		/**End Acceptance Section **/
		/**Home Section**/
		} else {
			$data['title'] = "ResOp :: Students";
			$query = $this->db->query("SELECT html FROM dyn_pages WHERE view = 'student.home'");
			$vdata['html'] = $query->row()->html;
			$view = 'curis/student/home';
		}
		
		/** Link Preparation and View Loading   **/
		
		//Array of links to be displayed by sidebar
		$links = array(
				'ResOp Home' => $this->urlroot,
               //'Student Home' => $this->urlroot . "/student",
               'Student Profile' => $this->urlroot . "/student/profile"
          );
        if($this->stud_see_proj == 1){
               $links['Projects'] = $this->urlroot . "/student/projects";
               $links['My Applications'] = $this->urlroot . "/student/scores";
          }
         if($this->stud_accept == 1){
         	$query = $this->db->query("SELECT * FROM matches WHERE sunetid='".$this->User->sunetid."'");
			//echo $query->num_rows();
         	//if($query->num_rows() >0)
	       //  	$links['Accept Match'] = $this->urlroot . "/student/accept";
        }
		$sidebarData['links'] = $links;
		
		$vdata['User'] = $this->User;
		
		//Display all views required
		$this->displayHeader($data);
		$this->displaySidebar($sidebarData);
		$this->load->view($view, $vdata);
		$this->displayFooter($data);
		
		/** End function, return to calling file **/
?>