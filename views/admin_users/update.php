<?php include ROOT .'/views/layouts/header_admin.php'; ?>
<style type="text/css">
	.width30 {
		width: 30%;
	}
	.width70 {
		width: 70%;	
	}
	.floatL{
		float: left;
	}
	.width50{
		width: 50%;
	}
	.floatR{
		float: right;
	}
	.btn{
		width: 100%;
		border-radius: 0px;
	}
	.width100{
		width: 100%;
	}
	.row{
		margin-left: -20px;
		margin-right: -20px;

	}
	.boxStyle{
		padding: 20px; 
		border-radius: 25px; 
		border-top: 6px solid #dc3545;
		border-bottom: 6px solid #28a745;
	}
</style>
<section>
	
            <li style=" text-align: center;"><a href="/admin">Панель Администратор</a></li>
           
           
        </ol>
    </div>
    <h4 style="text-align: center;">Редактирование пользователя #<?php echo $user['name']; echo "($id)"; ?></h4>
	<div class="container">
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-2"></div>		
		<div class="col-sm-6 bg-light boxStyle">
			<form action="#" method="post"  enctype="multipart/form-data" >
	<div class="form-group">
		<div class="width30 floatL"><label>Имя</label></div>
		<div class="width70 floatR"><input id="name" class="width100 form-control" name="name" type="text"  placeholder="" value="<?php echo $user['name']; ?>" size="20">
	</div><br><br>
	<div class="form-group">
		<div class="width30 floatL"><label>Email</label></div>
		<div class="width70 floatR"><input class="width100 form-control" name="email" type="text"  placeholder="" value="<?php echo $user['email']; ?>" size="20"></div>
	</div><br>
	<div class="form-group">
		<div class="width30 floatL"><label>Профессия</label></div>
		<div class="width70 floatR"><input class="width100 form-control" name="profession"  src=""   type="text"  placeholder="" value="<?php echo $user['profession']; ?>" size="20"></div>
	</div><br>
	 
	
 	 	<div class="form-group">
 		<div class="width30 floatL"><label>Статус:</label></div>
 	</div>
 	<div class="width70 floatR"><div class="form-group">           
    <input name="status" value="0" <?php if($user['status'] == 0) echo 'checked="checked"'; ?> type="radio">
    <label for="customRadio" >обычный</label>
    <input name="status" value="1"  <?php if($user['status'] == 1) echo 'checked="checked"'; ?> type="radio" >
    <label for="customRadio">предупреждение</label>
      	</div></div><br><br>

      	<div class="form-group">
 		<div class="width30 floatL"><label>Роль:</label></div>
 	</div>
 	<div class="width70 floatR"><div class="form-group">
    <input name="role" value="1" <?php if($user['role'] == 'admin') echo 'checked="checked"'; ?> type="radio">
    <label for="customRadio">Админ</label>
    <input name="role" value="0" <?php if($user['role'] == '0') echo 'checked="checked"'; ?> type="radio">
    <label for="customRadio">Пользователь</label>
   
      	</div></div><br><br><br>

  	<div class="form-group">
  	<div class="row">
	<div class="width100"><input class="btn btn-success"  name="submit" type="submit"   value="Сохранить" style="font-weight: bold"></div>
 	
  	</div>
  	</div>
     </form>      
		
</div>
</div>
</div>
</section>
		
	
	