# MovingToDo
## 概要
MovingToDoは、タスク管理アプリケーションで、ユーザーがフォルダを作成し、その中にタスクを追加、編集、削除できる機能を提供します。このアプリケーションはLaravelフレームワークを使用して構築されています。

## 特徴
- フォルダの作成、編集、削除
- タスクの追加、編集、削除
- タスクの状態管理（未着手、着手中、完了）
- 日付の設定とバリデーション

## インストール手順
1. リポジトリをクローンします。
   ```bash
   git clone https://github.com/yourusername/my-laravel-app.git
   ```
2. ディレクトリに移動します。
   ```bash
   cd my-laravel-app
   ```
3. 依存関係をインストールします。
   ```bash
   composer install
   ```
4. 環境設定ファイルを作成します。
   ```bash
   cp .env.example .env
   ```
5. アプリケーションキーを生成します。
   ```bash
   php artisan key:generate
   ```
6. データベースの設定を行い、マイグレーションを実行します。
   ```bash
   php artisan migrate
   ```

## 使用方法
- アプリケーションを起動します。
   ```bash
   php artisan serve
   ```
- ブラウザで `http://localhost:8000` にアクセスします。

## テスト
テストを実行するには、以下のコマンドを使用します。
