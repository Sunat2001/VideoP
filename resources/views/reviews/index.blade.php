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
                        <div class="tab-content">
                            <div class="tab-pane active" id="all">
                                <div class="col-lg-12">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>{{ __('dashboard.id') }}</th>
                                            <th>{{ __('dashboard.review.text') }}</th>
                                            <th>{{ __('dashboard.review.user') }}</th>
                                            <th>{{ __('dashboard.review.serial') }}</th>
                                            <th>{{ __('dashboard.review.status') }}</th>
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
                                                <td>{{ \App\Enum\ReviewStatuses::getLabel($review->status) }}</td>
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
                                <!-- /.post -->
                            </div>
                            <div class="tab-pane" id="on_moderation">
                                <div class="col-lg-12">
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
                                        @foreach($reviewsOnModeration as $review)
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
                                                <td class="d-flex">
                                                    <form
                                                        action="{{ route('reviews.change-status', ['review' => $review, 'status' => \App\Enum\ReviewStatuses::APPROVED]) }}"
                                                        method="post"
                                                        class="mr-1"
                                                    >
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                    <form
                                                        action="{{ route('reviews.change-status', ['review' => $review, 'status' => \App\Enum\ReviewStatuses::APPROVED]) }}"
                                                        method="post"
                                                    >
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
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
                            <div class="tab-pane" id="pass_moderation">
                                <div class="col-lg-12">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>{{ __('dashboard.id') }}</th>
                                            <th>{{ __('dashboard.review.text') }}</th>
                                            <th>{{ __('dashboard.review.user') }}</th>
                                            <th>{{ __('dashboard.review.serial') }}</th>
                                            <th>{{ __('dashboard.review.created_at') }}</th>
                                            <th>{{ __('dashboard.review.updated_at') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($reviewsApproved as $review)
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
                            <div class="tab-pane" id="rejected">
                                <div class="col-lg-12">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>{{ __('dashboard.id') }}</th>
                                            <th>{{ __('dashboard.review.text') }}</th>
                                            <th>{{ __('dashboard.review.user') }}</th>
                                            <th>{{ __('dashboard.review.serial') }}</th>
                                            <th>{{ __('dashboard.review.is_best') }}</th>
                                            <th>{{ __('dashboard.review.created_at') }}</th>
                                            <th>{{ __('dashboard.review.updated_at') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($reviewsRejected as $review)
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
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input name="is_best" type="checkbox" {{ $review->is_best == 1 ? 'checked' : '' }} class="custom-control-input"
                                                               id="customSwitch1">
                                                        <label class="custom-control-label"
                                                               for="customSwitch1">{{ __('dashboard.user.placeholder.is_admin') }}</label>
                                                        @error('is_admin')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </td>
                                                <td>{{ $review->created_at }}</td>
                                                <td>{{ $review->updated_at }}</td>
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
