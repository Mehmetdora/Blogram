@extends('Admin.layouts.app')
@section('style')
@endsection
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('Kayıtsız_Görüntülemeler.layouts._message')

                <div class="card" >
                    <div class="card-body">
                        <h5 class="card-title">
                            Users List
                            <a href="{{ route('add-user') }}" class="btn btn-primary"
                                style="float: right;margin-top: -10px">Add New User</a>
                        </h5>

                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Email Verified</th>
                                    <th scope="col">Rank</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $value)
                                    <tr>
                                        <th scope="row"> {{ $value->id }}</th>
                                        <td> {{ $value->name }}</td>
                                        <td> {{ $value->email }}</td>
                                        <td> {{ !empty($value->email_verified_at) ? 'Yes' : 'No' }}</td>
                                        <td style="color: red"> {{ !empty($value->is_admin) ? 'ADMİN' : 'Non-Admin' }}</td>
                                        <td> {{ !empty($value->status) ? 'Deleted' : 'Active' }}</td>
                                        <td> {{ $value->created_at }}</td>
                                        <td>
                                            <a href="{{ route('edit-user', $value->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <a onclick="delete_user({{ $value->id }}, '{{ route('delete-user') }}')"
                                                id="user-delete-btn" class="btn btn-danger btn-sm">Delete</a>

                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="100%">Record not found.</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>

                        {!! $users->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}


                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
