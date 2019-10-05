@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                    @foreach($world->getStructure() as $y => $row)

                        <tr class="">
                        @foreach($row as $x => $field)

                            <td class="p-1 small">

                                @if($player->onPosition($x, $y)) <div class="bg-primary"></div> @endif

                            </td>

                        @endforeach
                        </tr>

                    @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
