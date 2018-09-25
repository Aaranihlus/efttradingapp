<footer class="footer">
  <p>All images are copyright of BATTLESTATE GAMES LIMITED</p>
</footer>




<!-- Offer Modal -->
<div class="modal fade" id="OfferModal" tabindex="-1" role="dialog" aria-labelledby="OfferModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="OfferModalLabel">Modal Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="OfferForm">
          {{ csrf_field() }}
          <input type="text" id="lister_id" name="lister_id" value="" hidden>
          <input type="text" id="offer_item_id" name="offer_item_id" value="" hidden>
          <div class="form-group">
            <label for="offer_quantity" class="col-form-label" id="offer_quantity_label"></label>
            <input type="number" min="1" max="1" class="form-control" id="offer_quantity">
          </div>
          <label for="offer_price" class="col-form-label">Price Per Unit</label>
          <div class="row">
            <div class="col-7">
              <div class="form-group">
                <input type="number" class="form-control" id="offer_price">
              </div>
            </div>
            <div class="col-5">
              <div class="form-group">
                <select class="form-control" id="offer_currency" name="offer_currency">
                   <option value="Roubles">Roubles</option>
                   <option value="Euros">Euros</option>
                   <option value="Dollars">Dollars</option>
                </select>
              </div>
            </div>
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



<!-- Mark as Completed Modal -->
<div class="modal fade" id="OfferCompleteModal" tabindex="-1" role="dialog" aria-labelledby="OfferModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Complete Trade</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="OfferCompleteForm">
          <label>This will close the current trade and mark it as completed for you and your trade partner.</label>
          <label>You will be able to rate this trader and leave a comment from your offers page after it is marked as complete.</label>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" style="width:50%;" class="btn btn-primary" data-dismiss="modal">Cancel</button>
        <button type="button" style="width:50%;" class="btn btn-primary" id="markAsCompleteButton">Mark as Complete</button>
      </div>
    </div>
  </div>
</div>
<!-- Offer Modal -->



<!-- Cancel Trade Modal -->
<div class="modal fade" id="OfferCancelModal" tabindex="-1" role="dialog" aria-labelledby="OfferModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cancel Trade</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="OfferCancelForm">
          <label>This will cancel the current trade for you and your trade partner.</label>
          <label>The offer will be deleted, and removed from your offers page.</label>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" style="width:100%;" class="btn btn-primary" id="cancelTradeButton">Cancel This Trade</button>
      </div>
    </div>
  </div>
</div>
<!-- Cancel Trade Modal -->


<!-- Scam Modal -->
<div class="modal fade" id="OfferScamModal" tabindex="-1" role="dialog" aria-labelledby="OfferScamModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Report a Scam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="OfferScamForm">
          <label>This will cancel the current trade for you and your trade partner.</label>
          <label>Your trade partner will have their reputation reduced and their number of scam reports will increase</label>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" style="width:100%;" class="btn btn-primary" id="reportScamButton">Send Report</button>
      </div>
    </div>
  </div>
</div>
<!-- Scam Modal -->




<!-- Review Modal -->
<div class="modal fade" id="reviewTradeModal" tabindex="-1" role="dialog" aria-labelledby="reviewTradeModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reviewTradeTitle">Review Trade</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="reviewTradeForm">

          {{ csrf_field() }}

          <div class="form-group">
            <label for="review_rep" class="col-form-label" id="review_rep_label">How would you rate this trade?</label>
            <select class="form-control" id="review_rep">
              <option value="positive">Positive (+1 Rep)</option>
              <option value="negative">Negative (-1 Rep)</option>
            </select>
          </div>

          <div class="form-group">
            <label for="review_comment" class="col-form-label" id="review_comment_label">Comment</label>
            <textarea class="form-control" id="review_comment"></textarea>
          </div>

        </form>

      </div>
      <div class="modal-footer">
        <button type="button" style="width:100%;" class="btn btn-primary" id="reviewTradeButton">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- Review Modal -->
