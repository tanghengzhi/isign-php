# appstore connect api

> unoffical sdk for appstore connect api. *currently partially*

[see detail](https://developer.apple.com/documentation/appstoreconnectapi)


## install

```
composer require yunchuang/appstore-connect-api
```

## example
```php

use MingYuanYun\AppStore\Client;

$config = [
    'iss' => 'xx-xx-xx-xx-xxx',
    'kid' => 'xx',
    'secret' => '/path/to/private.p8'
];

$client = new Client($config);

// get jwt auth token, expired after 20 minutes later
$token = $client->getToken();

// set request auth header
$headers = [
	'Authorization' => 'Bearer ' . $token,
];
$client->setHeaders($headers);


// query devices
$queryParams = [
   'filter[platform]' => 'IOS',
   'filter[status]' => 'ENABLED',
   'filter[udid]' => '9be78daa0dbc12f3a95442caa164f36ab0b1ba47',
   'limit' => 1
];
$devices = $client->api('device')->all($queryParams);


// add device
$deviceName = 'test';
$platform = 'IOS';
$deviceUdid = '9be78daa0dbc12f3a95442caa164f36ab0b1ba47';
$result = $client->api('device')->register($deviceName, $platform, $deviceUdid);


// query bundleId
$params = [
   'fields[bundleIds]' => 'identifier',
   'filter[identifier]' => 'com.xx.xxx'
];
$result = $client->api('bundleId')->all($params);


// register bundleId
$name = 'test';
$platform = 'IOS';
$bundleId = 'com.xx.test';
$result = $client->api('bundleId')->register($name, $platform, $bundleId);


// delete bundleId
$id = 'xx';
$result = $client->api('bundleId')->drop($id);


// query capabilities of the bundleId
$bid = 'xx';
$params = [
   'fields[bundleIdCapabilities]' => 'capabilityType'
];
$result = $client->api('bundleId')->query($bid);


// add capability for the bundleId
$bid = 'xx';
$capability = 'PUSH_NOTIFICATIONS';
$result = $client->api('bundleIdCapabilities')->enable($bid, $capability);

// query profile
$params = [
   'filter[id]' => 'xx',
   'fields[profiles]' => 'bundleId,createdDate,expirationDate,name,profileState,profileType,uuid,profileContent'
];
$result = $client->api('profiles')->query($params);

// create profile for the bundleId
$bId = 'xx';
$name = 'mdev3';
$profileType = 'IOS_APP_DEVELOPMENT';
$devices = [
    'xx1', 'xx2', 'xx3'
];
$certificates = [
    'xx1'
];
$result = $client->api('profiles')->create($name, $bId, $profileType, $devices, $certificates);
```


## remark

- the profile content is base64 encoded, so you should base64 decode firstly, and then save as xxx.mobileprovision.
