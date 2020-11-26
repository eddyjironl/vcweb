<?php
	class saludo extends PHPUnit_Framework_TestCase{
		private $pcmsg;
		
		public function _construct($pcmsg1){
			$this->pcmsg = $pcmsg1;
		}
		public function testsayhola(){
			return $this->pcmsg;
		}
	}

	$persona = new saludo("Tu madre");
	echo "Primera prueba Unitaria";
	$persona->testsayhola();
	
?>