@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('dashboard.season.season_info') }}</h1>
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
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>{{ __('dashboard.rate') }}</b> <a
                                        class="float-right">{{ $serialSeason->rate }}</a>
                                </li>

                                <li class="list-group-item">
                                    <b>{{ __('dashboard.season.season_number') }}</b> <a
                                        class="float-right">{{ $serialSeason->season_number }}</a>
                                </li>

                                <li class="list-group-item">
                                    <b>{{ __('dashboard.season.year') }}</b> <a
                                        class="float-right">{{ $serialSeason->year }}</a>
                                </li>

                                <li class="list-group-item">
                                    <b>{{ __('dashboard.season.is_final') }}</b> <a
                                        class="float-right">{{ $serialSeason->is_final == 1 ? __('dashboard.yes') : __('dashboard.no') }}</a>
                                </li>

                                <li class="list-group-item">
                                    <b>{{ __('dashboard.episode.serial') }}</b> <a
                                        class="float-right"
                                        href="{{route('serials.show', ['serial' => $serialSeason->serial->id])}}">
                                        {{ $serialSeason->serial->name }}
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
                                {{ $serialSeason->description }}
                            </p>
                        </div>
                        <!-- /.card-body -->
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
