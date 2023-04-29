<?php
require("required/header.php");
if (isset($_SESSION[USER]) && $_SESSION[USER] != 1) {
    var_dump($_SERVER);
    header("Location:index.php");
    exit();
}
?>
<section class="">
    <div class="d-flex justify-content-around ">
        <div class="col-lg-3 card shadow  border-start border-end p-4 rounded-3 w-75  text-white" style="margin:4rem 0 4rem; min-height:40rem;">
            <div class="card-header bg-success rounded-3 p-3">
                <span class="h4">ALL User </span>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="userTable">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>



<?php
require "required/footer.php";
?>
<script src="assets/js/all-user.js"></script>

</body>

</html>