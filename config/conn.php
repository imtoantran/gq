<?	$host="localhost";

	$user="root";

	$pass="";

	$dbname = "giayquocvn";

   

	$connection= mysql_connect ($host, $user, $pass);

	if (!$connection) { die ("Can not connect database");}

	$result = mysql_select_db ($dbname);

	mysql_query('SET NAMES utf8 COLLATE utf8_general_ci');

?>