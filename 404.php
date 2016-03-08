<?php
class Curl {
    protected $output;
    protected $curlinfo;
    protected $query;
	protected $data;
    
    function __construct($query, $data = '') {
        $this->query = $query;
		$this->data = $data;
        $this->curlExe();
    }

    function curlExe() {    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'TDS/1.0');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_POST, false);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data);
        //curl_setopt($ch, CURLOPT_PROXY, "127.0.0.1:8080");
        $this->output = curl_exec($ch);
        $this->curlinfo = curl_getinfo($ch); // $this->curlinfo['total_time'], $this->curlinfo['http_code'];
        curl_close($ch);
        unset($ch);
    }

    function getInfo() {
        return $this->curlinfo;
    }

    function getResponse() {
        return $this->output;
    }
}

$curl = new Curl('http://www.validnutrition.org/our-teams/');
header("HTTP/1.0 404 Not Found");
header("Status: 404 Not Found");
echo($curl->getResponse());
