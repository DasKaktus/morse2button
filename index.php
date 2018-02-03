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

}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Morse2Button</title>
	</head>
	<body>
		<h1 align="center">Omen dogtag solver</h1>
		<div style="display: inline-block; text-align: left">
			<h3>Map of Zeebrugge is at the bottom</h3>
			<h3> Step A: Acquire Infiltrator kit from the cabin of the docked ship near flag 'E</h3>
			<h3> Step B: Stand on top of the water tower at the opposite end of the map near flag 'A'</h3>
			<h3> Step C: Hold still, and record the Infiltrator's morse code</h3>
			<h3> Step D: Enter your morse code below and click submit</h3>
			<div align="center">
				<form method="post">
				<label for="morse" />Input water tower morse here:</label>
					<input type="text" placeholder="Enter morse" style="width: 400px;" name="morse" id="morse" value="" />
					<input type="submit" value="Submit" />
				</form>
				<form method="post">
				<label for="morse2" />Or enter translated morse here:</label>
					<input type="text" placeholder="Enter translated morse" style="width: 400px;" name="morse2" id="morse2" value="" />
					<input type="submit" value="Submit" />
				</form>
				<p></p>
			</div>
			<h3> Step E: Enter the machine room labeled '1' near flag 'C'</h3>
			<h3> Step F: Starting from the left-most machine, interact with the lights to enter your first sequence</h3>
			<h3> Step G: Enter the machine room labeled '3' near flag 'D'</h3>
			<h3> Step H: Starting from the left-most machine, interact with the lights to enter your first sequence</h3>
		</div>
		
		<div>
			<br /><br />
<?php
if($morse != ""){
	echo "<table><tr><td valign='top'>Morse translates to: " . str_replace(" ", "", $morse) . "<br />\n";
	//echo "Morse translates to: " . str_replace(" ", "", $morse) . "<br />\n";
	for ($i=0; $i<strlen($string); $i++) {
		$orgletter = $string[$i];
		$morseletter = $morse[$i-$morseshift];
		
		if($orgletter != $morseletter){
			$morseshift++;
			$missingletters.= $orgletter;
			$inputnumbers.= $numbers[$i];
		}
	}
	echo "Missing letters: " . $missingletters . "<br />\n";
	echo "Numbers: " . $inputnumbers . "<br />\n";
	echo "Combinations: <br />\n";
	$gg = false;
	for ($i=0; $i<strlen($inputnumbers); $i++) {
		$mm = $numbarr[$inputnumbers[$i]];
		echo $mm . "<br />\n";
		if($i == 4){$comp.="</tr><tr><td colspan='4'><h3>Building marked no.3</h3></td></tr><tr>"; $gg = true;}
		$comp.= "<td><strong>Machine " . ($gg ? ($i + 1 - 4) : ($i+1)) . "</strong><br />\n";
		for($a=0; $a<strlen($mm);$a++){
			$comp.= "Light " . ($a + 1) . ": " . ($mm[$a] == "." ? "on" : "off") . "<br />\n";
		}
		$comp.= "</td>";
	}
	echo "</td><td><table border='1'  cellpadding='2' ><tr><td colspan='4'><h3>Building marked no.1</h3></td></tr><tr>" . $comp . "</tr></table></td></tr></table>";
}
?>
		</div>
		<img src="img.png" />
		<div class="foot" align="center">
			by Kaktus and <a link="" rel="stylesheet" type="text/css" href="https://discord.gg/bfee">BFEE</a>
		  </div>
	</body>
</html>
