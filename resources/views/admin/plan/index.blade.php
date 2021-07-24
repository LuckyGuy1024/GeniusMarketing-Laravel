@extends('admin.layouts.app')


@push('style')
    <style>
        .custom-size{
            height: 160px !important;
            font-size: 140px;
            font-weight: 700;
            color: red;
            text-align: center;
            background-color: #000036;
        }
    </style>
@endpush
@section('panel')

    <div class="row mb-5">




        <div class="col-md-6 offset-md-3">
            <div class="card">
                <h3 class="card-header text-center">@lang('Set Height & Width of MATRIX')</h3>
                <div class="card-body">
                    <form role="form" method="POST" action="{{route('admin.matrix.update')}}">
                        {{ csrf_field() }}

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong>@lang('Matrix Height') <small>(@lang('Should Be Numeric'))</small></strong>
                                <input type="text" class="form-control custom-size input-lg" value="{{$general->matrix_height}}" name="matrix_height">
                            </div>

                            <div class="form-group col-md-6">
                                <strong>@lang('Matrix Width') <small>(@lang('Should Be Numeric'))</small></strong>
                                <input type="text" class="form-control custom-size input-lg" value="{{$general->matrix_width}}" name="matrix_width">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">@lang('Update')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="row">



        <div class="col-md-12">

            <div class="card">
                <h3 class="card-header"> @lang($page_title)

                    <div class="caption font-dark float-right">
                        <i class="icon-settings font-dark"></i>
                        <a href="{{route('admin.plan.create')}}" class="btn btn-primary bold"><i class="fa fa-plus"></i> @lang('Add New') </a>
                    </div>

                </h3>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">@lang('Name')</th>
                            <th scope="col">@lang('Plan Price')</th>
                            <th scope="col">@lang('Referral Bonus')</th>
                            <th scope="col">@lang('Level Bonus')</th>
                            <th scope="col">@lang('Status')</th>
                            <th scope="col">@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($plan as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{$data->price}} {{$general->currency}}</td>
                            <td>{{$data->ref_bonus}} {{$general->currency}}</td>
                            <td>
                                <a href="#levComModal{{$data->id}}" data-toggle="modal" class="btn btn-info btn-block">
                                    <i class="fa fa-eye"></i> @lang('PROMO')
                                </a>
                            </td>
                            <td>
                                @if($data->status == 1)
                                    <span class="badge badge-success">@lang('Active')</span>
                                    @else
                                    <span class="badge badge-danger">@lang('Deactive')</span>
                                @endif
                            </td>
                            <td><a href="{{route('admin.plan.edit', $data->id)}}" class="btn btn-primary btn-block">@lang('Edit')</a></td>
                        </tr>
                        <div class="modal fade" id="levComModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel"> @lang($data->name.' Level Commissions')</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul  class="list-group">
                                            @foreach($data->plan_level as $lv)
                                                <li class="list-group-item">
                                                    <p class="text-center">@lang('PROMO '){{$lv->level}} : {{$lv->amount}} {{$general->currency}}</p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> @lang('Close')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@stop
@section('script')


@stop