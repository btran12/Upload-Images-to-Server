# Upload-Images-to-Server 
The php file will allow the user to upload multiple files to the server.

In my case, I can only upload 50 files or less, the total files size must be under 2048 megabytes.

##### To upload larger files, change these values in php.ini file (If you're using Apache, the file is at /etc/php5/apache2/php.ini)

upload_max_filesize 10M (Total size of all files)
post_max_size 10M (Max size per post reques)

(Time it would take to upload the files in seconds)
max_input_time 300
max_execution_time 300
***
###TO DO:
* Upload Progress Bar
* Able to create Directories
* Page Styling
