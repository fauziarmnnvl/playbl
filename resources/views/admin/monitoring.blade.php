@extends('layouts.admin')

@section('title', 'Monitoring Playbox — BoxPlay.id')
@section('page_title', 'Monitoring Playbox')
@section('page_description', 'Pantau status unit Playbox secara real-time')
@section('breadcrumb', 'Menu Utama / Monitoring Playbox')

@section('content')
    @livewire('monitoring-playbox')
@endsection
