@extends('admin.layouts.app')

@section('panel')
<div class="row">

    <div class="col-lg-12" id="app">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="">
                            <li class="text-info">Click Add Translatable Add Put Your Key For Translate</li>
                            <li class="text-danger">Add Translatable Key" please careful when you entering word or sentences, there shouldn't be any extra space or break.</li>
                            <li class="text-success">If your keywords are perfect but translator doesn't work, don't worry. escape all dynamic keywords and add single word, it'll work.</li>
                        </ul>
                    </div>
                    <div class="col-md-4">

                        <form class="form-inline" method="post" @submit.prevent="importKey">

                            <div class="input-group has_append">
                                <select  class="form-control" required v-model="importData.code">
                                    <option value="">Import Keywords</option>
                                    @foreach($list_lang as $data)
                                        <option value="{{$data->id}}" @if($data->id == $la->id) style="display: none" @endif>{{$data->name}}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Import Now</button>
                                </div>
                            </div>
                        </form>

                        <small class="text-danger">If you import keywords from another language, Your present "{{$la->name}}" all keywords will remove.</small>

                    </div>
                </div>
                <hr>
                <div class="tile-body" style="overflow: hidden">
                    <form method="post" action="{{route('admin.setting.key-update', $la->id)}}" id="langForm">
                        @csrf
                        {{method_field('put')}}
                        <div class="form-body">

                            <div class="row">
                                <div class="col-md-3" v-for="(value, key) in datas" :key="key">
                                    <label class="control-label">@{{ key }}</label>
                                    <div class="input-group has_append">
                                        <input type="text" :value="value" :name="'keys[' + key + ']'" class="form-control">
                                        <div class="input-group-append" >
                                            <span class="input-group-text" style="background: #ff4f59; color: white" @click.prevent="deleteElement(key)"><i class="fa fa-trash"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <br>


                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" data-toggle="modal" data-target="#addModal" class="btn btn-block btn-primary">Add Translatable Key</button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-block btn-success" data-toggle="tooltip" title="Save" @click.prevent="save">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="newlangForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">English</label>
                            <input type="text" class="form-control" v-model="newKey" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">{{$la->name}}</label>
                            <input type="text" class="form-control" v-model="newVal" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Add Field" @click.prevent="addfield()">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script src="{{ asset('assets/admin/js/vue.js') }}"></script>
    <script src="{{ asset('assets/admin/js/axios.js') }}"></script>
    <script>
        window.Laravel = @php echo json_encode(['csrfToken' => csrf_token()]);  @endphp ;
    </script>

    <script>
        window.app = new Vue({
            el: '#app',
            data: {
                datas: @php echo $json; @endphp,
                current: '{{ $la->code }}',
                newVal: null,
                newKey: null,


                importData : {
                    code : ''
                }

            },
            methods: {
                save() {
                    $('#langForm').submit();
                },

                deleteElement(key) {
                    Vue.delete(this.datas, key);
                },
                addfield() {
                    Vue.set(this.datas, this.newKey, this.newVal);
                    app.newKey = '';
                    app.newVal = '';
                    $("#addModal").modal('hide');
                },
                importKey()
                {
                    var code = this.importData;
                    axios.post('{{route('admin.setting.import_lang')}}', code).then(function (res) {
                        app.datas = res.data;
                    })

                }
            }
        })
    </script>
@endpush
