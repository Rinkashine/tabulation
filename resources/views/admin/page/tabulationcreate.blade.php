@extends('admin.layout.admin')
@section('content')
@section('title', 'Tabulate')

@livewire('admin.tabulation.tabulationcreate',['event' => $event,'classification' => $classification])


@endsection
