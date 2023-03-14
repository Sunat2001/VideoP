@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid d-flex justify-content-between">
            <h1 class="m-0">{{ __('dashboard.attributes') }}</h1>
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
                                        <th>{{ __('dashboard.attribute.id') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($attributes as $key => $attribute)
                                        <tr>
                                            <td>{{ $attribute->id }}</td>
                                            <td>{{ $attribute->name }}</td>
                                            <td>{{ $attribute->created_at }}</td>
                                            <td>{{ $attribute->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('attributes.show', ['attribute' => $attribute] ) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('attributes.edit', ['attribute' => $attribute] ) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <button type="button" onclick="setAttributeIdToDeleteModal({{$attribute->id}})"
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
                                {{ $attributes->links() }}
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
    </div>
@endsection
