<!-- Modal -->
<div class="modal fade " id="crop_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="expenseLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title" id="expenseLabel">ADD NEW RECORD</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form action="code.php" method="post">
              
            <div class="form-floating mb-3">
               <select class="form-control" name="crop" iid="floatingInput" placeholder="Croping">
                    <option value="1st Crop">1st Crop</option>
                    <option value="2nd Crop">2nd Crop</option>
                </select>
                <label id="floatingInput">Croping</label>
              </div>  
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" name="crop_record" type="submit">Submit</button>
              </div>
              <hr class="my-4">
            </form>
      </div>
    </div>
  </div>
</div>