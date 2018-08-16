window.$ = require('jquery');
require('bootstrap');
window.toastr = require('toastr');

//Get Main Categories on Page Load
$( document ).ready(function() {
  $.getJSON('/items/main', function(response)
  {
    $.each(response, function(k, v) {
      $('#MainCategories').append('<button class="btn btn-primary" data-type="'+ v +'">' + v.replace('_', ' ') + '</button>');
    })
  }
);
});

//When a main category is clicked, get its sub categories
$( "#MainCategories" ).on( "click", "button", function() {

  $('#SubCategories').empty();

  $.getJSON('/items/bymain/' + $(this).data("type"), function(response)
  {
    $.each(response, function(k, v) {
      $('#SubCategories').append('<button class="btn btn-secondary" data-type="'+ v +'">' + v.replace('_', ' ') + '</button>');
    })
  }
);
});

//When a sub category is clicked, get its items
$( "#SubCategories" ).on( "click", "button", function() {

  $('#CategoryItems').empty();

  $.getJSON('/items/subcat/' + $(this).data("type"), function(response)
  {
    $.each(response, function(k, v) {
      $('#CategoryItems').append('<div class="col-4 p-0 itembox" data-id="'+v.id+'"><p class="mx-auto">' + v.name + '</p><img class="mx-auto" src="../images/' + v.main_category + '/' + v.image + '"></div>');
    })
  }
);
});


$( "#CategoryItems" ).on( "click", ".itembox", function()
{
  var SelectedItemImg = $(this).find('img').attr('src');
  var SelectedItemName = $(this).find('p').text();
  var SelectedItemId = $(this).data('id');

  $('#SelectedItemInfo').empty();
  $('#ItemSellingPanel').empty();
  $('#ItemBuyingPanel').empty();
  $('#CategoryItems').empty();

  $('#SelectedItemInfo').append('<div class="col-4 p-0" data-id="' + SelectedItemId + '"><p class="mx-auto">' + SelectedItemName + '</p><img class="mx-auto" src="' + SelectedItemImg + '"></div>');

    $.getJSON('/items/user/' + SelectedItemId, function(response)
    {
      $('#item_id').val(SelectedItemId);
      $('#ItemSellingPanel').append(`<p>Selling</p>
                                     <input type="number" id="sellingqty" name="sellingqty"></input>
                                     <p>for:</p>
                                     <input type="number" id="sellingprice" name="sellingprice"></input>
                                     <select name="sellingcurrency">
                                        <option value="Roubles">Roubles</option>
                                        <option value="Euros">Euros</option>
                                        <option value="Dollars">Dollars</option>
                                     </select>`);
     $('#ItemBuyingPanel').append(`<p>Buying</p>
                                   <input type="number" id="buyingqty" name="buyingqty"></input>
                                   <p>for:</p>
                                   <input type="number" id="buyingprice" name="buyingprice"></input>
                                   <select name="buyingcurrency">
                                      <option value="Roubles">Roubles</option>
                                      <option value="Euros">Euros</option>
                                      <option value="Dollars">Dollars</option>
                                   </select>`);

    if(response[0]) {
      $("#sellingqty").val(response[0].selling_quantity);
      $("#sellingprice").val(response[0].selling_price);
      $("#buyingqty").val(response[0].buying_quantity);
      $("#buyingprice").val(response[0].buying_price);
    } else {
      $("#sellingqty").val(0);
      $("#sellingprice").val(0);
      $("#buyingqty").val(0);
      $("#buyingprice").val(0);
    }
  });
});


$('#UpdateItemButton').on('click', function(e){
  e.preventDefault();
  $.post("/profile/items", $( "#UpdateItemForm" ).serialize(), function(response){
    if(response == "true"){
      console.log('show flash message');
      toastr.info('Are you the 6 fingered man?');
    }
  });
});
