<!DOCTYPE html>
<html lang="pl">
<head>

    <meta charset="UTF-8" />
    <title>Kostka Rubika</title>

    <link href="style.css" rel="stylesheet" type="text/css">

    <script src="http://code.jquery.com/jquery-1.5.1.min.js"></script>
	<script type="text/javascript" src="javascript/highslide-with-gallery.js"></script>
	<script type="text/javascript">
		hs.graphicsDir = 'javascript/images/';
		hs.align = 'center';
		hs.transitions = ['expand', 'crossfade'];
		hs.outlineType = 'rounded-white';
		hs.fadeInOut = true;
		//hs.dimmingOpacity = 0.75;

		// Add the controlbar
		if (hs.addSlideshow) hs.addSlideshow({
			//slideshowGroup: 'group1',
			interval: 5000,
			repeat: false,
			useControls: true,
			fixedControls: 'fit',
			overlayOptions: {
				opacity: .75,
				position: 'bottom center',
				hideOnMouseOut: true
			}
		});
	</script>

</head>

<body>
        <div id="naglowek">
            <h1>
                <br />
                <img src="Logo.svg" style="width:100px; height:100px" alt="logo"/><br />
                Kostka Rubika
                <br />
                </h1>
        </div>
        <ul id="menu">
	    <li><a href="index.php">Start</a></li>
        <li><a href="e1.html">Jak ułożyć kostkę</a>
            <ul>
                <li><a href="e1.html">Etap 1 - biały krzyż</a></li>
                <li><a href="e2.html">Etap 2 - narożniki białej ściany</a></li>
                <li><a href="e3.html">Etap 3 - druga warstwa</a></li>
                <li><a href="e4.html">Etap 4 - żółty krzyż</a></li>
                <li><a href="e5.html">Etap 5 - permutacja żółtego krzyża</a></li>
                <li><a href="e6.html">Etap 6 - permutacja narożników</a></li>
                <li><a href="e7.html">Etap 7 - orientacja narożników</a></li>
                <li><a href="e8.html">Etap 8 - ostatnia permutacja</a></li>
            </ul>
        </li>
        <li><a href="kostki.html">Różne kostki</a></li>
        <li><a href="opcje.html">Opcje</a></li>
        <li><a href="kontakt.html">Kontakt</a></li>
    </ul>
    <article>
    <p>
	<br/>
<form method="post" action="usun.php"><table><tr>
<?php

session_start();
if(isset($_SESSION['username']))
	echo'<a href="logout.php">Wyloguj</a>';
else
	echo'<a href="register.php">Rejestracja</a>/<a href="login.php">logowanie</a><br/><br/>';
function get_db(){
	$mongo = new MongoClient("mongodb://localhost:27017/",['username' => 'wai_web',	'password' => 'w@i_w3b', 'db' => 'wai',	]);
	$db = $mongo->wai;
	return $db;
}
$db = get_db();
$products = $db->products->find();
$katalog = "watermark";
$katalogminiaturki = "miniature";
$galeria = opendir( $katalog );
$i=0;
while ( $zdjecie = readdir( $galeria ) ){
   
$odczyt = pathinfo( $katalog.'/'.$zdjecie );
  if (( $odczyt['extension']  == 'jpg' || $odczyt['extension']  == 'png' || $odczyt['extension']  == 'jpeg') && isset($_SESSION['galeria'][$zdjecie])){
	echo '<td>';
    echo '<a href="'.$katalog.'/'.$zdjecie.'" class="highslide" onclick="return hs.expand(this)" title="Zdjęcie: '.$zdjecie.'"><img width="200" height="133" src="'.$katalogminiaturki.'/'.$zdjecie.'" alt="Zdjęcie: '.$zdjecie.'" /></a>';
	foreach ($products as $product) {
		if($product['name']==$zdjecie){
			echo '<br/>Autor: '.$product['author'] . '<br/>';
			echo 'Tytuł: '.$product['title'] . '<br/>';		
			break;
		}
	}
	echo'<input type="checkbox" name="check_list[]" value="'.$zdjecie.'">';		
	echo '</td>';
	$i++;
	if($i%4==0)
		echo'</tr><tr>';
  }

}
closedir($galeria);
?>
</tr></table><input type="submit" value="„Usuń zaznaczone z zapamiętanych"></form>

		<a href="index.php">Wróć</a>
    </p>
    </article>
</body>
</html>