<?php
//DB Connect

$verbindung = mysql_connect ("localhost",
"resource", "taeghaiToh4oP")
or die ("keine Verbindung möglich.
 Benutzername oder Passwort sind falsch");

mysql_select_db("resource")
or die ("Die Datenbank existiert nicht.");



//Laden der XML vom Server
$xml = simplexml_load_file("http://www.resources-game.ch/exchange/kurseliste.xml") or die ("Error: Cannot create Object");

?>

<html>
	<head>
	 <meta charset="utf-8">
		<title>
			Resources Graph
		</title>
	</head>
	<body>
	<?php

    for($i=0;$i<57;$i++){

		$abfrage = "INSERT INTO `resource`.`material`(`mat_id`, `material_id`, `name`, `sm_wert`, `norm_wert`, `timestamp`)
VALUES (NULL,"." '".$xml-> ITEM[$i] -> ITEM_ID."' , '".$xml-> ITEM[$i] -> NAME_DE."', '".$xml-> ITEM[$i] -> SMKURS."', '".$xml-> ITEM[$i] -> NORMKURS."', '".$xml-> ITEM[$i] -> TS."');";
		$ergebnis = mysql_query($abfrage);
	}
	?>




<!-- Fabrikengewinn -->
<?php
//Array aller Gewinne der Fabriken
$fabrikname= array("Eisenhütte","Ziegelfabrik","Betonfabrik", "Aluminiumfabrik","Glasfabrik","Kunststofffabrik","Lithiumfabrik","Batterienfabrik","Waffenfabrik","Kupferfabrik","Ölraffinerie","Düngemittelfabrik","Insektizitfabrik","Siliziumfabrik","Goldfabrik","Schmuckfabrik");


// Wenn kein Angebot auf SM -> Dann Nachricht
$message0 =0;


//Stahl(1) 350€ 7 Erz 10 Kohle
$stahlpro=(7*$xml-> ITEM[10] -> SMKURS)+350+(10*$xml-> ITEM[25] -> SMKURS);
$stahlver=$xml-> ITEM[46] -> SMKURS;


if($stahlpro==0 OR $stahlver==0){
$stahlge=$message0;
}
else {
$stahlge=round(($stahlver-$stahlpro),0);
}


//Ziegel(2) 10€ 3 Lehm
$ziegelpro=(3*$xml->ITEM[31] ->SMKURS)+10;
$ziegelver=(2*$xml->ITEM[56]->SMKURS);
if($ziegelpro==0 OR $ziegelver==0){
$ziegelge=$message0;
}
else {
$ziegelge=round((($ziegelver-$ziegelpro)/2),0);
}


//Beton(14) 20€ 3 Kies 2 Kalk
$betonpro=(3*$xml->ITEM[24] ->SMKURS)+(3*$xml->ITEM[22] ->SMKURS)+20;
$betonver=(14*$xml->ITEM[7]->NORMKURS);
$betonge=round((($betonver-$betonpro)/14),0);



//Alluminium(4) 5000€ 24 Bauxit
$alupro=(24*$xml->ITEM[6] ->SMKURS)+5000;
$aluver=(4*$xml->ITEM[4]->SMKURS);
if($alupro==0 OR $aluver==0){
$aluge=$message0;
}
else {
$aluge=round((($aluver-$alupro)/4),0);
}


//Glas (8) 3000€ 6 Quarzsand 8 FossBrenn 4 Kalk
$glaspro=(6*$xml->ITEM[36] ->SMKURS)+(8*$xml->ITEM[14] ->SMKURS)+(4*$xml->ITEM[22] ->SMKURS)+3000;
$glasver=(8*$xml->ITEM[17]->SMKURS);
$glasge=round((($glasver-$glaspro)/8),0);



//Kunststoff (10) 1 ÖL 400€
$kunpro=(1*$xml->ITEM[39] ->SMKURS)+400;
$kunver=(10*$xml->ITEM[26]->SMKURS);
if($kunpro==0 OR $kunver==0){
$kunge=$message0;
}
else {
$kunge=round((($kunver-$kunpro)/10),0);
}



//Lithiumraffinerie (5) 115 Lithiumerz 5000€
$lizpro=(115*$xml->ITEM[33] ->SMKURS)+5000;
$lizver=(5*$xml->ITEM[32]->SMKURS);
if($lizpro==0 OR $lizver==0){
$lizge=$message0;
}
else {
$lizge=round((($lizver-$lizpro)/5),0);
}

//Batterienfabrik (10) 20 Lithium 40 Kunststoff 10 Alluminium 75000
$batpro=(20*$xml->ITEM[32] ->SMKURS)+(40*$xml->ITEM[26] ->SMKURS)+(10*$xml->ITEM[4] ->SMKURS)+75000;
$batver=(10*$xml->ITEM[5]->SMKURS);
if($batpro==0 OR $batver==0){
$batge=$message0;
}
else {
$batge=round((($batver-$batpro)/10),0);
}


//Waffenfabrik (25) 1 Stahl 1 Aluminium 1 Batterie 250000€
$wafpro=(1*$xml->ITEM[46] ->SMKURS)+(1*$xml->ITEM[4] ->SMKURS)+(1*$xml->ITEM[5] ->SMKURS)+250000;
$wafver=(25*$xml->ITEM[54]->SMKURS);
if($wafpro==0 OR $wafver==0){
$wafge=$message0;
}
else {
$wafge=round((($wafver-$wafpro)/25),0);
}

//Kupferfabrik (3) 9 Kupferkies 2500€
$kupfpro=(9*$xml->ITEM[29] ->SMKURS)+2500;
$kupfver=(3*$xml->ITEM[28]->NORMKURS);
if($kupfpro==0 OR $kupfver==0){
$kupfge=$message0;
}
else {
$kupfge=round((($kupfver-$kupfpro)/3),0);
}

//Ölraffinerie(4) 4 ÖL 150€
$olpro=(4*$xml->ITEM[39] ->SMKURS)+150;
$olver=(4*$xml->ITEM[14]->SMKURS);
if($olpro==0 OR $olver==0){
$olge=$message0;
}
else {
$olge=round((($olver-$olpro)/4),0);
}
//Düngemittel (11) 8 Kalkstein 90€
$dunpro=(8*$xml->ITEM[22] ->SMKURS)+90;
$dunver=(11*$xml->ITEM[9]->NORMKURS);
if($dunpro==0 OR $dunver==0){
$dunge=$message0;
}
else {
$dunge=round((($dunver-$dunpro)/11),0);
}

//Insektizide (35) 1 Kupfer 3 Kalkstein 2400
$inspro=(1*$xml->ITEM[28] ->NORMKURS)+(3*$xml->ITEM[22] ->SMKURS)+2400;
$insver=(8*$xml->ITEM[21]->NORMKURS);
if($inspro==0 OR $insver==0){
$insge=$message0;
}
else {
$insge=round((($insver-$inspro)/35),0);
}
//Silizium (2) 20 Quarz 1 Lehm 5 Fossile 49500
$silipro=(20*$xml->ITEM[36] ->SMKURS)+(1*$xml->ITEM[31] ->NORMKURS)+(5*$xml->ITEM[14] ->SMKURS)+49500;
$siliver=(2*$xml->ITEM[45]->SMKURS);
if($silipro==0 OR $siliver==0){
$silige=$message0;
}
else {
$silige=round((($siliver-$silipro)/2),0);
}
//Titan (4) 8 Ilmenit 10000
$titpro=(8*$xml->ITEM[20] ->SMKURS)+10000;
$titver=(4*$xml->ITEM[51]->SMKURS);
if($titpro==0 OR $titver==0){
$titge=$message0;
}
else {
$titge=round((($titver-$titpro)/4),0);
}

//Elektronik (8) 4 Kunst 3 Kupfer 1 Silizium  5000
$elepro=(4*$xml->ITEM[26] ->SMKURS)+(3*$xml->ITEM[28] ->NORMKURS)+(1*$xml->ITEM[45] ->SMKURS)+5000;
$elever=(8*$xml->ITEM[11]->NORMKURS);
if($elepro==0 OR $elever==0){
$elege=$message0;
}
else {
$elege=round((($elever-$elepro)/8),0);
}
//Medizintechnik (10) 4 Titan 2 Kunststoff 2 Elektronik 90000
$medpro=(4*$xml->ITEM[51] ->SMKURS)+(2*$xml->ITEM[26] ->SMKURS)+(2*$xml->ITEM[11] ->SMKURS)+90000;
$medver=(10*$xml->ITEM[34]->NORMKURS);
if($medpro==0 OR $medver==0){
$medge=$message0;
}
else {
$medge=round((($medver-$medpro)/10),0);
}



//Silber (50) 8 Silbererz 10000
$silpro=(8*$xml->ITEM[44] ->NORMKURS)+10000;
$silver=(50*$xml->ITEM[43]->NORMKURS);
if($silpro==0 OR $silver==0){
$silge=$message0;
}
else {
$silge=round((($silver-$silpro)/50),0);
}
//Gold (3) 20 Golderz 20000
$gopro=(20*$xml->ITEM[19] ->NORMKURS)+20000;
$gover=(3*$xml->ITEM[18]->SMKURS);
if($gopro==0 OR $gover==0){
$goge=$message0;
}
else {
$goge=round((($gover-$gopro)/3),0);
}
//Schmuck (2) 1000 Rohdiamanten  1 Gold 1 Silber 50000
$schpro=(1000*$xml->ITEM[38] ->SMKURS)+(1*$xml->ITEM[18] ->SMKURS)+(1*$xml->ITEM[43] ->NORMKURS)+50000;
$schver=(2*$xml->ITEM[42]->NORMKURS);
if($schpro==0 OR $schver==0){
$schge=$message0;
}
else {
$schge=round((($schver-$schpro)/2),0);
}
?>
<ul>
  <li><?php echo "Ziegel ".$ziegelge; ?></li>
  <li><?php echo "Stahl ".$stahlge; ?></li>
  <li><?php echo "Beton ".$betonge; ?></li>
  <li><?php echo "Alu ".$aluge; ?></li>
  <li><?php echo "Kunststoff ".$kunge; ?></li>
  <li><?php echo "Lithium ".$lizge; ?></li>
  <li><?php echo "Batterien ".$batge; ?></li>
  <li><?php echo "Kupfer ".$kupfge; ?></li>
  <li><?php echo "FossBrenn ".$olge; ?></li>
  <li><?php echo "Waffen ".$wafge; ?></li>
  <li><?php echo "Düngemittel ".$dunge; ?></li>
  <li><?php echo "Glas ".$glasge; ?></li>
  <li><?php echo "Insektizide ".$insge; ?></li>
  <li><?php echo "Schmuck ".$schge; ?></li>
  <li><?php echo "Gold ".$goge; ?></li>
  <li><?php echo "Silber ".$silge; ?></li>
  <li><?php echo "Medizintechnik ".$medge; ?></li>
  <li><?php echo "Titan ".$titge; ?></li>
  <li><?php echo "Elektronik ".$elege; ?></li>
  <li><?php echo "Silizium ".$silige; ?></li>
</ul>
<?php
$fabrikgewinn = array($stahlge,$ziegelge,$betonge,$aluge, $glasge, $kunge, $lizge,$batge, $wafge, $kupfge, $olge, $dunge, $insge, $silige, $titge, $elege, $medge, $silge,$goge,$schge);
$fabrikcount = count($fabrikgewinn);
$fabrikzeit = $xml->ITEM[0] ->TS;
for($i=0;$i<16;$i++){
$fabrikabfrage = "INSERT INTO `resource`.`fabrik`(`fid`, `name`, `gewinn`, `timestamp`) VALUES(NULL,'".$fabrikname[$i]."',".$fabrikgewinn[$i].",".$fabrikzeit.");";	
$fabrikergebnis = mysql_query($fabrikabfrage);
 }
?>	
	</body>
</html>
