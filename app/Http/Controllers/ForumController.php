<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use function Lmc\Steward\requireIfExists;
use function React\Promise\reject;

class ForumController extends Controller
{
    public function __construct()
    {
        $forums = DB::table('forum')->get();
        View::share('forums',$forums);
    }

    public function forum()
    {
        $accounts = DB::table('account')->join('forum','account.id_forum','=','forum.id')->select('account.*','forum.forum_name')->paginate(15);
        $total_account = DB::table('account')->count();
        $stt = $accounts->firstItem();

        return view('pages.forum',compact('forums','accounts','stt','total_account'));
    }

    public function filterAccountByForum($id_forum)
    {
        $accounts = DB::table('account')->join('forum','account.id_forum','=','forum.id')->select('account.*','forum.forum_name')->where('id_forum',$id_forum)->paginate(15);
        $total_account = DB::table('account')->join('forum','account.id_forum','=','forum.id')->where('id_forum',$id_forum)->count();
        $stt = $accounts->firstItem();
        $forum_id = $id_forum;
        return view('pages.forum',compact('forums','accounts','stt','total_account','forum_id'));
    }

    public function addForum(Request $request)
    {
        $this->validate($request,[
            'forum_name' => 'bail|required|unique:forum',
        ],[
            'forum_name.required' => 'Tên forum không được để trống',
            'forum_name.unique' => 'Forum đã có rồi',
        ]);

        DB::table('forum')->insert([
            'forum_name' => $request->forum_name,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);

        return redirect()->back()->with('message','success');

    }

    public function editForum($id)
    {
        $forum = DB::table('forum')->where('id',$id)->first();
        if($forum)
        {
            return view('pages.editForum',compact('forum'));
        }
        else
        {
            return abort(404);
        }

    }

    public function postEditForum(Request $request,$id)
    {
        $this->validate($request,[
            'forum_name' => 'bail|required|unique:forum',
        ],[
            'forum_name.required' => 'Tên forum không được để trống',
            'forum_name.unique' => 'Forum đã có rồi',
        ]);

        DB::table('forum')->where('id',$id)->update([
            'forum_name' => $request->forum_name,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);

        return redirect()->back()->with('message','success');
    }


    public function addAccount(Request $request)
    {
        $this->validate($request,[
            'id_forum' => 'bail|required',
            'username' => 'bail|required',
            'password' => 'bail|required',
        ],[
            'id_forum.required' => 'Chọn một forum cho tài khoản',
            'username.required' => 'Tên tài khoản không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
        ]);

        $check_account = DB::table('account')->where('id_forum',$request->id_forum)->where('username',$request->username)->first();
        if($check_account)
            return redirect()->back()->with('error','failed');

        DB::table('account')->insert([
            'id_forum' => $request->id_forum,
            'username' => $request->username,
            'password' => $request->password,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);

        return redirect()->back()->with('message','success');
    }

    public function deleteForum($id)
    {
        DB::table('forum')->where('id',$id)->delete();
        return redirect()->back();
    }

    public function deleteAccount($id)
    {
        DB::table('account')->where('id',$id)->delete();
        return redirect()->back();
    }

    public function editAccount($id)
    {
        $account = DB::table('account')->where('id',$id)->first();
        if(!$account)
            abort(404);
        return view('pages.editAccount',compact('account','forums'));
    }

    public function postEditAccount(Request $request,$id)
    {
        $this->validate($request,[
            'id_forum' => 'bail|required',
            'username' => 'bail|required',
            'password' => 'bail|required',
        ],[
            'id_forum.required' => 'Chọn một forum cho tài khoản',
            'username.required' => 'Tên tài khoản không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
        ]);

        DB::table('account')->where('id',$id)->update(
            [
                'id_forum' => $request->id_forum,
                'username' => $request->username,
                'password' => $request->password,
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ]
        );

        return redirect()->back()->with('message','success');
    }


    public function updateStatusAccount(Request $request)
    {
        $account = DB::table('account')->where('id',$request->id)->first();
        if(!$account)
            abort(404);
        $status = 0;
        if($account->status == 1)
            $status = 0;
        else
            $status = 1;
        DB::table('account')->where('id',$request->id)->update([
            'status' => $status,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        return response()->json(['message'=>'success'],200);
    }



    public function forumExtract()
    {
        $users = DB::table('users')->where('access',1)->get();
        foreach ($users as $user)
        {
            $forums = DB::table('forum')->where('id_user',$user->id)->get();
            $user->forums = $forums;
        }

        $forums = DB::table('forum')->where('id_user',null)->get();
        return view('pages.forum_extract',compact('users','forums'));
    }

    public function postForumExtract(Request $request)
    {
        $this->validate($request,[
            'id_user' => 'bail|required',
            'id_forums' => 'bail|required',
        ],[
            'id_user.required' => 'Chọn một người để đảm nhận',
            'id_forums.required' => 'Chọn ít nhất một forum để đảm nhận',
        ]);

        foreach ($request->id_forums as $id_forum)
        {
            DB::table("forum")->where('id',$id_forum)->update([
                'id_user' => $request->id_user,
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ]);
        }
        return redirect()->back()->with('message','success');
    }

    public function delForumOfUser($id)
    {
        DB::table('forum')->where('id',$id)->update([
            'id_user'=> null,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        return redirect()->back()->with('message','success');
    }


}
