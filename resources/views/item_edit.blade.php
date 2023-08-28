@extends('template.tmp')
@section('title', $pagetitle)
@section('content')
<!-- BEGIN: Content-->
<div class="main-content">
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
        <div class="row">
          @if (session('error'))
          <div class="alert alert-{{ Session::get('class') }} p-3" id="success-alert">
            <strong>{{ Session::get('error') }} </strong>
          </div>
          @endif
          @if (count($errors) > 0)
          <div>
            <div class="alert alert-danger p-1   border-1 bg-danger text-white">
              <p class="font-weight-bold"> There were some problems with your input.</p>
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
          @endif
          <div class="col-12"> 
            <!-- enctype="multipart/form-data" -->
            <form action="{{URL('/ItemUpdate')}}" enctype="multipart/form-data" method="post">
              <input type="hidden" name="ItemID" value="{{$item[0]->ItemID}}">
              {{csrf_field()}}
              <div class="card shadow-sm">
                <div class="card-header">
                  <h2> Update Item</h2>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">

                      <div class="mb-3 row">
                        <div class="col-sm-2">
                          <label class="col-form-label fw-bold" for="first-name">Type</label>
                        </div>
                        <div class="col-sm-9">
                          <div class="form-check form-check-inline pt-2">
                            <input class="form-check-input" type="radio" name="ItemType" id="inlineRadio1" value="Goods" {{ $item[0]->ItemType == 'Goods' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio1">Goods</label>
                          </div>
                          <div class="form-check form-check-inline pt-2">
                            <input class="form-check-input" type="radio" name="ItemType" id="inlineRadio1" value="Service" {{ $item[0]->ItemType == 'Service' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio1">Service</label>
                          </div>
                          <div class="form-check form-check-inline pt-2">
                            <input class="form-check-input" type="radio" name="ItemType" id="inlineRadio1" value="Restaurant" {{ $item[0]->ItemType == 'Restaurant' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio1">Restaurant</label>
                          </div>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <div class="col-sm-2">
                          <label class="col-form-label fw-bold" for="name">Name</label>
                        </div>
                        <div class="col-sm-9">
                          <input type="text" id="name" class="form-control" name="ItemName" value="{{$item[0]->ItemName}}">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <div class="col-sm-2">
                          <label class="col-form-label fw-bold" for="first-name">Item Code</label>
                        </div>
                        <div class="col-sm-9">
                          <input type="text" id="code" class="form-control" name="ItemCode" value="{{$item[0]->ItemCode}}">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <div class="col-sm-2">
                          <label class="col-form-label fw-bold" for="Taxable">Taxable</label>
                        </div>
                        <div class="col-sm-4">
                          <select name="Taxable" id="Taxable" class="form-select">
                            <option value="">Select</option>
                            <option value="No" {{($item[0]->Taxable== 'No') ? 'selected=selected':'' }}>No</option>
                            <option value="Yes" {{($item[0]->Taxable== 'Yes') ? 'selected=selected':'' }}>Yes</option>
                          </select>
                        </div>
                        <div class="col-sm-2">
                          <label class="col-form-label fw-bold" for="first-name">Percentage</label>
                        </div>
                        <div class="col-sm-3">
                          <input type="text" id="Percentage" class="form-control" name="Percentage" value="{{$item[0]->Percentage}}" {{($item[0]->Taxable== 'No') ? 'disabled':'' }}>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <div class="col-sm-2">
                          <label class="col-form-label  text-danger" for="first-name">Cost Price</label>
                        </div>
                        <div class="col-sm-4">
                          <input type="text" id="first-name" class="form-control" name="CostPrice" value="{{$item[0]->CostPrice}}">
                        </div>
                        <div class="col-sm-2">
                          <label class="col-form-label  text-danger" for="first-name">Selling Price</label>
                        </div>
                        <div class="col-sm-3">
                          <input type="text" id="first-name" class="form-control" name="SellingPrice" value="{{$item[0]->SellingPrice}}">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <div class="col-sm-2">
                          <label class="col-form-label  " for="first-name">Cost Remarks</label>
                        </div>
                        <div class="col-sm-9">
                          <textarea name="CostDescription" id="" class="form-control" cols="43" rows="3">{{$item[0]->CostDescription}}</textarea>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <div class="col-sm-2">
                          <label class="col-form-label " for="first-name">Selling Remarks</label>
                        </div>
                        <div class="col-sm-9">
                          <textarea name="SellingDescription" id="" class="form-control" cols="43" rows="3">{{$item[0]->SellingDescription}}</textarea>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3 mt-5 row">
                        <input type="hidden" name="item_image" value="{{$item[0]->ItemImage}}">
                        <div class="col-sm-2">
                          <label class="col-form-label fw-bold" for="first-name">Image</label>
                        </div>
                        <div class="col-sm-8">
                          <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="col-sm-2">
                          <img src="{{asset('thumbnail').'/'.$item[0]->ItemImage}}" width="50px" height="50px">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <div class="col-sm-2">
                          <label class="col-form-label fw-bold" for="first-name">Units</label>
                        </div>
                        <div class="col-sm-9">
                          <select name="unit_id" id="unit_id" class="form-select">
                            <option value="">Select</option>
                            @foreach($units as $unit)
                            <option value="{{$unit->id}}" {{($item[0]->UnitID == $unit->id) ? 'selected=selected':'' }}>{{$unit->base_unit}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <div class="col-sm-2">
                          <label class="col-form-label fw-bold" for="Category">Category</label>
                        </div>
                        <div class="col-sm-9">
                          <select id="categories" name="category_id" class="form-select">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{$category->ItemCategoryID}}" {{$item[0]->ItemCategoryID == $category->ItemCategoryID ? 'selected' : ''}}>{{$category->title}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <div class="col-sm-2">
                          <label class="col-form-label fw-bold" for="first-name">Brand</label>
                        </div>
                        <div class="col-sm-9">
                          <select id="brand" name="brand_id" class="form-select">
                            <option value="">Select Brand</option>
                            @foreach($lims_brand_list as $brand_list)
                            <option value="{{$brand_list->id}}" {{$item[0]->BrandID == $brand_list->id ? 'selected' : ''}}>{{$brand_list->title}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <div class="col-sm-2">
                          <label class="col-form-label  fw-bold" for="first-name">Cost Account</label>
                        </div>
                        <div class="col-sm-9">
                          <select name="CostChartofAccountID" class="select2 form-select">
                            @foreach($chartofaccount as $value)
                            <option value="{{$value->ChartOfAccountID}}">{{$value->ChartOfAccountID}}-{{$value->ChartOfAccountName}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <div class="col-sm-2">
                          <label class="col-form-label fw-bold" for="first-name">Selling Account</label>
                        </div>
                        <div class="col-sm-9">
                          <select name="SellingChartofAccountID" class="form-select select2">
                            @foreach($chartofaccount as $value)
                            <option value="{{$value->ChartOfAccountID}}">{{$value->ChartOfAccountID}}-{{$value->ChartOfAccountName}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <div class="col-sm-2">
                          <label class="  fw-bold" for="first-name">Is Featured</label>
                        </div>
                        <div class="col-sm-2">
                          <input type="checkbox" value="1" name="isFeatured" {{$item[0]->IsFeatured == 1 ? 'checked' : ''}}>
                          <label for="vehicle2"> Featured</label>
                        </div>

                        <div class="col-sm-2">
                          <label class="  fw-bold" for="first-name">Status</label>
                        </div>
                        <div class="col-sm-2">
                          <input type="checkbox" name="isActive" value="1" {{$item[0]->IsActive == 1 ? 'checked' : ''}}>
                          <label for="active"> Active</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">

                  <div><button type="submit" class="btn btn-success w-lg float-right">Save</button>
                    <a href="{{URL('/Item')}}" class="btn btn-secondary w-lg float-right">Cancel</a>
                  </div>
                </div>
              </div>
            </form>
            <!-- card end here -->
          </div>
        </div>
      </div>
    </div>
    <!-- END: Content-->
    @endsection

    @push('after-scripts')
    <script src="{{asset('assets/libs/fullcalendar/core/main.min.js')}}"></script>
        <script src="{{asset('assets/libs/fullcalendar/bootstrap/main.min.js')}}"></script>
        <script src="{{asset('assets/libs/fullcalendar/daygrid/main.min.js')}}"></script>
        <script src="{{asset('assets/libs/fullcalendar/timegrid/main.min.js')}}"></script>
        <script src="{{asset('assets/libs/fullcalendar/interaction/main.min.js')}}"></script>

         Calendar init
        <script src="{{asset('assets/js/pages/calendars-full.init.js')}}"></script> 
    <script type="text/javascript">
      $(document).ready(function() {
        
        $(document).on('change ', '#Taxable', function() {
          if ($('#Taxable').val() == 'Yes') {
            $("#Percentage").prop("disabled", false);
            $("#Percentage").focus();
            $("#Percentage").attr("placeholder", "5").placeholder();
          } else {
            $("#Percentage").prop("disabled", true);
            $("#Percentage").removeAttr("placeholder");
          }
        });
        $('#student_table').DataTable();
      });
    </script>
    @endpush