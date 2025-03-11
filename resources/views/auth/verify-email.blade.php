@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h3>Email Verification Required</h3>
    <p>Before proceeding, please check your email for a verification link.</p>
    <p>If you didn't receive the email, <a href="{{ route('verification.resend') }}">click here to request another</a>.</p>
</div>
@endsection
