@extends('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Add Team</h4>
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
                                                        <h4 class="card-title mb-0">Add Team</h4>
                                                    </div><!--end col-->
                                                </div>
                                            </div>

                                        <form action="{{ route('store.team') }}" id="myForm" method="post" enctype="multipart/form-data">
                                            @csrf

                                            <div class="card-body">

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Name</label>
                                                    <div class="form-group col-lg-12 col-xl-12">
                                                        <input class="form-control" type="text" name="name">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Position</label>
                                                    <div class="form-group col-lg-12 col-xl-12">
                                                        <input class="form-control" type="text" name="position">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Team Photo</label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <input id="image" class="form-control" type="file" name="image">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label"></label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <img id="showImage" src="{{ url('upload/no_image.jpg') }}" class="rounded-circle avatar-xxl img-thumbnail float-start" alt="image profile">
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


<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                }, 
                position: {
                    required : true,
                },
                image: {
                    required : true,
                },
                
            },
            messages :{
                name: {
                    required : 'Please Enter Name',
                }, 
                position: {
                    required : 'Position Field is Required',
                },
                image: {
                    required : 'Image Field is Required',
                },
                 

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
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