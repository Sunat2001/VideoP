@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('dashboard.episode.episode_info') }}</h1>
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
                                     src="{{ asset($serialEpisode->image_cover ?? 'storage/images/no_image.png') }}"
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $serialEpisode->name }}</h3>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>{{ __('dashboard.rate') }}</b> <a
                                        class="float-right">{{ $serialEpisode->rate }}</a>
                                </li>

                                <li class="list-group-item">
                                    <b>{{ __('dashboard.episode.episode_number') }}</b> <a
                                        class="float-right">{{ $serialEpisode->serial_number }}</a>
                                </li>

                                <li class="list-group-item">
                                    <b>{{ __('dashboard.episode.serial') }}</b> <a
                                        class="float-right"
                                        href="{{route('serials.show', ['serial' => $serialEpisode->serial])}}">
                                        {{ $serialEpisode->serial->name }}
                                    </a>
                                </li>

                                <li class="list-group-item">
                                    <b>{{ __('dashboard.episode.season') }}</b> <a
                                        class="float-right"
                                        href="{{route('serials_seasons.show', ['serials_season' => $serialEpisode->season])}}">
                                        {{ $serialEpisode->season->season_number }}
                                    </a>
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
                                {{ $serialEpisode->description }}
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
                                    <a class="nav-link active" href="#episode_videos"
                                       data-toggle="tab">{{ __('dashboard.episode.video') }}</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="episode_videos">
                                    <!-- Post -->
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>{{ __('dashboard.id') }}</th>
                                                    <th>{{ __('dashboard.episode.episode_video.url') }}</th>
                                                    <th>{{ __('dashboard.episode.episode_video.quality') }}</th>
                                                    <th>{{ __('dashboard.episode.episode_video.format') }}</th>
                                                    <th>{{ __('dashboard.episode.episode_video.duration') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($serialEpisode->serialEpisodeVideos as $video)
                                                    <tr>
                                                        <td>{{ $video->id }}</td>
                                                        <td>{{ $video->video_url }}</td>
                                                        <td>{{ $video->quality }}</td>
                                                        <td>{{ $video->format }}</td>
                                                        <td>{{ $video->duration }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.post -->
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
