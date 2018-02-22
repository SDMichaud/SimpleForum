#!/bin/bash

HELP_TEXT="usage: $0 [OPTION...]\n
OPTIONS:
-v View the table. Show all rows of the table
-r Refresh the table. Drop existing table and create a new empty one
-s Seed the table. Adds test data to an existing table.\n
NOTE: Running -s before -r will cause the table to be seeded and then dropped!\n
$0 is a script designed to assist in development of SimpleForum by automating common database actions.\n"

# This script will create, run, and delete a temporary .sql file
# it must be inthe directory that the script is in
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd)"

# These are the SQL commands that will run when the -r option is used
REFRESH_COMMAND="DROP TABLE IF EXISTS posts;
CREATE TABLE posts (
id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
author VARCHAR(64) NOT NULL DEFAULT 'Anonymous',
subject VARCHAR(128) DEFAULT NULL,
photo VARCHAR(16) DEFAULT NULL,
content TEXT NOT NULL,
updated DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
is_op BOOLEAN NOT NULL,
op INT DEFAULT NULL);"

# These are the SQL commands that will run when the -s option is used
SEED_COMMAND="INSERT INTO posts (photo, content, is_op)
VALUES ('test.png', 'This is a test post', 1);
INSERT INTO posts (author, content, is_op, op)
VALUES ('Name', 'This is a reply', 0, 1);
INSERT INTO posts (content, is_op, op)
VALUES ('This is another reply', 0, 1);
INSERT INTO posts (photo, content, is_op)
VALUES ('test.png', 'This is another test post', 1);
INSERT INTO posts (author, content, is_op, op)
VALUES ('Look At Me!', 'This is a reply', 0, 4);
INSERT INTO posts (content, is_op, op)
VALUES ('This is another reply', 0, 4);"

# These are the SQL commands the will run when the -v option is used
VIEW_COMMAND="SELECT * FROM posts;"

# Before running the commands we have to connect to a mySQL database
# To avoid requiring to type your password it can be set in
# a ~/.my.cnf file
#MYSQL_CONNECT="mysql -h localhost"

show_help()
{
    printf "$HELP_TEXT" >&2
}

# Script must be run with arguments
if [ "$1" = "" ]; then
    show_help
fi

# Run getopts in silent mode, no error messages displayed by getopts
while getopts ":rsvh" opt; do
    case $opt in
	r)
	    # A temp .sql file is created and executed by mySQL
	    printf "$REFRESH_COMMAND" > "$DIR/sfdb.sql"
	    mysql < "$DIR/sfdb.sql"
	    rm "$DIR/sfdb.sql"
	    # Delete all images in /uploads except test.png
	    cd "$DIR/../../uploads"
	    ls | grep -v test.png | xargs rm 2>/dev/null
	    ;;
	s)
	    printf "$SEED_COMMAND" > "$DIR/sfdb.sql"
	    mysql < "$DIR/sfdb.sql"
	    rm "$DIR/sfdb.sql"
	    ;;
	v)
	    printf "$VIEW_COMMAND" > "$DIR/sfdb.sql"
	    mysql < "$DIR/sfdb.sql"
	    rm "$DIR/sfdb.sql"
	    ;;
	h)
	    show_help
	    ;;
	\?)
	    echo "$0: Invalid option: -$OPTARG" >&2
	    ;;
    esac
done
