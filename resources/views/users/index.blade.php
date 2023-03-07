@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid d-flex justify-content-between">
            <h1 class="m-0">{{ __('dashboard.users') }}</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                <ion-icon name="add-circle-outline"></ion-icon>
            </button>
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
                                    <th>{{ __('dashboard.user.id') }}</th>
                                    <th>{{ __('dashboard.user.name') }}</th>
                                    <th>{{ __('dashboard.user.email') }}</th>
                                    <th>{{ __('dashboard.user.is_admin') }}</th>
                                    <th>{{ __('dashboard.user.language') }}</th>
                                    <th>{{ __('dashboard.user.created_at') }}</th>
                                    <th>{{ __('dashboard.user.email_verified_at') }}</th>
                                    <th>{{ __('dashboard.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        @if($user->is_admin == 1)
                                            <td><i class="fas fa-circle fa-1x text-green"></i></td>
                                        @else
                                            <td><i class="fas fa-circle fa-1x text-red"></i></td>
                                        @endif
                                        <td>{{ $user->language == '' ? 'ru': $user->language }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->email_verified_at }}</td>
                                        <td>
                                            <a href="{{ route('users.show', ['user' => $user] ) }}" class="btn btn-sm btn-primary">
                                                <ion-icon name="eye-outline"></ion-icon>
                                            </a>
                                            <a href="{{ route('users.edit', ['user' => $user] ) }}" class="btn btn-sm btn-primary">
                                                <ion-icon name="create-outline"></ion-icon>
                                            </a>
                                            <button type="button" onclick="setUserIdToDeleteModal({{$user->id}})" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-delete">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer clearfix">
                            {{ $users->links() }}
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
                                    <div class="modal-body">
                                        <form action="{{ route('users.store') }}" id="store_user" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{{ __('dashboard.user.email') }}</label>
                                                <input type="email" name="email" class="form-control"
                                                       id="exampleInputEmail1"
                                                       placeholder="{{ __('dashboard.user.placeholder.email') }}">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{{ __('dashboard.user.name') }}</label>
                                                <input name="name" type="text" class="form-control"
                                                       id="exampleInputEmail1"
                                                       placeholder="{{ __('dashboard.user.placeholder.name') }}">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label
                                                    for="exampleInputEmail1">{{ __('dashboard.user.password') }}</label>
                                                <input name="password" type="password" class="form-control"
                                                       id="exampleInputEmail1"
                                                       placeholder="{{ __('dashboard.user.placeholder.password') }}">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile">{{ __('dashboard.user.image') }}</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                                        <label class="custom-file-label"
                                                               for="exampleInputFile">{{ __('dashboard.user.placeholder.image') }}</label>
                                                        @error('image')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input name="is_admin" type="checkbox" class="custom-control-input"
                                                       id="customSwitch1">
                                                <label class="custom-control-label"
                                                       for="customSwitch1">{{ __('dashboard.user.placeholder.is_admin') }}</label>
                                                @error('is_admin')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label></label>
                                                <select name="language"
                                                        class="form-control select2 select2-hidden-accessible"
                                                        style="width: 100%;"
                                                        data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                    <option selected="selected"
                                                            disabled>{{ __('dashboard.user.placeholder.language') }}</option>
                                                    @foreach(\App\Enum\Languages::getLabels() as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                                @error('language')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">{{__('dashboard.close')}}</button>
                                                <button type="submit"
                                                        class="btn btn-primary">{{ __('dashboard.save') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <div class="modal fade show" id="modal-delete" style="display: none;" aria-modal="true" role="dialog">
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
                                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('dashboard.delete_dialog_cancel') }}</button>
                                        <form action="" data-user-id="" id="delete" method="post">
                                            @csrf
                                            <button onclick="deleteUser()" type="submit" class="btn btn-primary">{{ __('dashboard.delete_dialog_confirm') }}</button>
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
        function setUserIdToDeleteModal(userId) {
            $('#delete').attr('data-user-id', userId);
        }

        function deleteUser() {
            let userId = $('#delete').attr('data-user-id');
            $('#delete').attr('action', '/users/delete/' + userId);
        }

    </script>
@endsection
