<h1>Webinar Management System</h1>

#Linux System Setup
    1. Download PHP
        Ensure you have the required PHP version installed on your Linux system.
    2. Create a Soft Link for the Project
        Create a symbolic link (soft link) for easier project management.
    3. Nginx Server Setup
        Install Nginx and configure it for the webinar management system.
#Nginx Configuration
    1.Create a configuration file in sites-available:
        sudo nano /etc/nginx/sites-available/<your_site_name.conf>
    2.Example of the configuration file (<your_site_name.conf>):
        server {
            listen 80;
            listen 443;
            server_name webinar-mpanel.com;  # Your domain name
            root /var/www/html/myprojects;   # Path to the project root directory
            client_max_body_size 5000M;
            index home.php index.php index.html;

            location / {
                try_files $uri $uri/ =404;
            }

            location ~ \.php$ {
                include snippets/fastcgi-php.conf;
                fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
            }

            location ~ /\.ht {
                deny all;
            }
        }
    3.Set write permissions:
        sudo chmod -R 777 /etc/nginx/sites-enabled/
    4.Create a soft link for the configuration in sites-enabled:
        ln -s /etc/nginx/sites-available/<your_site_name.conf> /etc/nginx/sites-enabled/<your_site_name.conf>
    5.Set read permissions:
        sudo chmod -R 777 /etc/nginx/sites-enabled/

#Import the Database
    <h3><a href="#">Import the Database</a></h3>
#Database Structure
Tables:
    - broadcast
    - category
    - presenter_details
    - tags
    - user_details
    - webinar_details
    - webinar_presenter_relationship
    - webinar_tag_relationship
#Login to the Panel
    - Username: sraza1
    - Password: 12345
#Features of the Project
    - User Authentication: Login to the panel with session storage after authentication.
    - User Management: Add, edit, delete, and update user status.
    - Subscriber Management: Add, edit, delete, and update subscriber status.
    - Webinar Management: Add, edit, delete, and update webinar details.
    - Broadcast Management: Add, edit, delete, and update broadcast details.
    - Presenter Management: Add, edit, delete, and update presenter details.
    - Tag Management: Add, edit, and delete tags.
    - Category Management: Add, edit, delete, and manage categories, including parent-child relationships.
#Additional Features
    - Pagination: Implemented on listing pages.
    - Logout: User logout functionality.
    - Welcome Page: Custom welcome page.






