@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('dashboard.attribute_value.attribute_value_info') }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{ asset($attribute_value->image_cover ?? 'storage/images/no_image.png') }}"
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $attribute_value->name }}</h3>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>{{ __('dashboard.attribute_value.attribute') }}</b>
                                    <a  class="float-right"
                                        href="{{route('attributes.show', ['attribute' => $attribute_value->attribute])}}">
                                            {{ $attribute_value->attribute->name }}
                                        </a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ __('dashboard.is_active') }}</b>
                                    <a class="float-right">{{ $attribute_value->is_active == 1 ? __('dashboard.yes') : __('dashboard.no') }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
