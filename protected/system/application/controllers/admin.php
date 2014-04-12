<?php

//** Called as : function admin($page = "", $user_id = "", $proj_id = "") **//

		
		$vdata = ""; 
		
		//Not an admin, deny priviledges
		if($this->User->admin != "1"){
			$data['title'] = "ResOp :: Admin :: Access Denied";
			$view = 'curis/admin/denied';
		
		/**Project Section**/
		}else if($page == "projects"){
			
			//No selected project, display all of them
			if($proj_id == ""){
				//Filter has been set
				if(isset($_POST['Action']) && $_POST['Action']="Filter"){
					if($_POST['faculty'] != "all" || $_POST['field'] != "all"){
						//build the where restrictions based on the filter
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
					$vdata['prevfield'] = $_POST['field'];
					$vdata['prevprof'] = $_POST['faculty'];
					$vdata['projects'] = $this->db->query("SELECT proj_id, title, researchfield, secondfield, thirdfield, prof FROM projects ".$whereclause." ORDER BY researchfield, prof_id ")->result();
				}else{
					$vdata['projects'] = $this->getprojects();
				}
				$data['title'] = "ResOp :: Admin :: Projects";
				$view = 'curis/admin/projects';
				
				$vdata['fields'] = $this->fieldFilters();
				$vdata['faculty'] = $this->db->query("SELECT DISTINCT prof FROM projects")->result();
				
			//Display selected project
			}else{
				
				//Change has been made to a project.  Save it, return to all projects page
				if(isset($_POST['Action']) && $_POST['Action'] =="Save") {
					$this->updateproject($proj_id, $this->loadproject($proj_id)->prof_id);
					$vdata['projects'] = $this->getprojects();
					$data['title'] = "ResOp :: Admin :: Projects";
					$view = 'curis/admin/projects';
					
					$vdata['fields'] = $this->fieldFilters();
					$vdata['faculty'] = $this->db->query("SELECT DISTINCT prof FROM projects")->result();
				
				//Delete the selected project
				} else if (isset($_POST['Action']) && $_POST['Action'] =="Delete"){
					$this->db->query("DELETE FROM projects WHERE proj_id='$proj_id'");
					$vdata['projects'] = $this->getprojects();
					$data['title'] = "CURIS :: Admin :: Projects";
					$view = 'curis/admin/projects';
					
					$vdata['fields'] = $this->fieldFilters();
					$vdata['faculty'] = $this->db->query("SELECT DISTINCT prof FROM projects")->result();
				
				//Project Selected.  Display project info
				} else {
					$vdata['project'] = $this->loadproject($proj_id);
					$data['title'] = "ResOp :: Admin :: Projects :: ". $vdata['project']->title;
					$view = 'curis/admin/editproject';
				}
			}
			
		/**Application Section**/
		}else if($page == "applications"){
			$data['title'] = "ResOp :: Admin :: Applications";
			$user_id =$this->User->user_id;
			$query = $this->db->query("SELECT * FROM project_applications ORDER BY proj_id");
			$vdata['app'] = $query->result();
			
			$view = 'curis/admin/applications';
			
		/**Users Section**/
		} else if($page =="users"){
			
			//No user selected.  Display all users
			if($user_id == "" || $user_id == "0"){
				$vdata['result'] = $this->db->query("SELECT * FROM users ORDER BY type, sunetid")->result();
				$data['title'] = "ResOp :: Admin :: Users";
				$view = 'curis/admin/users';
				
			//user selected
			}else{
				$vdata['message'] = "";
				//User Updated.  Save changes and return to all users page
				if(isset($_POST['Action']) && $_POST['Action'] == "Save"){
					$this->updateuser($user_id, $vdata['message']);
					$vdata['result'] = $this->db->query("SELECT * FROM users ORDER BY type, sunetid")->result();
					$data['title'] = "CURIS :: Admin :: Users";
					$view = 'curis/admin/users';
				
				//User Selected.  Display single user editing mode
				} else {
					$vdata['query'] = $this->db->query("SELECT * FROM users WHERE user_id='$user_id'");
					$data['title'] = "ResOp :: Admin :: Users";
					$view = 'curis/admin/useredit';
				}
			}
		
		/**Pages Section**/
		} else if ($page == "pages"){
			$data['title'] = "ResOp :: Admin :: Pages";
			$view = 'curis/admin/pages';
			
		/**Edit Page Section**/	
		}else if ($page == "editpage"){
		
			//Page has been changed.  Save changes
			if (isset($_POST['Action']) && $_POST['Action'] == "Save"){
				$vdata['success'] = $this->updatepage($user_id);
				$vdata['html'] = $this->db->query("SELECT html FROM dyn_pages WHERE view='$user_id'")->row()->html;
				$vdata['view'] = $user_id;
				$data['title'] = "ResOp :: Admin :: Edit Page :: $user_id";
				$view = 'curis/admin/editpage';$vdata['view'] = $user_id;
			
			//Page Selected.  Go to edit page view
			} else {
				$vdata['html'] = $this->db->query("SELECT html FROM dyn_pages WHERE view='$user_id'")->row()->html;
				$vdata['view'] = $user_id;
				$data['title'] = "ResOp :: Admin :: Edit Page :: $user_id";
				$view = 'curis/admin/editpage';
				$vdata['success'] = "";
			}	
		
		/**Email  Section**/
		}else if ($page == "email"){
		
			//Message has been changed.  Save changes
			if (isset($_POST['Action'])){
				//send
				if($_POST['Action'] == "Send"){
					$text = $_POST['text'];
					$subject = str_replace(' ', '_', $_POST['subject']);
					$from = $_POST['from'];
					$to = $_POST['to'];
					exec("echo '$text' > matching_code/mail");
					exec("./matching_code/email matching_code/mail $subject $from $to", $output);
					$vdata['text'] = $output;
					$vdata['success'] = 'Successfully Sent';
					$view = 'curis/admin/exec_display';
					$data['title'] = "ResOp :: Admin :: Email Result";
				//save
				}else if($_POST['Action'] == "Save Message Body"){
					$text = $_POST['text'];
					exec("echo '$text' > matching_code/mail");				
					exec("cat matching_code/mail", $output);
					$vdata['text'] = $output;
					$vdata['success'] = 'Successfully Saved';
					$data['title'] = "ResOp :: Admin :: Send Email";
					$view = 'curis/admin/email';
				}
			//Go to edit message view
			} else {
				exec("cat matching_code/mail", $output);
				$vdata['text'] = $output;
				$data['title'] = "ResOp :: Admin :: Send Students Email";
				$view = 'curis/admin/email';
				$vdata['success'] = "";
			}	
			
		/** Edit Matching Email Message Section **/	
		}else if ($page == "editmessage"){
		
			//Message has been changed.  Save changes
			if (isset($_POST['Action']) && $_POST['Action'] == "Save"){
				$text = $_POST['text'];
				exec("echo '$text' > matching_code/mesg");
				exec("cat matching_code/mesg", $output);
				$vdata['text'] = $output;
				$vdata['success'] = 'Successfully Updated';
				$view = 'curis/admin/editmessage';
				$data['title'] = "ResOp :: Admin :: Edit Email Message";
				$view = 'curis/admin/editmessage';
			
			//Go to edit message view
			} else {
				exec("cat matching_code/mesg", $output);
				$vdata['text'] = $output;
				$data['title'] = "ResOp :: Admin :: Edit Email Message";
				$view = 'curis/admin/editmessage';
				$vdata['success'] = "";
			}	
			
			
		/**Matching Section**/	
		}else if ($page == "matching"){
			//a button has been pressed
			if (isset($_POST['Action'])){
				//run matching program
				if($_POST['Action'] == "Submit"){
					exec('./matching_code/gen_graph -f matching_code/graph.txt', $output);
					$min = $_POST['min'];
					$max = $_POST['max'];
					exec("./matching_code/match_graph -f matching_code/graph.txt -p -g -a $min -b $max", $output);
					$data['title'] = "ResOp :: Admin :: Your Matches";
					$vdata['text'] = $output;
					$view = 'curis/admin/matching_display';
				//select a givin matching
				}else if(strstr($_POST['Action'],'Select matching') != FALSE){
					$selectedMatchNum = str_replace ('Select matching ','', $_POST['Action']);
					exec("./matching_code/select_matching $selectedMatchNum", $output);
					$data['title'] = "ResOp :: Admin :: Selected Match";
					exec("cat ./matching_code/selected_matching.txt", $output);
					$vdata['text'] = $output;
					$view = 'curis/admin/selected_matching';
				//Finalize matching
				}else if($_POST['Action'] == "Finalize this selection and send emails"){
					$this->admin('selectedmatching');
					return;
				}
			//no buttons pressed, show default view
			}else{
				$data['title'] = "ResOp :: Admin :: Matching";
				$view = 'curis/admin/matching_range';
			}
			
		/**Selected Match**/
		}else if ($page == "selectedmatching"){		
			//finalize matching
			if (isset($_POST['Action']) && $_POST['Action'] == "Finalize this selection and send emails"){
				$data['title'] = "ResOp :: Admin :: Selected Match";
				$from = $_POST['from'];
				exec("./matching_code/finalize_matching matching_code/selected_matching.txt matching_code/mesg $from", $output);
				$view = 'curis/admin/exec_display';
				$vdata['text'] = $output;
			//display selected match
			}else{	
				$data['title'] = "ResOp :: Admin :: Selected Match";
				exec("cat ./matching_code/selected_matching.txt", $output);
				$vdata['text'] = $output;
				$view = 'curis/admin/selected_matching';
			}
			
		/** Export Acceptances **/
		}else if($page == "export"){
			if(isset($_POST['Action']) && $_POST['Action'] == "Generate"){
				$sql = "SELECT users.name, users.namelf, users.sunetid, users.email, users.year, matches.minority, matches.gender, projects.title, projects.prof, projects.prof_email FROM users, projects, matches WHERE matches.sunetid=users.sunetid AND projects.proj_id=matches.proj_id AND matches.accepted='yes'";
				$query = $this->db->query($sql);
				if($query->num_rows() > 0){
					$fh = fopen("/var/www/html/resop/protected/export.xls", "w");
					fputcsv($fh, array(
								'Name',
								'Name(LF)',
								'SUNet ID',
								'Email',
								'Year',
								'Minority?',
								'Gender',
								'Project Title',
								'Project Professor',
								'Professor Email'));
					foreach($query->result() as $row):
						fputcsv($fh, get_object_vars($row));
					endforeach;
					fclose($fh);
					$vdata['url'] = "http://cs.stanford.edu/resop/protected/export.xls";
					//$vdata['message'] = "Export generated.";
				} else{
					$vdata['message'] = "There were no accepted matches to export.";
				}
			}
			$data['title'] = "ResOp :: Admin :: Export Matches";
			$view = 'curis/admin/export';
			
			
		/**Housekeeping**/
		}else if ($page == "housekeeping"){
			if(isset($_POST['Action'])){
				switch($_POST['Action']){
					case "Archive":
						$this->archive();
						$vdata['result'] = "Successfully archived database.";
						break;
					case "Delete Apps":
						$this->db->query("TRUNCATE project_applications");
						$vdata['result'] = "Successfully deleted all student applications.";
						break;
					case "Delete Projects":
						$this->db->query("DELETE FROM projects WHERE save='0'");
						$vdata['result'] = "Successfully deleted all projects.";
						break;
					case "Delete Proxies":
						$this->db->query("TRUNCATE assistants");
						$vdata['result'] = "Successfully deleted all professor's assistants.";
						break;
					case "Delete Matches":
						$this->db->query("TRUNCATE matches");
						$vdata['result'] = "Successfully deleted all student-project matches.";
						break;
					case "Clear Profiles":
						$this->db->query("UPDATE users SET webpage='', interestarea='', major='', gpa='0', year='', transcript='', resume='' WHERE type='student'");
						$vdata['result'] = "Successfully cleared all student profiles.";
						break;
					case "Archive Documents":
						$this->db->query("UPDATE users SET transcript='', resume=''");
						exec("mv uploads/ archive/".$_POST['directory']);
						exec("mkdir uploads");
						$vdata['result'] = "All transcripts and resumes moved to archive/".$_POST['directory'];
						break;
					default:
						$vdata['result'] = "How did you get here? It's a bug, not a feature...";
				}
			}
			$data['title'] = "ResOp :: Admin :: Housekeeping";
			$view = 'curis/admin/housekeeping';
		
		/**Home Page Section**/	
		} else {
			//global settings have been updated
			if(isset($_POST['Action']) && $_POST['Action'] = "Save"){
				//if stage was changed, reset project capacities to 0.
				/*if($_POST['app_stage'] != $this->db->query("SELECT app_stage FROM global_settings LIMIT 1")->row()->app_stage){
					$this->db->query("UPDATE projects, users SET projects.capacity = '0', users.fac_capacity = '0'");
				}*/
				
				$this->db->update('global_settings', 
						array(	'fac_edit_proj' => $_POST['fac_edit_proj'],
								'fac_assn_asst' => $_POST['fac_assn_asst'],
								'fac_rate_stud' => $_POST['fac_rate_stud'],
								'stud_edit_prof'=> $_POST['stud_edit_prof'],
								'stud_see_proj' => $_POST['stud_see_proj'],
								'stud_apply'	=> $_POST['stud_apply'],
							//	'stud_accept'	=> $_POST['stud_accept'],
							//	'app_stage'	=> $_POST['app_stage'],
								'login_link' => $_POST['login_link']),"");
							//	'fac_see_matches' => $_POST['fac_see_matches']), "");
				}
			$vdata['updated'] = "Updated.";
			$vdata['settings'] = $this->db->query("SELECT * FROM global_settings LIMIT 1")->row();
			$data['title'] = "ResOp :: Admin";
			$view = 'curis/admin/home';
		}
		
		//All the links to display on the sidebar
		$links = array(
               'ResOp Home' => $this->urlroot,
               'Admin Home' => $this ->urlroot . "/admin",
               'Projects' => $this->urlroot . "/admin/projects",
               'Applications' => $this->urlroot . "/admin/applications",
               'Users' => $this->urlroot ."/admin/users",
               'Pages' => $this->urlroot ."/admin/pages",
               //'Email' => $this->urlroot ."/admin/email",
             //  'Matching Message' => $this->urlroot ."/admin/editmessage",
              // 'Select Matching' => $this->urlroot . "/admin/matching",
              // 'Finalize Matching' => $this->urlroot . "/admin/selectedmatching",
              // 'Export Matches' => $this->urlroot . "/admin/export",
               'Housekeeping' => $this->urlroot."/admin/housekeeping"
          );
		$sidebarData['links'] = $links;
		
		//Display all views necessary
		$this->displayHeader($data);
		$this->displaySidebar($sidebarData);
		$this->load->view($view, $vdata);
		$this->displayFooter($data);
?>