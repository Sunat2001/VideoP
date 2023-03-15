@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('dashboard.attribute.edit') }}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <form action="{{ route('attributes.update', ['attribute' => $attribute]) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    @if(!is_null($message))
                        <div class="alert alert-info">
                            {{ $message }}
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
                                <label for="inputName">{{ __('dashboard.attribute.name') }}({{ __('dashboard.en') }}
                                    )</label>
                                <input name="name_en" type="text" id="inputName" class="form-control"
                                       value="{{ $attribute->nameByLanguage(\App\Enum\Languages::EN) }}">
                            </div>
                            <div class="form-group">
                                <label for="inputName">{{ __('dashboard.attribute.name') }}({{ __('dashboard.ru') }}
                                    )</label>
                                <input name="name_ru" type="text" id="inputName" class="form-control"
                                       value="{{ $attribute->nameByLanguage(\App\Enum\Languages::RU) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Save Changes" class="btn btn-success float-right">
                </div>
            </div>
        </form>

@endsection
