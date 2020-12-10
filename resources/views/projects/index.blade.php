@extends ('layouts.app')
@section('content')
    <header class="flex items-center mb-3 py-4">
{{--        <h1 class="mr-auto">Birdboard</h1>--}}
        <div class="flex justify-between items-center w-full">
                <h2 class="text-gray text-2xl text-sm font-normal">My Projects</h2>
            <a class="button" href="/projects/create">New Project</a>
        </div>
    </header>

    <main class="lg:flex lg:flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                <div class="bg-white p-5 rounded-lg shadow" style="height: 200px;">
                    <h3 class="font-semibold font-normal text-xl py-4 mb-3 -ml-5 border-l-4 border-blue-light pl-4">
                        <a href="{{ $project->path() }}" class="text-back no-underline">{{ $project->title }}</a>
                    </h3>
    {{--                <div>{{ Illuminate\Support\Str::limit($project->description) }}</div>--}}
                    <div class="text-grey">{{ str_limit($project->description, 100) }}</div>
                </div>
            </div>
        @empty
            <div>No projects yet.</div>
        @endforelse
    </main>
@endsection
