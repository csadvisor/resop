<?php
	/**This authentication function is invoked by the CURIS controller
		for every page request. It validates using WebAuth information and loads additional user information stored in the CURIS database. **/

		//user sunetid
		$sunetid = getenv("WEBAUTH_USER");
		//user display name
		$name = getenv("WEBAUTH_LDAP_DISPLAYNAME");
		//user email
		$email = getenv("WEBAUTH_LDAP_MAIL");
		//Privelege type, either stanford:faculty or stanford:student
		$privelegegrp = getenv("WEBAUTH_LDAP_SUAFFILIATION");
        //Displayname, Last name first
       	$namelf = getenv("WEBAUTH_LDAP_SUDISPLAYNAMELF");

        if(stristr($privelegegrp, "stanford:faculty"))
        	$type = "faculty";
        else if(stristr($privelegegrp, "stanford:student"))
        	$type = "student";
        else if(stristr($privelegegrp, "stanford:staff"))
        	$type = "staff";
        else $type = "none";

        $this->load->model('User');
		$this->User->sunetid = $sunetid;
		$this->User->name = $name;
		$this->User->namelf = $namelf;
		$this->User->email = $email;
		$query = $this->db->query("SELECT * FROM assistants WHERE sunetid='$sunetid'");
		//if the user's sunetid has an entry in the assistants table,
		//load the assigning faculty info instead
	if($query->num_rows() > 0){
		  $this->User->populate_by_user_id($query->row()->fac_id);
		  $this->User->admin = '0';
		}else {
		  $this->User->populate_by_sunet($sunetid);
		  }
		//if the user is in the db, will do nothing - otherwise, adds a record
		  $this->User->type = $type;

		$this->User->insert();

?>