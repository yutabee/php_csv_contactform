<?php

$array = array();

// ファイルを開く（読み取り専用）
$file = fopen('./data/contact.csv', 'r');
// ファイルをロック
flock($file, LOCK_EX);


if ($file) {
  while ($line = fgetcsv($file)) {
    array_push($array, $line);
  }
}

// ロックを解除する
flock($file, LOCK_UN);
// ファイルを閉じる
fclose($file);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <title>contact</title>
</head>

<body>
  <a href="contact_txt_input.php">お問い合わせ入力フォーム</a>
  <br>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">name</th>
        <th scope="col">company</th>
        <th scope="col">email</th>
        <th scope="col">titile</th>
        <th scope="col">contact</th>
      </tr>
    </thead>
    <tbody id="outputArea"></tbody>
  </table>

  <script>
    const array = <?= json_encode($array) ?>;
    console.log(array);
    const Objs = array.map(x => ({
      yourName: x[0],
      company: x[1],
      email: x[2],
      contact_title: x[3],
      contact: x[4]
    }));
    console.log(Objs);

    let outText = '';
    for (Obj of Objs) {
      outText +=
        `
      <tr>
        <td>${Obj.yourName}</td>
        <td>${Obj.company}</td>
        <td>${Obj.email}</td>
        <td>${Obj.contact_title}</td>
        <td>${Obj.contact}</td>
      </tr>
      `
    };
    const outputArea = document.getElementById('outputArea');
    outputArea.innerHTML = outText;
  </script>
</body>

</html>