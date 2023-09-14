<!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupmodal">
  Launch demo modal
</button>--->

<!-- Modal -->
<div class="modal fade" id="signupmodal" tabindex="-1" aria-labelledby="signupmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="signupmodalLabel">sign up to forum for coders for Account</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="partials/handlesignup.php" method="post">
      <div class="modal-body">
        <div class="mb-3">
          <label for="password" class="form-label">Username</label>
          <input type="text" class="form-control" id="password" aria-describedby="emailHelp" name="email">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
          <label for="cpass" class="form-label">confirm Password</label>
          <input type="password" class="form-control" id="cpass" name="cpassword">
        </div>
        <div id="emailHelp" class="form-text">password and confirm password should be same.</div>

        
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary">sign up</button>

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>