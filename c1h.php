<?php

$i = 0;
$j = 1;
echo "$j<br/>";

while (($i + $j) < 1000) {
	$res = $j + $i;
	$i = $j;
	$j = $res;
	echo "$res<br/>";
}

?>