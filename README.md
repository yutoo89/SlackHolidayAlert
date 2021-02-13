# SlackHolidayAlert

祝日が近づいたことをSlackで通知してくれます。

## 使い方

### Slack側の設定

Slack APIの設定方法は下記を参考

[Slack APIを使用してメッセージを送信する](https://qiita.com/kou_pg_0131/items/56dd81f2f4716ca292ef)

#### Slack APIでアプリを作成

1. ワークスペースにログイン
2. 「 [Slack API](https://api.slack.com/apps?new_app=1) 」 から新しくアプリを作成
3. アプリ名を入力してワークスペースを選択して `Create App`ボタンをクリック

#### アプリにスコープを設定

1. `OAuth & Permission` をクリック
2. ページ内の`Scopes` セクションからアプリにスコープを追加
3. `Bot Token Scopes`の`Add an OAuth Scope` をクリック
4. メッセージ投稿に必要な`chat:write` を選択して追加

※ ボットとして投稿する場合は上記のトークンが必要

※ ユーザとして投稿する場合は`User Token Scope`を同様の手順で作成

#### アプリをワークスペースにインストール

1. スコープを設定したページの上部の`Install App to Workspace` ボタンをクリック
2. 権限のリクエストを許可する
3. アプリのインストールに成功するとトークンが生成されるのでコピー
   - `xoxb-` から始まる `Bot User OAuth Access Token`

※ ユーザとして投稿する場合は`xoxp-` から始まる `OAuth Access Token`をコピー

#### アプリをチャンネルに追加

1. Slackアプリを開き、メッセージを投稿したいチャンネルを開く
2. `詳細`をクリック
3. `その他` => `アプリを追加する`の順にクリック
4. さきほど作成したアプリを追加

### その他の準備

#### パッケージのインストール

```bash
composer install
```

#### .envファイルを作成

Slack API アプリのトークンを設定

```bash
cp .env.example .env
# 環境変数を設定
vim .env
```

.envファイル記述例

```
OAUTH_ACCESS_TOKEN="さきほど生成したBot User OAuth Access Token"
```

#### crontabの編集

定期的に自動通知するための設定

```bash
# エディタが開くのでcrontabを記述
crontab -e
```

cron記述例

```crontab
# 毎日07:00
0 7 * * * /usr/bin/php /Users/your_app_path/SlackHolidayAlert/index.php
```
