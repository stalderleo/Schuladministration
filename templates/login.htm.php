<form action="./index.php?id=login" method="POST">
  <div class="form-group">
    <label for="Username">Username</label>
    <input type="text" name="username" class="form-control is-valid" id="username" aria-describedby="emailHelp" placeholder="Enter Username">
    <div class="valid-feedback">
        Looks good!
    </div>
    <div class="invalid-feedback">
        Please enter your username!
    </div>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control is-invalid" id="password" placeholder="Enter Password">
    <div class="valid-feedback">
        Looks good!
    </div>
    <div class="invalid-feedback">
        Password incorrectly!
    </div>
  </div>
    
  <div class="form-group form-check">
    <input type="checkbox" name="remember_me" class="form-check-input" id="rememberMe">
    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
  </div>
  <button type="submit" class="btn btn-primary">Log In</button>
</form>
