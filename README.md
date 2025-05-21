PRABLO - Pragmatic blogging
===========================

If 'pragmatic blogging' Mode is active you just have to enter an Link
and PRABLO does the rest. Sure you can edit the suggestion!
You can't blog faster ;-)

FEATURES
======================================================================
- Advanced web-based admin system
- A dozen of style and content settings
- Security against MySQL injection
- Support for BBCode2HTML tags for links, images, videos, etc.
- Displays great on large screens and mobile devices (bootstrap based)
- Optimized SEO friendly Permalinks
- Simple MySQL setup (need only 1 table) use install.php
- Code is full of comments and well structured
- Editing is simple and intuitive
- Easy to add additional content to (pages and posts)
- For people who just want a simple and lightweight blog
- Template based (comes with two different Themes)
- Translation ready (comes with english and german)
- 100% Open Source - work with it as you like!

REQUIREMENTS
======================================================================
As long as you have a web server running PHP* and MySQL*,
you can use it by simply copying the files over to your server and
changing permissions on one directory.
It was tested on a server running Linux and Windows.

* You need to have all the details about the Database-Server
   (like Hostname, Username, Password and Database Name)


INSTALLATION - Easy as 1-2-3
======================================================================
1) Unzip the file containing the Blog-System and use Windows Explorer or a similarly capable FTP program, to navigate to the location where you want the Blog to operate. (It does NOT have to be at the root level and is recommended to be placed in a new folder e.g. 'PRABLO')
2) Copy the contents of unzipped folder to the target server folder.
3) Start 'inc/install.php' in your Browser and follow the instructions.
OR
3) Import 'inc/database.sql' file into db using phpMyAdmin! Configure the elements in the 'settings.php' file to customize the visual design, database and account security portions of the blog!

Ready!

.htaccess will be automatic generatet by the install.php
READ MORE https://perishablepress.com/stupid-htaccess-tricks/
======================================================================
# ROOT VERSION
<IfModule mod_rewrite.c>
AddDefaultCharset UTF-8
RewriteEngine On
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.+)$ /index.php/$1 [L,QSA]
</IfModule>
======================================================================
# IF INSTALLED IN SUBFOLDER
<IfModule mod_rewrite.c>
AddDefaultCharset UTF-8
RewriteEngine On
RewriteBase /PRABLO/
RewriteRule ^index\.php$ – [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.+)$ /PRABLO/index.php/$1 [L,QSA]
</IfModule>
======================================================================
