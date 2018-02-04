<?php
$string = "DULCEETDECORUMESTPROPATRIAMORI";
$numbers = "237177027124397900420304539245";
$morseshift = 0;
$morse = "";
$missingletters = "";
$inputnumbers = "";
$buttonstate = "";

$comp = "";

$numbarr = array(
	"0" => "-----",
	"1" => ".----",
	"2" => "..---",
	"3" => "...--",
	"4" => "....-",
	"5" => ".....",
	"6" => "-....",
	"7" => "--...",
	"8" => "---..",
	"9" => "----."
);

if(isset($_POST["morse"]) && $_POST["morse"] != ""){

	require('morse.php');
	$MorseCodeTranslator = new MorseCodeTranslator();

	//-.. ..- .-.. . . - -.. --- .-. ..- -- ... .--. --- .--. - .. .- -- --- .-. ..
	$morse = $MorseCodeTranslator->morseToLatin($_POST["morse"]);

}else if(isset($_POST["morse2"]) && $_POST["morse2"] != ""){

	require('morse.php');
	$MorseCodeTranslator = new MorseCodeTranslator();

	//-.. ..- .-.. . . - -.. --- .-. ..- -- ... .--. --- .--. - .. .- -- --- .-. ..
	//$morse = $MorseCodeTranslator->morseToLatin($_POST["morse"]);
	$morse = str_replace(" ", "", $_POST["morse2"]);

}else{
	echo json_encode(array("status" => "nomorse"));
	die();
}



$comb = array("building1" => array(), "building3" => array());
$machine = array("building1" => array(), "building3" => array());

for ($i=0; $i<strlen($string); $i++) {
	$orgletter = $string[$i];
	$morseletter = $morse[$i-$morseshift];
	
	if($orgletter != $morseletter){
		$morseshift++;
		$missingletters.= $orgletter;
		$inputnumbers.= $numbers[$i];
	}
}

for ($i=0; $i<strlen($inputnumbers); $i++) {
	$mm = $numbarr[$inputnumbers[$i]];
	if($i < 4){
		array_push($comb["building1"], $mm);
		for($a=0; $a<strlen($mm);$a++){
			array_push($machine["building1"], ($mm[$a] == "." ? "on" : "off"));
		}
	}else{
		array_push($comb["building3"], $mm);
		for($a=0; $a<strlen($mm);$a++){
			array_push($machine["building3"], ($mm[$a] == "." ? "on" : "off"));
		}
	}
}

if(strlen($missingletters) != 8){
	echo json_encode(array("status" => "wrongmorse"));
	die();
}

$retarr = array();
$retarr["status"] = "ok";
$retarr["translation"] = str_replace(" ", "", $morse);
$retarr["missing"] = $missingletters;
$retarr["numbers"] = $inputnumbers;
$retarr["combinations"] = $comb;
$retarr["machines"] = $machine;
	
echo json_encode($retarr);
?>