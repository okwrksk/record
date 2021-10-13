<?php

/**
 * CSRF対策
 * @param void
 * @return string $csrf_token
 */
function setToken() {
  //トークンを生成
  //トークンからそのトークンを送信
  //送信後の画面でそのトークンを照会
  //トークンを削除
  $csrf_token = bin2hex(random_bytes(32));
  $_SESSION['csrf_token'] = $csrf_token;

  return $csrf_token;
}