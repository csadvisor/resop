#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <mysql.h>


/**
 Usage: ./email {email message file} {subject} {from} {to index}
 Tilley:  This program is a mass emailing program that emails specific groups of people selected from the curis database.
		  The groups are as follows (along with their toIndex number):
			All Faculty and Students	(0)
			All Faculty					(1)
			All Students				(2)
			All Applied Students		(3)
			All Matched Students		(4)
			All Unmatched Students		(5)
 
 **/

int debug=0;


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
  char file[100];

  char query[20480];

  MYSQL mysql;
  MYSQL_ROW row;
  MYSQL_RES *query_result;
  char database[100] = "curis_db";

   if (argc < 3){
    printf("Usage: %s {email message file} {subject} {from} {to index}\n", argv[0]);
    exit(1);
  }

  strcpy(file, argv[1]);

  /* Init the DB */
  mysql_init(&mysql);
  if (!mysql_real_connect(&mysql,"cs-db-1.stanford.edu","curis_db_admin","curdb22",database,0,NULL,0))
  {
    fprintf(stderr, "Failed to connect to database: Error: %s\n",
          mysql_error(&mysql));
    exit(1);
  }


	
	int toIndex = atoi(argv[4]);
	if(toIndex == 0)
		query_result = do_query("SELECT email FROM users", &mysql);
	else if(toIndex == 1)
		query_result = do_query("SELECT email FROM users WHERE type = 'faculty'", &mysql);
	else if(toIndex == 2)
		query_result = do_query("SELECT email FROM users WHERE type = 'student' ", &mysql);
	else if(toIndex == 3){
		query_result = do_query("SELECT user_id FROM project_applications ", &mysql);
		MYSQL_ROW temp_row1;
		snprintf(query, 20479, "SELECT email FROM users WHERE user_id='");
		temp_row1 = mysql_fetch_row(query_result);
		strcat(query,temp_row1[0]);
		strcat(query,"'");
		while(temp_row1 = mysql_fetch_row(query_result)){
			strcat(query," OR user_id = '");
			strcat(query,temp_row1[0]);
			strcat(query,"'");
		}
		query_result = do_query(query, &mysql);
	}
		
	else if(toIndex == 4)
		query_result = do_query("SELECT email FROM users WHERE type = 'student' AND matched ='1'", &mysql);
	else if(toIndex==6){
		if (argc < 4) return;
		snprintf(query, 2047, "cat %s | mail -s '%s' %s -- -f %s", file, argv[2], row[0],  argv[3]);
	}else{
		query_result = do_query("SELECT user_id FROM project_applications ", &mysql);
		MYSQL_ROW temp_row1;
		snprintf(query, 20479, "SELECT email FROM users WHERE user_id='");
		temp_row1 = mysql_fetch_row(query_result);
		strcat(query,temp_row1[0]);
		strcat(query,"'");
		while(temp_row1 = mysql_fetch_row(query_result)){
			strcat(query," OR user_id = '");
			strcat(query,temp_row1[0]);
			strcat(query,"'");
		}
		strcat(query," AND matched ='0'");
		query_result = do_query(query, &mysql);
	}
	

	while(row =  mysql_fetch_row(query_result)) {

		snprintf(query, 2047, "cat %s | mail -s '%s' %s -- -f %s", file, argv[2], row[0],  argv[3]);
		printf("query %s\n", query);
		printf("Now sending in .5 second intervals(so not to stress the mail server)\n\n");

		if(system(query)) {
			printf("Something is wrong, can't email!\n\n");
			exit(1);
		}
		sleep(.5);

		printf("Email sent to %s\n", row[0]);
 }

printf("Done\n\n");

return 0;

}
