<?php

include "header.php";

?>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Student Online Registration</header>
            <form action="" class="action" enctype="multipart/form-data">
                <div class="error_text_errormessage">
                    
                </div>
                    <div class="name details">
                        <div class="field">
                            <label for="">First Name</label>
                            <input type="text" name="fname" placeholder="First Name" required></input>
                        </div>
                        <div class="field">
                            <label for="">Last Name</label>
                            <input type="text" name="lname" placeholder="Last Name" required></input>
                        </div>
                    </div>
                    <div class="field">
                        <label for="">Email</label>
                        <input type="text" name="email" placeholder="Email" required></input>
                    </div>
                    <div class="field">
                        <label for="">Password</label>
                        <input type="password" name="password" placeholder="Password" required></input>
                        <i class="eye fa fa-eye">
                        </i>
                    </div>
                    <div class="image">
                        <div class="fieldin">
                            <label for="">Image</label>
                            <input type="file" name="image" placeholder="Sellect Image" requred></input>
                        </div>
                    </div>
                    <div class="field">
                        <div class="button">
                            <input type="submit" placeholder="signup" ></input>
                        </div>
                    </div>
                    <div class="link">Already have an account <a href="login.php">Login</a></div>
            </form>
        </section>
    </div>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/signup.js"></script>
</body>
</html>