@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('dashboard.attribute.attribute_info') }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>{{ __('dashboard.attribute.name_en') }}</b> <a
                                        class="float-right">{{ $attribute->nameByLanguage(\App\Enum\Languages::EN) }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ __('dashboard.attribute.name_ru') }}</b> <a
                                        class="float-right">{{ $attribute->nameByLanguage(\App\Enum\Languages::RU) }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ __('dashboard.attribute.is_active') }}</b> <a
                                        class="float-right">{{ $attribute->is_active == 1 ? __('dashboard.yes') : __('dashboard.no') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#attribute_value"
                                       data-toggle="tab">{{ __('dashboard.attribute.attribute_value') }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="attribute_value">
                                    <ol>
                                        @foreach($attribute->attributeValues as $attributeValue)
                                            <li>
                                                <a href="{{route('attribute-values.show', ['attribute_value' => $attributeValue])}}">{{$attributeValue->name}}</a>
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
