@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid d-flex justify-content-between">
            <h1 class="m-0">{{ __('dashboard.attributes') }}</h1>
            <a class="btn btn-primary" href="{{ route('attribute-values.create') }}">
                <i class="fas fa-plus"></i>
            </a>
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
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>{{ __('dashboard.attribute_value.id') }}</th>
                                        <th>{{ __('dashboard.attribute_value.value') }}</th>
                                        <th>{{ __('dashboard.attribute_value.attribute') }}</th>
                                        <th>{{ __('dashboard.is_active') }}</th>
                                        <th>{{ __('dashboard.attribute_value.created_at') }}</th>
                                        <th>{{ __('dashboard.attribute_value.updated_at') }}</th>
                                        <th>{{ __('dashboard.actions') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($values as $key => $attribute)
                                        <tr>
                                            <td>{{ $attribute->id }}</td>
                                            <td>{{ $attribute->name }}</td>
                                            <td>
                                                <a href="{{route('attributes.show', ['attribute' => $attribute->attribute])}}">
                                                    {{ $attribute->attribute->name }}
                                                </a>
                                            </td>
                                            <td> <form
                                                    action="{{route('attribute-values.change-status', ['attribute_value' => $attribute])}}"
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
                                                        @error('is_active')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </form></td>
                                            <td>{{ $attribute->created_at }}</td>
                                            <td>{{ $attribute->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('attribute-values.show', ['attribute_value' => $attribute] ) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('attribute-values.edit', ['attribute_value' => $attribute] ) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <button type="button" onclick="setValueIdToDeleteModal({{$attribute->id}})"
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
                                {{ $values->links() }}
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
                                                <button onclick="deleteValue()" type="submit"
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
    </div>

    <script>
        function setValueIdToDeleteModal(valueId) {
            $('#delete').attr('data-user-id', valueId);
        }

        function deleteValue() {
            let valueId = $('#delete').attr('data-user-id');
            $('#delete').attr('action', '/attribute-values/delete/' + valueId);
        }

        function handleIsBestChange(attributeId) {
            $(`#form-change-best-${attributeId}`).submit();
        }
    </script>
@endsection
