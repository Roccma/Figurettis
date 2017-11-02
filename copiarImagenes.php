<?php

for($i = 0; $i < 480; $i++){
	$numeroFigurita = $i + 1;
	copy('img/no-image.jpg', 'img/Figuritas/' . $numeroFigurita . '.jpg');
}

echo "Ok";

?>