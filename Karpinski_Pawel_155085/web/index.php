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
            Kostka Rubika<br />
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
		<?php
			include 'galeria.php';
		?>
		<h3><a href="tylko_wybrane.php">Pokaż zapamiętane</a></h3>
		<form enctype="multipart/form-data" method="post" action="upload.php">
			<input type="file" size="32" name="plik_upload" value=""/>
			Znak wodny:
			<input type="text" size="32" name="watermark" value=""/><br/>
			Autor:
			<?php
				if(isset($_SESSION['username'])){
					$db = get_db();
					$query = ['_id' => $_SESSION['username']];
					$user = $db->users->findOne($query);
					echo'<input type="text" size="32" name="author" value="'.$user['login'].'"><br/>';
				}
				else			
					echo'<input type="text" size="32" name="author" value=""><br/>';
			?>
			Tytuł:
			<input type="text" size="32" name="title" value=""/><br/>
			<?php
			if(isset($_SESSION['username']))
				echo'
					Publiczny<input type="radio" name="pubpriv" value="publicimg" checked/>
					Prywatny<input type="radio" name="pubpriv" value="privateimg" />';
			?>
			
			<input type="submit" value="Wyślij zdjęcie"/>
		</form>
    </p>
    </article>
</body>
</html>