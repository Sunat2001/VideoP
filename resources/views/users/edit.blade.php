@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('dashboard.edit') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
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

                        <form action="{{ route('users.update', ['user' => $user]) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <input type="text" name="name" class="form-control "
                                           placeholder="{{__('dashboard.user.placeholder.name')}}"
                                           value="{{$user->name}}" required="">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="input-group mb-3">
                                    <input type="email" name="email" class="form-control "
                                           placeholder="{{ __('dashboard.user.placeholder.email') }}"
                                           value="{{ $user->email }}" required="">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="input-group d-flex justify-content-between mb-3">
                                    <div class="custom-control custom-switch">
                                        <input name="is_admin" type="checkbox" {{ $user->is_admin == 1 ? 'checked' : '' }} class="custom-control-input"
                                               id="customSwitch1">
                                        <label class="custom-control-label"
                                               for="customSwitch1">{{ __('dashboard.user.placeholder.is_admin') }}</label>
                                        @error('is_admin')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
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
                                <div class="input-group mb-3">
                                    <select name="language"
                                            class="form-control select2 select2-hidden-accessible"
                                            style="width: 100%;"
                                            data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option selected="selected" value="{{ $user->language ?? "ru" }}"
                                                >{{ \App\Enum\Languages::getLabel($user->language) }}</option>
                                        @foreach(\App\Enum\Languages::getLabels() as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('language')
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
