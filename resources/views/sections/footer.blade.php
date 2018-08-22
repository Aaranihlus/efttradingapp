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
        <h5 class="modal-title" id="OfferModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="OfferForm">
          {{ csrf_field() }}
          <input type="text" id="lister_id" name="lister_id" value="" hidden>
          <input type="text" id="offer_item_id" name="offer_item_id" value="" hidden>

          <select class="form-control" id="offer_currency" name="offer_currency">
             <option value="Roubles">Roubles</option>
             <option value="Euros">Euros</option>
             <option value="Dollars">Dollars</option>
          </select>

          <div class="form-group">
            <label for="offer_quantity" class="col-form-label" id="offer_quantity_label"></label>
            <input type="number" min="1" max="1" class="form-control" id="offer_quantity">
          </div>

          <div class="form-group">
            <label for="offer_price" class="col-form-label" id="">Price Per Unit</label>
            <input type="number" class="form-control" id="offer_price">
          </div>
        </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="SendOfferButton">Send Offer</button>
      </div>
    </div>
  </div>
</div>
<!-- Offer Modal -->
