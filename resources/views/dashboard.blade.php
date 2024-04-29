@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create A Bet</div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('store.bet') }}">
                            @csrf
                            <div class="form-group">
                                <label for="round">Round</label>
                                <input id="round" type="number" class="form-control @error('round') is-invalid @enderror" name="round" required>

                                @error('round')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="date">Date</label>
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" required>

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="time_per_round">Time Per Round</label>
                                <input id="time_per_round" type="text" class="form-control @error('time_per_round') is-invalid @enderror" name="time_per_round" required pattern="[0-5]?[0-9]:[0-5]?[0-9]" title="Please enter time in MM:SS format" placeholder="MM:SS">

                                @error('time_per_round')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </br>
                            <button type="submit" class="btn btn-primary">Create Bet</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
