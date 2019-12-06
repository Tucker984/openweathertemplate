<?php
$apiKey = '--api-key-here--';
$station = '--your-wu-station-id-here';
/*
stdClass Object
(
    [observations] => Array
        (
            [0] => stdClass Object
                (
                    [stationID] => IONTARIO226
                    [obsTimeUtc] => 2019-03-26T22:14:58Z
                    [obsTimeLocal] => 2019-03-26 18:14:58
                    [neighborhood] => Komoka Village
                    [softwareType] => Cumulus v1.9.4
                    [country] => CA
                    [solarRadiation] => 257
                    [lon] => -81.43488312
                    [realtimeFrequency] => 
                    [epoch] => 1553638498
                    [lat] => 42.95424271
                    [uv] => 0
                    [winddir] => 360
                    [humidity] => 35
                    [qcStatus] => 1
                    [metric] => stdClass Object
                        (
                            [temp] => 5
                            [heatIndex] => 5
                            [dewpt] => -9
                            [windChill] => 4
                            [windSpeed] => 5
                            [windGust] => 21
                            [pressure] => 1030.27
                            [precipRate] => 0
                            [precipTotal] => 0
                            [elev] => 243
                        )

                )

        )

)*/
   $STRopts = array(
	  'ssl'=>array(
	  'method'=>"GET",
	  'protocol_version' => 1.1,
    'verify_peer' => false,
	  'header'=>"Cache-Control: no-cache, must-revalidate\r\n" .
				"Cache-control: max-age=0\r\n" .
				"Connection: close\r\n" .
				"User-agent: Mozilla/5.0 (quake-json.php - saratoga-weather.org)\r\n" .
				"Accept: application/ld+json\r\n"
	  )
	);
	
$STRcontext = stream_context_create($STRopts);
$url = "https://api.weather.com/v2/pws/observations/current?stationId=$station&format=json&units=m&apiKey=$apiKey";

$json_string = file_get_contents($url,false,$STRcontext);
$parsed_json = json_decode($json_string);
//print_r($parsed_json);

//observations
$observation_stationID = $parsed_json->{'observations'}[0]->{'stationID'};
$observation_obsTimeUtc = $parsed_json->{'observations'}[0]->{'obsTimeUtc'};
$observation_TimeLocal = $parsed_json->{'observations'}[0]->{'obsTimeLocal'};
$observation_neighborhood = $parsed_json->{'observations'}[0]->{'neighborhood'};
$observation_softwareType = $parsed_json->{'observations'}[0]->{'softwareType'};
$observation_country = $parsed_json->{'observations'}[0]->{'country'};
$observation_solarRadiation = $parsed_json->{'observations'}[0]->{'solarRadiation'};
$observation_lon = $parsed_json->{'observations'}[0]->{'lon'};
$observation_realtimeFrequency = $parsed_json->{'observations'}[0]->{'realtimeFrequency'};
$observation_epoch = $parsed_json->{'observations'}[0]->{'epoch'};
$observation_lat = $parsed_json->{'observations'}[0]->{'lat'};
$observation_uv = $parsed_json->{'observations'}[0]->{'uv'};
$observation_winddir = $parsed_json->{'observations'}[0]->{'winddir'};
$observation_humidity = $parsed_json->{'observations'}[0]->{'humidity'};
$observation_qcStatus = $parsed_json->{'observations'}[0]->{'qcStatus'};
//metric
$observation_temp = $parsed_json->{'observations'}[0]->{'metric'}->{'temp'};
$observation_heatIndex = $parsed_json->{'observations'}[0]->{'metric'}->{'heatIndex'};
$observation_dewpt = $parsed_json->{'observations'}[0]->{'metric'}->{'dewpt'};
$observation_windChill = $parsed_json->{'observations'}[0]->{'metric'}->{'windChill'};
$observation_windSpeed = $parsed_json->{'observations'}[0]->{'metric'}->{'windSpeed'};
$observation_windGust = $parsed_json->{'observations'}[0]->{'metric'}->{'windGust'};
$observation_pressure = $parsed_json->{'observations'}[0]->{'metric'}->{'pressure'};
$observation_precipRate = $parsed_json->{'observations'}[0]->{'metric'}->{'precipRate'};
$observation_precipTotal = $parsed_json->{'observations'}[0]->{'metric'}->{'precipTotal'};
echo "The weather at Station ${observation_stationID} ${observation_neighborhood} Ontario, Canada ${observation_TimeLocal}:<br />
Temperature is ${observation_temp} C&deg;<br />
The heat index is ${observation_heatIndex} C&deg; and the windchill ${observation_windChill} C&deg;.  The dewpoint is at ${observation_dewpt} C&deg;.<br />
Wind is from ${observation_winddir} degrees at ${observation_windSpeed} kph with gusts of ${observation_windGust} kph.<br />
The barometric pressure is ${observation_pressure} MB. There  has been ${observation_precipTotal} mm rain so far.<br />
The solar radiation is ${observation_solarRadiation} W/m<sup>2</sup> and UV index is ${observation_uv}.
\n";
?>
