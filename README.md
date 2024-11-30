# anime_station　
<img width="1440" alt="2024-10-30" src="https://github.com/user-attachments/assets/a748c9d0-f5e8-44e7-b511-f3af084e8432">


## 概要
このシステムでは、YouTubeで投稿した動画作品を管理して、視聴、いいねを押すことができる動画作品投稿管理システムです。

作品の登録から編集、削除を行うことができ、各ユーザーが投稿した動画作品を閲覧することができます。

制作期間：１ヶ月（レスポンシブ非対応）

## 主な機能
- ログイン・ログアウト機能
- プロフィール画面
- アカウント情報登録、編集、削除機能
- 動画作品一覧画面
- 動画作品投稿登録、編集、削除機能
- 動画作品視聴画面
- 動画作品検索機能
- いいね機能
- アカウント管理一覧画面
- アカウント管理編集、削除機能（管理者アカウントのみ）

## 開発環境
```
PHP 8.2.0 
MySQL 8.0.35 
Laravel 10.48.22
```
## 設計書
[設計書ページへ](https://drive.google.com/drive/folders/1YgAsX0wfnoFdUEcnnU-STgbtIhC9oclf?usp=drive_link)

## システム閲覧
[サービスのページへ](https://anime-station-8a4665b10849.herokuapp.com)

## テストアカウント情報
```
メールアドレス : rtm96N95@gmail.com
パスワード : rtm96N95
```
## 開発経緯
既存の動画投稿サイトで作品投稿をしても、その他ジャンルの動画が混在しており、作品の品質管理が保てないと感じていました。さらに投稿作品は検索結果の上位にあがらない為、見れる機会を一律に増やせない現状があると考えていました。

そこで、ユーザーのアニメーション投稿作品がダイレクトに検索でヒットできるように改善し、
更には投稿ジャンルを統一化することで、投稿内容を魅力的に見せて、できる限り一元化したいと考え制作しました。

本システムではそのプロトタイプであり、試験的に投稿ジャンルをアニメや映像・音楽作品に絞ることで更なる検索の効率化を図っています。

管理方法は、YouTubeで投稿した動画作品をWebシステムで管理し、一覧性の優位性を保っています。

## 工夫点
色彩を統一させることでシンプルでスッキリした印象を与え、主役の動画を引き立たせられるように設計しました。

いいね数を動画ごとにカウントするために、他のテーブルとリレーションをかけたり、非同期でカウントするようにシンプルなコーディングにしました。そしてユーザーが投稿した動画の総いいね数をプロフィールに表示させることで、ユーザーの関心度を可視化できるようにしました。

投稿した動画を投稿したユーザーと管理者権限を持つアカウントのみが編集できるようにしました。編集ボタンはその仕様に沿って、表示を切り分けています。

サイドバーのアイコンとネームによって、ログインしているユーザーが一目で分かるようにしました。画像を編集すると反映できるようになっています。

投稿一覧で、検索機能を実装しました。動画タイトルと投稿したユーザーで検索できます。

管理者権限を持つアカウントだけの管理画面を作成しました。本システムにアカウント登録しているユーザーを一覧で管理し、検索機能と一括削除機能も追加してユーザーの品質を管理できるようにしています。