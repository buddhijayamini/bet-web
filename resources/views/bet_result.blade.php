<!-- calculate_bet_result.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Calculate Bet Result</div>

                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('calculate.bet.result') }}">
                        @csrf

                        <div class="form-group">
                            <label for="bets_id">Bet ID</label>
                            <input type="number" class="form-control" id="bets_id" name="bets_id" required>
                        </div>

                        <!-- Add more input fields for other data -->

                        <button type="submit" class="btn btn-primary">Calculate Bet Result</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
