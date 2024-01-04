<?php

include "header.php";

?>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Login to Your student account</header>
            <form action="" class="action">
                <div class="error_text_errormessage">
                    This is an error message
                </div>
                    <div class="field">
                        <label for="">Email</label>
                        <input type="text" name="email" placeholder="Email"></input>
                    </div>
                    <div class="field">
                        <label for="">Password</label>
                        <input type="password" name="password" placeholder="Password"></input>
                        <i class="eye fa fa-eye">
                        </i>
                    </div>
                    <div class="field">
                        <div class="button">
                            <input type="submit" placeholder="Login"></input>
                        </div>
                    </div>
                    <div class="link">Dont have an account <a href="index.php">Signup</a></div>
            </form>
        </section>
    </div>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/login.js"></script>
    <script src="fontawesome.js"></script>
    
</body>
</html>