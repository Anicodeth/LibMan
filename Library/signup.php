<!DOCTYPE html>
<html>

    <head>
    <style>
.sign-up-container{
  margin-top: 10rem;
  font-family: monospace !important;
  font-size : larger;
  font-weight: bold;

}


form {
    display: flex;
    flex-direction: column;
    align-items: center;
    border-radius:1rem;
 padding :1rem;
 width :20rem;
box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;;
 margin:auto;
  }

  label {
    margin-top: 10px;
  }
  
  .in {

    margin-bottom: 20px;
    padding: 5px;
    border: 1px solid gray;
    border-radius: 5px;
    width:17rem;
    height:1.5rem;
    
  }
  
  button {
    background-color: blue;
    color: white;
    padding: 10px;
    border: none;
    cursor: pointer;
    font-weight:bolder;
    width: 10rem;
    background-color: #1AB188;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  }

a{
    margin-top:0.5rem;
}
  
  
  
    </style>
    </head>
    <body>
        <div class = "sign-up-container">

            <form method="POST" action="signup.php">
            <h2>SIGN UP</h2>
                <label for="username">Username:</label>
                <input class = "in" type="text" name="username" id="username">
                
                <label for="email">Email:</label>
                <input class = "in" type="email" name="email" id="email">
                
                <label for="password">Password:</label>
                <input class = "in" type="password" name="password" id="password">
                
                <button type="submit">Sign up</button>
                <a href = "./librarylogin">Login</a>
            </form>
        </div>


        <?php


            if ($_SERVER['REQUEST_METHOD'] === 'POST'){

                $con = mysqli_connect("localhost", "root", "12345678", "library");
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];


                $sql = " INSERT INTO user VALUES ('$username', '$email', '$password')";
                if ($con->query($sql) === TRUE) {
                    echo "Added";
                    header("Location: ./librarylogin.php");
                    } else {
                    echo "Error: " . $con->error;
                    }
            }

            ?>

        
    </body>
</html>

