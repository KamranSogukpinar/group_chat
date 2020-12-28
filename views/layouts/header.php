<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
		<title>Chat By Kamran</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
        
    <link href="/template/bootstrap/css/bootstrap.min.css" rel="stylesheet">      
  
    <link href="/template/bootstrap/css/font-awesome.min.css" rel="stylesheet"/>
    
    <!-- global styles -->
   
    <link href="/template/themes/css/main.css" rel="stylesheet"/>
  

    <!-- scripts -->
    <script src="/template/themes/js/bootstrap.bundle.min.js"></script>
    <script src="/template/themes/js/jquery-3.3.1.slim.min.js"></script>
    <script src="/template/themes/js/script.js"></script> 

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>
<body>



  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Links -->
  <ul class="navbar-nav">
     <?php if(User::isGuest()): ?> 
    <li class="nav-item">
      <a class="nav-link" href="/user/register/">Авторизация</a></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/user/login/">Вход</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/guest/chat/">Чаты</a>
    </li>
       <?php else: ?>
    <li class="nav-item">
      <a class="nav-link" href="/cabinet/">Кабинет</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/chat/">Чаты</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/user/logout/">Выход</a>
    </li>
    <?php endif; ?> 
  </ul>
  
</nav>
<br>


							





   