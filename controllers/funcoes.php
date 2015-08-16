<?php
require '../lib/phplot.php';
require '../models/Simpson.php';

$function = $_POST["funcao"];
$a 				= $_POST["a"];
$b 				= $_POST["b"];
$n 				= $_POST["n"];
$rule 		= $_POST["rule"];

$simpson = null;

try{
	$simpson = new SimpsonRule($function, $a, $b, $n, $rule);
}catch(Exception $e){
	echo "<p class='error'>Erro: " . $e->getMessage() . "</p><br>";
	echo "<img src='assets/images/default.jpeg'/>\n";		
	return;
}

$plot = new PHPlot(800, 600);
$plot->SetImageBorderType('plain');
$plot->SetPlotType('lines');
$plot->SetDataType('data-data');
$plot->SetLegend(array('f(x) = ' . $function));
$plot->SetXDataLabelPos('none');
$plot->SetYTickIncrement(0.5);
$plot->SetPrecisionY(1);
$plot->SetDrawXGrid(True);
$plot->SetDrawYGrid(True);
$plot->SetPrintImage(False); 
$plot->SetPrecisionX(1);

switch ($rule) {
	case '1':
		echo '<p class="success">Cálculo da área: ' . $simpson->simpsonWidespreadTrapezeRule() . "<p><br>";
		$plot->SetTitle('Regra de Simpson: Trapezio');
		$data = $simpson->getFunctionPoints();
		$plot->SetDataValues($data);		
		$plot->SetXTickIncrement(($b-$a)/$n);
		$plot->DrawGraph(); 
		echo "<img src=\"" . $plot->EncodeImage() . "\">\n";
		break;
	
	case '2':
		echo '<p class="success">Cálculo da área: ' . $simpson->simpsonWidespreadOneThirdRule() . "<p><br>";
		$plot->SetTitle('Regra de Simpson: 1/3');
		$data = $simpson->getFunctionPoints();
		$plot->SetDataValues($data);		
		$plot->SetXTickIncrement(($b-$a)/(2*$n));
		$plot->DrawGraph(); 
		echo "<img src=\"" . $plot->EncodeImage() . "\">\n";		
		break;

	case '3':
		echo '<p class="success">Cálculo da área: ' . $simpson->simpsonWidespreadThreeEighthsRule() . "<p><br>";
		$plot->SetTitle('Regra de Simpson: 3/8');
		$data = $simpson->getFunctionPoints();
		$plot->SetDataValues($data);		
		$plot->SetXTickIncrement(($b-$a)/$n);
		$plot->DrawGraph(); 
		echo "<img src=\"" . $plot->EncodeImage() . "\">\n";		
		break;

	default:
		echo '<p class="error">Cálculo da área: Nenhuma regra selecionada</p><br>';
		echo "<img src='assets/images/default.jpeg'>\n";	
		break;
}


?>