<nav class="navbar navbar-expand-lg bg-light text-dark p-0" style="background-color: #557153 !important;">
    <div class="container">
        <a class="navbar-brand w-10" href="../../index.php">
            <div class="logo d-flex flex-column align-items-start">
                <img class="logo-img flex-fill w-50" src="../../img/tasty_food.jpg">
            </div>
        </a>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <span></span>
            </div>
            
<div id="mySidepanel" class="sidepanel">
        <a href="../../user/home_user.php">Home</a>&nbsp; &nbsp; &nbsp;
        <a href="../../user/user_recipes/create_recipe.php">Create Recipe</a>&nbsp; &nbsp; &nbsp;
        <a href="../../planner.php">Meal Planner</a>&nbsp; &nbsp; &nbsp;

        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="../../user/index_user.php" role="button" data-bs-toggle="dropdown" aria-expanded="false"> My Account </a>
                <ul class="dropdown-menu" id="my_acc_dropdown">
                    <li><a class="dropdown-item" href="../../user/index_user.php?id=<?= $_SESSION['USER'] ?>">My Recipes</a></li>
                    <li><a class="dropdown-item" href="../../user/user.php">Account details</a></li>
                    <li><a class="dropdown-item" href="../../user/update.php?id=<?= $_SESSION['USER'] ?>">Update Account</a></li>
                    <li><a class="dropdown-item" href="../../logout.php?logout">Log Out</a></li>
                </ul>
            </li>
        </ul>
     
</div>

<div><p id="my-4" class="text-dark ms-2"><strong><?= $username ?></strong></p>
<p><img id="my-pic" class="rounded-circle img-fluid" src="../../images/<?= $photo ?>" alt="user img"></p>

</nav>
</div>