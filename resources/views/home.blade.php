@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center mb-4">

        <div class="col-md-6">

            <worlds-component></worlds-component>

        </div>

        <div class="col-md-6">

            <world-component></world-component>

        </div>

    </div>

    <div class="row justify-content-center mb-4">

        <div class="col-md-6">

            <factions-component></factions-component>

        </div>

        <div class="col-md-6">

            <faction-component></faction-component>

        </div>

    </div>

    <div class="row justify-content-center mb-4">

        <div class="col-md-6">

            <squads-component></squads-component>

        </div>

        <div class="col-md-6">

            <squad-component></squad-component>

        </div>

    </div>

    <div class="row justify-content-center mb-4">

        <div class="col-md-6">

            <characters-component></characters-component>

        </div>

        <div class="col-md-6">

            <character-component></character-component>

        </div>

    </div>

    <div class="row justify-content-center mb-4">

        <div class="col-md-6">

            <inventory-component></inventory-component>

        </div>

        <div class="col-md-6">

            <history-component></history-component>

        </div>

    </div>

</div>
@endsection
