@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <faction-component></faction-component>

            <squad-component></squad-component>

            <characters-component></characters-component>

            <character-component></character-component>

            <inventory-component></inventory-component>

            <world-component></world-component>

            <history-component></history-component>

        </div>
    </div>
</div>
@endsection
