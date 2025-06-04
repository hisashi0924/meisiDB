<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>名刺登録</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">名刺登録フォーム</h1>

    <form action="insert.php" method="post" enctype="multipart/form-data" class="bg-white p-6 rounded shadow space-y-4">

        <div>
            <label class="block font-semibold mb-1">受領日</label>
            <input type="date" name="received_date" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">会社名</label>
            <input type="text" name="company" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">名前</label>
            <input type="text" name="name" class="w-full border rounded p-2">
        </div>

        <div>
            <label>電話番号: <input type="tel" name="tel" class="w-full border rounded p-2"></label><br>
        </div>

        <div>
            <label>メールアドレス: <input type="email" name="email" class="w-full border rounded p-2"></label><br>
        </div>

        <div>
            <label class="block font-semibold mb-1">備考</label>
            <textarea name="notes" class="w-full border rounded p-2" rows="4"></textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">名刺画像（表）</label>
            <input type="file" name="image_front" class="block w-full text-sm">
        </div>

        <div>
            <label class="block font-semibold mb-1">名刺画像（裏）</label>
            <input type="file" name="image_back" class="block w-full text-sm">
        </div>

        <div class="text-right">
            <button type="submit" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">登録</button>
        </div>
    </form>
</div>

</body>
</html>

