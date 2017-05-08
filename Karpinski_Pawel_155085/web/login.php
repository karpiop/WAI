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

			function get_db(){
				$mongo = new MongoClient("mongodb://localhost:27017/",['username' => 'wai_web',	'password' => 'w@i_w3b', 'db' => 'wai',	]);
				$db = $mongo->wai;
				return $db;
			}
		if ($_SERVER["REQUEST_METHOD"] === 'POST') {			
			$hashpwd=hash('ripemd160',$_POST['password']);
			if ($_SERVER["REQUEST_METHOD"] === 'POST') {
				$db = get_db();
				$query = [
					'login' => $_POST['login'],
					'password' => $hashpwd
				];
				$user = $db->users->findOne($query);
				if ($user) {					
					$tmp=$user['_id'];
					$_SESSION['username']=$tmp;
					echo "<br/>Zalogowany!\n";
					die('<a href="index.php">Wróć</a>');
				} else {
					echo "Niepoprawny login lub hasło!\n";
				}
			}
		}
		echo'
		<form method="post" action="login.php">
			login:<br/>
			<input type="text" size="32" name="login" value=""><br/>
			hasło:<br/>
			<input type="password" size="32" name="password" value=""><br/>
			<input type="submit" name="Zaloguj"><br/>
		</form>
<br/>';
		?>
	    <a href="index.php">Wróć</a>
    </p>
    </article>
</body>
</html>