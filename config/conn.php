<?	$host="localhost";

	$user="root";

	$pass="";

	$dbname = "giayquocvn";

	$connection= mysql_connect ($host, $user, $pass);

	if (!$connection) { die ("Can not connect database");}

	$result = mysql_select_db ($dbname);

	mysql_query('SET NAMES utf8 COLLATE utf8_general_ci');

	$db = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $pass, array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

?>