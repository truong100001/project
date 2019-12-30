@extends('master')

@section('content')
    @include('components.header_moblie')
    @include('components.header')
    @include('components.menu')
    @include('components.forum.content')

@endsection

@section('script')
    <script>
        jQuery(document).ready(function(){
            jQuery('#addForum').click(function(e){
                e.preventDefault();
                jQuery.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('#token').attr('content')
                    },
                    url: "{{ asset('/addForum')}}",
                    method: 'post',
                    data: {
                        name: $('#forum').val(),
                    },
                    success: function(data){
                        location.reload();
                    },
                    error: function(error)
                    {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: error.responseJSON.error,
                        })
                    }
                });
            });
        });
    </script>

    <script>
        function updateStatusAccount(id)
        {
            jQuery.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('#token').attr('content')
                },
                url: "{{ asset('/updateStatusAccount')}}",
                method: 'post',
                data: {
                    id: id,
                },
                success: function(data){
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        text: 'Cập nhật thành công',
                        showConfirmButton: false
                    })
                },
                error: function(error)
                {

                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Tên forum không được để trống',
                    })
                }
            });
        }
    </script>


    <script>
        $('#fillterAccount').change(function () {
            window.location = '/filter-account-by-forum/'+ $('#fillterAccount').val();
        });
    </script>

    <script>
        $('#refresh').click(function () {
            window.location = '{{asset('/forum-account')}}';
        });
    </script>





@endsection