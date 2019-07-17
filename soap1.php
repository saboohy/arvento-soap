<?php
	$param = array(
		'soap_version'=>SOAP_1_1,
		'exceptions'=>true,
		'trace'=>1,
		'cache_wsdl'=>WSDL_CACHE_NONE,
	);
	$log = array(
		'Username' => 'username',
		'PIN1' => 'pin1',
		'PIN2' => 'pin2',
		'Compress' => '1'
	);
	try {
		$soap = new SoapClient('http://ws.arvento.com/v1/report.asmx?wsdl',$param);
		$rap = $soap ->BuildingListReport($log)->BuildingListReportResult->any;	
		$array = array(json_decode(json_encode($rap),true));
		//-------------------------------------------------------------------------
		$xml = simplexml_load_string($array['0'], 'SimpleXMLElement');
		$arrayXML = json_decode(json_encode($xml),true);
		$tablolar = $arrayXML['NewDataSet']['Table1']['0'];
		foreach($arrayXML['NewDataSet']['Table1'] as $tablo){
			echo '<table border="1" style="margin-bottom:10px;">
				<tr>
					<td>ObjectID</td>
					<td>'.$tablo['ObjectID'].'</td>
				</tr>
				<tr>
					<td>ObjectName</td>
					<td>'.$tablo['ObjectName'].'</td>
				</tr>
				<tr>
					<td>CenterX</td>
					<td>'.$tablo['CenterX'].'</td>
				</tr>
				<tr>
					<td>CenterY</td>
					<td>'.$tablo['CenterY'].'</td>
				</tr>
				<tr>
					<td>Radius</td>
					<td>'.$tablo['Radius'].'</td>
				</tr>
				<tr>
					<td>CreatedBy</td>
					<td>'.$tablo['CreatedBy'].'</td>
				</tr>
				<tr>
					<td>DateCreated</td>
					<td>'.$tablo['DateCreated'].'</td>
				</tr>
			</table>';
		}
		// -----------------------------------------------------------------------------
		echo '<pre>';
		print_r($arrayXML);
		echo '</pre>';
	}catch (Exception $e) {
		echo $e->getMessage();
	}
?>
