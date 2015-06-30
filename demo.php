<?php
require 'Version.class.php';

$version = '2.7.1';

$obj = new Version();

// 版本转数字
$version_code = $obj->version_to_integer($version);
echo $version_code.'<br>';  // 20701

// 数字转版本
$version = $obj->integer_to_version($version_code);
echo $version.'<br>'; // 2.7.1

// 检查版本
$version = '1.1.a';
var_dump($obj->check($version)); // false

// 比较两个版本
$version1 = '2.9.9';
$version2 = '10.0.1';

$result = $obj->compare($version1, $version2);
echo $result; // -1
?>