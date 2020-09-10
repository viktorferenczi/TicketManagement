@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session()->has('message'))
                    <div class="alert alert-danger">{{session()->get('message')}}</div>
                @endif
                    @error('accessCode')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <h4>Please enter you verification code.</h4>
                <div class="card">
                    <div class="card-header">{{ __('Verification') }}</div>
                    <div class="card-body">
                        <form method="POST" action="/adminpanel/verification">
                            @csrf
                            <div class="form-group row">
                                <label for="accessCode" class="col-md-4 col-form-label text-md-right">{{ __('Code:') }}</label>

                                <div class="col-md-6">
                                    <input id="accessCode" type="text" class="form-control @error('accessCode') is-invalid @enderror" name="accessCode">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Enter') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
