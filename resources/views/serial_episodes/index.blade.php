@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid d-flex justify-content-between">
            <h1 class="m-0">{{ __('dashboard.serial_episodes') }}</h1>
            <a  class="btn btn-primary" href="{{route('serials_episodes.create')}}">
                <i class="fas fa-plus"></i>
            </a>
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @if(!is_null($message))
                        <div class="alert alert-info">
                            {{ $message }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>{{ __('dashboard.id') }}</th>
                                    <th>{{ __('dashboard.episode.name') }}</th>
                                    <th>{{ __('dashboard.episode.description') }}</th>
                                    <th>{{ __('dashboard.episode.serial') }}</th>
                                    <th>{{ __('dashboard.episode.season') }}</th>
                                    <th>{{ __('dashboard.episode.episode_number') }}</th>
                                    <th>{{ __('dashboard.rate') }}</th>
                                    <th>{{ __('dashboard.episode.created_at') }}</th>
                                    <th>{{ __('dashboard.episode.updated_at') }}</th>
                                    <th>{{ __('dashboard.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($serialEpisodes as $episode)
                                    <tr>
                                        <td>{{ $episode->id }}</td>
                                        <td>{{ $episode->name }}</td>
                                        <td width="20%">{{ $episode->description }}</td>
                                        <td>
                                            <a href="{{route('serials.show', ['serial' => $episode->serial])}}">
                                                {{ $episode->serial->name }}
                                            </a>
                                        </td>
                                        <td><a href="{{route('serials_seasons.show', ['serials_season' => $episode->season])}}">
                                                {{ $episode->season->season_number }}
                                            </a></td>
                                        <td>{{ $episode->episode_number }}</td>
                                        <td>{{ $episode->rate }}</td>
                                        <td>{{ $episode->created_at }}</td>
                                        <td>{{ $episode->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('serials_episodes.show', ['serials_episode' => $episode] ) }}"
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('serials_episodes.edit', ['serials_episode' => $episode] ) }}"
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#modal-delete"
                                                    onclick="setEpisodeIdToDeleteModal({{ $episode->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            {{ $serialEpisodes->links() }}
                        </div>
                        <div class="modal fade show" id="modal-delete" style="display: none;" aria-modal="true"
                             role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ __('dashboard.delete_dialog_title') }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ __('dashboard.delete_dialog_message') }}</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default"
                                                data-dismiss="modal">{{ __('dashboard.delete_dialog_cancel') }}</button>
                                        <form action="" data-user-id="" id="delete" method="post">
                                            @csrf
                                            <button onclick="deleteUser()" type="submit"
                                                    class="btn btn-primary">{{ __('dashboard.delete_dialog_confirm') }}</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setEpisodeIdToDeleteModal(episodeId) {
            $('#delete').attr('data-user-id', episodeId);
        }

        function deleteUser() {
            let episodeId = $('#delete').attr('data-user-id');
            $('#delete').attr('action', '/serials_episodes/delete/' + episodeId);
        }
    </script>
@endsection
