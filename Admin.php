<!DOCTYPE html>
<?php
   ob_start();
   session_start();
?>
<html lang="en">

<head>
    <title>Database search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- this is all the required links and imports being set up -->
</head>

<body>
    <div class="row">
        <header class="col-lg-12 bg-info">
            <class="col-lg-2">
                <h1 class="col-lg-10 text-center">Admin page</h1>
        </header>
<!--    header information being set up      -->
    </div>
    <div class="row">
        <nav class="col-lg-2">
            <h2 class="text">Navigation bar</h2>
            <ul class="nav nav-pills nav-stacked">
                <li><a href="index.html">Search</a></li>
                <li><a href="MSearched.php">10 Most Searched</a></li>
            </ul>
        </nav>
    </div>
<!--   navigation bar being setup and made   -->
                 <?php if ($_SESSION['username'] != 'TeamEAdmin'){
// only opens login if not logged in
					?>
                <div class = "container form-signin">
                <h1>Enter Admin Username and Password</h1>
                <?php
                    $msg = '';

                    if (isset($_POST['login']) && !empty($_POST['username']) 
                        && !empty($_POST['password'])) {

                        if ($_POST['username'] == 'TeamEAdmin' && 
                            $_POST['password'] == 'P@ssw0rd') {
                            $_SESSION['valid'] = true;
                            $_SESSION['timeout'] = time();
                            $_SESSION['username'] = 'TeamEAdmin';

                            echo 'You have entered the correct username and password';
                        	header("Refresh:0");
                        }else {
                            $msg = 'Wrong username or password';
                        }
                    }
				
                ?>
                </div> <!-- core setup for the login system -->

                <div class = "container">

                <form class = "form-signin" role = "form" 
                    action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
                    ?>" method = "post">
                    <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
                    <input type = "text" class = "form-control" 
                        name = "username" placeholder = "username" 
                        required autofocus></br>
                    <input type = "password" class = "form-control"
                        name = "password" placeholder = "password" required>
                    <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
                        name = "login">Login</button>
                </form>
				</div>
<!--   the actual container for the login   -->
    			<?php }
    			else{
//                 only opens menu if logged in
                	?>
        			 <div>
    				<main class="col-lg-10">
                	<h1 class="text">Unsubscribe user</h1>
                	<form action="UnSubadmin.php" method="POST">
                	  Name: <input type="text" name="name" id="name" maxlength="80" required><br>             
              	      Email: <input type="email" id="email" name="email" maxlength="150" required><br>
                    <input type="radio" id="news" name="subselect" value="news">
                    <label for="news">News</label><br>
                    <input type="radio" id="monthly" name="subselect" value="monthly">
                    <label for="monthly">Monthly</label><br>
                    <input type="radio" id="both" name="subselect" value="both" checked>
                    <label for="both">Both</label>
              	    <input type="submit">
            		</form>
                     <a href = "LogoutA.php" tite = "LogoutA"> logout.
                    </main>
                    </div>
            <!-- checks if logged in then brings up the fields for unsubbing a user  -->
            		<?php
            		}
    				?>
                   
        </main>
<!--   this is the code for the input boxes and how they send to the specific page for using them   -->
    


</body>

</html>