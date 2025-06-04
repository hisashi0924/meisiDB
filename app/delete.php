<?php
require 'db.php';

$id = $_POST['id'] ?? 0;

// 画像ファイルも削除
$stmt = $pdo->prepare("SELECT image_front, image_back FROM meishi WHERE id = :id");
$stmt->execute([':id' => $id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($data) {
    if ($data['image_front']) unlink($data['image_front']);
    if ($data['image_back']) unlink($data['image_back']);
    $stmt = $pdo->prepare("DELETE FROM meishi WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header('Location: index.php');
exit;

