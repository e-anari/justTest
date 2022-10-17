<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query();

        if (request('search')) {
            $keyword = trim(request('search'));
            $users->where('username', 'LIKE', "%{$keyword}%")
                ->orWhere('firstname', 'LIKE', "%{$keyword}%")
                ->orWhere('lastname', 'LIKE', "%{$keyword}%")
                ->orWhere('email', 'LIKE', "%{$keyword}%")
                ->orWhere('job', 'LIKE', "%{$keyword}%");
        }

        if (request('rank')) {
            $rank = request('rank');
            ($rank != 'all') ? $users->whereRank($rank) : $users;
        }

        if (request('sorting')) {
            $sort = request('sorting');
            switch ($sort) {
                case 'desc':
                    $users->orderby('created_at', 'desc');
                    break;
                case 'asc':
                    $users->orderby('created_at', 'asc');
                    break;
                case 'az':
                    $users->orderby('name', 'asc');
                    break;
                case 'za':
                    $users->orderby('name', 'desc');
                    break;

                default:
                    # code...
                    break;
            }
        }

        $users = $users->paginate(10);
        return view('admin.user.index', \compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request = $request->validate([
            'rank' => ['required', 'in:normal,staff,super'],
        ]);

        $user->update($request);

        return redirect(route('user.index'))->with('success', 'User edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect(route('user.index'))->with('success', 'User deleted.');
    }
}
