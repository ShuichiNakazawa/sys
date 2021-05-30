<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
	<script>
		// publishable API keyをセット
		var stripe = Stripe('pk_test_51IrwPCIGn1OXhDRnA1FggQtYdT4KUffGN31HTmM6TYvJY1GoBEOZbaB7aUM3Jb7NtzPwg97MmEjUOviW41GtCfF700627z9QoZ');
	
		stripe.redirectToCheckout({
		  // 上記で生成したセッションIDをセット
		  sessionId: '{{ $id }}'
		}).then(function (result) {
		  // エラー処理
		  // `result.error.message`を使うと、ブラウザの言語に合わせたエラーメッセージを表示することができる
		});
	</script>
</body>
</html>