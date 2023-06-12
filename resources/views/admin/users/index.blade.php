@extends('layouts.app')
@include('partials.navbar')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-orange">{{ __('Liste des utilisateurs') }}</div>
                <div class="card-body">
                    <table class="table table-hover table-borderless">
                        <thead class="table-dark">
                          <tr>
                            <th scope="col">id</th>
                            <th scope="col">Nom d'utilisateur</th>
                            <th scope="col">Mot de passe</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-orange"><i class="medium material-icons">mode_edit</i></a>
                                        <a href="{{ route('admin.users.destroy', $user->id) }}" class="text-orange"><i class="medium material-icons">delete</i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
