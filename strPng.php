<?php
if($argv[1] != "" && $argv[2] != "") {
    $_GET['tx'] = $argv[1];
    $_GET['s'] = $argv[2];
}
else if($argv[0] != '') {
    echo "Usage: php strPng.php Strings Size > OutputFilename\n";
    return;
}
if($_GET['tx'] == '' || $_GET['s'] == '') {
?>
<html><head><title>文字列画像変換</title><meta charset="utf-8"><meta name="viewport" content="width=device-width"></head><body>
<form action="./strPng.php" method="GET">
<table><tr><td>文字列</td><td><input type="text" name="tx" size="20" ></td></tr>
<tr><td>サイズ</td><td><input type="text" name="s" size="4" ></td></tr>
<tr><td colspan="2"><input type="submit" value="変換" ></td></tr></table>
</form>
</body></html>
<?php
}
else {
  header("Content-type: image/png");

  $sizex = 240;
  $sizey = 320;
  $scale = 1;

  $im = imagecreatetruecolor($sizex, $sizey);
  $red  = imagecolorallocate($im, 255, 0, 0);
  $white = imagecolorallocate($im, 255, 255, 255);
  $grey  = imagecolorallocate($im, 128, 128, 128);
  $black = imagecolorallocate($im, 0,   0,   0);
  imagefilledrectangle($im, 0, 0, $sizex - 1, $sizey - 1, $white);

  $text = mb_convert_encoding("文字列", "UTF-8", "auto");

  if($_GET['tx'] != "") {
    $text = str_replace("\\","",mb_convert_encoding(urldecode($_GET['tx']), "UTF-8", "auto"));

    if(mb_check_encoding(urldecode($_GET['tx']), "SJIS") && !mb_check_encoding(urldecode($_GET['tx']), "UTF-8")) {
      $text = str_replace("\\","",mb_convert_encoding(urldecode($_GET['tx']), "UTF-8", "SJIS"));
    }
  }

  $font = 'FS-Mincho.ttf';
  $textlenArray = imagettfbbox($_GET['s'], 0, $font, $text);
  imagedestroy($im);
  $im = imagecreatetruecolor(($textlenArray[2]-$textlenArray[6]) +12, ($textlenArray[3]-$textlenArray[7]) +16);
  $red  = imagecolorallocate($im, 255, 0, 0);
  $white = imagecolorallocate($im, 255, 255, 255);
  $grey  = imagecolorallocate($im, 128, 128, 128);
  $black = imagecolorallocate($im, 0,   0,   0);
  imagefilledrectangle($im, 0, 0, ($textlenArray[2]-$textlenArray[6]) +11, ($textlenArray[3]-$textlenArray[7]) +15, $white);

  imagettftext($im, $_GET['s'], 0, 3, ($textlenArray[3]-$textlenArray[7]), $black, $font, $text);

  imagepng($im);
  imagedestroy($im);
  }
?>