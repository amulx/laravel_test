<?php 

    $xml_data = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<orderImportRequest version="0.1" login="288923ka"  password="4578dfjk289818k">
    <orders>
        <order sequence="1">
            <clientCode>NIKE</clientCode>
            <clientReferenceNumber>45989283488</clientReferenceNumber>
            <branch>Shanghai Department</branch>
            <shipFrom>
                <companyName>Yaburo</companyName>
                <postcode>204574</postcode>
                <address>Hongkong SuperAdres</address>
                <loading>false</loading>
                <contact>
                    <name>Jimmis</name>
                    <phone>3321506</phone>
                    <phoneAreaCode>22</phoneAreaCode>
                    <mobile>78456985478</mobile>
                    <email>jimmis@yahoo.com</email>
                </contact>
                <locationRemarks>adgrewer</locationRemarks>
                <timeWindow>2</timeWindow>
                <weekdays>2</weekdays>
            </shipFrom>
            <shipTo>
                <companyName>Bonodo</companyName>
                <postcode>320178</postcode>
                <address>Bedryko SuperAdres</address>
                <loading>true</loading>
                <contact>
                    <name>Jimmis</name>
                    <phone>3321506</phone>
                    <phoneAreaCode>22</phoneAreaCode>
                    <mobile>78456985478</mobile>
                    <email>jimmis@yahoo.com</email>
                </contact>
                <locationRemarks>benrets</locationRemarks>
                <timeWindow>4</timeWindow>
                <weekdays>1</weekdays>
            </shipTo>
            <timeSchedule>
                <pickupDate>2012-12-23</pickupDate>
                <deliveryDate>2012-12-26</deliveryDate>
            </timeSchedule>
            <orderLines>
                <orderLine>
                    <cargoDescription>
                        <productCode>CODE</productCode>
                        <productName>trousers</productName>
                        <unitType>4</unitType>
                        <unitLength>1</unitLength>
                        <unitWidth>2</unitWidth>
                        <unitHeight>1</unitHeight>
                        <unitWeight>10</unitWeight>
                    </cargoDescription>
                    <quantity>211</quantity>
                </orderLine>
                <orderLine>
                    <externalId>SKIRTS</externalId>
                    <quantity>55</quantity>
                    <customFields>
                        <customText1>nike</customText1>
                        <customNum1>42.0978
                        </customNum2>
                        <customEnum2>LARGE_CARTON</customEnum2>
                    </customFields>
                </orderLine>
            </orderLines>
            <cargoDetails>
                <totalQuantity>266</totalQuantity>
                <totalWeight>9000</totalWeight>
                <totalVolume>23</totalVolume>
                <cargoType>1</cargoType>
                <packageType>A</packageType>
            </cargoDetails>
            <transportMode>
                <transportType>FTL</transportType>
                <truckType>2</truckType>
                <transportRemarks>these are remarks</transportRemarks>
                <truckLength>4.2</truckLength>
            </transportMode>
            <revenue>
                <lineHaul>11.11</lineHaul>
                <baseRateDescription>line revenue</baseRateDescription>
                <other>11.11</other>
                <otherFeesDescription>other revenue</otherFeesDescription>
            </revenue>
            <cost>
                <lineHaul>22.22</lineHaul>
                <baseRateDescription>line cost</baseRateDescription>
                <other>22.22</other>
                <otherFeesDescription>other cost</otherFeesDescription>
            </cost>
            <vendorCode>SH00103</vendorCode>
        </order>
        <order sequence="2">
            <clientCode>NIKE</clientCode>
            <clientReferenceNumber>45989283489</clientReferenceNumber>
            <erpNumber>989384892089883984</erpNumber>
            <branch>Tokyo Department</branch>
            <shipFromExternalId>HARBIN001</shipFromExternalId>
            <shipTo>
                <companyName>Shanghai Corp</companyName>
                <town>上海市</town>
                <address>Nankin Road 782</address>
                <loading>true</loading>
                <contact>
                    <name>Jimmis</name>
                    <phone>3321506</phone>
                    <phoneAreaCode>22</phoneAreaCode>
                    <mobile>78456985478</mobile>
                    <email>jimmis@yahoo.com</email>
                </contact>
                <locationRemarks>benrets</locationRemarks>
                <timeWindow>4</timeWindow>
                <weekdays>1</weekdays>
            </shipTo>
            <timeSchedule>
                <pickupDate>2012-12-24</pickupDate>
                <deliveryDate>2013-01-02</deliveryDate>
            </timeSchedule>
            <cargoDetails>
                <totalWeight>9000</totalWeight>
                <totalVolume>24.1</totalVolume>
                <cargoType>2</cargoType>
                <packageType>C</packageType>
            </cargoDetails>
            <transportMode>
                <transportType>LTL</transportType>
                <truckType>1</truckType>
            </transportMode>
        </order>
    </orders>
</orderImportRequest> ';
$url = 'https://demo.otms.cn/ws/orderImport';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data);
    // curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $output = curl_exec($ch);

    if (curl_errno($ch)) {  print curl_error($ch); }
    else {  curl_close($ch); }  // $data contains the result of the post...

    echo $output;

?>