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
                text:"Thêm thành công",
                showConfirmButton: false,
                timer:3000
            });
        </script>
    @endif
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <!-- DATA TABLE -->
                        <h3 class="title-5 m-b-35">Forum</h3>
                        <form action="{{asset('/addForum')}}" method="post">
                            {{csrf_field()}}
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <input name="forum_name" type="text" class="form-control" placeholder="Nhập tên forum">
                                    @if($errors->has('forum_name'))
                                        <div class="text-danger">{{ $errors->first('forum_name') }}</div>
                                    @endif
                                </div>
                                <div class="table-data__tool-right">
                                    <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        <i class="zmdi zmdi-plus"></i>Thêm forum
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive table-responsive-data2" id="listForum">
                            <table class="table table-data2">
                                <thead>
                                <tr class="text-center">
                                    <th>
                                        STT
                                    </th>
                                    <th>Tên forum</th>

                                    <th></th>
                                </tr>
                                </thead>
                                    @foreach($forums as $index => $forum)
                                    <tbody class="text-center">
                                    <tr class="tr-shadow">
                                        <td>{{$index+1}}</td>

                                        <td>
                                            <span class="block-email">{{$forum->forum_name}}</span>
                                        </td>

                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{asset('/editForum')}}/{{$forum->id}}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Sửa">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="{{asset('/deleteForum')}}/{{$forum->id}}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Xóa">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    </tbody>
                                    @endforeach
                            </table>
                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                    <div class="col-md-8">
                        <!-- DATA TABLE -->
                        <h3 class="title-5 m-b-35">Account</h3>
                        <div class="table-data__tool">
                            <div class="table-data__tool-left">
                                <div class="rs-select2--light rs-select2--md">
                                    <select class="js-select2" name="property" id="fillterAccount">
                                        <option value="">Lọc theo forum</option>
                                        @foreach($forums as $forum)
                                            <option value="{{$forum->id}}">{{$forum->forum_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                <button class="au-btn-filter" data-toggle="modal" id="refresh" >
                                    <i class="zmdi zmdi-refresh"></i>
                                    Refesh
                                </button>
                            </div>
                            <div class="table-data__tool-right">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#mediumModal">
                                    <i class="zmdi zmdi-plus"></i>Thêm Account
                                </button>
                            </div>
                        </div>


                        <div class="table-responsive table-responsive-data2" id="listAccount">
                            <div id="allAccount">
                                <div class="row">
                                    <div class="col-md-3">
                                        <span class="text-primary">Tổng số account</span> <span class="badge badge-primary"> {{$total_account}}</span>
                                    </div>
                                </div>
                                <table class="table table-data2">
                                    <thead>
                                    <tr class="text-center">
                                        <th>
                                            STT
                                        </th>
                                        <th>Tên forum</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    @foreach($accounts as $account)
                                    <tbody class="text-center">
                                    <tr class="tr-shadow">
                                        <td>{{$stt++}}</td>
                                        <td>
                                            <span class="badge badge-dark">{{$account->forum_name}}</span>
                                        </td>
                                        <td>{{$account->username}}</td>
                                        <td>{{$account->password}}</td>
                                        <td>
                                            <label class="switch switch-3d switch-success mr-3">

                                                <input onclick="updateStatusAccount({{$account->id}})" type="checkbox" class="switch-input"
                                                       @if($account->status == 1)
                                                       checked
                                                        @endif
                                                >
                                                <span class="switch-label"></span>
                                                <span class="switch-handle"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{asset('/editAccount')}}/{{$account->id}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Sửa">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                </a>


                                                <a href="{{asset('/deleteAccount')}}/{{$account->id}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Xóa">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    </tbody>
                                    @endforeach
                                </table>
                                {{$accounts->links()}}
                            </div>
                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                </div>



            </div>
        </div>
    </div>
    <style>
        .error-abc{
            display: block !important;
            padding-right: 17px;
        }
    </style>
    {{-- THÊM MỚI ACcount --}}
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true"
         >

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Thêm Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{asset("/addAccount")}}" method="post">
                    {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Chọn forum</label>
                                    <select name="id_forum" id="id_forum" class="form-control">
                                        @foreach($forums as $forum)
                                         <option value="{{$forum->id}}">{{$forum->forum_name}}</option>
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
                                <input id="username" name="username" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                @if($errors->has('username'))
                                    <div class="text-danger">{{ $errors->first('username') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Mật khẩu</label>
                                <input id="password"  name="password" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                @if($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                        </div>
                        {{--<div class="col-md-12">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="cc-payment" class="control-label mb-1">Url profile</label>--}}
                                {{--<input id="url_profile" name="url_profile" type="text" class="form-control" aria-required="true" aria-invalid="false">--}}
                                {{--@if($errors->has('url_profile'))--}}
                                    {{--<div class="text-danger">{{ $errors->first('url_profile') }}</div>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    </div>
                </div>
                <div class="modal-footer">
                    <button id="addAccount" type="submit" class="btn btn-primary">Thêm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- END THÊM MỚI --}}
</div>