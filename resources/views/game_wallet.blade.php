@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Game Wallet</div>

                <div class="card-body">
                    <p>Your general wallet balance: $ {{ $generalWallet ?? 0 }}</p>
                    <p>Your game wallet balance: $ {{ $gameWallet ?? 0 }}</p>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                    <!-- Form to top up the general wallet -->
                    <form method="POST" action="{{ route('topup.game') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="topup_amount" class="col-md-4 col-form-label text-md-right">Top Up Amount</label>

                            <div class="col-md-6">
                                <input id="topup_amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" required autofocus>

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Top Up Wallet
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Link to transfer funds -->
                    <div class="mt-3">
                        {{-- <a href="{{ route('transfer.funds') }}" class="btn btn-success">Transfer Funds</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
