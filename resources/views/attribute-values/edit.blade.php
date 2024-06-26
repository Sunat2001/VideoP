@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('dashboard.attribute_value.edit') }}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <form action="{{ route('attribute-values.update', ['attribute_value' => $attribute_value]) }}" method="post">
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
                            <h3 class="card-title">{{ __('dashboard.attribute_value.attribute_value_info') }}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <div class="form-group">
                                <label
                                    for="exampleInputEmail1">{{ __('dashboard.attribute.name_en') }}</label>
                                <input type="text"
                                       name="name_en"
                                       class="form-control"
                                       id="exampleInputEmail1"
                                       value="{{ $attribute_value->nameByLanguage(\App\Enum\Languages::EN) }}"
                                       placeholder="{{ __('dashboard.attribute.name_en') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label
                                    for="exampleInputEmail1">{{ __('dashboard.attribute.name_ru') }}</label>
                                <input name="name_ru"
                                       type="text"
                                       class="form-control"
                                       value="{{ $attribute_value->nameByLanguage(\App\Enum\Languages::RU) }}"
                                       id="exampleInputEmail1"
                                       placeholder="{{ __('dashboard.attribute.name_ru') }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label
                                    for="exampleInputFile">{{ __('dashboard.serial.image') }}</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"
                                               id="exampleInputFile">
                                        <label class="custom-file-label"
                                               for="exampleInputFile">{{ __('dashboard.user.placeholder.image') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label></label>
                                <select name="attribute_id"
                                        class="form-control select2 select2-hidden-accessible"
                                        style="width: 100%;"
                                        data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="{{ $attribute_value->attribute->ids }}" selected="selected"
                                            disabled>{{$attribute_value->attribute->name}}</option>
                                    @foreach($attributes as $attribute)
                                        <option
                                            value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                    @endforeach
                                </select>
                                @error('language')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
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
                                    <td>{{ $attribute->image ?? '-' }}</td>
                                    <td>-</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            @if($attribute->image)
                                                <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                            @endif
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
