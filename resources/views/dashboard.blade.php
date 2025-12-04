@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('breadcrumbs')
    <span class="breadcrumb-separator">/</span>
    <span class="breadcrumb-item active">Dashboard</span>
@endsection

@section('content')
    <div class="card">
        <h2>Welcome, {{ Auth::user()->name ?? 'User' }}!</h2>
        <p>You're logged in to Accounts Management.</p>
    </div>
@endsection


