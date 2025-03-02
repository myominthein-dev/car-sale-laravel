@extends('layouts.app')

@section('title', 'Home - Car Findal Service')

@section('content')
    
    <x-add-car-form :makers="$makers" :models="$models" :states="$states" :cities="$cities" :carTypes="$carTypes" :fuelTypes="$fuelTypes"  />

 

@endsection