<?php
header( 'content-type: text/html; charset=utf-8' );
ini_set('display_errors', 'off'); 
require_once './sources/meteoapi/OpenWeather.php';

    $ville="";
                        /* ici ça recupere la valeur de select exactement la liste deroulante*/
                        
                        if(!empty($_POST['dir'])){
                                
                                $ville= $_POST['dir']; 
                              
                              
                              
                        }else
                            $ville="France";

header('Content-type: text/html; charset=UTF-8'); ?>




<!DOCTYPE html>   
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
    <title>Développement web</title>
    
    <link rel="stylesheet" type="text/css" href="./style/style.css">
    <link rel="stylesheet" type="text/css" href="./style/carte_style.css">
    
    <meta charset="UTF-8"/>
    <style>
        footer{
            margin-top: 3%;
        }
    </style>

</head>

<body>
    <header id="haut_header">
        
        <div id="container_header">
            <div><h1>Météo de <br>France</h1></div>     
            <div><img
                    src="images/carte_france_png.PNG" 
                    alt="[france ]"/>
            </div>
            <div class="searchcity"> 
                <?php if (!empty($_GET['nom'])) {

                        $ville=$_GET['nom']; }?>

                <form action="./sources/meteoapi/meteo.php" method="get">
                    <p><input class="dd" type="text" name="nom" placeholder="   Météo pour ..."  />
                    <input class="bsubmit" type="submit" value="Recherche" /></p>
                </form>
            </div>
        </div>

        <nav>
            <ul>
                <li><a href="./index.php">Accueil</a></li>
                <li><a href="#Statistiques">Statistiques</a></li>
                <li><a href="./a.php">New</a></li>
               
<!--                 <li><a href="./sources/meteoapi/meteo.php">Meteo</a></li>
                <li><a href="./sources/meteoapi/meteocopie.php">new</a></li>
 -->          
            </ul> 
        </nav>
    </header>


   			<section>            	
 			<h3> Région  Fonctionnelle -> ILE DE FRANCE</h3>

 			<p> Affichage météo sur 5 jours (page d'acceuil)</p>
    		<p> Option d'affichage (vent,ressenti) </p>
    		<p> Choix d'affichage (6 heure,une journée, 3jours)</p>
			<p> Pages fonctionnelles validé avec "validator.w3.org" (0 erreurs)</p>
		          <p> Statistiques sur (une semaine,les 5 villes les plus visité , 1 mois (nb visiteurs-nb recherches méteo pour les derniers mois) )</p>
          
				        <h2>Merci de laisser vos remarques ci-dessous</h2>
          

			
           <form action="new.php" method="post"> 
						 		<?php  echo"Remarque" ?> :<br />
      <textarea name="message" id="message" cols="60" rows="8" ></textarea><br /> 
     <input type="hidden" name="pseudo" value="<? echo $pseudo?>"> 
      <input type="submit" value="Envoyer"/>
</form>

          <?php

            
          	$fichier= fopen('./sources/ftexts/remarqueprof.txt','c+b');
            //On écrit un premier texte dans notre fichier
            	$utilisateur= $_POST['user00'];
			    $pseudo= $_POST['pseudo'];
			    $message= $_POST['message'];
			 
			     $contenu = file_get_contents('exemple.txt');
			     $txt=$_POST['message'];
				 fwrite($fichier,$contenu."".$txt."\n");

          	 /*fwrite($fichier, 'juba');
             */ 
        ?>

    	</section>
    	

<?php	 require './include/footer.php' ?>
