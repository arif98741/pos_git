<?php
	function accessLog()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
		$cSession = curl_init(); 
		curl_setopt($cSession,CURLOPT_URL,"http://ip-api.com/json/".$ip);
		curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($cSession,CURLOPT_HEADER, false); 
		
		$result = curl_exec($cSession);
		
		curl_close($cSession);
		
		return json_decode($result);
		
    }
	

?>