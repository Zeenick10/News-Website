<?php

function con(){
    return mysqli_connect("localhost","root","","blog");
}

$info = array(
  "name" => "MMS IT",
  "short" => "MMS",
  "description" => "နည်းပညာ အခက်အခက်အခဲများ အတွက် MMS IT မှ ကူညီပေးလျှက်ရှိပါတယ်။ လူကြီးမင်းတို့၏ စီးပွာရေး လုပ်ငန်းများကိုနည်းပညာဖြင့် အဆင့်မြှင့်တင်နိုင်ဖို့ အခုပဲ ဆက်သွယ်လိုက်ပါ။",
);

$role = ['Admin','Editor','User'];

//$url = "http://{$_SERVER['HTTP_HOST']}/my_class/web_dev_7/4_basic_crud/blog";
$url = "http://{$_SERVER['HTTP_HOST']}/PHP-SHHZ/sample_blog/";

date_default_timezone_set('Asia/Yangon');