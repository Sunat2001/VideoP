@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('dashboard.season.edit') }}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <form action="{{route('serials_seasons.update', ['serials_season' => $serialSeason])}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
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
                            <h3 class="card-title">{{ __('dashboard.seasons') }}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body" style="display: block;">
                            <div class="form-group">
                                <label for="inputDescription">{{ __('dashboard.season.season_number') }}</label>
                                <input name="season_number"
                                       value="{{ $serialSeason->season_number }}"
                                       type="text"
                                       id="inputName"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">{{ __('dashboard.season.year') }}</label>
                                <input name="year"
                                       value="{{ $serialSeason->year }}"
                                       type="number"
                                       id="inputName"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="is_final">{{__('dashboard.season.is_final')}}</label>
                                <select name="is_final"
                                        id="is_final"
                                        class="form-control select2"
                                        style="width: 100%;"
                                        data-select2-id="1"
                                        tabindex="-1"
                                        aria-hidden="true">
                                    <option selected="selected"
                                            value="{{ $serialSeason->is_final ? 1 : 0}}">
                                        {{ $serialSeason->is_final ? __('dashboard.yes') : __('dashboard.no') }}
                                    </option>
                                    @if($serialSeason->is_final)
                                        <option value="0">{{ __('dashboard.no') }}</option>
                                    @else
                                        <option value="1">{{ __('dashboard.yes') }}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="serials">{{ __('dashboard.episode.serial') }}</label>
                                <select name="serial_id"
                                        id="serials"
                                        class="form-control select2"
                                        style="width: 100%;"
                                        data-select2-id="1"
                                        tabindex="-1"
                                        aria-hidden="true">
                                    <option selected="selected"
                                            value="{{ $serialSeason->serial_id }}">{{ $serialSeason->serial->name }}</option>
                                    @foreach($serials as $serial)
                                        <option value="{{$serial->id}}">{{$serial->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">{{ __('dashboard.description') }}({{ __('dashboard.en') }}
                                    )</label>
                                <textarea id="inputDescription" name="description_en" class="form-control"
                                          rows="4">{{ $serialSeason->descriptionByName(\App\Enum\Languages::EN) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">{{ __('dashboard.description') }}({{ __('dashboard.ru') }}
                                    )</label>
                                <textarea id="inputDescription" name="description_ru" class="form-control"
                                          rows="4">{{ $serialSeason->descriptionByName(\App\Enum\Languages::RU) }}</textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row pb-3">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">{{ __('dashboard.delete_dialog_cancel') }}</a>
                    <input type="submit" value="{{ __('dashboard.season.edit') }}" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
@endsection
