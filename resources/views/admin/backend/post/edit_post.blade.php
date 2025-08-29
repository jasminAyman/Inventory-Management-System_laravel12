@extends('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Edit Blog Post</h4>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">

                        <div class="tab-pane pt-4" id="profile_setting" role="tabpanel">
                            <div class="row">

                                <div class="row">
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="card border mb-0">

                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h4 class="card-title mb-0">Edit Blog Post</h4>
                                                    </div><!--end col-->
                                                </div>
                                            </div>

                                        <form action="{{ route('update.blog.post') }}" method="post" enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="id" value="{{ $post->id }}">

                                            <div class="card-body">

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Blog Category</label>
                                                    <div class="col-lg-6 col-xl-6">
                                                        <select id="simpleinput" name="blogcat_id" class="form-select" aria-label="Default select example">
                                                            <option seclected="">Select Category</option>
                                                            @foreach ($blogcat as $cat)
                                                                <option value="{{ $cat->id }}" {{ $cat->id == $post->blogcat_id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Title</label>
                                                    <div class="col-lg-6 col-xl-6">
                                                        <input class="form-control" type="text" name="post_title" value="{{ $post->post_title }}">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Description</label>
                                                    <div class="col-lg-12 col-xl-12">

                                                        <textarea name="long_desc" id="description" style="display:none;"></textarea>

                                                        <div name="description" id="quill-editor" style="height: 200px;">
                                                            {!! $post->long_desc !!}
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Post Image</label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <input id="image" class="form-control" type="file" name="image">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label"></label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <img id="showImage" src="{{ asset($post->image) }}" class="rounded-circle avatar-xxl img-thumbnail float-start" alt="image profile">
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Save Changes</button>

                                            </div><!--end card-body-->
                                        </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> <!-- end education -->

                    </div>

                </div><!-- end card -->
            </div><!-- end col-12 -->
        </div><!-- end row -->


    </div><!-- end container-xxl -->
</div><!-- end content -->


<script>
    document.querySelector('form').onsubmit = function() {
        var description = document.querySelector('#description');
        description.value = quill.root.innerHTML;
    };
</script>

<script type="text/javascript">

    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })

</script>

@endsection