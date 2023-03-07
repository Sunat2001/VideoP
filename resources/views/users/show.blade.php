@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('dashboard.profile') }}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
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
                                     src="{{ asset($user->image ?? 'storage/avatars/default.jpg') }}"
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $user->name }}</h3>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>{{ __('dashboard.user.email') }}</b> <a
                                        class="float-right">{{ $user->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ __('dashboard.user.language') }}</b> <a
                                        class="float-right">{{ \App\Enum\Languages::getLabel($user->language) }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ __('dashboard.user.email_verified_at') }}</b> <a
                                        class="float-right">{{ $user->email_verified_at }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ __('dashboard.user.is_admin') }}</b> <a
                                        class="float-right">{{ $user->is_admin==1 ? __('dashboard.yes') : __('dashboard.no') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ __('dashboard.user.created_at') }}</b> <a
                                        class="float-right">{{ $user->created_at }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ __('dashboard.user.updated_at') }}</b> <a
                                        class="float-right">{{ $user->updated_at }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#activity"
                                       data-toggle="tab">{{ __('dashboard.reviews') }}</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="activity">
                                    <!-- Post -->
                                    @foreach($user->reviews as $review)
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm"
                                                 src="{{ $review->serial->image_cover /*asset($review->serial->image_cover) */}}"
                                                 alt="user image">
                                            <span class="username">
                                                <a href="{{ route('serials.show', ['serial' => $review->serial_id]) }}">{{ $review->serial->name }}</a>
                                                <a href="{{ route('reviews.destroy', ['review' => $review->id]) }}"
                                                   class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                            </span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            {{ $review->text }}
                                        </p>
                                    </div>
                                    @endforeach
                                    <!-- /.post -->
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
                <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
