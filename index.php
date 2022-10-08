<!-- 
-- ΣΗΜΕΙΩΣΕΙΣ --
- Η διαχείρηση των κουμπιών γίνεται μέσω Javascript, αλλά οι πράξεις γίνονται αποκλειστικά με Php.
- Οι επιπλέον μαθηματικοί υπολογισμοί εμφανίζονται μέσω ενός κουμπιού στο πλάι.
 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
	<script type="text/javascript" src="script.js"></script>
    <title>Calculator</title>
</head>
<body>
		<div class="calc-container">
			<div class="scientific-panel" id="scientificPanel">
				<button onclick="MoveScientificPanel()" id="scientificButton">&sect;</button>
				<div class="panel-buttons">
					<button onclick="SpecialCharacter('^')"	class="btn-power">x<sup>2</sup></button>
					<button onclick="SpecialCharacter('v')"	class="btn-root">&radic;<sub>x</sub></button>
					<button onclick="SpecialCharacter('/x')" class="btn-divby">1/x</button>
					<button onclick="SpecialCharacter('|')" class="btn-absolute">|x|</button>
					<button onclick="SpecialCharacter('e')" class="btn-factorial">e<sup>x</sup></button>
				</div>	
			</div>
			<div class="calc-body">
				<form class="screen" id="form" action="" method="POST">
					<input type="text" name="num1" id="num1" value="<?php PostHandler("num1"); ?>" readonly>
					<input type="text" name="symbol" id="symbol" value="<?php CheckPrevTemp(); ?>" readonly>
					<input type="text" name="screen" id="screenText" value="<?php PostHandler("screen"); ?>" readonly>
					<input type="hidden" name="temp" id="temp" value="" readonly>
					<input type="hidden" name="special" id="special" value="" readonly>
				</form>
				<button onclick="RandomNumber()" class="btn-random">R</button>
				<button onclick="ClearScreen()" class="btn-ce">CE</button>
				<button onclick="ClearForm()" class="btn-c">C</button>
				<button onclick="Backspace()" class="btn-backspace">&lArr;</button>
				<button onclick="SubmitForm()" class="btn-equal">&equals;</button>
				<button onclick="SpecialCharacter('%')" class="btn-percent">&percnt;</button> 
				<button onclick="AddToScreen('/')" class="btn-divide">&divide;</button>
				<button onclick="AddToScreen('*')" class="btn-multiply">&times;</button>
				<button onclick="AddToScreen('-')" class="btn-subtract">&minus;</button>
				<button onclick="AddToScreen('+')" class="btn-add">&plus;</button>
				<button onclick="AddToScreen('.')" class="btn-dot">.</button>
				<button onclick="AddToScreen(1)" class="btn-one">1</button>
				<button onclick="AddToScreen(2)" class="btn-two">2</button>
				<button onclick="AddToScreen(3)" class="btn-three">3</button>
				<button onclick="AddToScreen(4)" class="btn-four">4</button>
				<button onclick="AddToScreen(5)" class="btn-five">5</button>
				<button onclick="AddToScreen(6)" class="btn-six">6</button>
				<button onclick="AddToScreen(7)" class="btn-seven">7</button>
				<button onclick="AddToScreen(8)" class="btn-eight">8</button>
				<button onclick="AddToScreen(9)" class="btn-nine">9</button>
				<button onclick="AddToScreen(0)" class="btn-zero">0</button>
			</div>
		</div>
<?php
		// HANDLE POST INFORMATION

		function PostHandler($input_tag)
		{
			$n1 = isset($_POST["num1"]) ?  $_POST["num1"] : '';
			$n2 = isset($_POST["screen"]) ?  $_POST["screen"] : '';
			$temp = isset($_POST["temp"]) ? $_POST["temp"] : '';
			$symbol = isset($_POST["symbol"]) ?  $_POST["symbol"] : '';
			$special = isset($_POST["special"]) ?  $_POST["special"] : '';

			// check division by zero
			if($n2==0 && ($symbol=='/' || $special=='/x'))
			{
				if ($input_tag == "num1")
				{
					echo "Cannot divide by zero";
					$_POST["temp"] = "";
					return;
				}
				else if ($input_tag == "screen")
				{
					echo "";
					return;
				}
			}

			// check if no operation is needed
			if($input_tag == "screen")
			{
				if($n1 == "" && $n2 == "")
				{
					echo "";
					return;
				}
				else if($n1 == "" && $special == "")
				{
					echo $n1;
					return;
				}
				else if($n2 == "")
				{
					echo $n1;
					return;
				}
			}
			
			// if user ended operation with a symbol
			if ( ($input_tag == "num1" && $temp == '') || ($input_tag == "screen" && $temp != '') )
			{
				echo "";
				return;
			}
			
			// special operations
			if($special!="")
			{
				Calculate("", $n2, $special);
			}
			// regular operations
			else if($n2!='')
			{
				Calculate($n1, $n2, $symbol);
			}
			else
			{
				echo "";
			}
		}


		// MATH
		
		function Calculate($n1, $n2, $operation)
		{
			switch ($operation)
			{
				case "+":
					$result = $n1+$n2;
					break;
				case "-":
					$result = $n1-$n2;
					break;
				case "*":
					$result = $n1*$n2;
					break;
				case "/":
					$result = $n1/$n2;
					break;
				case "^":
					$result = pow($n2,2);
					break;
				case "v":
					$result = sqrt($n2);
					break;
				case "/x":
					$result = 1/$n2;
					break;
				case "%":
					$result = $n2/100;
					break;
				case "|":
					$result = abs($n2);
					break;
				case "e":
					$result = exp($n2);
					break;
				default:
					$result = "error";
					break;
			}

			echo round($result,7);
		}

		// CHECK FOR TEMPORARY SYMBOL

		function CheckPrevTemp()
		{
			if(isset($_POST["temp"]) && $_POST["temp"]!='')
			{
				echo $_POST["temp"];
			}
		}
?>
</body>
</html>