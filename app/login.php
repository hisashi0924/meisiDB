<?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ldap_host = "ldap://10.90.210.135";
    $ldap_dn_base = "DC=itsol,DC=ndkcom,DC=co,DC=jp";
    $username = $_POST['username'];
    $password = $_POST['password'];

    // LDAP 接続
    $ldap_conn = ldap_connect($ldap_host);
    ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap_conn, LDAP_OPT_REFERRALS, 0);

    if ($ldap_conn) {
        $bind_dn = "itsol\\$username";  // Samba4の場合、ドメイン名\\ユーザー名形式が多いです
        if (@ldap_bind($ldap_conn, $bind_dn, $password)) {
            $_SESSION['username'] = $username;
            header('Location: index.php');
            exit;
        } else {
            $error = "ユーザー名またはパスワードが正しくありません。";
        }
    } else {
        $error = "LDAPサーバーに接続できません。";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ログイン</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="bg-white p-8 rounded shadow-md w-96">
    <div class="text-center">
      <img src="title.png" alt="タイトル画像" class="h-12 mb-6 mx-auto">
    </div>
    <?php if ($error): ?>
      <div class="bg-red-100 text-red-700 p-2 mb-4 rounded"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post">
      <input type="text" name="username" placeholder="ユーザー名" required class="w-full p-2 mb-4 border rounded">
      <input type="password" name="password" placeholder="パスワード" required class="w-full p-2 mb-4 border rounded">
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 w-full rounded hover:bg-blue-700">ログイン</button>
    </form>
  </div>
</body>
</html>

