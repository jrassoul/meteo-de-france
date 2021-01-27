<?php header('Content-type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html>   
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
    <title>Développement web</title>
    
    <link rel="stylesheet" type="text/css" href="../../style/region.css">
    <link rel="stylesheet" type="text/css" href="../../style/style.css">
    <link rel="stylesheet" type="text/css" href="../../style/carte_style.css">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
        footer{
            margin-top: 3%;
        }


    </style>
</head>
<body>
    <header id="haut_header">
        
        <div id="container_header">
            <div><h1>Météo de<br>France</h1></div>     
            
            <div><img
                    src="../../images/carte_france_png.PNG" 
                    alt="[france ]"/>
            </div>
            
            <div class="searchcity"> 
                <?php if /*(!empty($_POST['nom'])) {
                        $ville=$_POST['nom'];}*/
                     /*   elseif */(!empty($_GET['nom'])) {
                                $ville=$_GET['nom'];
                            }    
                        ?>

            <form action="meteo.php" method="get" >
            <p><input class="dd" type="text" name="nom" placeholder="   Météo pour ..."  />
            <input class="bsubmit" type="submit" value="Recherche" /></p>
            </form>
        </div>
        
        

        </div>

            <nav>
        <ul>
            <li><a href="../../index.php">Accueil</a></li>
            <li><a href="#Statistiques">Statistiques</a></li>
           
            
        </ul>
    </nav>
    </header>


