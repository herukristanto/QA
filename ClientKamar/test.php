<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php

    $nomsk = 0;


    for ($i=1; $i < 5; $i++) {
      $masuk = $nomsk + $i;
      echo "$masuk";
      echo "<br>";
    }


    $bdgNo1 = 0;
    $bdgNo2 = 4;


    if ($bdgNo1 < $bdgNo2) {
      echo "Masuk Antrian Slip";

    }else {
      echo "Masuk Antrian";
    }
?>

  </body>
</html>
