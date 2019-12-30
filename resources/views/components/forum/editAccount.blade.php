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
                                <h5 class="modal-title" id="mediumModalLabel">Sửa Account</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{asset("/editAccount")}}/{{$account->id}}" method="post">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Chọn forum</label>
                                                    <select name="id_forum" id="id_forum" class="form-control">
                                                        @foreach($forums as $forum)
                                                            <option @if($forum->id == $account->id_forum) {{'selected'}} @endif  value="{{$forum->id}}">{{$forum->forum_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('id_forum'))
                                                        <div class="text-danger">{{ $errors->first('id_forum') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">User name</label>
                                                <input id="username" value="{{$account->username}}" name="username" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                @if($errors->has('username'))
                                                    <div class="text-danger">{{ $errors->first('username') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Mật khẩu</label>
                                                <input value="{{$account->password}}" id="password"  name="password" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                @if($errors->has('password'))
                                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                                @endif
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