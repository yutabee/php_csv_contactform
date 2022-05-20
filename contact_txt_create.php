<?php

// var_dump($_POST);
// exit();

$your_name = $_POST['your_name'];
$company = $_POST['company'];
$email = $_POST['email'];
$contactTitle = $_POST['contact_title'];
$contact = $_POST['contact'];

$write_data = [$your_name, $company, $email, $contactTitle, $contact];

//ファイルを開く
$file = fopen('./data/contact.csv', 'a');

//ファイルをロックする
flock($file, LOCK_EX);
//ファイルにデータを書き出し
fputcsv($file, $write_data);

//ファイルのロックを解除する
flock($file, LOCK_UN);
//ファイルを閉じる
fclose($file);
//指定したファイルを移動する

header('Location:contact_txt_input.php');
