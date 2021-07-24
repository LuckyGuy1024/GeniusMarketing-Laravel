@extends(activeTemplate() .'layouts.app')

@section('style')

@stop
@section('content')



<!-- report start here -->
  <div class="row "  >
 <form id="frmProducts" method="post"   action="{{route('user.matrix.index.date')}}" style="width:100% !important;">
     @csrf
                         <div class="form-group">
                            <div class="row">
                          <div class="col-md-6"></div>
                          
                    <div class="col-md-4" >
                               
                                    <strong style="color:white;">Select Date:</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-lg plan-price'"  id="current_date" name="current_date" required="required" class="form-control" required="">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Date</span>
                                        </div>
                                    </div>

                                </div>

                                <input type="hidden" name="request" value="">
                           
<div class=" col-md-2" style="margin-top:15px !important;" >


<input type="submit" value="View Report" class="btn btn-block btn-primary mt-2">
    </div>
    </div>
    </div>

</form>
    </div>

<!-- report ends here -->




    <div class="row">
        <div class="col-lg-12">
           
            <div class="card">
                <div class="table-responsive table-responsive-xl">
                    <table class="table align-items-center table-light">
                        <thead>
                        <tr>
                            <th scope="col">@lang('Username')</th>
                            <th scope="col">@lang('Under Position')</th>
                            <th scope="col">@lang('Ref. By')</th>
                            <th scope="col">@lang('Balance')</th>

                        </tr>
                        </thead>
                        <tbody class="list">
                        {{ showUserLevel(auth()->user()->id, $lv_no) }}
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection


