
		<form method="post" action="memo.php">
			<table>
				<tr>
				<?php
					session_start();
					if(isset($_SESSION['username']))
						echo'<a href="logout.php">Wyloguj</a><br/><br/>';
					else
						echo'<a href="register.php">Rejestracja</a>/<a href="login.php">logowanie</a><br/><br/>';
					include 'baza.php';
					$products = $db->products->find();
					$katalog = "watermark";
					$katalogminiaturki = "miniature";
					$galeria = opendir( $katalog );
					$i=0;
					while ( $zdjecie = readdir( $galeria ) ){					   
						$odczyt = pathinfo( $katalog.'/'.$zdjecie );
						if ( $odczyt['extension']  == 'jpg' || $odczyt['extension']  == 'png' || $odczyt['extension']  == 'jpeg'){
							$tmp=false;
							foreach ($products as $product) {
								if($product['name']==$zdjecie && isset($product['private']) && $product['private']!=$_SESSION['username']){
									$tmp=true;
									break;
								}
							}
							if($tmp)
								continue;
							echo '<td>';
							echo '<a href="'.$katalog.'/'.$zdjecie.'" class="highslide" onclick="return hs.expand(this)" title="Zdjęcie: '.$zdjecie.'"><img width="200" height="133" src="'.$katalogminiaturki.'/'.$zdjecie.'" alt="Zdjęcie: '.$zdjecie.'" /></a>';
							foreach ($products as $product) {
								if($product['name']==$zdjecie){
									echo '<br/>Autor: '.$product['author'] . '<br/>';
									echo 'Tytuł: '.$product['title'] . '<br/>';		
									if(isset($product['private']))
										echo'Prywatne';
									break;
								}
							}
							if(isset($_SESSION['galeria'][$zdjecie]))
								echo'<input type="checkbox" name="check_list[]" value="'.$zdjecie.'" checked>';
							else
								echo'<input type="checkbox" name="check_list[]" value="'.$zdjecie.'">';		
							echo '</td>';
							$i++;
							if($i%4==0)
								echo'</tr><tr>';
						}
					}
					closedir($galeria);
				?>
				</tr>
			</table>
			<input type="submit" value="Zapamiętaj wybrane">
		</form>