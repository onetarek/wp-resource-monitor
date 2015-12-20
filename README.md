# WP Resource Monitor
Monitor the server resource like database query, execution time etc used by WordPress website. 
This script will print the result after footer.

#HOW TO USE 
INSTALL AND ACTIVATE THIS AS AN WORDPRESS PLUGIN
To see result add a query parameter monitor=yes with the URL. eg: example.com/?monitor=yes
By default it will show total time and total queries. 
If you want to see the list of queries, then add show_query=yes eg: example.com/?monitor=yes&show_query=yes

#CAUTION
DO NOT USE show_query=yes on your live website. It will show the list of mySql queries run by your website.
Some external script like adsense, analytics or any other script may copy the output of this plugin and can copy the url with parameter you use for this plugin. IT MAY CAUSE OF SECURITY ISSUE
