@extends('layouts.main-layout')
@section('title', 'Home')
@section('main')
    <main>
        <x-hero :posts="$posts" />
        <x-recent-post :posts="$posts" />
        <x-news-latter />
    </main>
@endsection
