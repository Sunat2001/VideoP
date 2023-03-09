@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('dashboard.serial.edit') }}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <form action="{{route('serials.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('dashboard.serials') }}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body" style="display: block;">
                            <div class="form-group">
                                <label for="inputName">{{ __('dashboard.serial.name') }}({{ __('dashboard.en') }}
                                    )</label>
                                <input name="name_en" type="text" id="inputName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputName">{{ __('dashboard.serial.name') }}({{ __('dashboard.ru') }}
                                    )</label>
                                <input name="name_ru" type="text" id="inputName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">{{ __('dashboard.description') }}({{ __('dashboard.en') }}
                                    )</label>
                                <textarea id="inputDescription" name="description_en" class="form-control"
                                          rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">{{ __('dashboard.description') }}({{ __('dashboard.ru') }}
                                    )</label>
                                <textarea id="inputDescription" name="description_ru" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">{{ __('dashboard.serial.image') }}</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label"
                                               for="exampleInputFile">{{ __('dashboard.user.placeholder.image') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('dashboard.attributes') }}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        {{--                    <!-- CSS -->--}}
                        {{--                    <link rel="stylesheet" href="https://unpkg.com/multiple-select-js@1.0.2/dist/multiple-select.css">--}}
                        {{--                    <!-- JS -->--}}
                        {{--                    <script src="https://unpkg.com/multiple-select-js@1.0.2/dist/assets/js/multiple-select.js"></script>--}}
                        {{--                    @foreach($attributes as $attribute)--}}
                        {{--                        <div class="form-group">--}}
                        {{--                            <label for="select-language">{{ $attribute->name }}</label>--}}
                        {{--                            <select name="{{$attribute->id}}" id="select-multiple-language{{$attribute->id}}" multiple>--}}
                        {{--                                @foreach($attribute->attributeValues as $attributesValue)--}}
                        {{--                                    <option value="{{$attributesValue->id}}">{{$attributesValue->name}}</option>--}}
                        {{--                                @endforeach--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}
                        {{--                        <script>--}}
                        {{--                            new MultipleSelect('#select-multiple-language{{$attribute->id}}', {--}}
                        {{--                                placeholder: '{{ __('dashboard.select') }} {{$attribute->name}}'--}}
                        {{--                            })--}}
                        {{--                        </script>--}}
                        {{--                    @endforeach--}}
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">{{ __('dashboard.delete_dialog_cancel') }}</a>
                    <input type="submit" value="{{ __('dashboard.serial.add') }}" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>

@endsection

