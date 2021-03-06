require('./bootstrap');
window.$ = require('jquery');
window.toastr = require('toastr');

toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-bottom-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};

$(function () {
  $('[data-toggle="popover"]').popover()
})

var selected_main_category = "";

$( "#specific_item_view" ).on( "click", function(e){
  $('#item_view_container').show();
});

if ($('#MainCategories').length ){
  $.getJSON('/items/main', function(response){
    $.each(response, function(k, v){
      $('#MainCategories').append('<button class="btn btn-primary" data-type="'+ v +'">' + v.replace('_', ' ') + '</button>');
    });
  });
};





document.addEventListener('keydown', function(event) {
  if(event.keyCode == 13){
    event.preventDefault();
    if($('#offer_message_send').length){
      $('#offer_message_send').click();
    } else {
      $('#g_chat_send').click();
    }
  };
});



$( "#MainCategories" ).on( "click", "button", function(e){
  $('#SubCatHeader').show();
  $('#SubCategoriesContainer').show();
  selected_main_category = $(e.target).text();

  $('#SubCategories').empty();
  $.getJSON('/items/bymain/' + $(this).data("type"), function(response){
    $.each(response, function(k, v){
      $('#SubCategories').append('<button class="btn btn-primary" data-type="'+ v +'">' + v.replace('_', ' ') + '</button>');
    });
  });
});


$( "#SubCategories" ).on( "click", "button", function(){
  $('#CategoryItemsContainer').show();
  $('#CategoryItems').empty();
  $.getJSON('/items/subcat/' + $(this).data("type") + '/' + selected_main_category.replace('%20', ' '), function(response){
    if($('#SelectedItemInfo').length == 0){
      $.each(response, function(k, v){
        $('#CategoryItems').append('<a class="col-3 mb-5" href="/item/' + v.id + '"><p class="text-center text-truncate">' + v.name + '</p><div class="image-block" style="background-image:url(../images/' + v.main_category + '/' + v.image + ');"></div></a>');
      });
    } else {
      $.each(response, function(k, v){
        $('#CategoryItems').append('<div class="col-3 mb-5" data-id="'+v.id+'" href="/item/' + v.id + '"><p class="text-center">' + v.name + '</p><div class="image-block" style="background-image:url(../images/' + v.main_category + '/' + v.image + ');"></div></div>');
      });
    }
  });
});


$( "#CategoryItems" ).on( "click", ".col-3", function(){
  $('#SelectedItemContainer').show();
  var SelectedItemImg = $(this).find('.image-block').css('background-image');
  var ImgPath = SelectedItemImg.replace(/(?:^url\(["']?|["']?\)$)/g, "");
  var SelectedItemName = $(this).find('p').text();
  var SelectedItemId = $(this).data('id');

  $('#SelectedItemInfo').empty();
  $('#ItemSellingData').empty();
  $('#ItemBuyingData').empty();
  $('#CategoryItems').empty();

  $('#SelectedItemInfo').append(`<div data-id="` + SelectedItemId + `"><p>Selected: ` + SelectedItemName + `</p>
                                      <img class="img-fluid" src="` + ImgPath + `">
                                   </div>`);

  $('#item_id_s').val(SelectedItemId);
  $('#item_id_b').val(SelectedItemId);

  $('#ItemSellingData').append(`<p>Selling Info</p>

                                <div class="form-group row">
                                  <label for="s_quantity" class="col-3 col-form-label">Quantity</label>
                                  <div class="col-9">
                                    <input type="number" class="form-control" id="s_quantity" name="quantity"></input>
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="s_price" class="col-3 col-form-label">Price</label>
                                  <div class="col-9">
                                    <input class="form-control" type="number" id="s_price" name="price"></input>
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="s_currency" class="col-3 col-form-label">Currency</label>
                                  <div class="col-9">
                                    <select class="form-control" id="s_currency" name="currency">
                                      <option value="Roubles">Roubles</option>
                                      <option value="Euros">Euros</option>
                                      <option value="Dollars">Dollars</option>
                                    </select>
                                  </div>
                                </div>`);

    $('#ItemBuyingData').append(`<p>Buying Info</p>

                                  <div class="form-group row">
                                    <label for="b_quantity" class="col-3 col-form-label">Quantity</label>
                                    <div class="col-9">
                                      <input type="number" class="form-control" id="b_quantity" name="quantity"></input>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="b_price" class="col-3 col-form-label">Price</label>
                                    <div class="col-9">
                                      <input class="form-control" type="number" id="b_price" name="price"></input>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="b_currency" class="col-3 col-form-label">Currency</label>
                                    <div class="col-9">
                                      <select class="form-control" id="b_currency" name="currency">
                                        <option value="Roubles">Roubles</option>
                                        <option value="Euros">Euros</option>
                                        <option value="Dollars">Dollars</option>
                                      </select>
                                    </div>
                                  </div>`);

      $.getJSON('/items/user/selling/' + SelectedItemId).done(function(response){
        if(response[0]){
          $("#s_quantity").val(response[0].quantity);
          $("#s_price").val(response[0].price);
        } else {
          $("#s_quantity").val(0);
          $("#s_price").val(0);
        }
      });

      $.getJSON('/items/user/buying/' + SelectedItemId).done(function(response){
        if(response[0]){
          $("#b_quantity").val(response[0].quantity);
          $("#b_price").val(response[0].price);
        } else {
          $("#b_quantity").val(0);
          $("#b_price").val(0);
        }
      });
    });


    $('#UpdateBuying').on('click', function(e){
      e.preventDefault();
      $.post("/user/update_buying", $( "#BuyingForm" ).serialize(), function(response){
        if(response == "true"){
          toastr.info('Buying Information Successfully Updated!');
        }
      });
    });

    $('#UpdateSelling').on('click', function(e){
      e.preventDefault();
      $.post("/user/update_selling", $( "#SellingForm" ).serialize(), function(response){
        if(response == "true"){
          toastr.info('Selling Information Successfully Updated!');
        }
      });
    });


    $('#OfferModal').on('show.bs.modal', function (event){
      var button = $(event.relatedTarget);
      var modal = $(this);
      modal.find('.modal-title').text(button.text() + button.data('name'));
      modal.find('#offer_quantity_label').text('How many do you want to ' + button.text()+'?');
      modal.find('#offer_quantity').val(1);
      modal.find('#offer_quantity').attr('max', button.data('quantity'));
      modal.find('#offer_price').val(button.data('price'));
      modal.find('#lister_id').val(button.data('lister'));
      modal.find('#offer_item_id').val(button.data('item_id'));
    });


    $('#markAsCompleteButton').on('click', function(){
      $.post("/complete_offer", { _token: $('input[name="_token"]').val(), offer_id: $('#offer_message_offer_id').val() },
      function(response){
        if(response == "success"){
          toastr.info('Offer Marked as Complete!');
          $("#offer_message_send").prop('disabled', true);
          $("#openCompleteModal").prop('disabled', true);
          $("#openCancelModal").prop('disabled', true);
        } else {
          toastr.error('Failed to mark offer as complete');
        }
      });
    });

    $('#cancelTradeButton').on('click', function(){
      $.post("/close_offer", { _token: $('input[name="_token"]').val(), offer_id: $('#offer_message_offer_id').val() },
      function(response){
        if(response == "success"){
          toastr.info('Offer Has Been Cancelled');
          $("#offer_message_send").prop('disabled', true);
          $("#openCompleteModal").prop('disabled', true);
          $("#openCancelModal").prop('disabled', true);
        } else {
          toastr.error('Failed to cancel offer');
        }
      });
    });

    $('#SendOfferButton').on('click', function(){
      $.post("/offer", { quantity: $('#offer_quantity').val(), price: $('#offer_price').val(), _token: $('input[name="_token"]').val(), lister_id: $('#lister_id').val(), currency: $('#offer_currency').val(), item_id: $('#offer_item_id').val() },
      function(response){
        if(response == "success"){
          toastr.info('Your offer was sent successfully!');
        } else {
          toastr.error('Failed to send trade offer');
        }
      });
    });


    $('#recieved_offers_list, #sent_offers_list').on('click', 'a', function(e){
      if(e.target.dataset.id){
        $.post("/close_offer", { offer_id: e.target.dataset.id, _token: $('#csrf_header').attr('content') },
        function(response){
          if(response == "success"){
            toastr.info('Offer Removed');
            $('#offer-' + e.target.dataset.id).remove();
          } else {
            toastr.error('Failed to remove offer');
          }
        });
      }
    });


    $('#reviewTradeModal').on('show.bs.modal', function (event){
      var button = $(event.relatedTarget);
      var modal = $(this);

      reviewer_id = $('#app').data('uid');
      offer_id = button.data('offer_id');

      //If the current users ID is equal to the creator ID, then the trade partner ID must be the recipient ID
      if(reviewer_id == button.data('creator_id')){
        partner_id = button.data('recipient_id');
      }

      //If the current users ID is equal to the recipient ID, then the trade partner ID must be the creator ID
      if(reviewer_id == button.data('recipient_id')){
        partner_id = button.data('creator_id');
      }

      modal.find('#reviewTradeTitle').text('Review Offer #' + button.data('offer_id'));
    });


    $('#reviewTradeButton').on('click', function(){
      $.post("/review_offer", { reviewer_id: reviewer_id, user_id: partner_id, _token: $('input[name="_token"]').val(), type: $('#review_rep').val(), comment: $('#review_comment').val(), offer_id: offer_id },
      function(response){
        if(response == "success"){
          toastr.info('Your review was succesfully saved!');
        } else {
          toastr.error('Failed to save review');
        }
      });
    });



    $('#active_listings_list').on('click', 'a', function(e){

      if(e.target.innerText == "Remove"){
        $.post("/remove_listing", { _token: $('input[name="_token"]').val(), item_id: e.currentTarget.dataset.item_id, type: e.currentTarget.dataset.listing_type, listing_id: e.currentTarget.dataset.listing_id },
        function(response){
          if(response == "success"){
            $('#pos_in_list_' + e.currentTarget.dataset.pos).remove();
            toastr.info('Listing Removed');
          } else {
            toastr.error('Failed to remove listing');
          }
        });
      };

      if(e.target.innerText == "Edit"){

      };
    });
