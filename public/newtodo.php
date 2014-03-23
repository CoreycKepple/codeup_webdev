<?php
require_once('classes/new_todoclass.php');

//Establishing global variables
$error = '';
$key = '';

// var_dump($_POST);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>CCK | Todo List</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:200,300,400,600,700');" rel='font'>
        <link href='/css/basis.css' rel='stylesheet'>  

        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
    </head>
      <body>
        
        <div class="wrapper" >
    <div class="box">
        <div class="row">
          
            <!-- sidebar -->
            <div class="column col-sm-3" id="sidebar">
                <a class="logo" href="cck.html">CK</a>
                <ul class="nav" id="links">
                    <li class="active"><a href="cck.html#resume">Resume</a>
                    </li>
                    <li><a href="cck.html#portfolio">Portfolio</a>
                    </li>
                </ul>
            </div>
            <!-- /sidebar -->
          
            <!-- main -->
            <div class="column col-sm-9" id="main">
                <div class="padding">
                    <div class="full col-sm-9">
                        <!-- content -->
                      <div class="mid">    
                        <h1>TODO list:</h1>
                          <ul class='padbot'>  
                            <?if(isset($list)) : ?>
                              <?  while ($row = $list->fetch_assoc()) : ?>
                                  <li><?= $row['item']; ?> | <a href="<?= $row['id']; ?>" class="removeItem">Remove</a></li>
                              <? endwhile; ?>
                            <? else : ?>
                              <h3><?= "You have nothing to do? Find something :";?></h3>
                              <p><?= "<a href='http://google.com'>GOOGLE</a>";?></p>
                            <? endif; ?>
                          </ul>
                        <h2>Add items to list</h2>
                          <? if (!empty($error)) : ?>
                            <hr><strong><?= $error; ?></strong><hr>
                          <? endif; ?>
                        <form method="POST" action="">
                            <p class='margleft padtop'>
                              <label for="additem">Item to add:</label>
                              <input id="additem" name="additem" type="text" placeholder="Enter new TODO item">
                              <input type="submit" value="Add">
                            </p>
                        </form>
                      </div>   
                       
                    </div><!-- /col-9 -->
                </div><!-- /padding -->
            </div>
            <!-- /main -->
          
        </div>
    </div>
</div>   
        <form id="deleteItem" method="POST" action="newtodo.php">
          <input type="hidden" name="remove" id="remove">
        </form>

        <script>
          var form = $('#deleteItem');
          var id;

          $('.removeItem').click(function(evt){
              evt.preventDefault();

              id = $(this).attr('href');

              console.log(id);

              $('#remove').val(id);
              form.submit();
          });   
        </script> 
      
        
        
    </body>
</html>