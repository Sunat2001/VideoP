@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid d-flex justify-content-between">
            <h1 class="m-0">{{ __('dashboard.serials') }}</h1>
            <a class="btn btn-primary" href="{{ route('serials.create') }}">
                <i class="fas fa-plus"></i>
            </a>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
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
                                    <th>{{ __('dashboard.serial.id') }}</th>
                                    <th>{{ __('dashboard.serial.name') }}</th>
                                    <th>{{ __('dashboard.description') }}</th>
                                    <th>{{ __('dashboard.rate') }}</th>
                                    <th>{{ __('dashboard.serial.episode_count') }}</th>
                                    <th>{{ __('dashboard.serial.season_count') }}</th>
                                    <th>{{ __('dashboard.serial.created_at') }}</th>
                                    <th>{{ __('dashboard.serial.updated_at') }}</th>
                                    <th>{{ __('dashboard.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($serials as $serial)
                                    <tr>
                                        <td>{{ $serial->id }}</td>
                                        <td>{{ $serial->name }}</td>
                                        <td width="20%">{{ $serial->description}}</td>
                                        <td>{{ $serial->rate }}</td>
                                        <td>{{ $serial->serial_episodes_count }}</td>
                                        <td>{{ $serial->serial_episode_seasons_count }}</td>
                                        <td>{{ $serial->created_at }}</td>
                                        <td>{{ $serial->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('serials.show', ['serial' => $serial] ) }}"
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('serials.edit', ['serial' => $serial] ) }}"
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <button type="button" onclick="setSerialIdToDeleteModal({{$serial->id}})"
                                                    class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#modal-delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer clearfix">
                            {{ $serials->links() }}
                        </div>
                        <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{__('dashboard.user.add')}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
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
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <script>
        function setSerialIdToDeleteModal(serialId) {
            $('#delete').attr('data-user-id', serialId);
        }

        function deleteUser() {
            let serialId = $('#delete').attr('data-user-id');
            $('#delete').attr('action', '/serials/delete/' + serialId);
        }
    </script>
@endsection
