<?php
//Include Class to use within file
require_once('classes/new_ab_class.php');

//Set error to an empty string
$error = '';





?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>CCK | Address Book</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:200,300,400,600,700');" rel='font'>
        <link href='/css/basis.css' rel='stylesheet'>  
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
	
	
					<h2>Address Book:</h2>
						<table>
							<tr>
								<th>Name:</th><th>Address:</th><th>City:</th><th>State:</th><th>Zip:</th><th>Phone (optional):</th>
							</tr>
								<? if (!empty($address_book)) : ?>
										<? foreach ($address_book as $key => $fields) : ?>
										<tr>
											<? foreach ($fields as $field): ?>
												<? $field = htmlspecialchars(strip_tags($field)); ?>
												<td>||&mdash;<?=$field;?>&mdash;||</td>
											<? endforeach; ?>
										<td><?="<a href='?remove=$key'>Remove</a>"?></td></tr>
										<? endforeach; ?>
									<? else : ?>
										<tr><?= "Enter New Address" ?></tr>
									<? endif; ?>
								<? if (!empty($error)) : ?>
									<hr><tr><strong><?=$error?></strong></tr><hr>
								<? endif; ?>
						</table>
					<h2>Add New Address:</h2>
					<hr>
						<form method="POST" action="">
							<p>
								<label for="sendto">Recipients Name:</label>
								<input id="sendto" name="sendto" type="text" value="<?= (empty($error)) ? '' : htmlspecialchars(strip_tags($_POST['sendto']));?>">
							</p>
							<p>
								<label for="address">Recipients Address:</label>
								<input id="address" name="address" type="text" value="<?=  (empty($error)) ? '' : htmlspecialchars(strip_tags($_POST['address']));?>">
							</p>
							<p>
								<label for="city">Recipients City:</label>
								<input id="city" name="city" type="text" value="<?= (empty($error)) ? '' : htmlspecialchars(strip_tags($_POST['city']));?>">
							</p>
							<p>
								<label for="state">Recipients State:</label>
								<input id="state" name="state" type="text" value="<?= (empty($error)) ? '' : htmlspecialchars(strip_tags($_POST['state']));?>">
							</p>
							<p>
								<label for="zip">Recipients Zip-Code:</label>
								<input id="zip" name="zip" type="text" value="<?= (empty($error)) ? '' : htmlspecialchars(strip_tags($_POST['zip']));?>">
							</p>
							<p>
								<label for="phone">Recipients Phone Number:</label>
								<input id="phone" name="phone" type="text" value="<?= (empty($error)) ? '' : htmlspecialchars(strip_tags($_POST['phone']));?>">
							<p>
								<input type='submit' value='Add New Entry'>
							</p>
						</form>
	
  					 </div><!-- /col-9 -->
                </div><!-- /padding -->
            </div>
            <!-- /main -->
          
        </div>
    </div>
</div>        
      
        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
        
    </body>
</html>