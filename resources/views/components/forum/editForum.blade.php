<!-- PAGE CONTAINER-->
<div class="page-container">
    <!-- HEADER DESKTOP-->
@include('components.header_desktop')
<!-- END HEADER DESKTOP-->
    @if(session('message'))
        <script>
            Swal.fire({
                toast: true,
                position:'top-end',
                icon: 'success',
                text:"Sửa thành công",
                showConfirmButton: false
            });
        </script>
@endif
<!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Sửa forum</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{asset("/editForum")}}/{{$forum->id}}" method="post">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Tên forum</label>
                                                <input name="forum_name" value="{{$forum->forum_name}}" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="addAccount" type="submit" class="btn btn-primary">Lưu</button>
                                    <a href="{{asset('/forum-account')}}">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>