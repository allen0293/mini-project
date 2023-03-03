<!-- Modal -->
<div class="modal fade " id="expense" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="expenseLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title" id="expenseLabel">ADD NEW EXPENSE</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form action="code.php" method="post">
              
            <div class="form-floating mb-3">
                <input type="text" name="dsc" class="form-control" id="description" placeholder="Description" required>
                <label for="description">Description</label>
              </div>  

              <div class="form-floating mb-3">
                <input type="text" name="amount" class="form-control" id="amount" placeholder="Amount" required >
                <label for="amount">Amount</label>
              </div>

              <div class="form-floating mb-3">
                <input type="date" name="date_record" class="form-control" id="date" placeholder="Date" required >
                <label for="date">Date</label>
              </div>

              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" name="expense_record" type="submit">Submit</button>
              </div>
              <hr class="my-4">
            </form>
      </div>
    </div>
  </div>
</div>