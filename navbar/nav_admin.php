<nav class="navbar navbar-expand-lg bg-light text-dark p-0" style="background-color: #557153 !important;">
        <div class="container">
        <a class="navbar-brand w-10" href="../index.php">
            <div class="logo d-flex flex-column align-items-start">
                <img class="logo-img-adm flex-fill w-50 " src="../img/tasty_food.jpg">
            </div>
        </a>
        <div class="hero">
            <img class="userImage" src="../images/<?php /*  echo $row['picture'];  */?>" alt="<?php /*  echo $row['first_name']; */ ?>">
        </div>
            
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <span></span>
            </div>
            
        <div id="mySidepanel_adm" class="sidepanel_adm">
        <ul class="navbar-nav">
  <a href="../admin/index_admin.php">Admin Dashboard</a>

    <li class="nav-item dropdown">
   <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Recipes </a>
    <ul class="dropdown-menu" id="my_acc_dropdown">
      <li><a class="dropdown-item" href="../admin/create_recipe.php">Create New Recipe</a></li>
      <li><a class="dropdown-item" href="../admin/reviews.php">Recipe Reviews</a></li>
    </ul>
    </li>
    </ul> 
 
    <a href="../logout.php?logout">Logout</a>
 
    </div>
   
</div>

    <div class="adm-nav-div"><p id="adm-nav" class="text-dark ms-2 fs-2"><strong>Welcome back ADMIN, <br><?= $username ?></strong>
<p><img id="userImage" class="rounded-circle img-fluid" src="../images/admin.jpg" alt="admin img"></p> 

</nav>
