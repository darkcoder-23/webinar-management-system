<h1>Webinar Management System</h1>

#Linux System Setup<br>
    1. Download PHP<br>
        Ensure you have the required PHP version installed on your Linux system.<br>
    2. Create a Soft Link for the Project<br>
        Create a symbolic link (soft link) for easier project management.<br>
    3. Nginx Server Setup<br>
        Install Nginx and configure it for the webinar management system.<br>
#Nginx Configuration<br>
    1.Create a configuration file in sites-available:<br>
        sudo nano /etc/nginx/sites-available/<your_site_name.conf><br>
        sudo nano /etc/nginx/sites-available/<your_site_name.conf><br>
    2.Example of the configuration file (<your_site_name.conf>):
        sudo nano /etc/nginx/sites-available/<your_site_name.conf><br>
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
    <br>
    3.Set write permissions: <br>
        sudo chmod -R 777 /etc/nginx/sites-enabled/<br>
    4.Create a soft link for the configuration in sites-enabled: <br>
        ln -s /etc/nginx/sites-available/<your_site_name.conf> /etc/nginx/sites-enabled/<your_site_name.conf><br>
    5.Set read permissions:<br>
        sudo chmod -R 777 /etc/nginx/sites-enabled/<br>

#Import the Database<br>
    <h3><a href="#">Import the Database</a></h3><br>
#Database Structure<br>
Tables:<br>
    - broadcast<br>
    - category<br>
    - presenter_details<br>
    - tags<br>
    - user_details<br>
    - webinar_details<br>
    - webinar_presenter_relationship<br>
    - webinar_tag_relationship<br>
#Login to the Panel<br>
    - Username: sraza1<br>
    - Password: 12345<br>
#Features of the Project<br>
    - User Authentication: Login to the panel with session storage after authentication.<br>
    - User Management: Add, edit, delete, and update user status.<br>
    - Subscriber Management: Add, edit, delete, and update subscriber status.<br>
    - Webinar Management: Add, edit, delete, and update webinar details.<br>
    - Broadcast Management: Add, edit, delete, and update broadcast details.<br>
    - Presenter Management: Add, edit, delete, and update presenter details.<br>
    - Tag Management: Add, edit, and delete tags.<br>
    - Category Management: Add, edit, delete, and manage categories, including parent-child relationships.<br>
#Additional Features<br>
    - Pagination: Implemented on listing pages.<br>
    - Logout: User logout functionality.<br>
    - Welcome Page: Custom welcome page.<br>






