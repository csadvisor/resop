#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <mysql.h>

#define MAX_FACULTY_CAPACITY 100


/** 
 
 Tilley: This program is almost identical to the one used to generate the graph before, with a few small changes:
	1. The database has been switched to the new curis database
	2. A few tests were removed that actually could cause the program to crash
	3. Pulling scores in stages (Primary, Secondary, Tertiary) and ignoring matched students have been added
 
 **/
int debug=0;

struct Node {
	struct  Node* Next;
	int  Prev;
	
	char Name[10];
	int Capc;
	int Flow;
	int Weight;
	int Dist;
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


void Save (FILE* outfd, struct Node* Orig_Graph, int Gsize)
{
	struct   Node* Slider;
	int i=0;
	
	fprintf(outfd, "Adjacency list representation of a graph\n\n");
	fprintf(outfd, "Format of vertices: Name\n");
	fprintf(outfd, "Format of edges: Name [tab] Capacity [tab] Weight\n");
	fprintf(outfd, "(An integer for a name indicates ProjID)\n");
	
	for(i = 0; i < Gsize; i++) {
		fprintf(outfd, "\nVertex: %s", Orig_Graph[i].Name);
		Slider = Orig_Graph[i].Next;
		while (Slider) {
			fprintf(outfd, "\nEdge: %s\t%d\t%d", Slider->Name, Slider->Capc, Slider->Weight);
			Slider = Slider->Next;
		}
		fprintf(outfd, "\n");
	}
}



int main(int argc, char *argv[])
{
	MYSQL mysql;
	MYSQL_RES *Facl_result;
	MYSQL_RES *Proj_result;
	MYSQL_RES *Stud_result;
	MYSQL_RES *Stud_result2;
	
	MYSQL_ROW row;
	int num_Facl, num_Proj;
	int num_Stud = 0;
	
	struct   Node* Source;
	struct   Node* Sink;
	struct   Node* Slider;
	struct   Node* Temp;
	struct   Node* Temp2;
	
	struct   Node* Facl;
	struct   Node* Proj;
	struct   Node* Stud;
	
	struct   Node* Orig_Graph;
	struct   Node* Resid_Graph;
	
	char query[2048];
	char command;
	int i, j, k, Gsize;
	int FlowDump =0;
	int Happy=0;
	int PrevHappy=0;
	int Matches;
	int stage = 1;
	extern char *optarg;
	extern int opterr;
	int option;
	FILE *outfd = NULL;
	FILE *tmpfd = NULL;
	char* file = "graph.txt";
	//Tilley: the new database
	char* database = "curis_db";
	//OLD: char* database = "prod";
	
	
    /* Parse the command line arguments. */
	opterr = 0;
	while ((option = getopt(argc, argv, "db:f:")) != EOF) {
		switch (option) {
			case 'd':
				debug = 1;
				break;
			case 'b':
				database = optarg;
				break;
			case 'f':
				file = optarg;
				break;                    
			default:
				printf("options:\n  -f  {filename}  default \"graph.txt\"\n  -b  {database_name}  indicate the DB to use ('prod' is default)\n  -d  debug feature - print DB queries to stdout\n");
				exit(1);
		}
	}
	
	outfd = fopen(file, "w");
	if (outfd == NULL) {
		printf("cannot write/create %s\n", file);
		exit(1);
	}
	
	/* Init the DB */
	mysql_init(&mysql);
	//Tilley: Here is where it connects to the new CURIS database
	if (!mysql_real_connect(&mysql,"cs-db-1.stanford.edu","curis_db_admin","curdb22",database,0,NULL,0))
		//OLD: if (!mysql_real_connect(&mysql,"localhost","curis","",database,0,NULL,0))
	{
		fprintf(stderr, "Failed to connect to database: Error: %s\n",
				mysql_error(&mysql));
		exit(1);
	}
	
	//Tilley: Get the current application stage
	Stud_result = do_query("SELECT app_stage FROM global_settings LIMIT 1",&mysql);
	row = mysql_fetch_row(Stud_result);
	stage = atoi(row[0]);
	printf("Generating graph for matching round %d...\n",stage);
	
	
	
	/* Get initial DB data, and sizes of vertex lists */
	
	
	//Tilley: Get the faculty information from the users table
    //OLD: Facl_result = do_query("select sunetid, MaxStudents from Faculty order by sunetid", &mysql);
	Facl_result = do_query("select sunetid, fac_capacity from users WHERE type = 'faculty' order by sunetid", &mysql);
	if (!(num_Facl = mysql_num_rows(Facl_result))){
		fprintf(stderr, "Failed get Facl query: Error: %s\n", mysql_error(&mysql));
		exit(1);
	}
	
	/***I guess we are not doing this. We are using the MaxStudents value
	 NumStudProj_result = do_query("select sunetid, sum(NumStud) from Projects group by sunetid order by sunetid", &mysql);
	 */
	
	//Tilley: Get all the project ids from the projects table
	//OLD: Proj_result = do_query("select ProjID from Projects", &mysql);
	Proj_result = do_query("select proj_id from projects", &mysql);
    if (!(num_Proj = mysql_num_rows(Proj_result))){
		fprintf(stderr, "Failed get Proj query: Error: %s\n", mysql_error(&mysql));
		exit(1);
	}
	
	//Tilley:Get all student sunetids from the project applications table
	//OLD: Stud_result = do_query("select DISTINCT sunetid from Scores", &mysql);
	Stud_result = do_query("select DISTINCT student_sunetid from project_applications", &mysql);

	if (!(num_Stud = mysql_num_rows(Stud_result))){
		fprintf(stderr, "Failed get Stud query: Error: %s\n", mysql_error(&mysql));
		exit(1);
	 }
	
	//Tilley: This section updates the total number of students to be considered, removing all
	//those who have already been matched
	MYSQL_RES *MatchedStud_result;
	MYSQL_ROW temp_row1;
	while(temp_row1 = mysql_fetch_row(Stud_result)){
		snprintf(query, 2047, "select * from users where sunetid = '%s' AND matched = '1'", temp_row1[0]);
		MatchedStud_result = do_query(query, &mysql);
		if(mysql_num_rows(MatchedStud_result) == 1) --num_Stud;
	}
	Stud_result = do_query("select DISTINCT student_sunetid from project_applications", &mysql);
	
	/* printf("num_Facl = %d, num_Proj = %d, num_Stud = %d\n", num_Facl, num_Proj, num_Stud); */
	
	/* Allocate space for the Graphs - adjacency list representation           *
	 * the '2' on the next line is for the Sink + Source on top other vertices */
	Gsize = num_Facl + num_Proj + num_Stud + 2; 
	printf("Number of Faculty: %d Number of Projects: %d Number of Students: %d\n", num_Facl, num_Proj, num_Stud);
	Orig_Graph = (struct Node*) malloc(Gsize * sizeof(struct Node));
	memset(Orig_Graph, 0, Gsize * sizeof(struct Node));
	
	
	/********** Construct the original Graph */
	/* Here, fill in faculty vertices and edges from Source to Faculty */
	i=0; j=0;
	strcpy(Orig_Graph[i].Name, "Source");
	Slider = &Orig_Graph[i];
	j++;
	while(row = mysql_fetch_row(Facl_result)){
		i++;
		
		Slider->Next = (struct Node*) malloc(sizeof(struct Node));
		memset(Slider->Next, 0, sizeof(struct Node));
		strcpy(Slider->Next->Name, row[0]);

		Slider->Next->Capc = atoi(row[1])==0 ? MAX_FACULTY_CAPACITY : atoi(row[1]);
		
		strcpy(Orig_Graph[i].Name, row[0]);
		
		Orig_Graph[i].Capc = Slider->Next->Capc;
		
		Slider = Slider->Next;
	}
	Slider->Next = NULL;
	
	/* Fill in project vertices and edges from faculty to projects */
	k=i;
	for (j; j<=i; j++) {
		Slider = &Orig_Graph[j];
		
		//Tilley: select all of the professor's own projects
		// snprintf(query, 2047, "select ProjID, NumStud from Projects where sunetid = '%s'", Slider->Name);
		snprintf(query, 2047, "select proj_id, capacity from projects where prof_sunetid = '%s'", Slider->Name);
		
		Proj_result = do_query(query, &mysql);
		
		//Tilley: this test will actually break the program if the professor has no projects.  While loop
		//ahead gracefully handles no projects
		//int test;
		//         if (!(test = mysql_num_rows(Proj_result))){
		//                 fprintf(stderr, "%d %s Failed get projects from fac query: Error: %s\n", Slider->Name, test, mysql_error(&mysql));
		//                 exit(1);
		//         }
		
		//
		while(row = mysql_fetch_row(Proj_result)){
			Slider->Next = (struct Node*) malloc(sizeof(struct Node));
			memset(Slider->Next, 0, sizeof(struct Node));
			strcpy(Slider->Next->Name, row[0]);
			
			Slider->Next->Capc = atoi(row[1]);
			
			k++;
			strcpy(Orig_Graph[k].Name, row[0]);
			Orig_Graph[k].Capc = atoi(row[1]);
			
			Slider = Slider->Next;
		} 
		Slider->Next = NULL;
	}
	
	/* Fill in students vertices and edges from projects to students */
	i=k;
	for (j; j<=k; j++) {
		Slider = &Orig_Graph[j];
		
        //Tilley: Gathers student score from project_applications and the faculty score for the current stage from there as well
		snprintf(query, 2047, "select student_sunetid, score, fac_rating%d from project_applications where proj_id = '%s'", stage, Slider->Name);
		//snprintf(query, 2047, "select sunetid, ProjScore, StuScore from Scores where ProjID = '%s'", Slider->Name);
		
		Stud_result2 = do_query(query, &mysql);
		
		//Tilley: again, this test will break the program if a given project has no applications.
		//While loop ahead gracefully handles this case.
		// int test;
		//         if (!(test = mysql_num_rows(Stud_result2))){
		//                 fprintf(stderr, "projid = %s Failed get students from applications query: Error: %s\n",Slider->Name, mysql_error(&mysql));
		//                 exit(1);
		//         }
		//
		
		while(row = mysql_fetch_row(Stud_result2)) {
			//Tilley: Accounts for matched students when building student graph
			snprintf(query, 2047, "select * from users where sunetid = '%s' AND matched = '1'", row[0]);
			MatchedStud_result = do_query(query, &mysql);
			if(mysql_num_rows(MatchedStud_result) == 0){
				Slider->Next = (struct Node*) malloc(sizeof(struct Node));
				memset(Slider->Next, 0, sizeof(struct Node));
				
				strcpy(Slider->Next->Name, row[0]);				
				Slider->Next->Capc = 1;
				Slider->Next->Weight = atoi(row[1]) * atoi(row[2]);
				Slider = Slider->Next;
			}
		}
		Slider->Next = NULL;
	}
	
	/* Fill in the sink and the edges leading into it from students */
	i=j;
	while(row = mysql_fetch_row(Stud_result)) {
		//Tilley: Accounts for matched students when connecting students to sink
		snprintf(query, 2047, "select * from users where sunetid = '%s' AND matched = '1'", row[0]);
		MatchedStud_result = do_query(query, &mysql);
		if(mysql_num_rows(MatchedStud_result) == 0){
			strcpy(Orig_Graph[j].Name, row[0]);           
			Orig_Graph[j].Capc = 1;
			Orig_Graph[j].Next = (struct Node*) malloc(sizeof(struct Node));
			memset(Orig_Graph[j].Next, 0, sizeof(struct Node));
			strcpy(Orig_Graph[j].Next->Name, "Sink");
			Orig_Graph[j].Next->Capc = 1;
			j++;
		}
	}
	strcpy(Orig_Graph[j].Name, "Sink");
	mysql_close(&mysql);
	
	Save(outfd, Orig_Graph, Gsize);
	printf("Written to %s successfully\n\n", file);
	
	return 0;
}
