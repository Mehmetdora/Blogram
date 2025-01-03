@extends('Management_pages.layouts.app')
@section('style')
@endsection
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('Public_pages.layouts._message')

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Category</h5>

                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{route('added-category')}}" method="post">
                            @csrf

                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Name *</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required
                                       id="inputNanme4">
                                <div style="color: red"> {{ $errors->first('name') }}</div>
                            </div>

                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Status *</label>
                                <select class="form-control" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>

                            </div>



                            <hr>

                            <div class="col-12">
                                <label class="form-label">Meta Title *</label>
                                <input type="text" class="form-control" name="meta_title"
                                       value="{{ old('meta_title') }}" >
                                <div style="color: red"> {{ $errors->first('meta_title') }}</div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Meta Description</label>
                                <textarea class="form-control" name="meta_description"></textarea>
                                <div style="color: red"> {{ $errors->first('meta_description') }}</div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Meta Keywords</label>
                                <input type="text" class="form-control" name="meta_keywords"
                                       value="{{ old('meta_keywords') }}">
                                <div style="color: red"> {{ $errors->first('meta_keywords') }}</div>
                            </div>

                            <hr>

                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Menu *</label>
                                <select class="form-control" name="is_menu">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>

                            </div>


                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
