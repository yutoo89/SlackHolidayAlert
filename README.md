# SlackHolidayAlert

祝日が近づいたことをSlackで通知してくれます。

## 使い方

パッケージのインストール

```bash
composer install
```

.envファイルを作成

```bash
cp .env.example .env
# 環境変数を設定
vim .env
```

crontabの編集

```bash
# エディタが開くのでcrontabを記述
crontab -e
```

```crontab
# 毎日07:00
0 7 * * * /usr/bin/php /Users/your_app_path/SlackHolidayAlert/index.php
```
