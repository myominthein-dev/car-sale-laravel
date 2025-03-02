@extends('layouts.app')

@section('title', 'Home - Car Findal Service')

@section('content')
    
    <x-edit-car-form :makers="$makers" :models="$models" :states="$states" :cities="$cities" :carTypes="$carTypes" :fuelTypes="$fuelTypes"  :carImages="$carImages" :car="$car" :carFeatures="$carFeatures" />


@endsection