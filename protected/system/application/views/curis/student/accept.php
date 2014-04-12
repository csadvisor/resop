			<div id="content">
			<script language="Javascript">
			function validate(){
				msg = "";
				if((document.form1.accept[0].checked == false) && (document.form1.accept[1].checked == false))
					msg += "Please choose to accept or decline.\n";
				if(document.form1.accept[0].checked == true){
					if((document.form1.minority[0].checked == false) && (document.form1.minority[1].checked == false))
						msg += "Please choose your minority status.\n";
					if((document.form1.gender[0].checked == false) && (document.form1.gender[1].checked == false))
						msg += "Please choose your gender.\n";
				}
				
				
				if(msg != ""){
					alert(msg);
					return false;
				}
				return true;
			}
			</script>
			
				<h2>Accept Match</h2>
				
				<?php if (isset($message)) echo $message;
				else {?>
				<p>You have been matched with the following project: <b><?=$project_title?></b>.</p>
				
				<p>To accept, Please specify the following: <p>


     <FORM ACTION='' METHOD='POST' name="form1" onSubmit="return validate()">


         Do you accept this offer?  Yes<input type=radio name='accept' <?=($match->accepted == "yes"?"checked":"unchecked")?> value = yes> No<input type=radio name='accept' <?=($match->accepted == "no"?"checked":"unchecked")?> value = no><p>
        
        Are you African-American, Hispanic, or Native American?  Yes <input type=radio name=minority value='yes' <?=($match->minority == "yes"?"checked":"unchecked")?>> No <input type=radio name=minority value='no' <?=($match->minority == "no"?"checked":"unchecked")?>>
        <br> Gender:  Male <input <?=($match->gender == "male"?"checked":"unchecked")?> type=radio name=gender value=male> Female <input <?=($match->gender == "female"?"checked":"unchecked")?> type=radio name=gender value=female>
        
        <br><i>The CURIS Program is required to collect this information by the University.</i>
<p>

        <INPUT TYPE='submit' name="Action" VALUE='Submit'>
      </form>
      <?php }?>

			
			</div>