<?php
require 'db.php';

function uploadImage($fileKey, $oldPath) {
    $uploadDir = 'uploads/';
    if (!empty($_FILES[$fileKey]['name'])) {
        $fileName = time() . '_' . basename($_FILES[$fileKey]['name']);
        $filePath = $uploadDir . $fileName;
        move_uploaded_file($_FILES[$fileKey]['tmp_name'], $filePath);
        return $filePath;
    }
    return $oldPath;
}

$sql = "UPDATE meishi SET 
    received_date = :received_date,
    company = :company,
    name = :name,
    tel = :tel,
    email = :email,
    notes = :notes,
    image_front = :image_front,
    image_back = :image_back
    WHERE id = :id";

$stmt = $pdo->prepare("SELECT image_front, image_back FROM meishi WHERE id = :id");
$stmt->execute([':id' => $_POST['id']]);
$old = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':received_date' => $_POST['received_date'],
    ':company' => $_POST['company'],
    ':name' => $_POST['name'],
    ':tel' => $_POST['tel'],
    ':email' => $_POST['email'],
    ':notes' => $_POST['notes'],
    ':image_front' => uploadImage('image_front', $old['image_front']),
    ':image_back' => uploadImage('image_back', $old['image_back']),
    ':id' => $_POST['id'],
]);

header('Location: index.php');
exit;

