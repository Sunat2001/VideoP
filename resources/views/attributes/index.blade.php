@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid d-flex justify-content-between">
            <h1 class="m-0">{{ __('dashboard.attributes') }}</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-store">
                <i class="fas fa-plus"></i>
            </button>
        </div><!-- /.container-fluid -->
    </div>

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
                                    <th>{{ __('dashboard.attribute.id') }}</th>
                                    <th>{{ __('dashboard.attribute.name') }}</th>
                                    <th>{{ __('dashboard.attribute.is_active') }}</th>
                                    <th>{{ __('dashboard.attribute.created_at') }}</th>
                                    <th>{{ __('dashboard.attribute.updated_at') }}</th>
                                    <th>{{ __('dashboard.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($attributes as $key => $attribute)
                                    <tr>
                                        <td>{{ $attribute->id }}</td>
                                        <td>{{ $attribute->name }}</td>
                                        <td> <form
                                                action="{{route('attributes.change-status', ['attribute' => $attribute])}}"
                                                method="post"
                                                id="form-change-best-{{$attribute->id}}"
                                                class="form-group"
                                            >
                                                @csrf
                                                <div class="custom-control custom-switch">
                                                    <input name="is_best" type="checkbox"
                                                           onchange="handleIsBestChange({{$attribute->id}})"
                                                           {{ $attribute->is_active == 1 ? 'checked' : '' }}
                                                           class="custom-control-input"
                                                           id="customSwitch{{$key}}">
                                                    <label class="custom-control-label" for="customSwitch{{$key}}"></label>
                                                    @error('is_admin')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    @enderror
                                                </div>
                                            </form></td>
                                        <td>{{ $attribute->created_at }}</td>
                                        <td>{{ $attribute->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('attributes.show', ['attribute' => $attribute] ) }}"
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('attributes.edit', ['attribute' => $attribute] ) }}"
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" onclick="setAttributeIdToDeleteModal({{$attribute->id}})"
                                                    class="btn btn-sm btn-danger" data-toggle="modal"
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
                            {{ $attributes->links() }}
                        </div>
                        <div class="modal fade" id="modal-store" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{__('dashboard.attribute.add')}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('attributes.store') }}" id="store_attribute" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{{ __('dashboard.attribute.name_en') }}</label>
                                                <input type="text" name="name_en" class="form-control"
                                                       id="exampleInputEmail1"
                                                       placeholder="{{ __('dashboard.attribute.name_en') }}">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{{ __('dashboard.attribute.name_ru') }}</label>
                                                <input name="name_ru" type="text" class="form-control"
                                                       id="exampleInputEmail1"
                                                       placeholder="{{ __('dashboard.attribute.name_ru') }}">
                                                @error('name')
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
        function setAttributeIdToDeleteModal(attributeId) {
            $('#delete').attr('data-user-id', attributeId);
        }

        function deleteUser() {
            let attributeId = $('#delete').attr('data-user-id');
            $('#delete').attr('action', '/attributes/delete/' + attributeId);
        }

        function handleIsBestChange(attributeId) {
            $(`#form-change-best-${attributeId}`).submit();
        }
    </script>
@endsection
