<?php include ROOT.'/views/layouts/header.php'; ?>

    
 
<div class="container py-5 px-4">
  <!-- For demo purpose-->
  <header class="text-center">
   <h1 class="display-4 text-white">Чат приложения</h1>
      <p class="text-white lead mb-4">
      <a href="https://bootstrapious.com" class="text-white">
        <u><?php echo $user['name'];?> Онлайн</u></a>
    </p>

  </header>
 
  <div class="row rounded-lg overflow-hidden shadow">
    <!-- Users box-->
    <div class="col-5 px-0">
      <div class="bg-white">

        <div class="bg-gray px-4 py-2 bg-light">
          <p class="h5 mb-0 py-1">Чаты</p>
        </div>

        <div class="messages-box">
          <div class="list-group rounded-0">
            <?php foreach ($users as $users): ?>
               <a href="#" <?php if($users['role']== 'admin') echo 'class="list-group-item list-group-item-action active text-white rounded-0"'; else echo  'class="list-group-item list-group-item-action text-grey rounded-0"';?>">
              <div class="media"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="40" class="rounded-circle">
                <div class="media-body ml-4">
                  <div class="d-flex align-items-center justify-content-between mb-1">
                    <h6 class="mb-0"><?php echo $users['name'];?></h6><small class="small font-weight-bold"><?php echo $users['status'];?></small>
                  </div>
                  
                  <p class="font-italic mb-0 text-small"><?php echo $users['role'];?></h6></p>
                </div>
              </div>
            </a>
            <?php endforeach; ?>
          </div>
        </div>


    
      </div>
    </div>
    <!-- Chat Box-->
    <div class="col-7 px-0">
      <div class="px-4 py-5 chat-box bg-white">
       
      
<ul id="messages"><?php echo $chat_history;?></ul>



      </div>

      <!-- Typing area -->
      <form action="#" method="post" class="bg-light">
        <div class="input-group">
         
          <input type="text" name="chat_message" placeholder="Написать" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
          
           
            <button class="btn btn-primary" type="submit" name="submit" value="Отправить" >Отправить</button>
          </div>
        </div>
      </form>


    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

</body>
</html>




<?php include ROOT.'/views/layouts/footer.php'; ?>