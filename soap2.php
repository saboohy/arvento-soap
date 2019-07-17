<?php
	$param = array(
		'soap_version'=>SOAP_1_1,
		'exceptions'=>true,
		'trace'=>1,
		'cache_wsdl'=>WSDL_CACHE_NONE,
	);
	$log = array(
		'Username' => 'abagroup',
		'PIN1' => '2303',
		'PIN2' => '2303',
		'Language' => '0'
	);
	try {
		$soap = new SoapClient('http://ws.arvento.com/v1/report.asmx?wsdl',$param);
		$rap = $soap ->GetVehicleStatus($log)->GetVehicleStatusResult->any;
		$array = array(json_decode(json_encode($rap),true));
		$xml = simplexml_load_string($array['0'], 'SimpleXMLElement');
		$arrayXML = json_decode(json_encode($xml),true);
		foreach($arrayXML['tblVehicleStatus']['dtVehicleStatus'] as $civiler){
			echo 'Cihaz: '.$civiler['Cihaz_x0020_No'].'<br>';
			echo 'Tarix: '.$civiler['GMT_x0020_Tarih_x002F_Saat'].'<br>';
			echo 'Enlem: '.$civiler['Enlem'].'<br>';
			echo 'Boylam: '.$civiler['Boylam'].'<br>';
			echo 'Suret: '.$civiler['Hız'].'<br>';
			echo 'Adres: '.$civiler['Adres'].'<br>';
			echo 'Bolge: '.$civiler['Bina_x0020__x002F__x0020_Bölge'].'<hr>';
		}
		print_r($arrayXML);
	}catch (Exception $e) {
		echo $e->getMessage();
	}
?>
