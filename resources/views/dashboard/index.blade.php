@extends("layout.master")
@section("title")
    Dashboard
@endsection
@section("content")
    <section>
        {{session("auth")->name}}
        <form action="{{route("auth.logout")}}" method="post">
            @csrf
            <button class="btn btn-primary">Logout</button>
        </form>
    </section>
@endsection
