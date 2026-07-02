@extends('layouts.admin')

@section('title', 'Monitoring Playbox — BoxPlay.id')
@section('page_title', 'Monitoring Playbox')
@section('page_description', 'Pantau status unit Playbox cabang Anda secara real-time')
@section('breadcrumb', 'Monitoring Playbox')

@section('content')
    @livewire('monitoring-playbox')
@endsection
