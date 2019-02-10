<?php

/*
*   @author:    Ali Yılmaz
*   @github:    https://github.com/aliyilmaz
*/

class ipscanner
{
	private $wait  = 1;
	private $limit = 5;
	private $oneip = '0.0.0.0';
	private $twoip = '255.255.255.255';
	private $oneipDigit;
	private $twoipDigit;

	public function __construct()
	{
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		ini_set('max_execution_time', 0);
		date_default_timezone_set('Europe/Istanbul');
		foreach (array_merge($_POST, $_GET) as $name => $value) {
			$this->post[$name] = $value;
		}
		echo $this->ipController();

	}
	/*ip control, ip generate and send multicURL*/
	private function ipController() {	

		if(!ctype_digit($this->post['limit'])) {
			$this->post['limit'] = $this->limit;
		}
		if(!ctype_digit($this->post['wait'])) {
			$this->post['wait'] = $this->wait;
		}
		if(!filter_var($this->post['oneip'], FILTER_VALIDATE_IP) === TRUE){
			$this->post['oneip'] = $this->oneip;
		} 
		if(!filter_var($this->post['twoip'], FILTER_VALIDATE_IP) === TRUE){
			$this->post['twoip'] = $this->twoip;
		} 

		$this->oneipDigit = ip2long($this->post['oneip']); 
		$this->twoipDigit = ip2long($this->post['twoip']); 

	
		if($this->twoipDigit > $this->oneipDigit){
			// if Second ip address is big.
		} elseif ($this->twoipDigit == $this->oneipDigit) {
			// if addresses are the same.
		} elseif($this->oneipDigit > $this->twoipDigit) {
			// if irst address is big.
			$x = $this->post['twoip'];
			$this->post['twoip'] = $this->post['oneip'];
			$this->post['oneip'] = $x;
		}
		
		$this->oneipDigit = ip2long($this->post['oneip']); 
		$this->twoipDigit = ip2long($this->post['twoip']); 

		list($aa, $bb, $cc, $dd) = explode('.', $this->post['oneip']);
		$list = array();
		for ($a=$aa; $a <= 255; $a++) { 
			for ($b=$bb; $b <= 255; $b++) { 
				for ($c=$cc; $c <= 255; $c++) { 
					for ($d=$dd; $d <= 255; $d++) { 
						if ($a.'.'.$b.'.'.$c.'.'.$d == $this->post['twoip']) {
							$list[] = $a.'.'.$b.'.'.$c.'.'.$d;
							$this->cURLconnection($list);
							unset($list);
							die('-complete!');
						} elseif($this->post['limit'] > count($list)){
							$list[] = $a.'.'.$b.'.'.$c.'.'.$d;
						} elseif ($this->post['limit'] == count($list)) {
							$list[] = $a.'.'.$b.'.'.$c.'.'.$d;
							$this->cURLconnection($list);
							unset($list); $list = array();
						}						
						$dd = 0;
					}
					$cc = 0;
				}
				$bb = 0;
			}
			$aa = 0;
		}		
		$this->cURLconnection($list);
		unset($list); $list = array();
	}

	/*multicURL with array send*/
	private function cURLconnection($ip){

		$mh = curl_multi_init();
		foreach($ip as $key => $value){
			$ch[$key] = curl_init($value);
			curl_setopt($ch[$key], CURLOPT_TIMEOUT, 1);
			curl_setopt($ch[$key], CURLOPT_HEADER, 0);
			curl_setopt($ch[$key], CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch[$key], CURLOPT_BINARYTRANSFER, 1);
			curl_setopt($ch[$key], CURLOPT_TIMEOUT, $this->post['wait']);
			curl_setopt($ch[$key], CURLOPT_VERBOSE, 0);
			curl_multi_add_handle($mh,$ch[$key]);
		}
		do {
		  curl_multi_exec($mh, $running);
		  curl_multi_select($mh);
		} while ($running > 0);
		$date = date('d_m_Y_H_i_s');
		foreach(array_keys($ch) as $key){
			$httpcode = curl_getinfo($ch[$key], CURLINFO_HTTP_CODE);
			$data = array(
					'date' 		=> $date,
		  			'ipaddress' => $ip[$key]
		  		);

			$this->seperator($data, $httpcode);

			unset($data);
			curl_multi_remove_handle($mh, $ch[$key]);
		}
		curl_multi_close($mh);
		
	}

	/*special functions can be used*/
	private function seperator($data, $httpcode){
		$xdata = '';
		switch ($httpcode) {
			case '200':
				$xdata = $data;
			break;
			case '302':
				$xdata = $data;
			break;
			default:
				$xdata = $data;
			break;
		}
		if(!empty($xdata)){
			$this->write($xdata, $httpcode.'.txt');
		}
	}

	/*write*/
	private function write($x, $y) {
		if(is_array($x)){
			$content 		= implode(':',$x);
		} else {
			$content 		= $x;
		}
		if(isset($content)){
	        $writedb 		= fopen($y, "a+");
	        fwrite($writedb, $content . "\r\n");
	        fclose($writedb);
		}
    }
}

new ipscanner();