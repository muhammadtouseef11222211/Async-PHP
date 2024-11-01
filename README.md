This project is designed to enhance the performance of an Apache web server through asynchronous PHP scripts and modular architecture. It includes reusable views, async scripts, and backend functionality.

Apache server installed
PHP installed (with necessary extensions)
Installation Steps
Download the Project: Clone or download the repository from GitHub.
Configure Apache:
Extract apache_final_project.zip into your web server's document root (e.g., /var/www/html).
Make sure the .htaccess file is correctly configured for your server. You may need to enable mod_rewrite.

Testing:
Access index.php through your web browser to ensure everything is working.
Usage
Modular Scripts: Use the files in the Backend directory for managing Apache modules and ports.
Asynchronous Functionality: The async_scripts directory contains scripts for handling asynchronous operations.
Reusable Views: Utilize the files in app/reuseable_views to create consistent headers and footers across your application.


Core Configuration:


make sure to do this before using becuase it is high level access project:

(sudo chown www-data:www-data /etc/apache2/ports.conf
sudo chmod 664 /etc/apache2/ports.conf
sudo chown www-data:www-data /etc/apache2/mods-enabled & mods-available
sudo chmod 664 /etc/apache2/ports.conf & mods-enabled & mods-available
sudo chown www-data:www-data /etc/apache2/sites-available/
sudo chmod 755 /etc/apache2/sites-available/
chmod -R 777 /var/www/html/*
%www-data ALL=(ALL) NOPASSWD: ALL   (add after sudo visudo))


