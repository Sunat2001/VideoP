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
        <form action="{{ route('serials.update', ['serial' => $serial]) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    @if(!is_null($message))
                        <div class="alert alert-info">
                            {{ $message }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('dashboard.serial.serial_info') }}</h3>

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
                                <input name="name_en" type="text" id="inputName" class="form-control"
                                       value="{{ $serial->nameByLanguage(\App\Enum\Languages::EN) }}">
                            </div>
                            <div class="form-group">
                                <label for="inputName">{{ __('dashboard.serial.name') }}({{ __('dashboard.ru') }}
                                    )</label>
                                <input name="name_ru" type="text" id="inputName" class="form-control"
                                       value="{{ $serial->nameByLanguage(\App\Enum\Languages::RU) }}">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">{{ __('dashboard.description') }}({{ __('dashboard.en') }}
                                    )</label>
                                <textarea id="inputDescription" name="description_en" class="form-control"
                                          rows="4">{{ $serial->descriptionByLanguage(\App\Enum\Languages::EN) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">{{ __('dashboard.description') }}({{ __('dashboard.ru') }}
                                    )</label>
                                <textarea id="inputDescription" name="description_ru" class="form-control"
                                          rows="4">{{ $serial->descriptionByLanguage(\App\Enum\Languages::RU) }}</textarea>
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
                        <div class="card-body" style="display: block;">
                            @foreach($serial->attributeValues->groupBy('attribute') as $attribute => $attributeValues)
                                <div class="form-group">
                                    <label>{{__('dashboard.select')}} {{json_decode($attribute)->name}}</label>
                                    <select class="select2"
                                            multiple
                                            data-placeholder="{{__('dashboard.select')}} {{json_decode($attribute)->name}}"
                                            style="width: 100%;"
                                            tabindex="-1"
                                            aria-hidden="true"
                                            name="attributeValues[]"
                                    >
                                        @foreach($attributeValues as $attributesValue)
                                            <option
                                                value="{{$attributesValue->id}}">{{$attributesValue->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            @endforeach
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('dashboard.files') }}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0" style="display: block;">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>{{ __('dashboard.file_name') }}</th>
                                    <th>{{ __('dashboard.file_size') }}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td>{{ $serial->image_cover }}</td>
                                    <td>-</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Save Changes" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
@endsection
