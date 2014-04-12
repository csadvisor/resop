
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int debug=1;

/**
 
 Tilley:  This program is almost identical to the original, with some small modifications:
	1. The user calls this program with the option of two extra arguments: a min and max match number.
	   These restrict what is displayed by the program to only matching numbers between the min and max, inclusive.
	   Default is zero, which displays all the matchings.
	2. This program also prints out to a file the matchings in an easily parsible way, which is used by "select matching"
	   to get in a human readable and passible to finalize matching format.
 
 **/


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



int Load(FILE* infd, struct Node* Orig_Graph)
{
  char buffer[80];
  char buffer2[80];
  char buffer3[80];
  struct   Node* Slider;
  int i=0;

     while(fscanf(infd, "%s", buffer) != EOF){
       if (!strcmp(buffer, "Vertex:")) {
	 fscanf(infd, "%s", buffer);
	 strcpy(Orig_Graph[i].Name, buffer);
	 Slider = &Orig_Graph[i];
	 i++;
	 /* printDebug("Got this V", buffer); */
       }
       if (!strcmp(buffer, "Edge:")) {
	 fscanf(infd, "%s%s%s", buffer, buffer2, buffer3);
	 Slider->Next = (struct Node*) malloc(sizeof(struct Node));
	 memset(Slider->Next, 0, sizeof(struct Node));
	 strcpy(Slider->Next->Name, buffer);
	 Slider->Next->Capc = atoi(buffer2);
	 Slider->Next->Weight = atoi(buffer3);
	 Slider = Slider->Next;
	 /* printDebug("Got this E: %s-%s-%s\n", buffer, buffer2, buffer3);*/
       }
     }
return i;
}


int main(int argc, char *argv[])
{
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

  char buffer[80];
  char buffer2[80];
  char buffer3[80];
  char command;
  int i, j, k, Gsize;
  int FlowDump =0;
  int PrintAssn = 0;
  int Happy=0;
  int PrevHappy=0;
  int Matches;
  extern int opterr;
  extern char* optarg;
  int option;
  FILE *infd = NULL;
  FILE *outfd = NULL;
  FILE *tmpfd = NULL;
  char *infile = "graph.txt";
  char * outfile = "matching_code/possible_matches.txt";
  char* old_file = NULL;
  char database[50];

    /* Parse the command line arguments. */
  opterr = 0;
  int maxMatches = 0;
  int minMatches = 0;
  while ((option = getopt(argc, argv, "f:gpa:b:")) != EOF) {
    switch (option) {
    case 'b':
	  maxMatches = atoi(optarg);
	  break;
	case 'a':
	  minMatches = atoi(optarg);
	  break;			
	case 'f':
      infile = optarg;
      break;
    case 'g':
      FlowDump = 1;
      break;
    case 'p':
      PrintAssn = 1;
      break;
    case 'd':
      debug = 1;
      break;
    default:
      printf("options:\n  -f  {filename}  default \"graph.txt\"\n  -g  dump flow graph to stdout on every match\n  -p  print the assignments on every match\n\n");
      exit(1);
    }
  }
 Gsize = 1000;
  Orig_Graph = (struct Node*) malloc(Gsize * sizeof(struct Node));
  memset(Orig_Graph, 0, Gsize * sizeof(struct Node));
                                                              
      infd = fopen(infile, "r");
      if (infd == NULL) {
        printf("cannot read %s\n", infile);
        exit(1);
      }
	
	outfd = fopen(outfile, "w+");
	if (outfd == NULL) {
        printf("cannot read %s\n", outfile);
        exit(1);
	}         
  Gsize = Load(infd, Orig_Graph);

printf("The 'Happiness factor' is the sum of all products of (Weight x Flow) in the entire graph.\n\n\n");

   /**********************************************/
   /* Saving/Loading Construction the Graph is done */
   /* Now do the main loop of bipartite matching */
   /* (this will leak memory like crazy - but we don't care - it's a batch, volumes are tiny, the whole thing never goes above 2Mb)*/

 Matches = 0;
 Resid_Graph = (struct Node*) malloc(Gsize * sizeof(struct Node));
	

 while(++Matches <= maxMatches || maxMatches == 0) {
  memset(Resid_Graph, 0, Gsize * sizeof(struct Node));

   /******** Build Residual graph */

   /* Copy the vertices into the Residual graph - they stay the same */
   for(i = 0; i < Gsize; i++) {
     strcpy(Resid_Graph[i].Name, Orig_Graph[i].Name);
     Resid_Graph[i].Capc = Orig_Graph[i].Capc;
     Resid_Graph[i].Flow =Orig_Graph[i].Flow;
     Resid_Graph[i].Weight = Orig_Graph[i].Weight;
     Resid_Graph[i].Dist = 1000;
     if (i == 0) Resid_Graph[i].Dist = 0;
   }


   /* Go thru the Orig and set edges in the Resid */
   for(i = 0; i < Gsize; i++) {
     Slider = Orig_Graph[i].Next;
     while (Slider) {
       /* Put in forward edge */
       if (Slider->Capc - Slider->Flow > 0){
	 Temp = Resid_Graph[i].Next;
	 Resid_Graph[i].Next = (struct Node*) malloc(sizeof(struct Node));
	 memset(Resid_Graph[i].Next, 0, sizeof(struct Node));
	 strcpy(Resid_Graph[i].Next->Name, Slider->Name);
	 Resid_Graph[i].Next->Flow = Slider->Capc - Slider->Flow;
	 Resid_Graph[i].Next->Weight = 10 - Slider->Weight;
	 Resid_Graph[i].Next->Next = Temp;
       }
       
       if (Slider->Flow > 0) {
	 /* Find the vertex and put in the backward edge */
	 for(j = 0; j < Gsize; j++) {
	   if (!strcmp(Resid_Graph[j].Name, Slider->Name)) {
	     Temp = Resid_Graph[j].Next;
	     Resid_Graph[j].Next = (struct Node*) malloc(sizeof(struct Node));
	     memset(Resid_Graph[j].Next, 0, sizeof(struct Node));
	     strcpy(Resid_Graph[j].Next->Name, Orig_Graph[i].Name);
	     Resid_Graph[j].Next->Flow = Slider->Flow;
	     Resid_Graph[j].Next->Weight = Slider->Weight - 10;
	     Resid_Graph[j].Next->Next = Temp;
	     j = Gsize;
	   }
	 }
       }
       Slider = Slider->Next;
     }
   }

   /*************/
   /* Here, search for the augmenting path thru Resid */

   for(i = 1; i < Gsize; i++) {
     for(j = 0; j < Gsize; j++) {
       Slider = Resid_Graph[j].Next;
       while (Slider) {
	 for(k = 0; k < Gsize; k++)
	   if (!strcmp(Resid_Graph[k].Name, Slider->Name))
	     if (Resid_Graph[k].Dist > Resid_Graph[j].Dist + Slider->Weight) {
	       Resid_Graph[k].Dist = Resid_Graph[j].Dist + Slider->Weight;
	       Resid_Graph[k].Prev = j;
	       break;
	     }
	 Slider = Slider->Next;
       }
     }
   }

   /* Check for negative cycles - more of a debug thing. A properly done resid */
   /* graph should never result in neg cycles */

   for(j = 0; j < Gsize; j++) {
     Slider = Resid_Graph[j].Next;
     while (Slider) {
       for(k = 0; k < Gsize; k++)
	 if (!strcmp(Resid_Graph[k].Name, Slider->Name))
	   if (Resid_Graph[k].Dist > Resid_Graph[j].Dist + Slider->Weight) {
	     printf("\nNEG CYCLE: Shortest Path Error!!!\n"); exit(1);
	   }   
       Slider = Slider->Next;
     }
   }

     if (Resid_Graph[Gsize-1].Prev == 0){
		 if(Matches >= minMatches)
			 printf("\nEnding condition met\n");
       exit(0);
     }

  
	 //Not necessary for our purposes
	 /* printf("Augmenting path:\n");
     i  = Gsize-1;
     while (i) {
       printf("Name: %s\n", Resid_Graph[i].Name);
       i = Resid_Graph[i].Prev;
     }
     printf("Name: %s\n", Resid_Graph[i].Name);/*


     /* ************** */
     /* Increase the flow thru the original graph along the augmenting path found above*/

   j  = Gsize-1;
   i = Resid_Graph[j].Prev;
   while (i || j) {
     Slider = Resid_Graph[i].Next;
     k=0;
     while(Slider){
       if (!strcmp(Slider->Name, Resid_Graph[j].Name)){
	 Temp = Orig_Graph[i].Next;
	 while(Temp){
	   if (!strcmp(Temp->Name, Resid_Graph[j].Name)){
	     Temp->Flow++;
	     k = 1;
	     break;
	   }	   
	   Temp = Temp->Next;
	 }

	 if (k==0) {
	   Temp = Orig_Graph[j].Next;
	   while(Temp){
	     if (!strcmp(Temp->Name, Resid_Graph[i].Name)){
	       Temp->Flow--;
	       break;
	     }
	     Temp = Temp->Next;
	   }
	 }
	 break;
       }
       Slider = Slider->Next;
     }
     j=i;
     i=Resid_Graph[j].Prev;
   }

   /* Compute the happiness factor */
   PrevHappy=Happy;
   Happy = 0;
	 int numNines = 0;
	 int numSix = 0;

   for(i = 0; i < Gsize; i++) {
     Slider = Orig_Graph[i].Next;
     while (Slider) {
		 //Tilley: added a counter for displaying the number of '9' and '6' matched
		 if(Slider->Weight * Slider->Flow == 9 ) numNines++;
		 if(Slider->Weight * Slider->Flow == 6 ) numSix++;
       Happy += Slider->Weight * Slider->Flow;
       Slider = Slider->Next;
     }
   }


   /* Normal exit - no more augmenting paths */
   if (PrevHappy == Happy && Happy != 0){
     if(Matches >= minMatches)
		 printf("\n Happiness cannot be increased anymore.\n");
   }
   /*
       exit(0);
       }*/

	 if(Matches >= minMatches ){
		 printf("Total Match(es): %d\nHappiness: %d\n Number of '9' matches: %d\n Number of '6' matches: %d\n", Matches, Happy, numNines, numSix );
		 
		 //Tilley: prints out to file which matching number we're on
		 fprintf(outfd, ".%d\n", Matches);
	 }

   /* Super-insane loop to format the whole flow at this point: */
	 
	 //Tilley: wherever you see if(Matches >= minMatches ) is where data is restricted from being printed based
	 //on constraints given to the program through command line arguments

   if(FlowDump || PrintAssn) {
      if(FlowDump)
		  if(Matches >= minMatches )
			  printf("Format of edges: Name [tab] Flow\n");
      Slider = Orig_Graph[0].Next;
      while (Slider != NULL) {
	if (Slider->Flow > 0){
	 if (FlowDump)
		 if(Matches >= minMatches ){
			 printf("\nProfessor: %s\tflow: %d", Slider->Name, Slider->Flow);
			 // fprintf(outfd, "%s ", Slider->Name);
		 }
	  for(i = 1; i < Gsize; i++) {
	    if (!strcmp(Slider->Name, Orig_Graph[i].Name)) {	      
	      Temp =Orig_Graph[i].Next;
	      while(Temp != NULL) {
	      if (Temp->Flow > 0){
		if (FlowDump)
			if(Matches >= minMatches ){
				printf("\n     Project# %s \t flow: %d\n", Temp->Name, Temp->Flow);	
				//fprintf(outfd, "%s ", Temp->Name);
			}
		else if (PrintAssn)
			if(Matches >= minMatches){
				printf("\nProject: %s\n", Temp->Name);
				//fprintf(outfd, "%s ", Temp->Name);
			}
		for (j=1; j<Gsize; j++) {
		   if (!strcmp(Temp->Name, Orig_Graph[j].Name)) {
		     Temp2 =Orig_Graph[j].Next;
		     while(Temp2 != NULL) {
		      if (Temp2->Flow > 0) {
			if(PrintAssn)
				if(Matches >= minMatches ){
					printf("\nFaculty: %s\nStudent: %s\n", Slider->Name, Temp2->Name);
					
					//Tilley: Prints project, faculty, and student out to file
					fprintf(outfd, "%s %s %s\n", Temp->Name, Slider->Name, Temp2->Name);
				}
			else 
				if(Matches >= minMatches ){
					printf("\n          Student %s\tflow: %d\tweight: %d\n", Temp2->Name, Temp2->Flow, Temp2->Weight);
					//fprintf(outfd, "%s %s ", Temp2->Name);
				}
		      }
		      Temp2=Temp2->Next;
		     }
		   }
		}
	      }
	      Temp=Temp->Next;
	      }
	    }
	  }
	}
	Slider = Slider->Next;
       }
   }
	 if(Matches >= minMatches){
		 printf("======================================================\n\n\n");
		 
		 //Tilley: denotes the end of this matching
		 fprintf(outfd, "- - -\n");
	 }

 } /* while Matches loop */

  return 0;
}
