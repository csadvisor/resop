#!/bin/sh

matchmake: match_graph.c select_matching.c
	gcc -o match_graph match_graph.c -I.
	gcc -o select_matching select_matching.c -I.
	gcc -g -I/usr/include/mysql -L/usr/lib/mysql -o email email.c -lmysqlclient -lm -lnsl
	gcc -g -I/usr/include/mysql -L/usr/lib/mysql -o gen_graph gen_graph.c -lmysqlclient -lm -lnsl
	gcc -g -I/usr/include/mysql -L/usr/lib/mysql -o finalize_matching finalize_matching.c -lmysqlclient -lm -lnsl
