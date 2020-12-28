<?php include ROOT .'/views/layouts/header_admin.php'; ?>



<div class="row justify-content-center">
   <div class="col info-box rounded col-lg-10 col-xl-8 bg-light p-4 m-3 ">
      <div class="row ">
         <div class="col-12 col-sm-2 d-flex justify-content-center align-items-center mb-2 mb-sm-0 display-3 text-primary">

            <i class="fa fa-info-circle"><!-- / --></i>
         </div>
         <div class="col-12 col-sm-10 pl-sm-0 mb-2">
            <h4>Удалить пользователя #<?php echo $user['name']; echo "($id)"; ?> </h4>
            <p> Действительно хотите удалить этого пользователя?
            </p>
         </div>
      </div>
      <div class="row">
         <div class="col text-right"></div>
          <form method="post">
        <button  type="submit" name="delete" class="btn btn-danger">Да</button>
           <button type="submit" name="back" class="btn btn-primary ">Нет</button>
      
</form>
</div>
      </div>
   </div>

<?php include ROOT .'/views/layouts/footer_admin.php'; ?>