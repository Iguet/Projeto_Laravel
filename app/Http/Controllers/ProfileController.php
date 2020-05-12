<?php

namespace App\Http\Controllers;

use App\Jobs\ImportJob;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

        $user = Auth::user();

        return view('layouts\editProfile', [
            'user' => $user,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, User $user)
    {

        if ($request->password === $request->password_confirmation) {

            $dados = $user->find($id);
            $dados->name = $request->name;
            $dados->email = $request->email;
            $dados->password = Hash::make($request->password);
            $dados->save();

            if ($request->has('image')) {

                if (Storage::disk('public')->exists($dados->image)) {

                    Storage::disk('public')->delete($dados->image);

                }

                $dados->image = $request->image;
                $dados->save();
                $dados->update([
                    'image' => request()->image->store('uploads', 'public'),
                ]);

            }

            return redirect()->route('home');

        } else {

            return redirect()->route('editProfile');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
