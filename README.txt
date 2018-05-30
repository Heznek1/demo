1) We used bootstrap, There is option to watch the project in mobile view.
2)For the design of the site, we created a virtual host
Step A:
Entering the Application XAMPP
Click on the explorer tab. (on the right side)
apache ---> conf ---> extra ---> httpd-vhosts ---> open in notepad
on the last line add this line:
<VirtualHost *: 80>
DocumentRoot "c: / xampp / htdocs / demo"
ServerName localhost
<Directory "c: / xampp / htdocs / demo">
</ Directory>
</ VirtualHost>