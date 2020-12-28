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
                <th scope="col">Имя пользователя</th>
                <th scope="col">Почта</th>
                <th scope="col">Управление</th>
                <th scope="col">Посмотреть</th>
                <th scope="col">Роль</th>
              </tr>
            </thead>
            <tbody>
               <?php foreach ($usersList as $users): ?>
              <tr>
                <th scope="row"><?php echo $users['id']; ?></th>
                <td><?php echo $users['name']; ?></td>
                <td><?php echo $users['email']; ?></td>
                <td>
                    <a class="btn btn-sm btn-primary" href="/admin/users/update/<?php echo $users['id'];?>"><i class="fa fa-edit"></i> Редактировать</a>
                    <a class="btn btn-sm btn-danger" href="/admin/users/delete/<?php echo $users['id'];?>"><i class="fa fa-trash-alt"></i>Удалить</a>    
                </td>
                <td><a class="btn btn-sm btn-info" href="/admin/users/view/<?php echo $users['id'];?>""><i class="fa fa-info-circle"></i> Информация</a> </td>
                <td><?php echo $users['role']; ?></td>
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