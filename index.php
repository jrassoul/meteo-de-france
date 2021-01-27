<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

// On s'amuse à créer quelques variables de session dans $_SESSION


$o = fopen("sources/ftexts/nbrecherchejuba.txt","r");
$l = fgets($o); 
$l=intval($l);

fclose($o);


if(empty($_SESSION['nbrecherchde'])) {
    $_SESSION['nbrecherche']=$l;
}



// le contenu de votre cookie
if (empty($_COOKIE['temporisation'])) {
    setcookie("temporisation", '20min', time()+900);
}




/*setcookie('pseudo', 'M@teo21', time() + 365*24*3600);
*/

?>

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
        footer
        {
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
                            $_SESSION['nbrecherche']+=1;
                                $o = fopen("./sources/ftexts/nbrecherchejuba.txt","r+w");
                                ftruncate($o,0);
                                fwrite($o,$_SESSION['nbrecherche']);
                                fclose($o);
                              
                        $ville=$_GET['nom']; 
                        }?>

                <form action="./sources/meteoapi/meteo.php" method="get">
                    <p><input class="dd" type="text" name="nom" placeholder="   Météo pour ..."  />
                    <input class="bsubmit" type="submit" value="Recherche" /></p>
                </form>
            </div>
        </div>

        <nav>
            <ul>
                <li><a href="./index.php">Accueil</a></li>
                <li><a href="./sources/statistiques/statistiques.php">Statistiques</a></li>
                <li><a href="./new.php">New</a></li>
                
               
<!--                 <li><a href="./sources/meteoapi/meteo.php">Meteo</a></li>
                <li><a href="./sources/meteoapi/meteocopie.php">new</a></li>
 -->          
            </ul> 
        </nav>
    </header>


    


      <div class="containerindex">
      	<div class="contenu">
			<div class="map">		
				<div class="map-image">
					<h3 id="cartenom">CARTE DE FRANCE</h3>	

  <!-- Generator: Adobe Illustrator  Carte de france en SVG -->
        <?php require './include/carte_svg/carte_de_france.svg'; ?>  
    	        </div>
    		</div>
    	</div>

    

    


            <div class="articleindex">
              
                    <?php               

                    $weather=new OpenWeather('c67a9b3b60c0c6e938ef3afb74b787dc');
                    $forcast = $weather->getForcast($ville.',fr');
                    ?>
            
        
        <!-- Information general de la meteo -->
            <h5 style="font-weight: normal;"> <?php echo $_SESSION['derniere']; ?> Prochains jours</h5>
            <h3 style="margin-bottom:0px; background-color: #f7f7f7; padding-left: 5px; padding-right: 5px; width: 280px;"><?=$ville ?></h3>

                    <!-- Traitement de l'API soustraction d'information API -->
                    <?php     
                        require './include/tableau_conversion_fr.php';  
                    $rep="peu importe";
                        $jourss=0;
                        $trheure=0;
                        $rep1=0;
                        $temperature=0;
                        $diviseurtemp=0;
                        $moyennetemperature=0;
                        $j=0;
                        
                        $temperature1=0;
                        $temperature2=0;
                        $temperature3=0;
                        $temperature4=0;
                        $temperature5=0;
                        $diviseurtemp1=0;
                        $diviseurtemp2=0;
                        $diviseurtemp3=0;
                        $diviseurtemp4=0;
                        $diviseurtemp5=0;
                            $d01=0;
                            $d02=0;
                            $d03=0;
                            $d04=0;
                            $d05=0;
                            $d10=0;
                            $d09=0;
                            $nb2=0;

                        foreach ($forcast as $hour): 
                        
                      # decouper la date et l'heure  
                        $date = date_create(substr($hour['date'], 0,10)); 
                        $heure = substr($hour['date'], 10,3)."h";
                        $ressenti = $hour['ressenti'];
                        $logometeo= $hour['logometeo'];
                        $icongeneral='<img style="height: 40px;width: 40px; " src="./images/icon/'.$logometeo.'.png" alt="texte" />';
                        $description = $hour['description'];     
                        $temp=$hour['temp'];
                            
                            if (!empty($temp)) {
                                        
                            if ($rep !== date_format($date, 'd-m-Y')) {     
                                $dateexpld=explode(" ",strftime("%A %d %B %G", strtotime(date_format($date, 'd-m-Y'))));
                                $jours[]=$jour[ $dateexpld[0]]." ".$dateexpld[1]." ".$mois[$dateexpld[2]]." ".$dateexpld[3];
                                /* affichage par rapport au bouttons radio */
                                        $joursSemaine[$j]=$jour[ $dateexpld[0]];
                                        /*echo $joursSemaine[$j];
                                    */                          
                                        
                                            # code...
                                            
                                        /*La moyenne des temperature -> temperature d'une journée*/
                                        $valval=0;
                                        for ($i=0; $i <5 ; $i++) { 
                                            $h=$i+1;
                                        if ($j===$h) {
                                        
                                        echo '<table style="background-color: #f7f7f7; padding-left:5px; padding-right:5px; width:290px;" >';
                                        echo '<tr>';
                                        $joursSemaine[0]="Aujourd'hui";
                                        echo '<td style="width:130px">'.$joursSemaine[$i].'</td>';

                                            for ($i=0; $i <6 ; $i++) { 
                                                # code...
                                            
                                                if ($d01>$d02) {
                                                    $valval="01d";
                                                    $valm=$d01;
                                                }else{
                                                    $valm=$d02;
                                                    $valval="02d";  
                                                }
                                                if ($valm<$d03) {
                                                    $valval="03d";
                                                    $valm=$d03;
                                                }
                                                if ($valm<$d04) {
                                                    $valval="04d";
                                                    $valm=$d04;
                                                }
                                                if ($valm<$d10) {
                                                    $valval="10d";
                                                    $valm=$d10;
                                                }
                                                if ($valm<$d09) {
                                                    $valval="09d";
                                                    $valm=$d09;
                                                }

                                            }
                                        echo '<td style="width:100px"><img style="height: 25px;width: 25px;" src="./images/icon/'.$valval.'.png" alt="texte" /></td>';
                                        
                                        switch ($h) {
                                            case 1:
                                                echo '<td>'.round($temperature1/$diviseurtemp1).'°</td>';
                                                break;
                                            case 2:
                                                echo '<td>'.round($temperature2/$diviseurtemp2).'°</td>';                                           
                                                break;
                                            case 3:
                                                echo '<td>'.round($temperature3/$diviseurtemp3).'°</td>';
                                                break;
                                            case 4:
                                                echo '<td>'.round($temperature4/$diviseurtemp4).'°</td>';
                                                break;
                                            case 5:
                                                echo '<td>'.round($temperature5/$diviseurtemp5).'°</td>';

                                                break;              
                                            default:
                                                # code...
                                                break;
                                        }
                                        echo '</tr>';
                                        echo '</table>';
                                        
                                        }

                                        }
                                                                        

                                        
                                            

                                        

                                        $j++;   
                                        $jourss="je veux juste que j'affiche la premiere ligne comme (Aujourdhui)";     
                                        $rep1++;                            
                            
                            }}else{
                                if ($nb2===0) {
                                    echo "Oops!!! Merci de bien renseigner votre ville";
                                    $nb2=1;
                                }
                                
                            }

                            # recherche le nombre de logo meteo qui apparaît le plus dans la journée 
                            for ($i=0; $i <5 ; $i++) { 
                                # code...
                                if ($j===$i) {
                                            if ($logometeo==="01d" || $logometeo==="01n") {
                                                        $d01++;
                                            }
                                            if ($logometeo==="02d" || $logometeo==="02n") {
                                                        $d02++;
                                                }
                                            if ($logometeo==="03d" || $logometeo==="03n") {
                                                            $d03++;
                                                }
                                            if ($logometeo==="04d" || $logometeo==="04n") {
                                                        $d04++;
                                            }
                                            if ($logometeo==="10d" || $logometeo==="10n") {
                                                        $d10++;

                                            }
                                            if ($logometeo==="09d" || $logometeo==="09n") {
                                                        $d09++;
                                                }
                                    }
                            }
                                        
        #Pour la  Moyenne de la temperature de la journée  
                            switch ($j) {
                                case 1:
                                    $temperature1+=(int)$temp;
                                    $diviseurtemp1++;       
                                    break;
                                case 2:
                                    $temperature2+=(int)$temp;
                                    $diviseurtemp2++;       
                                    break;          
                                case 3:
                                    $temperature3+=(int)$temp;
                                    $diviseurtemp3++;
                                    break;
                                case 4:
                                    $temperature4+=(int)$temp;
                                    $diviseurtemp4++;
                                    break;
                                case 5:
                                    $temperature5+=(int)$temp;
                                    $diviseurtemp5++;
                                    break;          
                                default:
                                    # code...
                                    break;
                            }
                            $rep = date_format($date, 'd-m-Y');
                    ?>
                    <!-- Affichage des information de la meteo -->                      
           
    
                <?php endforeach ?>
            
            <form  action="index.php" method="get" >
            <p><input class="dd" type="text" name="nom" placeholder="   Choisir une ville..."  />
            <input class="bsubmit" type="submit" value="Recherche" /></p>
            </form> 

            
        </div>
 
</div>
        
<!--         <p>aaa</p><br>
 -->
   <?php

//-- Fonction de récupération de l'adresse IP du visiteur
        $serv=$_SERVER['REMOTE_ADDR'];
        $content = file_get_contents('./sources/ftexts/visitetemporaire.txt');
        $find = $serv."sddqsdfsdfgdddffd";
        $pos = strpos($content, $find);
        if ($pos === FALSE) {
            $varv="pastrouve";
        } else {
            $varv="trouve";
        }        

        if ($varv==="pastrouve") {
            $fichier= fopen('./sources/ftexts/visitetemporaire.txt','a+');
                //On écrit un premier texte dans notre fichier         
                 /*$contenu = file_get_contents('exemple.txt');*/
                 $txt=$find;
                 fwrite($fichier,$contenu."".$txt."\n");             
        }
        
        $fileLines=file("./sources/ftexts/visitetemporaire.txt");
        $total= count($fileLines);
        

        $totaltempvisteur+=$total;

        fclose($fichier);

        if (empty($_COOKIE['temporisation'])) {
                $z = fopen("./sources/ftexts/nbvisiteurjuba.txt","r");
                $n = fgets($z); 
                $n =intval($n);

                $totalvisteur=$totaltempvisteur+$n;
                fclose($z);


                $z = fopen("./sources/ftexts/nbvisiteurjuba.txt","r+w");
                fwrite($z,$totalvisteur);
                fclose($z);


                $y= fopen("./sources/ftexts/visitetemporaire.txt","r+w");
                ftruncate($y,0);
                setcookie("temporisation", 'jubatemps', time()+900);    
                fclose($y);
                
                }
        
        $z = fopen("./sources/ftexts/nbvisiteurjuba.txt","r");
                $n = fgets($z); 
                $n =intval($n);

        $nbrecherche = $_SESSION['nbrecherche'];


/*
        echo "Nombre de visiteur:".$n.": ".$totaltempvisteur."<br>";
        echo " Nombre de recherche: ".;
    */
        /*    $tab = file('../www/include/data/villes.txt');
            $der_ligne =$tab[count($tab)-1];
            echo $der_ligne; */
            
    

    $content = file_get_contents('./sources/ftexts/departement.txt');
        $find = "Saône-et-Loire";
        $pos = strpos($content, $find);
        if ($pos === FALSE) {
            echo "<br>";
            echo "pas trouve";

        } else {
            echo "<br>";
            echo "trouve";

        }

     /*   $fichier = file("./sources/ftexts/departement.txt");
        // Nombre total de ligne du fichier
        $total = count($fichier);

        for($i = 0; $i < $total; $i++) {
        // On affiche ligne par ligne le contenu du fichier
        // avec la fonction nl2br pour ajouter les sauts de lignes
        $vardep=strtoupper(nl2br($fichier[$i]));

        $file = fopen("./sources/ftexts/departementmaj.txt", "a");
                fwrite($file , $vardep);
                fclose($file); 

    }*/
?>




 <?php   require 'include/footer.php'; ?>

