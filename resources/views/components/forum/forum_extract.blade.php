<!-- PAGE CONTAINER-->
<div class="page-container">
    <!-- HEADER DESKTOP-->
@include('components.header_desktop')
<!-- END HEADER DESKTOP-->
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <form action="{{asset('/postForumExtract')}}" method="post">
                    {{csrf_field()}}
                <div class="row au-card">
                    <div class="col-md-12 mb-3">
                        <h4>Phân forum</h4>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="id_user" class="form-control">
                                @foreach($users as $user)
                                 <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('id_user'))
                                <div class="text-danger">{{ $errors->first('id_user') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <select class="js-example-basic-multiple" name="id_forums[]" multiple="multiple">
                            @foreach($forums as $forum)
                                <option value="{{$forum->id}}">{{$forum->forum_name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('id_forums'))
                            <div class="text-danger">{{ $errors->first('id_forums') }}</div>
                        @endif
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </div>
                </div>
                </form>
            </div>
        </div>

        <div class="section__content section__content--p30 mt-3">
            <div class="container-fluid">
                <div class="row au-card">
                    <div class="col-md-12 mb-3">
                        <h4>Danh sách phân forum</h4>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive table-responsive-data2" id="listChannel">
                            <table class="table table-data2">
                                <thead>
                                <tr class="text-center">
                                    <th>
                                        STT
                                    </th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Forum được phân</th>
                                </tr>
                                </thead>
                                    @foreach($users as $index => $user)
                                    <tbody class="text-center">
                                    <tr class="tr-shadow">
                                        <td>{{$index+1}}</td>
                                        <td>
                                            <span class="text-dark">{{$user->name}}</span>
                                        </td>
                                        <td>
                                            <span class="text-dark">{{$user->email}}</span>
                                        </td>

                                        <td class="limit-forum">
                                            @foreach($user->forums as $forum)
                                                <button type="button" class="btn btn-success btn-sm m-l-10 m-b-10">{{$forum->forum_name}}
                                                    <a href="{{asset('/delForumOfUser')}}/{{$forum->id}}">
                                                         <span class="badge badge-light">x</span>
                                                    </a>
                                                </button>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    </tbody>
                                    @endforeach
                            </table>
                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>