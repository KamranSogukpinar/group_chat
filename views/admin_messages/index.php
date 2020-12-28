<?php include ROOT .'/views/layouts/header_admin.php'; ?>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
<style type="text/css">
  .bg__card__navbar{
  background-color: #000000;
}
.bg__card__footer{
  background-color: #000000 !important;
}

</style>
<section>



<main>
<div class="container my-5">
       <div class="card-body text-center">
    <h4 class="card-title">Управление пользователями</h4>
    <p class="card-text">Список всех пользователей</p>
  </div>
    <div class="card">
        
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Имя пользователя(отправитель)</th>
                <th scope="col">Сообщение</th>
                <th scope="col">Время</th>
                <th scope="col">Посмотреть</th>
                <th scope="col">Статус (корректный)</th>
              </tr>
            </thead>
            <tbody>
               <?php foreach ($messages as $messages): ?>
              <tr>
                <th scope="row"><?php echo $messages['chat_message_id']; ?></th>
                <td><?php echo $messages['from_user_name']; ?></td>
                 <td><?php echo $messages['chat_message']; ?></td>
                  <td><?php echo $messages['timestamp']; ?></td>
                <td>
                    <a class="btn btn-sm btn-primary" href="/admin/messages/correct/<?php echo $messages['chat_message_id'];?>"><i class="fa fa-edit"></i> Отметить</a>
                </td>
                
                <td>
                  <?php 
                  if ($messages['incorrect']==0){ echo '<i class="btn-icon-only icon-ok"></i>';
                  }else{ echo '<i class="btn-icon-only icon-remove"></i>';
                  }?>
                    
                  </td>
              </tr>
             
              <?php endforeach; ?>
            </tbody>
          </table>
    </div>
    <!-- Large modal -->



</div>
</main>
         
</section>
<?php include ROOT .'/views/layouts/footer_admin.php'; ?>