<footer class="text-muted">
  <div class="container">
    <p class="float-right">Footer</p>
  </div>
</footer>



<!--registration Modal-->
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
<!-- registration Modal -->


<!-- Offer Modal -->
<div class="modal fade" id="OfferModal" tabindex="-1" role="dialog" aria-labelledby="OfferModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="OfferModalLabel">Send an Offer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
<!-- Offer Modal -->
