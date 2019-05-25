<?php
	$u0 = 0;
	$u1 = 1;
	$res = 0;
	do{
		$res = $u0 + $u1 ;
		$tmp = $u1 ;
		$u1 = $res ;
		$u0 = $tmp ;
		echo "$res <br /> ";
	}while($res <6765);
?>
