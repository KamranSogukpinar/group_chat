
<?php include ROOT .'/views/layouts/header_admin.php'; ?>

<link rel="stylesheet" type="text/css" href="/template/themes/css/styles_for_admin_panel.css">

<link rel="stylesheet" type="text/css" href="/template/themes/css/styles_for_cabinet.css">


<div class="container emp-profile">

   <div class="container">
    <h4 style=" text-align: center;">Панель Администратор</h4>
    <br>
    <div class="row">

     
     
      <div class="col-lg-3" style="">
        <div class="panel panel-danger">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <i class="fa fa-users fa-5x"></i>
              </div>
              <div class="col-xs-6 text-right">
                <p class="announcement-heading"><?php echo $countUsers; ?></p>
                <p class="announcement-text">Пользователи</p>
              </div>
            </div>
          </div>
          <a href="/admin/users">
            <div class="panel-footer announcement-bottom">
              <div class="row">
                <div class="col-xs-6">
                  Перейти
                </div>
                <div class="col-xs-6 text-right">
                  <i class="fa fa-arrow-circle-right"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="panel panel-success">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <i class="fa fa-comments fa-5x"></i>
              </div>
              <div class="col-xs-6 text-right">
                <p class="announcement-heading"><?php echo $countMessages; ?></p>
                <p class="announcement-text"> Сообщений в чатах</p>
                
              </div>
            </div>
          </div>
          <a href="/admin/messages">
            <div class="panel-footer announcement-bottom">
              <div class="row">
                <div class="col-xs-6">
                  Перейти
                </div>
                <div class="col-xs-6 text-right">
                  <i class="fa fa-arrow-circle-right"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div><!-- /.row -->
    </div>
   </div>         
<?php include ROOT .'/views/layouts/footer_admin.php'; ?>