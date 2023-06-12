<?php

namespace App\Http\Controllers\Profile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ParametresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::user();
        return view('profileFolder.parametres', compact('user'));
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required | min:8 | max:100',
            'confirm_password' => 'required | same:new_password'
        ]);

        $user = Auth::user();
        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                "password" => Hash::make($request->new_password),
            ]);
            return redirect()->back()->with('success', 'Mot de passe mis à jour avec succès');
        } else {
            return redirect()->back()->with('fail', 'Ancien mot de passe ne correspond pas');
        }
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
    public function edit($id)
    {
        return view('profileFolder.changePSW', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'email' => 'required | email',
            'nom' => 'required | min:3 | max:100',
            'prenom' => 'required | min:3 | max:100'
        ]);

        $user->update([
            // "matricule" => $request->input('matricule'),
            "nom" => $request->input('nom'),
            "prenom" => $request->input('prenom'),
            "email" => $request->input('email'),
        ]);
        if ($request->image != "") {
            $image_name = $user->matricule . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $image_name);
            $user->update([
                "profile_image" => '\images\\' . $image_name,
            ]);
        }

        return redirect()->route('parametres.index')->with('success', 'Paramètres mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
