@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid d-flex justify-content-between">
            <h1 class="m-0">{{ __('dashboard.reviews') }}</h1>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
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
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#all"
                                       data-toggle="tab">{{ __('dashboard.review.all') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#on_moderation"
                                       data-toggle="tab">{{ __('dashboard.review.on_moderation') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#pass_moderation"
                                       data-toggle="tab">{{ __('dashboard.review.pass_moderation') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#rejected"
                                       data-toggle="tab">{{ __('dashboard.review.rejected') }}</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="all">
                                    <!-- Post -->
                                    <div class="tab-pane" id="seasons">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body p-0">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th>{{ __('dashboard.id') }}</th>
                                                                <th>{{ __('dashboard.review.text') }}</th>
                                                                <th>{{ __('dashboard.review.user') }}</th>
                                                                <th>{{ __('dashboard.review.serial') }}</th>
                                                                <th>{{ __('dashboard.review.created_at') }}</th>
                                                                <th>{{ __('dashboard.review.updated_at') }}</th>
                                                                <th>{{ __('dashboard.actions') }}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($reviews as $review)
                                                                <tr>
                                                                    <td>{{ $review->id }}</td>
                                                                    <td width="20%">{{ $review->text}}</td>
                                                                    <td>
                                                                        <a href="{{ route('users.show', ['user' => $review->user->id]) }}">
                                                                            {{ $review->user->name }}
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('serials.show', ['serial' => $review->serial->id]) }}">
                                                                            {{ $review->serial->name }}
                                                                        </a>
                                                                    </td>
                                                                    <td>{{ $review->created_at }}</td>
                                                                    <td>{{ $review->updated_at }}</td>
                                                                    <td>
                                                                        <button type="button"
                                                                                onclick="setReviewIdToDeleteModal({{$review->id}})"
                                                                                class="btn btn-sm btn-primary"
                                                                                data-toggle="modal"
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
                                                        {{ $reviews->links() }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="on_moderation">
                                                <div class="row">

                                                </div>
                                            </div>
                                            <!-- /.post -->
                                        </div>

                                    </div>
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
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
                                            <button onclick="deleteReview()" type="submit"
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
    </section>

    <script>
        function setReviewIdToDeleteModal(reviewId) {
            $('#delete').attr('data-user-id', reviewId);
        }

        function deleteReview() {
            let reviewId = $('#delete').attr('data-user-id');
            $('#delete').attr('action', '/reviews/delete/' + reviewId);
        }
    </script>
@endsection
