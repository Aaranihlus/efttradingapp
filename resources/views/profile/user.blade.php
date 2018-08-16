@extends('sections.main')

@section('content')
<div class="container-fluid">

  <div class="row">

    <div class="col-2 p-0" style="background-color:#6c757d; text-align:center;">
      <div class="container-fluid p-0">
        <p>{{ auth()->user()->username }}</p>
        <p>Profile Picture</p>
        <p>Completed Trades:</p>
        <p>Rating:</p>
      </div>
    </div>

    <div class="col-10 p-0" style="border-left: 1px solid #212529;">

      <div class="container-fluid p-0" id="MainCategories"></div>
      <div class="container-fluid p-0" id="SubCategories"></div>

      <div class="container-fluid" style="background-color:#353a3f">
        <form method="POST" id="UpdateItemForm">
          {{ csrf_field() }}
          <input type="text" id="item_id" name="item_id" value="" hidden>
        <div class="row">
          <div class="col-4 itembox" id="SelectedItemInfo"></div>
          <div class="col-3 itembox" id="ItemSellingPanel"></div>
          <div class="col-3 itembox" id="ItemBuyingPanel"></div>
          <div class="col-2 itembox">
            <button class="btn btn-primary mx-auto" id="UpdateItemButton">Update Item</button>
          </div>
        </div>
        </form>

      </div>



      <div class="container-fluid">
          <div class="row" id="CategoryItems"></div>
      </div>



    </div>

  </div>

</div>
@endsection
