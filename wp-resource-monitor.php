<?php
/*
Plugin Name: WP Resource Monitor
Description: Monitor the server resource like database query, execution time etc used by WordPress website. Show result in footer. To see result add a query parameter monitor=yes with the URL. eg: example.com/?monitor=yes
Author: oneTarek
Author URI: http://onetarek.com
Version: 1.0

HOW TO USE:
INSTALL AND ACTIVATE THIS AS AN WORDPRESS PLUGIN
To see result add a query parameter monitor=yes with the URL. eg: example.com/?monitor=yes
By default it will show total time and total queries. 
If you want to see the list of queries, then add show_query=yes eg: example.com/?monitor=yes&show_query=yes
*/
 $wprm_num_exicuted_queries;
 $wprm_exicuted_queries=array();
 function wprm_log_query($query)
 {
 	global $wprm_num_exicuted_queries, $wprm_exicuted_queries;
 	$wprm_num_exicuted_queries++;
  	$wprm_exicuted_queries[]=$query;
 	return $query; 
 }
 if(isset($_GET['monitor']) && $_GET['monitor'] == 'yes')
 {
 	add_filter('query','wprm_log_query');
 	add_action('shutdown', 'wprm_show_result', 30);
 }
 function wprm_show_result()
 {
		echo '<div style="min-height:200px; border:5px solid #CCCCCC;"><div style="font-size:25px; text-align:center; background:#CCCCCC; font-weight:bold; padding:2px;">Resource Monitor</div>';
			echo '<div style="padding:10px;">';
				global $wprm_num_exicuted_queries, $wprm_exicuted_queries;
				echo '<table width="100%" border="1">';
					echo '<tr><td width="150">Execution Time: </td><td><strong>'; timer_stop(1); echo "</strong> Second</td></tr>";
					echo "<tr><td>Total MySQL Query: </td><td><strong>".get_num_queries(); echo "</strong> queries ( <strong>".$wprm_num_exicuted_queries."</strong> queries are counted using wp query filter )</td></tr>";
					if(isset($_GET['show_query']) && $_GET['show_query']=='yes'){
					echo '<tr><td colspan="2">MySQL Queries:'; 
						echo '<table>';
						$i=1;
						foreach($wprm_exicuted_queries as $qur){
							echo '<tr><td>'.$i.'</td><td style="background:#efefef; border-bottom: 1px solid #dddddd"><code>'.$qur.'</code></td></tr>';
							$i++;
						}
						echo '<table>';
					echo "</td></tr>"; 
					}
					#IF YOU NEED TO SEE MY SQL PORCESS LIST THEN UNCOMMENT FOLLOWING BLOCK OF CODE
					/*
					echo '<tr><td colspan="2">PROCESS LIST'; 
						$pro=@mysql_query("SHOW FULL PROCESSLIST");
						while($process=mysql_fetch_assoc($pro))
						{
						echo "<pre>"; print_r($process); echo "</pre>";
						}
					echo "</td></tr>"; 
					*/
				
					

				echo '</table>';
			echo'</div>';
		echo '</div>';
 }
 
/*
#another way to see the number of queries
function add_performance_stats() {
	echo "\n";
	echo '<!-- Blog ' . get_current_blog_id() . ' was created in ' . timer_stop( 0 ) . ' seconds via ' . get_num_queries() . ' queries -->';
	echo "\n";
}
add_action( 'wp_footer', 'add_performance_stats', 9999 );

*/