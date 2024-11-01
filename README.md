This project is designed to enhance the performance of an Apache web server through asynchronous PHP scripts and modular architecture. It includes reusable views, async scripts, and backend functionality.

Project Structure


├── apache_final_project.zip      # Compressed project file
├── app
│   ├── .htaccess                 # Apache configuration for URL rewriting
│   ├── apache
│   │   └── run_without_reload.php # Script to run Apache configuration without reload
│   └── reuseable_views            # Contains reusable view components
│       ├── footer.php
│       ├── footer_async.php
│       ├── footer_form.php
│       ├── footer_json.php
│       └── header.php
├── async_scripts                  # Directory for asynchronous scripts
├── Backend                        # Backend logic for Apache configuration
│   ├── apache
│   │   ├── apache_status.php      # Checks Apache status
│   │   ├── dbcode                 # Database related scripts
│   │   │   ├── test.php
│   │   │   └── test1.php
│   │   ├── enable.php             # Script to enable modules
│   │   ├── mods.php               # Module management
│   │   ├── ports.php              # Port management
│   │   └── request_mods.php       # Request module status
├── css                            # CSS files
│   └── style.php                  # Stylesheet for the application
├── db.php                         # Database connection file
├── index.php                      # Main entry point
├── js                             # JavaScript files
│   ├── apache.js                  # Main JavaScript logic
│   └── router_js.php              # JavaScript router
├── lib                            # Library functions
│   ├── AsyncRunner.php            # Asynchronous runner class
│   ├── db_insert.php              # Database insertion logic
│   └── macro                      # Macro functions for database operations
│       ├── db_conn.php
│       ├── include_file.php
│       ├── macro_db.php
│       ├── macro_insert.php
│       └── macro_router.php
├── router_links                   # Links routing
│   └── links.php                  # Link management
└── spaces                         # Data files for configuration
    ├── apache_ports.csv           # List of Apache ports
    └── apache_sites.csv           # List of Apache sites

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



We're working on an automated vulnerability-finding and attack software using asynchronous PHP. It will gather practical data and launch targeted attacks while adapting based on AI insights. About 30% of the software will be publicly available for scanning and basic attacks, while the rest will remain private for security reasons. Thanks for your interest!




