@extends ('layouts.app')
@section('content')
    <header class="flex items-center mb-3 py-4">
        {{--        <h1 class="mr-auto">Birdboard</h1>--}}
        <div class="flex justify-between items-end w-full">
            <p class="text-gray text-sm font-normal">
                <a href="/projects" class="text-gray text-sm font-normal no-underline">My Projects</a> / {{ $project->title }}
            </p>

            <a class="button" href="/projects/create">New Project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-6">
                    <h2 class="text-gray font-normal text-lg mb-3">Tasks</h2>
                    {{--tasks--}}
                    <div class="card mb-3">Lorem ipsum</div>
                    <div class="card mb-3">Lorem ipsum</div>
                    <div class="card mb-3">Lorem ipsum</div>
                    <div class="card">Lorem ipsum</div>
                </div>

                <div>
                    <h2 class="text-gray font-normal text-lg mb-3">General notes</h2>
                    {{--general notes--}}

{{--                    <div class="card">Lorem ipsum</div>--}}
                    <textarea class="card w-full" style="min-height: 200px;">Lorem ipsum</textarea>
                </div>
            </div>

            <div class="lg:w-1/4 px-3">
                @include('projects.card')
{{--                <div class="card">
                    <h1 class="text-4xl font-bold">{{ $project->title }}</h1>
                    <div>{{ $project->description }}</div>
                    <a href="/projects">Go Back</a>
                </div>--}}
            </div>
        </div>
    </main>
@endsection
