@extends('layouts.default-container')

@section('content')

    <div>

        <form method="POST" action="/Admin/UserEdit">
            @csrf

            <table>
                <tbody>
                    <tr>
                        <td><strong>Name</strong></td>
                        <td><input type="text" name="name" value="{{ $User->name }}"/></td>
                    </tr>
                    <tr>
                        <td><strong>E-mail</strong></td>
                        <td><input type="text" name="email" value="{{ $User->email }}"/></td>
                    </tr>
                    <tr>
                        <td><strong>Streetname</strong></td>
                        <td><input type="text" name="streetname" value="{{ $User->streetname }}"/></td>
                    </tr>
                    <tr>
                        <td><strong>Housenumber</strong></td>
                        <td><input type="text" name="housenumber" value="{{ $User->housenumber }}"/></td>
                    </tr>
                    <tr>
                        <td><strong>Zipcode</strong></td>
                        <td><input type="text" name="zipcode" value="{{ $User->zipcode }}"/></td>
                    </tr>
                    <tr>
                        <td><strong>Region/City</strong></td>
                        <td><input type="text" name="region" value="{{ $User->region }}"/></td>
                    </tr>
                </tbody>
            </table>

            <input type="hidden" name="id" value="{{ $User->id }}" />
            <button type="submit" >Update user</button>

        </form>

    </div>

@endsection