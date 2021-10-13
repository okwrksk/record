<?php
session_start();

require_once '../functions.php';
require_once '../classes/UserLogic.php';

$result = UserLogic::checkLogin();
if ($result) {
  header('Location: mypage.php');
  return;
}

$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err'] : null;
unset($_SESSION['login_err']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー登録画面</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="signup-form">
    <h2>ユーザー登録フォーム</h2>
    <?php if (isset($login_err)) : ?>
      <p><?php echo $login_err; ?></p>
    <?php endif; ?>
    <form action="register.php" method="post">
      <p>
        <label for="username">ユーザー名</label>
        <br>
        <div class="form">
          <input type="text" name="username">
        </div>
      </p>
      <p>
        <label for="email">メールアドレス</label>
        <br>
        <div class="form">
          <input type="email" name="email">
        </div>
      </p>
      <p>
        <label for="password">パスワード</label>
        <br>
        <div class="form">
          <input type="password" name="password">
        </div>
      </p>
      <p>
        <label for="password_conf">パスワード確認</label>
        <br>
        <div class="form">
          <input type="password" name="password_conf">
        </div>
      </p>
      <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
      <p class="link">
        <input type="submit" value="新規登録" class="btn">
      </p>
    </form>
    <div class="link">
      <a href="login_form.php">ログインする</a>
    </div>
  </div>
</body>
</html>