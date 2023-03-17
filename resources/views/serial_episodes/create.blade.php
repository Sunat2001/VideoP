@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('dashboard.episode.add') }}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <form action="{{route('serials.store')}}" method="post">
            @csrf
            <div class="row">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('dashboard.episodes') }}</h3>

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
                                <label for="inputDescription">{{ __('dashboard.episode.episode_number') }}</label>
                                <input name="serial_number" type="text" id="inputName" class="form-control">
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
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('dashboard.episode.video') }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row pb-3">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">{{ __('dashboard.delete_dialog_cancel') }}</a>
                    <input type="submit" value="{{ __('dashboard.serial.add') }}" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
@endsection
