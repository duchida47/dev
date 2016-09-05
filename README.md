# strPng.php
入力された文字列をPNG画像に変換するPHPプログラムです。

1.使い方
  ウェブサーバ上に展開してブラウザから実行する方法と、コマンドから実行する方法の2通りあります。

  1.1.ブラウザから実行する
    1.1.1.ウェブサーバに配置したアドレスへアクセスする
          例: https://daisukeuchida.net/services/strPng.php

    1.1.2.表示されたページから、必要なパラメータを入力する
         ・文字列(tx)
         ・サイズ(s)
         ※直接URLパラメータを指定することも可能
         例: https://daisukeuchida.net/services/strPng.php?tx=変換文字列&s=16

  1.2.コマンドから実行する
    例: php strPng.php 変換文字列 16 > 出力ファイル名
