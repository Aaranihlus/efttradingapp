@extends('sections.main')

@section('content')
<div class="container-fluid">

  <br>

  <div class="row">

    <div class="col-2">

      <ul class="list-group text-center">
        <li class="list-group-item">
          <h2>{{ auth()->user()->username }}</h2>
        </li>

        <li class="list-group-item">
          <p>Profile Picture</p>
        </li>

        <li class="list-group-item">
          <p>Completed Trades:</p>
        </li>

        <li class="list-group-item">
          <p>Rating:</p>
        </li>
      </ul>
    </div>

    <div class="col-2">
      <ul class="list-group text-center">
        <li class="list-group-item p-0">
          <p>Items I am Buying<p>
        </li>
      </ul>
    </div>


    <div class="col-2">
      <ul class="list-group text-center">
        <li class="list-group-item p-0">
          <p>Items I am Selling<p>
        </li>
      </ul>
    </div>





    <div class="col-6">
      <ul class="list-group">

        <li class="list-group-item">Main Categories</li>

        <li class="list-group-item p-0" id="MainCategoriesContainer">
          <div id="MainCategories"></div>
        </li>


        <li class="list-group-item" id="SubCatHeader" style="display:none;">Sub Categories</li>
        <li class="list-group-item p-0" id="SubCategoriesContainer" style="display:none;">
          <div class="container-fluid p-0" id="SubCategories"></div>
        </li>


        <li class="list-group-item p-0" id="SelectedItemContainer" style="display:none;">
          <div class="container-fluid p-0">

            <br>
            <div class="row">
              <div class="col-4" id="SelectedItemInfo"></div>

              <div class="col-4">
                <form method="POST" id="SellingForm">
                  {{ csrf_field() }}
                  <input class="form-control" type="text" id="item_id_s" name="item_id" value="" hidden>
                  <div id="ItemSellingData"></div>
                  <button class="btn btn-primary align-middle" id="UpdateSelling">Update Selling</button>
                </form>
              </div>

              <div class="col-4">
                <form method="POST" id="BuyingForm">
                  {{ csrf_field() }}
                  <input class="form-control" type="text" id="item_id_b" name="item_id" value="" hidden>
                  <div id="ItemBuyingData"></div>
                  <button class="btn btn-primary align-middle" id="UpdateBuying">Update Buying</button>
                </form>
              </div>

            </div>
          </div>
        </li>


        <li class="list-group-item" id="CategoryItemsContainer" style="display:none;">
          <div class="row" id="CategoryItems"></div>
        </li>

      </ul>



    </div>

  </div>

</div>
@endsection
