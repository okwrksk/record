<?php

function dbc()
{
  $dsn = 'mysql:dbname=tb230056db;host=localhost;charset=utf8mb4';
  $user = '***********';
  $pass = '***********';

  try {
    $pdo = new PDO($dsn, $user, $pass,
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => pdo::FETCH_ASSOC
    ]);
    echo '成功です';
    return $pdo;
  } catch (PDOException $e) {
    exit($e->getMessage());
  }
}

dbc();

/**
 * ファイルデータを保存
 * @param string $filename ファイル名
 * @param string $save_path　保存先のパス
 * @param string $caption　キャプション
 * @return bool $result
 */
function fileSave($filename, $save_path, $caption)
{
  $result = false;

  $sql = "INSERT INTO file_table (file_name, file_path, description) VALUE (?, ?, ?)";

  try {
    $stmt = dbc()->prepare($sql);
    $stmt->bindValue(1, $filename);
    $stmt->bindValue(2, $save_path);
    $stmt->bindValue(3, $caption);
    $result = $stmt->execute();
    return $result;
  } catch (\Exception $e) {
    echo $e->getMessage();
    return $result;
  }
}

/**
 * ファイルデータを取得
 * @return array $fileData
 */
function getAllFile()
{
 $sql = "SELECT * FROM file_table";

 $fileData = dbc()->query($sql);

 return $fileData;
}

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}