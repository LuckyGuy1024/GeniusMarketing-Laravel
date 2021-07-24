@extends(activeTemplate() .'layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive table-responsive-xl">
                    <table class="table align-items-center table-light">
                        <thead>
                        <tr>
                            <th scope="col">@lang('Date')</th>
                            <th scope="col">@lang('Ip')</th>
                            <th scope="col">@lang('Location')</th>
                            <th scope="col">@lang('Detail')</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @forelse($history as $data)
                            <tr>
                                <td scope="row">{{date('g:ia \o\n l jS F Y', strtotime($data->created_at))}}</td>
                                <td>{{__($data->user_ip)}}</td>
                                <td>{{__($data->location)}}</td>
                                <td>{{__($data->details)}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{__('NO DATA FOUND')}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav aria-label="...">

                        {{$history->links()}}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
