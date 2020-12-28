<?php include ROOT.'/views/layouts/header.php'; ?>

			
			<section class="header_text sub">
			<img class="pageBanner" src="/template/themes/images/pageBanner.png" alt="New products" >
				<h4><span>Редактирование аккаунта</span></h4>
			</section>			
			<section class="main-content">				
				<div class="row">
					<div class="span5">					
					<?php if($result): ?>	
						<h4 class="title"><span class="text"><strong>Данные</strong> отредактированы</span></h4>
                    <?php else: ?>
						<?php if(isset($errors) && is_array($errors)): ?>
						<ul>
							<?php foreach ($errors as $error): ?> 
								<li> - <?php echo $error; ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
						<form action="#" method="post">
							<input type="hidden" name="next" value="/">
							<fieldset>
								<div class="control-group">
									<label class="control-label">Имя:</label>
									<div class="controls">
										<input type="text" name="name" placeholder="Имя" class="input-xlarge" value="<?php echo $name; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Email :</label>
									<div class="controls">
										<input type="email" name="email" placeholder="E-mail" class="input-xlarge" value="<?php echo $email; ?>">
                                    </div>
								</div>
								<div class="control-group">
									<label class="control-label">Пароль:</label>
									<div class="controls">
										<input type="password" name="password" placeholder="Пароль" class="input-xlarge" value="<?php echo $password; ?>">
									</div>
								</div>
								<div class="control-group">
									<input tabindex="3" class="btn btn-inverse large" type="submit"  name="submit" value="Сохранить">
									<hr>
									
								</div>
							</fieldset>
						</form>	
						<?php endif; ?>			
					</div>
					
				</div>
			</section>			
			

<?php include ROOT.'/views/layouts/footer.php'; ?>