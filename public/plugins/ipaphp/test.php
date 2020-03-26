<?php
// require_once("./vendor/autoload.php");
include "./vendor/autoload.php";
include "./vendor/yunchuang/appstore-connect-api/src/Client.php";
// use yunchuang\AppStore\Client;
// use yunchuang\AppStore\Client;
use MingYuanYun\AppStore\Client;
$config = [
    'iss' => '69a6de95-3735-47e3-e053-5b8c7c11a4d1',
    'kid' => '7ZHWJ7UDZQ',
    'secret' => 'AuthKey_7ZHWJ7UDZQ.p8'
];
$client = new Client($config);

// get jwt auth token, expired after 20 minutes later
$token = $client->getToken();

// set request auth header
$headers = [
	'Authorization' => 'Bearer ' . $token,
];
$client->setHeaders($headers);


// query devices 通过
// $queryParams = [
//    'filter[platform]' => 'IOS',
//    'filter[status]' => 'ENABLED',
//    'filter[udid]' => '9be78daa0dbc12f3a95442caa164f36ab0b1ba47',
//    'limit' => 1
// ];
$devices = $client->api('device')->all();

#var_dump($devices);


// add device 通过
// $deviceName = 'testipa';
// $platform = 'IOS';
// $deviceUdid = '9be78daa0dbc12f3a95442caa164f36ab0b1ba47';
// $result = $client->api('device')->register($deviceName, $platform, $deviceUdid);
// var_dump($result);


// // query bundleId通过
// $params = [
//    'fields[bundleIds]' => 'identifier',
//    'filter[identifier]' => 'com.xx.xxx'
// ];
// $result = $client->api('bundleId')->all();
// var_dump($result);


// register bundleId通过
// $name = 'test';
// $platform = 'IOS';
// $bundleId = 'com.xxpennenfnef.test13';
// $result = $client->api('bundleId')->register($name, $platform, $bundleId);
// var_dump($result);


// // delete bundleId 通过
// $id = 'com.xxpennenfnef.test';
// $result = $client->api('bundleId')->drop($id);
// var_dump($result);


// // query capabilities of the bundleId 暂时没用
// $bid = 'xx';
// $params = [
//    'fields[bundleIdCapabilities]' => 'capabilityType'
// ];
// $result = $client->api('bundleId')->query($bid);


// // add capability for the bundleId  暂时没用
// $bid = 'xx';
// $capability = 'PUSH_NOTIFICATIONS';
// $result = $client->api('bundleIdCapabilities')->enable($bid, $capability);




// // create profile for the bundleId
$bId = 'A5PH32VNY4'; #这里不是bid，而是列表的id
$name = make_password(8);#每次不能重复
$profileType = 'IOS_APP_ADHOC';
$devices = [
    '24PJ644N2Z',
];
$certificates = [
    'PT8KWW5MM9'
];
$result = $client->api('profiles')->create($name, $bId, $profileType, $devices, $certificates);

var_dump($result['data']['attributes']['profileContent']);

$mobileprovision = base64_decode($result['data']['attributes']['profileContent']);
file_put_contents("b.mobileprovision",$mobileprovision);
// query profile
// $params = [
//    'filter[id]' => 'com.xxpennenfnef.test13',
// //    'fields[profiles]' => 'bundleId,createdDate,expirationDate,name,profileState,profileType,uuid,profileContent'
// ];
#$result = $client->api('profiles')->query();
// var_dump($result);


// /Users/zhigangyang/.fastlane/bin/bundle/lib/ruby/gems/2.2.0/gems/fastlane-2.128.1/sigh/lib/assets/resign.sh /Users/zhigangyang/\开\发/isign/tests/Test.ipa 4FE15E182EC8EAF7AD737197714D0822EED3E1D7 -p         /Users/zhigangyang/\开\发/isign/tests/Test.ipa
$output;
$cmd = "/Users/zhigangyang/.fastlane/bin/bundle/lib/ruby/gems/2.2.0/gems/fastlane-2.128.1/sigh/lib/assets/resign.sh /Users/zhigangyang/\开\发/isign/tests/Test.ipa 4FE15E182EC8EAF7AD737197714D0822EED3E1D7 -p   b.mobileprovision      /Users/zhigangyang/\开\发/isign/tests/Test.ipa";
exec($cmd,$output);
var_dump($output);
function make_password( $length = 8 )
{
    // 密码字符集，可任意添加你需要的字符
    $chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 
    'i', 'j', 'k', 'l','m', 'n', 'o', 'p', 'q', 'r', 's', 
    't', 'u', 'v', 'w', 'x', 'y','z', 'A', 'B', 'C', 'D', 
    'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L','M', 'N', 'O', 
    'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y','Z', 
    '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '!', 
    '@','#', '$', '%', '^', '&', '*', '(', ')', '-', '_', 
    '[', ']', '{', '}', '<', '>', '~', '`', '+', '=', ',', 
    '.', ';', ':', '/', '?', '|');
    // 在 $chars 中随机取 $length 个数组元素键名
    $keys = array_rand($chars, $length); 
    $password = '';
    for($i = 0; $i < $length; $i++)
    {
        // 将 $length 个数组元素连接成字符串
        $password .= $chars[$keys[$i]];
    }
    return $password;
}
