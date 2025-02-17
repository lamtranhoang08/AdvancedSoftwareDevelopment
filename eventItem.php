<header class="c-header">
  <h1>Event Management Menu</h1>
  <p></p>
  <?php
    include("connection.php");
    //session_cache_limiter('private_no_expire');
    session_start();
    
    
  ?>
</header>
<body>
<div class="background">
<section class="c-posts">
<div class="new1">
  <article class="c-posts__item">
  </article>
</div>   
</section>

<?php
  

  if (!isset($_POST['eventID'])) {//event ID - create new event 
    $viewName = "";
    $viewNumAtendees = "";
    $viewDate = 0;
    $viewDescription = "";

    $value = "create";

    $submitValue = "Save Changes";
    $formHeader = "Create Event: ";
    $organiserID = $_POST['organiserID'];
  }
  else {
    $viewName = $_POST['name'];
    $viewNumAtendees = $_POST['numAtendees'];
    $viewDate = $_POST['date'];
    $viewDescription = $_POST['description'];
    $organiserID = $_POST['organiserID'];
    $specialRequestsID = $_POST['specialRequestsID'];
    $value = "edit";
    $eventID = $_POST['eventID'];

    if (isset($_POST["employeeID"])) {
      $submitValue = "Submit Changes";
      $formHeader = "Manage event: ";
    }
    else {
      $submitValue = "Save Changes";
      $formHeader = "Edit event: ";
    }
  }

?>
        <form action="searchEvent.php" method="POST">
        <div class=""><h3><?php echo "$formHeader" . $viewName;?></h3><br><br></div>
        <label id="icon" for="name"><i class="input"> Name:  </i></label><br><br>
        <?php if (!isset($_SESSION['employeeID'])) {?>
        <input type="text" name="name" id="name" value="<?php echo $viewName;?>" required/>
        <?php } else { ?>
          <p><?php echo $viewName; ?></p>
        <?php } ?>
        <br>
        <br>
        <br>
        <label id="icon"><i class="input">Number of atendees:  </i></label><br><br>
        <?php if (!isset($_SESSION['employeeID'])) {?>
        <input type="number" name="numAtendees" id="numAtendees" value="<?php echo $viewNumAtendees;?>" required/>
        <?php } else { ?>
          <p><?php echo $viewNumAtendees; ?></p>
        <?php } ?>
        <br>
        <br>
        <br>
        <?php if (!isset($_SESSION['employeeID'])) {?>
        <label id="icon" ><i class="input">Event date: </i></label><br><br>
        <input type="date" name="date" id="date" value="<?php echo $viewDate;?>" required/>
        <?php } else { ?>
          <p><?php echo $viewDate; ?></p>
        <?php } ?>
        <br>
        <br>
        <br>
        <label id="icon"><i class="input">Description </i></label><br><br>
        <?php if (!isset($_SESSION['employeeID'])) {?>
        <input type="text" name="description" id="description" value="<?php echo $viewDescription;?>" required/>
        <?php } else { ?>
          <p><?php echo $viewDescription; ?></p>
        <?php } ?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <?php if (!isset($_SESSION['employeeID'])) {?>
        <h2>Special Requests:</h2>
        <br>
        <br>
        <br>
        <label for="name">Select vegan catering:</label> <br><br>
          <select name="veganOptions" id="veganOptions"> 
              <option value="AllOrders">All orders</option> 
              <option value="Entrees">Entrees</option> 
              <option value="EntreesMains">Entrees and mains</option> 
              <option value="Mains">Mains</option> 
              <option value="MainsDesserts">Mains and desserts</option> 
              <option value="None" selected>None</option> 
          </select>
          <br>
          <br>
          <br>
          <label for="name">Select a cake:</label> <br><br>
          <select name="specialCake" id="specialCake"> 
              <option value="Chocolate">All orders</option> 
              <option value="BlackForest">Black Forest</option> 
              <option value="IceCreamCake">Ice Cream Cake</option> 
              <option value="Tirimasu">Tirimasu</option> 
              <option value="None" selected>None</option> 
          </select>
          <br>
          <br>
          <br>
          <label>Select table size:</label> <br><br>
          <input type="number" name="tableSize" id="tableSize" value="0" required/>
          <br>
          <br>
          <br>
          <label>Tables outside?</label><br><br>
          <input type="checkbox" id="tablesOutside" name="tablesOutside">
          <br>
          <br>
          <br>
          <label>Request kids table</label><br><br>
          <input type="checkbox" id="kidsTable" name="kidsTable">
          <br>
          <br>
          <br>
          <label>Order extra large pizzas</label><br><br>
          <input type="checkbox" id="largePizzas" name="largePizzas">
          <br>
          <br>
          <br>
          <label>Play song during dinner</label><br><br>
          <input type="text" name="song" id="song"/>
          <?php } else { ?>

          <?php } ?>
        <input type='hidden' name='eventID' id='eventID' value="<?php echo $eventID;?>"/>
        
        <?php if (!isset($_POST['eventID'])) {?>
        <input type='hidden' name='organiserID' id='organiserID' value="<?php echo $organiserID;?>"/>
        <?php } ?>
        <input type='hidden' name='task' id='task' value="<?php echo $value;?>"/>
        <br><br><br>

          <?php 
          if (isset($_POST['status']) && $_POST['status'] == "submitted") { ?>
          <select name="status" id="status"> 
              <option value="approved">Approve</option> 
              <option value="rejected">Reject</option> 
              <option value="submitted" selected>Do nothing</option> 
          </select>
          <?php } else if (!isset($_POST['status'])) {?>
          <input type='hidden' name='status' id='status' value="<?php echo $submitted;?>"/>
          <?php } ?>

      </div>
        <div>
          <input class="c-btn"id="button" type="submit" value="<?php echo "$submitValue"; ?>"><br><br>
        </div>
      </form>
    </div>

 <?php
    if (isset($_POST['organiserID']) && isset($_POST['eventID'])) {
      echo "
        <div class='main-block' style='text-align:center; padding:20px;'>
        <div id='box'>
          <form method='post' action='searchEvent.php'>
          <input type='hidden' name='eventID' id='eventID' value=" . "$eventID" . "/>
          <input type='hidden' name='task' id='task' value= 'delete'/>
          <input class='c-btn'id='button' type='submit' value='delete'>
          <br><br>
          </div>
        </form>
      </div>
      ";
    }
    ?>







</body>