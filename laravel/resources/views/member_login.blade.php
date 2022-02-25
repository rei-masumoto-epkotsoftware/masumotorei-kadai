<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>

会員ログイン<br/>
<br/>
<form method="post"action="/shop/member_login_check">
  @csrf
登録メールアドレス<br/>
<input type="text"name="email"><br/>
パスワード<br/>
<input type="password"name="pass"><br/>
<br/>
<input type="submit"value="ログイン">
</form>
</body>
</html>
