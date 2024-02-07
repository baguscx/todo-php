<?php 

$employe = [
                ['nama'=>'Toni','alamat'=>'Bandung'],
                ['nama'=>'Naufal','alamat'=>'Bandung'],
                ['nama'=>'Davi','alamat'=>'Jakarta']
			];
$input = serialize($employe);
file_put_contents("data.txt", $input);

$show = file_get_contents("data.txt");
$output = unserialize($show);
print_r($output);

?>