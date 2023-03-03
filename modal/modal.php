<!-- Modal -->
<div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title" id="staticBackdropLabel">Create Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form action="code.php" method="post">
              <div class="form-floating mb-3">
                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username" required >
                <label for="floatingInput">username</label>
              </div>

              <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="newAcctPassword" placeholder="Password" required >
                <label for="newAcctPassword">Password</label>
              </div>

              <div class="form-floating mb-3">
                <input type="text" name="recovery_key" class="form-control" id="floatingInput" placeholder="recovery_key" required >
                <label for="floatingInput">Recovery Key</label>
              </div>

              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck" onclick="showPass2()" >
                <label class="form-check-label" for="rememberPasswordCheck">
                Show Password
                </label>
              </div>

              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" name="new_user" type="submit">Submit</button>
              </div>
              <hr class="my-4">
            </form>
      </div>
    </div>
  </div>
</div>