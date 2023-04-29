<?php
require("required/header.php");
if (isset($_SESSION[USER]) && $_SESSION[USER] != 0) {
    header("Location:index.php");
    exit();
}
?>
<section class="">
    <div class="d-flex justify-content-around ">
        <div class="col-lg-3 card shadow  border-start border-end p-4 rounded-3 w-75  text-white" style="margin:4rem 0 4rem; min-height:40rem;">
            <div class="card-header bg-success rounded-3 p-3">
                <div class="d-flex justify-content-between">
                    <span class="h4">ALL Transactions </span>
                    <div class="buttons">
                        <span class="btn btn-warning text-dark rounded-1 p-2" data-bs-toggle="modal" data-bs-target="#myModal">Deposit</span>
                        <span class="btn btn-light text-dark rounded-1 p-2" data-bs-toggle="modal" data-bs-target="#withdraw">With Draw</span>
                    </div>
                </div>
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

<div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="backend/transaction.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Deposit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="userID" value="1">
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example1">Deposit</label>
                        <input type="text" id="form2Example1" class="form-control" name="deposit" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="withdraw" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="backend/transaction.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Withdraw</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="userID" value="1">
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example1">Withdraw</label>
                        <input type="text" id="form2Example1" class="form-control" name="withdraw" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
require "required/footer.php";
?>
<script src="assets/js/transaction.js"></script>

</body>

</html>