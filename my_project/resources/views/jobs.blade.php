<x-layout>
    <x-slot:heading>Job Listings</x-slot:heading>
    @foreach ($jobs as $job )

    <li>
        <a href="/jobs/{{$job['id']}}" class='hover:text-blue-500 hover:underline'>
            <strong>{{$job['title']}}</strong> : {{$job['salary']}} per year.
        </a>
    </li>
    
    @endforeach ()
</x-layout>