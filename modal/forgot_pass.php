<!-- Modal -->
<div class="modal fade " id="forgot_pass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title" id="staticBackdropLabel">FORGOT PASSWORD</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form action="code.php" method="post">
              <div class="form-floating mb-3">
                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username" required >
                <label for="floatingInput">Username</label>
            </div>
              <div class="form-floating mb-3">
                <input type="text" name="recovery_key" class="form-control" id="floatingInput" placeholder="recovery_key" required >
                <label for="floatingInput">Recovery Key</label>
              </div>

              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" name="pass" type="submit">Submit</button>
              </div>
              <hr class="my-4">
            </form>
      </div>
    </div>
  </div>
</div>
