<!-- Modal -->
<div class="modal fade " id="sales" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="expenseLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title" id="expenseLabel">ADD NEW SALES</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form action="code.php" method="post">
              
            <div class="form-floating mb-3">
                <input type="text" name="crop_name" class="form-control" id="cropName" placeholder="Cop Name" required>
                <label for="cropName">Crop Name</label>
              </div>  

              <div class="form-floating mb-3">
                <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Quantity" required >
                <label for="quantity">Qauntity</label>
              </div>

              <div class="form-floating mb-3">
                <input type="text" name="weight" class="form-control" id="weight" placeholder="Amount" required >
                <label for="weight">Average Weight</label>
              </div>

              <div class="form-floating mb-3">
                <input type="text" name="amount" class="form-control" id="amount" placeholder="Weight" required >
                <label for="amount">Amount</label>
              </div>

              <div class="form-floating mb-3">
                <input type="date" name="sales_date" class="form-control" id="date" placeholder="Date" required >
                <label for="date">Date</label>
              </div>

              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" name="sales_record" type="submit">Submit</button>
              </div>
              <hr class="my-4">
            </form>
      </div>
    </div>
  </div>
</div>