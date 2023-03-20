@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('dashboard.episode.edit') }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <form action="{{route('serials_episodes.update', ['episode' => $serialEpisode])}}" method="post">
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
                                <input name="name_en"
                                       value="{{$serialEpisode->nameByLanguage(\App\Enum\Languages::EN)}}"
                                       type="text"
                                       id="inputName"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputName">{{ __('dashboard.serial.name') }}({{ __('dashboard.ru') }}
                                    )</label>
                                <input name="name_ru"
                                       type="text"
                                       value="{{$serialEpisode->nameByLanguage(\App\Enum\Languages::RU)}}"
                                       id="inputName"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">{{ __('dashboard.episode.episode_number') }}</label>
                                <input name="serial_number"
                                       value="{{$serialEpisode->serial_number}}"
                                       type="text"
                                       id="inputName"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label></label>
                                <select name="serial_id"
                                        id="serials"
                                        onchange="handleSerialSelect()"
                                        class="form-control select2"
                                        style="width: 100%;"
                                        data-select2-id="1"
                                        tabindex="-1"
                                        aria-hidden="true">
                                    <option selected
                                            value="{{$serialEpisode->serial->id}}">
                                        {{ $serialEpisode->serial->name }}
                                    </option>
                                    @foreach($serials as $serial)
                                        <option value="{{$serial->id}}">{{$serial->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label></label>
                                <select name="season_id"
                                        id="seasons"
                                        class="form-control select2 select2-hidden-accessible"
                                        style="width: 100%;"
                                        data-select2-id="1"
                                        tabindex="-1"
                                        aria-hidden="true">
                                    <option selected
                                            value="{{$serialEpisode->season->id}}"
                                    >
                                        {{ $serialEpisode->season->season_number }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">{{ __('dashboard.description') }}({{ __('dashboard.en') }}
                                    )</label>
                                <textarea id="inputDescription"
                                          name="description_en"
                                          class="form-control"
                                          rows="4">{{ $serialEpisode->descriptionByLanguage(\App\Enum\Languages::EN) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">{{ __('dashboard.description') }}({{ __('dashboard.ru') }}
                                    )</label>
                                <textarea id="inputDescription"
                                          name="description_ru"
                                          class="form-control"
                                          rows="4"
                                >{{ $serialEpisode->descriptionByLanguage(\App\Enum\Languages::RU) }}</textarea>
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
                            <div class="form-group">
                                <label for="inputDescription">{{ __('dashboard.episode.trailer_url') }}</label>
                                <input name="trailer_url"
                                       value="{{$serialEpisode->serialEpisodeVideos[0]->video_url ?? ''}}"
                                       type="text"
                                       id="inputName"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row pb-3">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">{{ __('dashboard.delete_dialog_cancel') }}</a>
                    <input type="submit" value="{{ __('dashboard.episode.edit') }}" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>

    <script>
        function handleSerialSelect() {
            let serialId = $('#serials').val();
            $.ajax({
                url: `http://localhost/api/serials/season/${serialId}`,
                type: 'GET',
                success: function (response) {
                    let seasons = response.data;
                    let seasonsHtml = '';
                    seasons.forEach(season => {
                        seasonsHtml += `<option value="${season.id}">${season.season_number}</option>`;
                    });
                    $('#seasons').html(seasonsHtml);
                }
            });
        }
    </script>
@endsection
