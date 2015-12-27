# Yii2 CMS Application

This is basic example of simple CMS for blog, news or similar site function maded in purpose of learning Yii 2 framework 
advanced template. In the beginning of learning process one could experience some frustration but after a while 
it becomes clear that it's worth every struggling. Yii 2 is big framework with alot of features and I think that 
developers in the future will adopt it for most of their projects. With Yii 2 you can build applications in matter 
of days after you become comfortable with it. Advanced template is also amazing because it makes so much things in 
the start for you in the separation of the public area (called frontend in Yii 2) and the administration area (called backend) 
which act as two separated applications. 
In this application I'm using two virtual hosts simulating domain for frontend and subdomain for backend.
Therefore you need to edit `httpd-vhosts.conf` and add those virtual hosts to test this application. They also needs 
to be added to `Windows\System32\drivers\etc\hosts` file. 
The first one is for frontend:

```
<VirtualHost yiicms.dev:80>
	ServerAdmin webmaster@yiicms.dev
	DocumentRoot "c:\\wamp\\www\\yiicms\\frontend\\web\\"
	ServerName yiicms.dev
	ServerAlias yiicms.dev www.yiicms.dev
	<Directory "c:\\wamp\\www\\yiicms\\frontend\\web\\">
		Options Indexes FollowSymLinks
		AllowOverride All
		Require local
	</Directory>
</VirtualHost>
```

And second one for backend:

```
<VirtualHost yiicms.dev:80>
	ServerAdmin webmaster@yiicms.dev
	DocumentRoot "c:\\wamp\\www\\yiicms\\backend\\web\\"
	ServerName yii2build.dev
	ServerAlias backend.yiicms.dev www.backend.yiicms.dev
	Alias /uploads "c:\\wamp\\www\\yiicms\\frontend\\web\\images\\blog\\"
	<Directory "c:\\wamp\\www\\yiicms\\backend\\web\\">
		Options Indexes FollowSymLinks
		AllowOverride All
		Require local
	</Directory>
</VirtualHost>
```

Both are pointing to different root folders because in basic, they are two separated applications. In the backend virtual host 
you need to create uploads alias which represents the upload folder. It is designed so that all files (images) are uploaded to 
`web\images\blog` folder in the frontend application, so to display images in the backend you need to create this alias. 
In the public area user can:
   - read articles
   - view articles sorted by category
   - register with choosen username and password
   - view recent comments
   - comment the article and leave replies to the same
   - edit the profile and see the list of articles commented
   - view the profile of other users and see the list of articles commented
   - view the profile of the author and see the list of articles written 

In the admin area user can:
   - view, update, and delete articles
   - view, update, and delete categories
   - view and set the user as admin

The project needs some improvements which will be added in the future (e.g search site function and search articles by tags).
You also need to change the database connection settings to your local environment in the common\config\main-local.php file.
Migrations are used for database creation (mostly also for learning purpose) but if something is wrong with it I included 
mysqldump file in database folder. Let me know if there are some errors or possible improvements.



