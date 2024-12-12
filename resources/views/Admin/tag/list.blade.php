@extends('Admin.layouts.app')
@section('style')
@endsection
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('Kayıtsız_Görüntülemeler.layouts._message')

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Tags List({{$count}})
                            <a onclick="add_tag('{{ route('tag_added') }}')" class="btn btn-primary"
                                style="float: right;margin-top: -10px">Add New
                                Tag</a>
                        </h5>

                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tags as $tag)
                                    <tr>
                                        <th scope="row"> {{ $tag->id }}</th>
                                        <td> {{ $tag->name }}</td>
                                        <td> {{ $tag->created_at }}</td>
                                        <td>
                                            <a onclick="delete_tag({{ $tag->id }}, '{{ route('tag_deleted') }}')"
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

                        {!! $tags->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}


                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection

@section('script')
    {{-- tag insertion --}}
    <script>
        function add_tag(url) {

            Swal.fire({
                title: "Type new tag name here",
                input: "text",
                inputLabel: "New Tag Name",
                showCancelButton: true,
                inputValidator: (value) => {
                    if (!value) {
                        return "You cant left blank here!";
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData();
                    formData.append('tag_name', result.value);

                    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    formData.append('_token', csrfToken);

                    fetch(url, { // action attribute'undan URL'yi alıyoruz
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Success:', data);

                            Swal.fire({
                                icon: "success",
                                title: "Tag is deleted successfully!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            location.reload();

                        })
                        .catch((error) => {
                            console.error('Error:', error);
                        });

                }


            });

        }
    </script>
@endsection
