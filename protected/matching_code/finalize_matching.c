#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <mysql.h>

/**
 
 Tilley: This program does basically the same thing as the "send_emails" program from the old site, with the addition of
		 managing some database state.  This program updates the students' info, setting their matched criteria to "TRUE" and
		 creates new entries in the database for each match.
 
 **/


int debug=0;

struct Match {
  int Number;
  char PName[500];
  char FName[100];
  char FEmail[100];
  char SName[100];
  char SEmail[100];
};

void printDebug(char *s, char *t)
{
  if(debug){
        printf("%s: %s\n", s, t);
  }
}

MYSQL_RES * do_query(char* query, MYSQL *mysql)
{

  MYSQL_RES *result;
  MYSQL_RES *result2;
  int ret;

  printDebug("Query:", query);
  
  if(mysql_query(mysql, query) != 0){
    fprintf(stderr, "Query %s failed: Error: %s\n", query, mysql_error(mysql));
    exit(1);
  }
  result = mysql_store_result(mysql) ;
  if(result == NULL){
    fprintf(stderr, "storing query results failed. Error: %s\n", 
                mysql_error(mysql));
    exit(1);
  }

  return result;
}


int main(int argc, char *argv[])
{
  FILE *infd = NULL;
  char file[100];
  char file2[100];
  char buffer[100];
  char email[100];

  struct Match List[1000];
  char query[2048];
  char inc;

  MYSQL mysql;
  MYSQL_ROW row;
  MYSQL_RES *query_result;
  char database[100] = "curis_db";

  int i=0;
  int j=0;
  int ThisProject = 0;
  char ThisProjectName[100];
  char ThisFacultyName[100];
  char ThisFacultyEmail[100];
	char ThisStudentSunetid[100];

  if (argc < 4){
    printf("Usage: %s {matches file} {email message file} {email address from} {database (default \"prod\")}\n", argv[0]);
    exit(1);
  }

  strcpy(file, argv[1]);
  strcpy(file2, argv[2]);
  strcpy(email, argv[3]);

  if(argc == 5) strcpy(database, argv[4]);

  infd = fopen(file, "r");
  if (infd == NULL) {
     printf("cannot read %s\n", file);
     exit(1);
  }                        

  /* Init the DB */
  mysql_init(&mysql);
  if (!mysql_real_connect(&mysql,"cs-db-1.stanford.edu","curis_db_admin","curdb22",database,0,NULL,0))
  {
    fprintf(stderr, "Failed to connect to database: Error: %s\n",
          mysql_error(&mysql));
    exit(1);
  }

	//Tilley: parses all the info out of the selected matching file
  while(fscanf(infd, "%s", buffer) != EOF){
    if (!strcmp(buffer, "Project:")) {
      fscanf(infd, "%s", buffer);
      ThisProject = atoi(buffer);
      snprintf(query, 2047, "select title, prof, prof_email from projects where proj_id='%d'", ThisProject);
      query_result = do_query(query, &mysql);
      row = mysql_fetch_row(query_result);
      if (row == NULL) {
	printf("error - no such project in DB \"%s\"\n", database);
	exit(1);
      }
      strcpy(ThisProjectName, row[0]);
      strcpy(ThisFacultyName, row[1]);
      strcpy(ThisFacultyEmail, row[2]);
    } else 
    if (strcmp(buffer, "")) {
      if (!strcmp(buffer, "Faculty:")) {
	fscanf(infd, "%s", buffer);
	if (!strcmp(ThisFacultyEmail, "")) {
	  strcpy(ThisFacultyEmail, buffer);
	  strcat(ThisFacultyEmail, "@stanford.edu");
		}
	  }
      fscanf(infd, "%s", buffer);
      if (!strcmp(buffer, "Student:")) {
        fscanf(infd, "%s", buffer);
	strcpy(ThisStudentSunetid, buffer);
	snprintf(query, 2047, "select name, email from users where sunetid='%s'", ThisStudentSunetid);
	query_result = do_query(query, &mysql);
	row = mysql_fetch_row(query_result);
      	if (row == NULL) {
          printf("error - no such student in DB \"%s\"\n", database);
          exit(1);
      	}

	if (!strcmp(row[1], ""))
	  strcat(List[i].SName, "@stanford.edu");
	else
	strcpy(List[i].SEmail, row[1]);

        strcpy(List[i].SName, row[0]);
      }
      List[i].Number = ThisProject;
      strcpy(List[i].PName, ThisProjectName);
      strcpy(List[i].FName, ThisFacultyName);
      strcpy(List[i].FEmail, ThisFacultyEmail);
		
		
		//Tilley: Database update of new matches:
		snprintf(query, 2047, "INSERT INTO matches (sunetid, proj_id) VALUES ('%s', '%d')", ThisStudentSunetid, ThisProject);
		mysql_query(&mysql, query);
		snprintf(query, 2047, "UPDATE users SET matched = '1' WHERE sunetid = '%s'", ThisStudentSunetid);
		mysql_query(&mysql, query);
		//
		
      i++;
    }
  }


  printf("Match information ready.\n");
	
//Tilley: not needed, all done through web interface
//  printf("Do you want to send out the emails NOW y/n?\n");
//  scanf("%c", &inc);
//
//  if(inc != 'y') {
//   printf("Nothing sent\n\n");
//   exit(0);
//  }

	
	//Tilley: this part actually sends all the emails
  for(j; j<i; j++) {
    snprintf(query, 2047, 
     "echo '\nCURIS matching for project: \"%s\"\n\nStudent: %s\nMentor: %s\n\nDear %s,\n' >  matching_code/tempf",
     List[j].PName, List[j].SName, List[j].FName, List[j].SName);
    if(system(query)) {
      printf("Something is wrong, can't create temp file\n\n");
      exit(1);
    }

    snprintf(query, 2047, "cat %s >> matching_code/tempf", file2);
    if(system(query)) {
      printf("Something is wrong, can't append temp file\n\n");
      exit(1);
    }

    snprintf(query, 2047, "cat matching_code/tempf | mail -c %s,%s -s 'CURIS matching result' %s -- -f %s", email, List[j].FEmail, List[j].SEmail, email);

     printf("Now sending in .5 second intervals(so not to stress the mail server)\n\n");

    if(system(query)) {
      printf("Something is wrong, can't email!\n\n");
      exit(1);
    }
    sleep(.5);

     printf("\nProject: %s\n", List[j].PName);
     printf("Faculty: %s\n", List[j].FName);
     printf("Student: %s\nEmail sent!\n\n", List[j].SName);
    printf("%s ; %s ; %s ; %s\n", List[j].SName, List[j].SEmail, List[j].FName, List[j].PName);
  }

//Tilley: For permissions difficulties, unlinking is a bad idea
//unlink("tempf");
printf("Done\n\n");

return 0;

}
