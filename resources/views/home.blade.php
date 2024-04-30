@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="card-body">
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('message') }}
                                </div>
                            @endif
                        <h3>Place A Bet</h3>
                        @if ($bet)
                            <ul>
                                <li>{{ $bet->id }} - {{ $bet->date }} </br>
                                    <form action="{{ route('bet.vote', $bet->id) }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="round">Amount</label>
                                            <input id="amount" type="number"
                                                class="form-control @error('amount') is-invalid @enderror" name="amount"
                                                required>

                                            @error('amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        </br>
                                        <button type="submit" name="action" value="buy"
                                            class="btn btn-primary">Buy</button>
                                        <button type="submit" name="action" value="sell"
                                            class="btn btn-danger">Sell</button>
                                    </form>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
