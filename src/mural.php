<?php
$redis_server=$_SERVER["REDIS_SERVER"] or die ("variavel REDIS_SERVER nao foi definida");

# echo $redis_server ;
$redis = new Redis(); 
$redis->connect($redis_server, 6379) or die ("Nao foi possive se conectar ao servidor $redis_server");


// 
if ($_POST["submit"] == "Submit") {
	#print_r($_POST);
	$redis->lpush("mural-list", $_POST["texto"]);
}
?>

<html>
<form action="" method="POST">
	<input type="text" name="texto" /> 
	<br><br>
	<input type="submit" name="submit" value="Submit">
</form>

<h1>Mensagens</h1>

<?php
$msgs = $redis->lrange("mural-list", 0 ,10);

foreach ($msgs as $msg)
	echo "$msg <br><hr>";

//print_r($msgs,false);
?>
</html>
