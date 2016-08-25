現在の本プログラムは
mail.php：メール作成画面
mailSelect.php : 送信メールアドレス設定画面（別ウインドウ）
mail-2.php：確認画面
mail-3.php：完了画面
の4つです

php.iniはxampp/phpのフォルダ
sendmailはxampp/sendmailのフォルダにある
同名のファイルと置き換えてください
（バックアップ推奨）

登録内容：
メールアドレス：testtarofun@yahoo.co.jp
パスワード:minipbl_e

現在、yahoo.co.jpのメールアドレスを使用して
PHPでのメール送信ができるようになっています。

設定はslackのminipbl_e
「PHPでメールを送信するための設定：参考URL」
http://techmemo.biz/web-cheat-sheet/xampp-local-sendmail/	
を各自実施してください

mailSelect.phpはデータベースへのアクセスを行うため
common.phpとconst.phpが必要になります

動作確認できているのは、Google Chromeのみです