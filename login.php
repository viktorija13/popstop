<?php

include('config/db_connect.php');

session_unset();

$username = $password = '';
$errors = ['username' => '', 'password' => ''];

if (isset($_POST['login'])) {

    if (empty($_POST['username'])) {
        $errors['username'] = 'Username is required!';
    } else {
        $username = $_POST['username'];

        // provera da li postoji korisnik sa tim usernamemom
        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        if ($user == null) { // ako ne postoji taj korisnik
            $errors['username'] = "User with this username does not exist!";
        } elseif (empty($_POST['password'])) {
            $errors['password'] = "Password is required!";
        } else { // ako postoji korisnik i unesena je šifra
            $password = $_POST['password'];

            // provera da li se šifre poklapaju
            if (strcmp($password, $user['password'])) {
                $errors['password'] = "Wrong password!";
            } else {

                session_start();
                $_SESSION['username'] = $user['username'];
                $_SESSION['id'] = $user['id'];

                header('Location: index.php');
            }
        }
    }
}




?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php') ?>

<section class="container">
    <h4 class="center">Login to post songs</h4>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="white form" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>">
        <div class="red-text"><?php echo $errors['username']; ?></div>

        <label for="password">Password:</label>
        <input type="password" name="password" value="<?php echo htmlspecialchars($password) ?>">
        <div class="red-text" style="padding-bottom:10px;"><?php echo $errors['password']; ?></div>

        <div class="center">
            <input type="submit" name="login" value="Login" class="btn blue darken-2 z-depth-0">
        </div>
    </form>

</section>

<?php include('templates/footer.php') ?>

</html>