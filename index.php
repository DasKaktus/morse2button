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
<html lang="en">
	<head>
		<title>Morse2Button</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<style>
			#zeebruggeimg {
				border-radius: 5px;
				cursor: pointer;
				transition: 0.3s;
			}
			#zeebruggeimg:hover {opacity: 0.7;}
			.modal {
				display: none; /* Hidden by default */
				position: fixed; /* Stay in place */
				z-index: 1; /* Sit on top */
				padding-top: 100px; /* Location of the box */
				left: 0;
				top: 0;
				width: 100%; /* Full width */
				height: 100%; /* Full height */
				overflow: auto; /* Enable scroll if needed */
				background-color: rgb(0,0,0); /* Fallback color */
				background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
			}

			/* Modal Content (Image) */
			.modal-content {
				margin: auto;
				display: block;
				width: 80%;
				max-width: 700px;
			}

			/* Caption of Modal Image (Image Text) - Same Width as the Image */
			#caption {
				margin: auto;
				display: block;
				width: 80%;
				max-width: 700px;
				text-align: center;
				color: #ccc;
				padding: 10px 0;
				height: 150px;
			}

			/* Add Animation - Zoom in the Modal */
			.modal-content, #caption {
				animation-name: zoom;
				animation-duration: 0.6s;
			}

			@keyframes zoom {
				from {transform:scale(0)}
				to {transform:scale(1)}
			}

			/* The Close Button */
			.close {
				position: absolute;
				top: 15px;
				right: 35px;
				color: #f1f1f1;
				font-size: 40px;
				font-weight: bold;
				transition: 0.3s;
			}

			.close:hover,
			.close:focus {
				color: #bbb;
				text-decoration: none;
				cursor: pointer;
			}

			/* 100% Image Width on Smaller Screens */
			@media only screen and (max-width: 700px){
				.modal-content {
					width: 100%;
				}
			}
		</style>
	</head>
	<body>
		
		<div class="container">
			<div class="well">
				<center><h3>An Omen Dogtag solver</h3></center>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">Step-by-step guide</div>
				<div class="panel-body">
					<ul>
						<li>Step A: Acquire Infiltrator kit from the cabin of the docked ship near flag 'E</li>
						<li>Step B: Stand on top of the water tower at the opposite end of the map near flag 'A'</li>
						<li>Step C: Hold still, and record the Infiltrator's morse code</li>
						<li>Step D: Enter your morse code below and click submit</li>
						<li>Step E: Enter the machine room labeled '1' near flag 'C'</li>
						<li>Step F: Starting from the left-most machine, interact with the lights to enter your first sequence</li>
						<li>Step G: Enter the machine room labeled '3' near flag 'D'</li>
						<li>Step H: Starting from the left-most machine, interact with the lights to enter your first sequence</li>
					</ul>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">Morse input</div>
				<div class="panel-body">
					<div class="col-lg-6">
						<div class="input-group">
							<input type="text" class="form-control" id="morsetxt" placeholder="Enter morse">
							<span class="input-group-btn">
								<button class="btn btn-default" id="solvemorsebtn" type="button">Solve!</button>
							</span>
						</div>
						<div class="input-group">
							<input type="text" class="form-control" id="translatedmorsetxt" placeholder="Enter translated morse">
							<span class="input-group-btn">
								<button class="btn btn-default" id="solvetranslatedbtn" type="button">Solve!</button>
							</span>
						</div><br/>
						<div class="input-group">
							<span class="input-group-btn">
								<button class="btn btn-default" id="copysolution" type="button">Copy solution</button>
							</span>
						</div>
					</div>
				</div>
			</div>
			
			<div id="solutionpanel" class="panel panel-default" style="display: none;">
				<div class="panel-heading">Solution</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-6 col-md-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Morse translation</h3>
								</div>
								<div class="panel-body" id="solutiontranslation">						
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Missing letters</h3>
								</div>
								<div class="panel-body" id="solutionmissing">						
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Missing letter translation</h3>
								</div>
								<div class="panel-body" id="solutionmissingtranslation">						
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Combinations</h3>
								</div>
								<div class="panel-body" id="solutioncombination">
									<table class="table" id="solutioncombinationtable">
									</table>
								</div>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Machine configuration</h3>
								</div>
								<div class="panel-body" id="solutionmachine">
									<table class="table" id="solutionmachinetable">
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<img src="img.png" id="zeebruggeimg" alt="Map of Zeebrugge">
						<div class="caption">
							<h3>Map of Zeebrugge</h3>
							<p>This is a map of Zeebrugge for easy navigation.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div id="imgModal" class="modal">
			<span id="closemodal" class="close">&times;</span>
			<img class="modal-content" id="img01">
			<div id="caption">Map of Zeebrugge</div>
		</div>
		
	
	
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script>
			var selecttext = "";
			$(document).ready(function(){
				
				$(document).on("click", "#copysolution", function() {
					var element = $('<textarea>').appendTo('body').val(selecttext).select()
					document.execCommand('copy')
					element.remove();					
				});
				
				$(document).on("click", "#zeebruggeimg", function(){
					$("#imgModal").css("display", "block");
					$("#img01").attr("src", $("#zeebruggeimg").attr("src"));
					$("#caption").html($("#zeebruggeimg").attr("alt"));
				});
				
				$(document).on("click", "#closemodal", function(){
					$("#imgModal").css("display", "none");
				});
				
				$(document).on("click", "#solvemorsebtn", function(){
					postMorse("morse");
				});
				$(document).on("click", "#solvetranslatedmorsebtn", function(){
					postMorse("morse2");
				});
			});
			
			function postMorse(val){
				var datan = {};
				if(val == "morse"){
					datan["morse"] = $("#morsetxt").val();
				}else{
					datan["morse2"] = $("#translatedmorsetxt").val();
				}
				$.ajax( {
					type: "POST",
					url: "ajax.php",
					data: datan,
					dataType: "json",
					success: function(msg) {
						var combs = "";
						$("#solutioncombinationtable tr").remove();
						$("#solutionmachinetable tr").remove();
						$("#solutionpanel").css("display","");
						$("#solutiontranslation").html(msg.translation);
						$("#solutionmissing").html(msg.missing);
						$("#solutionmissingtranslation").html(msg.numbers);
						
						var comb = 1;
						var first = true;
						$.each(msg.combinations, function(i, item) {
							if(first){
								first = false;
								$("#solutioncombinationtable").append("<tr><td colspan='2' style='text-align:center;'><strong>Building 1</strong></td></tr>");
							}else{
								$("#solutioncombinationtable").append("<tr><td colspan='2'style='text-align:center;'><strong>Building 3</strong></td></tr>");
							}
							comb = 1;
							$.each(item, function(i2, item2) {
								$("#solutioncombinationtable").append("<tr><td>"+comb+"</td><td>"+item2+"</td></tr>");
								combs+=item2+"\n";
								comb++;
							});
						});
						first = true;
						$.each(msg.machines, function(i, item) {
							if(first){
								first = false;
								$("#solutionmachinetable").append("<tr><td colspan='2' style='text-align:center;'><strong>Building 1</strong></td></tr>");
							}else{
								$("#solutionmachinetable").append("<tr><td colspan='2' style='text-align:center;'><strong>Building 3</strong></td></tr>");
							}
							comb = 1;
							var machine = 1;
							$.each(item, function(i2, item2) {
								if(comb == 6){comb = 1; machine++;}
								if(comb == 1){
									$("#solutionmachinetable").append("<tr><td colspan='2'><strong>Machine "+machine+"</strong></td></tr>");
								}else{
									$("#solutionmachinetable").append("<tr><td>Light "+comb+"</td><td>"+item2+"</td></tr>");
								}
								comb++;

							});
						});
						
						selecttext = "Morse translates to: "+msg.translation+"\n";
						selecttext += "Missing letters:" + msg.missing + "\n";
						selecttext += "Numbers:" + msg.numbers + "\n";
						selecttext += "Combinations:\n";
						selecttext += combs;
						console.log(selecttext);
					}
				});
			}
		</script>
	</body>
</html>
