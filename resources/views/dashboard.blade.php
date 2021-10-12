@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <h1>Dashboard, Halo {{ Auth::user()->name }}</h1>
@endsection
