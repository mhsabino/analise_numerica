<?php 
class SimpsonRule {
	private $function;
	private $a;
	private $b;
	private $n;
	private $h;

	function __construct($function, $a, $b, $n, $rule) {
		$this->function = $function;
		$this->a = $a;
		$this->b = $b;
		$this->n = $n;
		$this->validateParams();
		$this->setH($rule);
	}

	public function simpsonWidespreadTrapezeRule() {
		$value = 0;

		for ($point = ($this->a + $this->h); $point < $this->b; $point = ($point + $this->h)) {
			$value = $value + $this->executeFunction($point);
		}

		$value = 2 * $value;
		$value = $value + $this->executeFunction($this->a) + $this->executeFunction($this->b);
		$value = ($this->h / 2) * $value;

		return abs($value);
	}

	public function simpsonWidespreadOneThirdRule() {
		$value = 0;

		$i = 0;
		for ($point = ($this->a + $this->h); $point < $this->b; $point = ($point + $this->h)) {
			if (($i % 2) == 0) {
				$value = $value + (4 * $this->executeFunction($point));
			} else {
				$value = $value + (2 * $this->executeFunction($point));
			}
			$i = $i + 1;
		}

		$value = $value + $this->executeFunction($this->a) + $this->executeFunction($this->b);
		$value = ($this->h / 3) * $value;

		return abs($value);
	}

	public function simpsonWidespreadThreeEighthsRule() {
		$value = 0;

		$i = 1;
		for ($point = ($this->a + $this->h); $point < $this->b; $point = ($point + $this->h)) {
			if (($i % 3) == 0) {
				$value = $value + (2 * $this->executeFunction($point));
			} else {
				$value = $value + (3 * $this->executeFunction($point));
			}
			$i = $i + 1;
		}

		$value = $value + $this->executeFunction($this->a) + $this->executeFunction($this->b);
		$value = $this->h * (3/8) * $value;

		return abs($value);
	}

	public function getFunctionPoints() {
		$data = array();	

		for ($point = $this->a; $point <= $this->b; $point = ($point + $this->h)) {
			$data[] = array("", $point, $this->executeFunction($point));
		}

		return $data;
	}	

	private function validateParams() {
		if ($this->n == 0) { 
			throw new Exception("A quantidade de intervalos 'n' não pode ser igual a zero e deve ser preenchido."); 
		}

		if ($this->a == '') {
			throw new Exception("O ponto inicial 'a' deve ser preenchido."); 
		}

		if ($this->b == '') {
			throw new Exception("O ponto final 'b' deve ser preenchido."); 
		}		

		if ($this->a > $this->b) { 
			throw new Exception("Intervalo incorreto: " . $this->a . " > " . $this->b); 
		}

		if (!($this->executeFunction($this->b))) {
			throw new Exception("Função incorreta: "); 
		}
	}

	private function executeFunction($value) {
		$f = str_replace('x', '$value', $this->function);
		return eval("return $f;");
	}	

	private function setH($rule) {
		if ($rule == '2') {
			$this->h = $this->h = ($this->b - $this->a) / (2 * $this->n);
		} else {
			$this->h = $this->h = ($this->b - $this->a) / $this->n;			
		}
	}	

}

?>