require('./bootstrap');

window.$ = require('jquery');
window.toastr = require('toastr');

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
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


var selected_main_category = "";

//Get Main Categories on Page Load
if ($('#MainCategories').length )
{
  $.getJSON('/items/main', function(response)
  {
    $.each(response, function(k, v)
    {
      $('#MainCategories').append('<button class="btn btn-primary" data-type="'+ v +'">' + v.replace('_', ' ') + '</button>');
    });
  });
};

//When a main category is clicked, get its sub categories
$( "#MainCategories" ).on( "click", "button", function(e)
{
  $('#SubCatHeader').show();
  $('#SubCategoriesContainer').show();
  selected_main_category = $(e.target).text();

  $('#SubCategories').empty();
  $.getJSON('/items/bymain/' + $(this).data("type"), function(response)
  {
    $.each(response, function(k, v)
    {
      $('#SubCategories').append('<button class="btn btn-primary" data-type="'+ v +'">' + v.replace('_', ' ') + '</button>');
    });
  });
});

//When a sub category is clicked, get its items
$( "#SubCategories" ).on( "click", "button", function()
{
  $('#CategoryItemsContainer').show();
  $('#CategoryItems').empty();
  $.getJSON('/items/subcat/' + $(this).data("type") + '/' + selected_main_category.replace('%20', ' '), function(response)
  {
    if($('#SelectedItemInfo').length == 0)
    {
      $.each(response, function(k, v)
      {
        $('#CategoryItems').append('<a class="col-4 mb-5" href="/item/' + v.id + '"><p class="text-center text-truncate">' + v.name + '</p><div class="image-block" style="background-image:url(../images/' + v.main_category + '/' + v.image + ');"></div></a>');
      });
    }
    else
    {
      $.each(response, function(k, v)
      {
        $('#CategoryItems').append('<div class="col-4 mb-5" data-id="'+v.id+'" href="/item/' + v.id + '"><p class="text-center">' + v.name + '</p><div class="image-block" style="background-image:url(../images/' + v.main_category + '/' + v.image + ');"></div></div>');
      });
    }
  });
});


$( "#CategoryItems" ).on( "click", ".col-4", function()
{
  $('#SelectedItemContainer').show();
  var SelectedItemImg = $(this).find('.image-block').css('background-image');
  var ImgPath = SelectedItemImg.replace(/(?:^url\(["']?|["']?\)$)/g, "");
  var SelectedItemName = $(this).find('p').text();
  var SelectedItemId = $(this).data('id');

  $('#SelectedItemInfo').empty();
  $('#ItemSellingData').empty();
  $('#ItemBuyingData').empty();
  $('#CategoryItems').empty();

  $('#SelectedItemInfo').append('<div data-id="' + SelectedItemId + '"><p>' + SelectedItemName + '</p><img class="img-fluid" src="' + ImgPath + '"></div>');

  $('#item_id_s').val(SelectedItemId);
  $('#item_id_b').val(SelectedItemId);

  $('#ItemSellingData').append(`<p>Selling</p>
                                 <input type="number" class="form-control" id="s_quantity" name="quantity"></input>
                                 <p>for:</p>
                                 <input class="form-control" type="number" id="s_price" name="price"></input>
                                 <select class="form-control" id="s_currency" name="currency">
                                    <option value="Roubles">Roubles</option>
                                    <option value="Euros">Euros</option>
                                    <option value="Dollars">Dollars</option>
                                 </select>`);

   $('#ItemBuyingData').append(`<p>Buying</p>
                                  <input type="number" class="form-control" id="b_quantity" name="quantity"></input>
                                  <p>for:</p>
                                  <input class="form-control" type="number" id="b_price" name="price"></input>
                                  <select class="form-control" id="b_currency" name="currency">
                                     <option value="Roubles">Roubles</option>
                                     <option value="Euros">Euros</option>
                                     <option value="Dollars">Dollars</option>
                                  </select>`);

  $.getJSON('/items/user/selling/' + SelectedItemId).done(function(response)
  {
    if(response[0])
    {
      $("#s_quantity").val(response[0].quantity);
      $("#s_price").val(response[0].price);
    }else{
      $("#s_quantity").val(0);
      $("#s_price").val(0);
    }
  });

  $.getJSON('/items/user/buying/' + SelectedItemId).done(function(response)
  {
    if(response[0])
    {
      $("#b_quantity").val(response[0].quantity);
      $("#b_price").val(response[0].price);
    }else{
      $("#b_quantity").val(0);
      $("#b_price").val(0);
    }
  });

});


$('#UpdateBuying').on('click', function(e){
  e.preventDefault();
  $.post("/user/update_buying", $( "#BuyingForm" ).serialize(), function(response)
  {
    if(response == "true")
    {
      toastr.info('Buying Information Successfully Updated!');
    }
  });
});

$('#UpdateSelling').on('click', function(e){
  e.preventDefault();
  $.post("/user/update_selling", $( "#SellingForm" ).serialize(), function(response)
  {
    if(response == "true")
    {
      toastr.info('Selling Information Successfully Updated!');
    }
  });
});



$('#OfferModal').on('show.bs.modal', function (event)
{
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


$('#SendOfferButton').on('click', function()
{
  $.post("/offer", { quantity: $('#offer_quantity').val(), price: $('#offer_price').val(), _token: $('input[name="_token"]').val(), lister_id: $('#lister_id').val(), currency: $('#offer_currency').val(), item_id: $('#offer_item_id').val() },
  function(response)
  {
    if(response == "success"){
      toastr.info('Your offer was sent successfully!');
    }
    else {
      toastr.error('Failed to send trade offer');
    }
  });
});
