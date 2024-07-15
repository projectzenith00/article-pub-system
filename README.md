# article-pub-system

1 Download and install Xampp
2. Go to the htdocs folder where your xammpp is installed Ex: "C:\xampp\htdocs\"
3. Create a new folder and rename
4. Download and extract the files in the new folder
5. Open the Xampp application and start Apache and MySQL
6. Open your browser and go to http://localhost/phpmyadmin/
7. Go to the SQL tab and paste the SQL codes below
	
	"CREATE DATABASE article_publishing_system;

	USE article_publishing_system;

	CREATE TABLE articles (
	    id INT AUTO_INCREMENT PRIMARY KEY,
	    image TEXT(255),
	    title TEXT(255),
	    date DATE,
	    content MEDIUMTEXT(5000)
	);"
	
8. Click the Go button below to run the sql commands
9. To access the site, open a new tab in your browser and enter "http://localhost/name -of-your-folder-in-htdocs/"
10. Make sure to replace the text "name -of-your-folder-in-htdocs" with the actual name of your in htdocs where you  extracted the files.