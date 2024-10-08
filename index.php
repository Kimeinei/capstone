<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container" id="signIn">
        <header>
            <p class="welcome-message">Welcome</p>
            <img src="photos/GUI-no-tubig.png" alt="Logo" class="logo">
        </header>
        <form method="post" action="bouncer.php">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <p class="recover">
                <a href="recover.html">Recover Password</a>
            </p>
            <input type="submit" class="btn" value="Sign In" name="signIn">
        
            <p class="or-divider">or</p>
            <p class="login-guest">
                <a href="MainPage/main_page.html">Log in as Guest</a>
            </p>
        </form>
    </div>
</body>
</html>
