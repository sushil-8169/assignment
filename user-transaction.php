<?php
require("required/header.php");
if (isset($_SESSION[USER]) && $_SESSION[USER] != 1) {
    header("Location:index.php");
    exit();
}
?>
<section class="">
    <div class="d-flex justify-content-around ">
        <div class="col-lg-3 card shadow  border-start border-end p-4 rounded-3 w-75  text-white" style="margin:4rem 0 4rem; min-height:40rem;">
            <div class="card-header bg-success rounded-3 p-3">
                <span class="h4">ALL Transactions </span>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Deposit</th>
                            <th scope="col">Withdraw</th>
                            <th scope="col">Balance Amount</th>
                            <th scope="col">Transaction Date</th>
                        </tr>
                    </thead>
                    <tbody id="accountTable">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


<?php
require "required/footer.php";
?>
<script src="assets/js/transaction.js"></script>

</body>

</html>