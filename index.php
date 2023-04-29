<?php
require("required/header.php");
?>

<section class="">
    <div class="d-flex justify-content-around ">
        <div class="col-lg-3 card shadow  border-start border-end p-4 rounded-3 bg-success text-white" style="margin:10rem;">
            <span class="h2 mb-4">Login </span>
            <form action="backend/login.php" method="post">
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example1">Email Address :</label>
                    <input type="email" id="form2Example1" class="form-control" name="email" />
                </div>
                <!-- Password input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example2">Password :</label>
                    <input type="password" id="form2Example2" class="form-control" name="password" />
                </div>

                <div class="d-flex justify-content-around">
                    <button type="submit" name="singUp" class="btn text-white mb-4 w-100 rounded-pill p-3  text-center bg-dark rounded-0">Sign in</button>
                </div>

            </form>
        </div>
    </div>
</section>



<?php
require "required/footer.php";
?>


</body>

</html>