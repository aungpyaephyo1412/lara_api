@extends("layout.master")
@section("title")
    Dashboard
@endsection
@section("content")
    <section>
        {{session("auth")->name}}
    </section>
@endsection
