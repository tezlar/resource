<html>
<head>

<title> 
Startseite
</title>
<link rel="stylesheet" href="/css/styletab.css">
<style>


#drawers div { display:none; }

ul li{
    list-style: none; 
    margin: 0; 
    padding: 5;
    border: 0;
    width: 768px;
    background-color: #E0E0E0 ;
    color:black;

}
#drawers .headline {
  color: #084B8A;
  font-weight: bold;
  font-size: 22px;
}
ul li:hover{
  background-color: #E8E8E8 ;
  color:black;
}
ul {
  list-style: none; 
    margin: 0; 
    padding: 0;
    border: 0;  
}
h5{
  padding-bottom: 5px;
  padding-left:0;
  padding-right:0;
  padding-top:0;
  margin:0;
  font-weight:normal;
}
#quickstart li{
  display: inline;
  padding: 5px;
  text-align: center;
}
#quickstart li a{
  text-decoration: none;
  padding: 5px;
  color: black;
}
#quickstart li a:hover{
  background-color:#084B8A;
  color:white;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
  <div id="maincontent">
<h2>
Resources - whatever
</h2>



<!-- Fundgegenstände -->

<?php
$xml = simplexml_load_file("http://www.resources-game.ch/exchange/kurseliste.xml") or die ("Error: Cannot create Object");

$fundgegenstaende = array ("Alte Reifen", "Altglas", "Altmetall", "Altöl", "Drohnenwrack", "Fossilien", "Elektronikschrott","Kunststoffschrott", "Kupfermünzen","Riesendiamant","Römische Münzen","Techupgrade 1","Techupgrade 2","Techupgrade 3","Techupgrade 4");
$produkte = array ("Aluminium","Batterien","Beton","Düngemittel", "Elektronik", "Glas", "Gold","Kunststoffe", "Kupfer","Lithium","Medizintechnik","Schmuck","Silizium","Silber","Stahl","Titan", "Waffen", "Ziegel");
$rohstoffe = array ("Bauxit", "Eisenerz", "Golderz","Ilmenit","Kalkstein","Kies", "Kohle","Kupferkies","Lehm","Lithiumerz","Quarzsand","Rohdiamanten","Rohöl","Silbererz");
$fundcount = count($fundgegenstaende);
$prodcount = count($produkte);
$rohcount  = count($rohstoffe);
?>
<ul id="quickstart">
  <li><a href="#roh">Rohstoffe</a></li>
  <li><a href="#pro">Produkte</a></li>
  <li><a href="#fund">Fundgegenstände</a></li>
 </ul>

<ul id="drawers">
  <?php 
  echo "<li class='headline' id='roh'> Rohstoffe </li>";
  for ($i=0; $i < $rohcount; $i++) { 
  echo "<li><h5>".$rohstoffe[$i]."</h5>"."<div><img src='".$rohstoffe[$i].".svg'></div></li>";
  }
  echo "<li class='headline' id='pro'> Produkte </li>";
  for ($i=0; $i < $prodcount; $i++) { 
  echo "<li><h5>".$produkte[$i]."</h5>"."<div><img src='".$produkte[$i].".svg'></div></li>";
  }

  echo "<li class='headline' id='fund'> Fundgegenstände </li>";
  for ($i=0; $i < $fundcount; $i++) { 
  echo "<li><h5>".$fundgegenstaende[$i]."</h5>"."<div><img src='".$fundgegenstaende[$i].".svg'></div></li>";
  }
  ?>
</ul>
<script type="text/javascript">
$('#drawers').find('h5').click(function(){
    $(this).next().slideToggle();
    $("#drawers div").not($(this).next()).slideUp();
});
</script>

</div>
<p>
<a href="http://resource.arcturus.uberspace.de/resources_graph.php " target="_blank"> Hole Einträge und schreibe in DB </a>
</p>
<p>
 </p>
 <ausgabe class="infobox">
    <section id="zweitage">
        <h2><a href="#zweitage">2 Tage</a></h2>
        <p>Hier stehen ganz allgemeine Informationen.</p>
    </section>
    <section id="total">
        <h2><a href="#total">Gesamtübersicht</a></h2>
        <p>Hier stehen Informationen zu den Funktionen</p>
    </section>
    <section id="fabrik">
        <h2><a href="#fabrik">Fabriken</a></h2>
        <p>Hier stehen Informationen zu den Preisen.</p>
    </section>
</article>
</body>
</html>
