<!DOCTYPE html>
<html lang="pl">
<head>

    <meta charset="UTF-8" />
    <title>Kostka Rubika</title>

    <link href="style.css" rel="stylesheet" type="text/css">

    <script src="http://code.jquery.com/jquery-1.5.1.min.js"></script>

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
	<br>
<?php
session_start();
function get_db()
{
    $mongo = new MongoClient(
        "mongodb://localhost:27017/",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b',
            'db' => 'wai',
        ]);

    $db = $mongo->wai;

    return $db;
}
if(!isset($_FILES['plik_upload']))
	die('Zbyt duży plik (max 1MB)<br/><a href="index.php">Wróć</a>');
$f = $_FILES['plik_upload'];
if($_POST['watermark']=="" || $_POST['author']=="" || $_POST['title']=="")
	echo 'Uzupełnij wszystkie pola.';
else{
IF($f['type'] == 'image/png' or $f['type'] == 'image/jpeg'){
	$x = getimagesize($f['tmp_name']);
	IF(!is_array($x) or $x[0] < 2)
		{
		die('Zły plik graficzny<a href="index.php">Wróć</a>');
		}	
	IF($f['size']<=1024*1024){
		$patch = str_replace('upload.php', '', $_SERVER['SCRIPT_FILENAME']);
		$filename=$f['name'];
		while(file_exists($patch.'/images/'.$filename))
			$filename=rand('0','9').$filename;
		move_uploaded_file($f['tmp_name'], $patch.'/images/'.$filename);
		echo 'Przesłano plik.<br/>';
		IF($f['type'] == 'image/png'){
			//header('Content-Type: image/png');
			$im = imagecreatefrompng($patch.'/images/'.$filename);
		}
		else{
			//header('Content-Type: image/jpeg');
			$im = imagecreatefromjpeg($patch.'/images/'.$filename);
		}
		$white = imagecolorallocate($im, 255, 255, 255);
		$black = imagecolorallocate($im, 0, 0, 0);
		$text = 'Testing...';
		$text = $_POST['watermark'];
		$font_file = './arial.ttf';
		imagefttext($im, 20, 0, 11, imagesy($im)-9, $black, $font_file, $text);	
		imagefttext($im, 20, 0, 10, imagesy($im)-10, $white, $font_file, $text);	
		IF($f['type'] == 'image/png')			
			imagepng($im,$patch.'/watermark/'.$filename);
		else
			imagejpeg($im,$patch.'/watermark/'.$filename);
		echo 'Dodano znak wodny.<br/>';
		IF($f['type'] == 'image/png'){
			//header('Content-Type: image/png');
			$im = imagecreatefrompng($patch.'/images/'.$filename);
		}
		else{
			//header('Content-Type: image/jpeg');
			$im = imagecreatefromjpeg($patch.'/images/'.$filename);
		}
		$im=imagescale($im,200,125);
		IF($f['type'] == 'image/png')			
			imagepng($im,$patch.'/miniature/'.$filename);
		else
			imagejpeg($im,$patch.'/miniature/'.$filename);
		echo 'Dodano miniaturę.<br/>';		
		imagedestroy($im);
		
		$db = get_db();
		if(isset($_SESSION['username']) && $_POST['pubpriv']=='privateimg')
			$product = [
				'name' => $filename,
				'author' => $_POST['author'],
				'title' => $_POST['title'],
				'private' => $_SESSION['username']
			];
		else
			$product = [
				'name' => $filename,
				'author' => $_POST['author'],
				'title' => $_POST['title']
			];
		$db->products->insert($product);
		
	}
}
else
	{
	echo 'Plik niedozwolonego typu<br/>';
	}
IF($f['size']>1024*1024){
	echo 'Zbyt duży plik (max 1MB)<br/>';
}}
?>
<br/>
	    <a href="index.php">Wróć</a>
    </p>
    </article>
</body>
</html>
