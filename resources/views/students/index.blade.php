{{-- @foreach ($students as $student)
    {{$student->first_name}}
@endforeach --}}

{{-- @php
    print_r($students);
@endphp --}}

{{-- @include('partials.__header')

    <ul>
        @foreach($students as $student)
        <li>{{$student->first_name}}{{$student->last_name}}{{$student->gender}}</li>
        @endforeach

    </ul>
@include('partials.__footer') --}}

@include('partials.__header')

<?php
    $array = array('title'=>'Student System');
?>

<x-nav :data="$array"/>


     <header class="max-w-lg mx-auto mt-5">
        <a href="#">
            <h1 class="text-4xl font-bold text-center text-white mb-5">Student List</h1>
        </a>
    </header>
    <section>
        <div class="overflow-x-auto relative">
            <table class="w-96 mx-auto text-sm text-left text-gray-500">
                <thead class="text-xs text gray-700 uppercase bg-gray-50">

                    <tr>
                        <th scope="col" class="py-3 px-6">

                        </th>
                        <th scope="col" class="py-3 px-6">
                            Firstname
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Lastname
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Email
                        </th>
                        <th scope="col" class="py-3 px-6">
                            gender
                        </th>
                        <th scope="col">

                        </th>

                    </tr>

                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr class="bg-gray-800 border-b text-white">
                        @php
                        //    $default_profile = "https://api.dicebear.com/7.x/initials/".$student->first_name."-".$student->last_name.".svg";
                          // echo $default_profile,'<br>';
                          $default_profile ="https://api.dicebear.com/7.x/adventurer-neutral/svg";
                        @endphp
                        <td>
                            <img src="{{$student->student_image ? asset("storage/student/thumbnail/".$student->student_image) : $default_profile}}">
                        </td>
                        <td class="py-4 px-6">{{$student->first_name}}</td>
                        <td class="py-4 px-6">{{$student->last_name}}</td>
                        <td class="py-4 px-6">{{$student->email}}</td>
                        <td class="py-4 px-6">{{$student->gender}}</td>
                        <td class="py-4 px-6"><a href="/student/{{$student->id}}" class="bg-sky-600 text-white px-4 py-1 rounded">view</a></td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
          <div class="mx-auto max-w-lg pt-6 p-4">
            {{$students->links()}}
          </div>
        </div>
    </section>
@include('partials.__footer')
