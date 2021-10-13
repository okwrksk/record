<?php

session_start();

require_once '../classes/UserLogic.php';
require_once '../functions.php';
require_once '../dbconnect.php';

//ログインしているか判定し、していなかったら新規登録画面へ返す
$result = UserLogic::checkLogin();

if (!$result) {
  $_SESSION['login_err'] = 'ユーザーを登録してログインしてください。';
  header('Location: signup_form.php');
  return;
}

$login_user = $_SESSION['login_user'];

$files = getAllFile();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h2>私の勉強記録</h2>
    <nav class="header-nav">
      <ul>
        <li>
          <p class="username">ログインユーザー :<?php echo h($login_user['name']); ?></p>
        </li>
        <li class="logout">
          <form action="logout.php" method="POST">
            <input type="submit" name="logout" value="ログアウト" class="button">
          </form>
        </li>
      </ul>
    </nav>
  </header>
  <main>
    <form enctype="multipart/form-data" action="./file_upload.php" method="POST" class="upload-form">
      <h3>投稿フォーム</h3>
      <div class="file-up">
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
        <label for="img">投稿する画像 : </label>
        <input name="img" type="file" accept="image/*" class="img"/>
      </div>
      <div class="comment">
        <label for="caption">コメント入力欄 : </label>
        <textarea name="caption" placeholder="コメント（100文字以下）" id="caption" class="caption" rows="4" cols="40"></textarea>
      </div>
      <div class="submit">
        <input type="submit" value="投稿" class="button" />
      </div>
    </form>
    <div class="show">
      <?php foreach($files as $file): ?>
        <div class="post-container">
          <img src="<?php echo "{$file['file_path']}"; ?>" alt="">
          <div class="post">
            <p><?php echo h("{$file['description']}"); ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </main>
</body>
</html>