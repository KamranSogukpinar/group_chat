


<?php include ROOT.'/views/layouts/header.php'; ?>
<link rel="stylesheet" type="text/css" href="/template/themes/css/styles_for_login.css">
<body>

<div class="container">
	<div class="d-flex justify-content-center h-100">

		<div class="card">
			<div class="card-header">
				<h3>Создать аккаунт</h3>
				
			</div>
			<div class="card-body">
				 <?php if($result): ?>
                    	<p>Вы зарегистрированы!</p>
                    <?php else: ?>

						<?php if(isset($errors) && is_array($errors)): ?>
						<ul>
							<?php foreach ($errors as $error): ?> 
								<li> - <?php echo $error; ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				<form action="#" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						</div>
						<input type="name" name="name" class="form-control" placeholder="Имя" value="<?php echo $name; ?>">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						</div>
						<input type="email" name="email" class="form-control" placeholder="Почта" value="<?php echo $email; ?>">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control" placeholder="Пароль" value="<?php echo $password; ?>">
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox">Запомнить
					</div>
					<div class="form-group">
						<input type="submit" name="submit"  value="Создать" class="btn float-right login_btn">
					</div>
				</form>
				<?php endif; ?>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Уже зарегистрированы?<a href="/user/login">Войти</a>
				</div>
				
			</div>
		</div>
	</div>
</div>
</body>
</html>