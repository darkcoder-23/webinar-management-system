<h1>Webinar Management System</h1>

<h3>Linux System Setup</h3><br>
    1. Download PHP<br>
        Ensure you have the required PHP version installed on your Linux system.<br>
    <br>
    2. Create a Soft Link for the Project<br>
        Create a symbolic link (soft link) for easier project management.<br>
        <br>
    3. Nginx Server Setup<br>
        Install Nginx and configure it for the webinar management system.<br>
        <br>
<h3>Nginx Configuration</h3><br>
    1.Create a configuration file in sites-available:<br>
        sudo nano /etc/nginx/sites-available/<your_site_name.conf><br>
        <br>
    2.Example of the configuration file (<your_site_name.conf>):<br>
        sudo nano /etc/nginx/sites-available/<your_site_name.conf><br><br>
        
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
        sudo chmod -R 777 /etc/nginx/sites-enabled/ <br>
        <br>
4.Create a soft link for the configuration in sites-enabled: <br>
    ln -s /etc/nginx/sites-available/<your_site_name.conf> /etc/nginx/sites-enabled/<your_site_name.conf><br>
    <br>
5.Set read permissions:<br>
    sudo chmod -R 755 /etc/nginx/sites-enabled/<br>
<br><br>
<h3><a href="https://drive.google.com/file/d/1tRqzonRO2HH9-JmHIUkooja6ViCws07W/view?usp=sharing">Source of the DB. You Can Import this in the Local Database</a></h3>
<br>
<br>
<h3>Database Structure</h3><br>
Tables:<br>
    - broadcast<br>
    - category<br>
    - presenter_details<br>
    - tags<br>
    - user_details<br>
    - webinar_details<br>
    - webinar_presenter_relationship<br>
    - webinar_tag_relationship<br><br>
<h3>Login to the Panel</h3><br>
    - Username: sraza1<br>
    - Password: 12345<br>
    <br>
<h3>Features of the Project</h3><br>
    - User Authentication: Login to the panel with session storage after authentication.<br>
    - User Management: Add, edit, delete, and update user status.<br>
    - Subscriber Management: Add, edit, delete, and update subscriber status.<br>
    - Webinar Management: Add, edit, delete, and update webinar details.<br>
    - Broadcast Management: Add, edit, delete, and update broadcast details.<br>
    - Presenter Management: Add, edit, delete, and update presenter details.<br>
    - Tag Management: Add, edit, and delete tags.<br>
    - Category Management: Add, edit, delete, and manage categories, including parent-child relationships.<br>
    <br>
<h3>Additional Features</h3><br>
    - Pagination: Implemented on listing pages.<br>
    - Logout: User logout functionality.<br>
    - Welcome Page: Custom welcome page.<br>






