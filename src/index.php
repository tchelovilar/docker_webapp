<?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;


$a=0;
for($i = 0; $i < 10000000; $i++) {
     $a += $i;
}

// 
$user_agent=isset($_SERVER['HTTP_USER_AGENT']);


$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);

//
session_start();
if ($_REQUEST["nome"]) {
  $_SESSION["nome"]=$_REQUEST["nome"];
}

if ( $_SESSION["nome"] != "") {
  echo "Nome: $_SESSION[nome]";
} else {
  echo 'Digite seu nome: <form action="" method="POST"><input name="nome"><input type="submit" value="Submit"></form> ';
}
echo "<br><br>";

//
if (! preg_match("/curl|^$/",$user_agent)) echo "<br>" ;
echo "Host: ";
echo gethostname();
echo "  \n";
echo "<br>";
echo 'Total Time: '.number_format($total_time,2).' seconds.';

echo '<br><br><font size="1">Version 0.14</font>';
?>

