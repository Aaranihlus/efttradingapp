<footer class="text-muted">
  <div class="container">
    <p class="float-right">Footer</p>
  </div>
</footer>




<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <div class="container">
          @include('sections.errors')
        </div>


        <form method="POST" action="/register">
          {{ csrf_field() }}

          <div class="form-group row">
            <label for="username" class="col-2 col-form-label">Username</label>
            <div class="col-10">
              <input class="form-control" type="text" id="username" name="username">
            </div>
          </div>

          <div class="form-group row">
            <label for="email" class="col-2 col-form-label">Email Address</label>
            <div class="col-10">
              <input class="form-control" type="email" id="email" name="email">
            </div>
          </div>

          <div class="form-group row">
            <label for="password" class="col-2 col-form-label">Password</label>
            <div class="col-10">
              <input class="form-control" type="text" id="password" name="password">
            </div>
          </div>

          <div class="form-group row">
            <label for="password_confirmation" class="col-2 col-form-label">Password Confirmation</label>
            <div class="col-10">
              <input class="form-control" type="text" id="password_confirmation" name="password_confirmation">
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>

        </form>
      </div>

    </div>
  </div>
</div>
