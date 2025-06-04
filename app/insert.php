<?php
require 'db.php';

function uploadImage($fileKey) {
    $uploadDir = 'uploads/';
    if (!empty($_FILES[$fileKey]['name'])) {
        $fileName = time() . '_' . basename($_FILES[$fileKey]['name']);
        $filePath = $uploadDir . $fileName;
        move_uploaded_file($_FILES[$fileKey]['tmp_name'], $filePath);
        return $filePath;
    }
    return null;
}

$sql = "INSERT INTO meishi (received_date, company, name, tel, email, notes, image_front, image_back)
        VALUES (:received_date, :company, :name, :tel, :email, :notes, :image_front, :image_back)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':received_date' => $_POST['received_date'],
    ':company' => $_POST['company'],
    ':name' => $_POST['name'],
    ':tel' => $_POST['tel'],
    ':email' => $_POST['email'],
    ':notes' => $_POST['notes'],
    ':image_front' => uploadImage('image_front'),
    ':image_back' => uploadImage('image_back'),
]);

header('Location: index.php');
exit;

