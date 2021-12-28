@extends('layouts.app')

@section('content')
    <v-app>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <squad-component v-bind:id="{{ $id }}"></squad-component>

                </div>
            </div>
        </div>
    </v-app>
@endsection
