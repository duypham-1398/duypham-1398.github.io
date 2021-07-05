<!DOCTYPE html>
<html>
<head>
	<title>Activation Email - KSD</title>
</head>
<body>
	<p>
		Chào mừng {{ $user->name }} đã đăng ký thành viên tại Công Ty Cổ Phần Xây Dựng KSD. Bạn hãy click vào đường link sau đây để hoàn tất việc đăng ký.
		</br>
		<a href="{{ $user->activation_link }}">{{ $user->name }}/xacnhan/dangky/KSD</a>
	</p>
</body>
</html>