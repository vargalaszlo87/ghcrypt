<?php

/*	
 *	GHCrypt.php	
 *
 *			desc.:	This is a keyless encrypt/decrypt 
 *							algorithm for plain text.
 *
 *			usage:		
 *							$myCrypt = new GHCrypt();
 *							$p1 = $myCrypt -> enstring($test);
 *							$p2 = $myCrypt -> destring($p1);
 *
 *			author:		2022 vargalaszlo.com
 *			license:	GPLv3
 *			version:	1.13
 *			
 */

error_reporting(0);

class GHCrypt {
	
	 private 
		static
			$array;
		
	function __construct() {
		GHCrypt::$array = str_split(" !\"#$%&'()*+,-./0123456789:;<=>?@ABCDEFGHIJKL[\]^_`abcdefghijklmnopqrstuvwxyz{|}~");
	}	
	
	private function index($p1,$p2) {
		// string,array
		return array_search($p1,$p2)+1;
	}		
			
	private function group($p1,$p2) {
		//index,size
		return ($p1%$p2==0) ? $p1/$p2 : ($p1/$p2)-(($p1%$p2)/$p2)+1;
	}

	private function decto($p1) {
		$a1 = "0123456789abcdefghijklmnopqrst";
		return $a1[$p1];
	}	

	private function todec($p1) {
		$a1	= str_split("0123456789abcdefghijklmnopqrst"); // k
		return array_search($p1,$a1);
	}

	private function enchar($p1,$p2) {
		// str,array
		$v1 = sqrt(count($p2));
		$v2 = $this->group($this->index($p1,$p2),$v1);
		$v3 = $p2[(rand(0,$v1-1)*$v1)+($v2-1)]; 			
		$v4 = ($this->index($p1,$p2))-(($v2-1)*$v1); 				
		return $v3.$this->decto($this->group($this->index($v3,$p2),$v1)+$v4);
	}

	private function dechar($p1,$p2) {
		// str,array
		$v1 = sqrt(count($p2));
		$v2 = str_split($p1);
		$v3 = $this->todec($v2[0]);
		$v4 = ($this->index($v2[0],$p2))-((($this->group($this->index($v2[0],$p2),$v1))-1)*$v1);
		$v5 = ($this->todec($v2[1]))-($this->group($this->index($v2[0],$p2),$v1));
		return $p2[(($v4-1)*$v1)+$v5-1];
	}

	public function enstring($p1) {
		// str,array
		$v1 = null;
		$a1 = str_split($p1);
		foreach ($a1 as $v2)
			$v1 .= $this->enchar($v2,GHCrypt::$array);
		return $v1;
	}

	public function destring($p1) {
		// str,array
		$v1 = null;
		$a1 = str_split($p1,2);
		foreach ($a1 as $v2)
			$v1 .= $this->dechar($v2,GHCrypt::$array);
		return $v1;
	}
	
}

# test

$text = "follow the white rabbit...";

	$myCrypt = new GHCrypt();
	$encrypt = $myCrypt -> enstring($text);
	$decrypt = $myCrypt -> destring($encrypt);

	echo "Plain-text: ".$text."\n";
	echo "Crypted: ".$encrypt."\n";
	echo "Decrypted: ".$decrypt."\n";

unset($myCrypt);

?>