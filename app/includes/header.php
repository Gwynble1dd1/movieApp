<!-- HEADER -->
<header class="container-fluid">
    <div class="container">
        <div class="row">     
            <div class="row col-4">
                <h1>
                    <a href="index.php">MovieApp</a>
                </h1>
            </div>    
                <nav class="col-8">
                    <ul><?php if(isset($_SESSION['login'])):?>
                        <li><a href="profile.php"><i class="fa-solid fa-user"><?=$_SESSION['login'];?></i></a></li>
                        <li><i class="fa-solid fa-wallet"></i><?=$_SESSION['wallet'];?>$</li>
                        
                            <button type="button" class="btn btn-warning"><a href="logout.php">LogOut</a></button>
                        <?php else:?>
                            <button type="button" class="btn btn-outline-light me-2 sing-in"><a href="log.php">LogIn</a></button>
                            <button type="button" class="btn btn-warning"><a href="reg.php">Sign-up</a></button>
                        <?php endif;?>
                    </ul>
                </nav>
        </div>
        
    </div>
</header>
