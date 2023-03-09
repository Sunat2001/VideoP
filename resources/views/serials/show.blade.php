@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('dashboard.serial.serial_info') }}</h1>
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
                                     src="{{ asset($serial->image_cover ?? 'storage/avatars/default.jpg') }}"
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $serial->name }}</h3>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>{{ __('dashboard.rate') }}</b> <a
                                        class="float-right">{{ $serial->rate }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('dashboard.description') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <p class="text-muted">
                                {{ $serial->description }}
                            </p>

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
                                    <a class="nav-link active" href="#reviews"
                                       data-toggle="tab">{{ __('dashboard.reviews') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#seasons"
                                       data-toggle="tab">{{ __('dashboard.serial.seasons') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#episodes"
                                       data-toggle="tab">{{ __('dashboard.serial.episodes') }}</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="reviews">
                                    <!-- Post -->
                                    @foreach($serial->reviews as $review)
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm"
                                                     src="{{ $review->user->image ?? asset( 'storage/avatars/default.jpg' ) /*asset($review->serial->image_cover) */}}"
                                                     alt="user image">
                                                <span class="username">
                                                <a href="{{ route('users.show', ['user' => $review->user]) }}">{{ $review->user->name }}</a>
                                                <a href="{{ route('reviews.destroy', ['review' => $review]) }}"
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
                                <div class="tab-pane" id="seasons">
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>{{ __('dashboard.id') }}</th>
                                                    <th>{{ __('dashboard.description') }}</th>
                                                    <th>{{ __('dashboard.season.season_number') }}</th>
                                                    <th>{{ __('dashboard.rate') }}</th>
                                                    <th>{{ __('dashboard.season.year') }}</th>
                                                    <th>{{ __('dashboard.season.is_final') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($serial->serialEpisodeSeasons as $season)
                                                    <tr>
                                                        <td>{{ $season->id }}</td>
                                                        <td width="50%">{{ $season->description }}</td>
                                                        <td>{{ $season->season_number }}</td>
                                                        <td>{{ $season->rate }}</td>
                                                        <td>{{ $season->year }}</td>
                                                        <td>{{ $season->is_final ? __('dashboard.yes') : __('dashboard.no') }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="episodes">
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>{{ __('dashboard.id') }}</th>
                                                    <th>{{ __('dashboard.serial.name') }}</th>
                                                    <th>{{ __('dashboard.description') }}</th>
                                                    <th>{{ __('dashboard.episode.episode_number') }}</th>
                                                    <th>{{ __('dashboard.season.season_number') }}</th>
                                                    <th>{{ __('dashboard.rate') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($serial->serialEpisodes as $episode)
                                                    <tr>
                                                        <td>{{ $episode->id }}</td>
                                                        <td>{{ $episode->name }}</td>
                                                        <td width="50%">{{ $episode->description }}</td>
                                                        <td>{{ $episode->serial_number }}</td>
                                                        <td>{{ $episode->season->season_number }}</td>
                                                        <td>{{ $episode->rate }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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
