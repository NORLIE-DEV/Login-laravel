@include('partials.__header',[$title])
<header class="max-w-lg mx-auto">
    <a href="#">
        <h1 class="text-4xl font-bold text-center text-white mb-5">Edit {{$student->first_name}} {{$student->last_name}}</h1>
    </a>
</header>
<main class="bg-white max-w-lg mx-auto p-8 rounded-lg shadow-2xl">
    <section class="mt-10">
        <form action="/student/{{$student->id}}" method="POST" class="flex flex-col" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="flex justify-center items-center my-4">
                @php
                //    $default_profile = "https://api.dicebear.com/7.x/initials/".$student->first_name."-".$student->last_name.".svg";
                  // echo $default_profile,'<br>';
                  $default_profile ="https://api.dicebear.com/7.x/adventurer-neutral/svg";
                @endphp

                <img class="w-[200px] h-[200px]" src="{{$student->student_image ? asset("storage/student/thumbnail/".$student->student_image) : $default_profile}}">
            </div>
            @error('first_name')
            <p class="text-red-500 text-xs p-1">
                {{$message}}
            </p>
            @enderror
            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label for="firstname" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Firstname</label>
                <input type="text" name="first_name" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-400" autocomplete="off" value="{{$student->first_name}}">
              </div>
            @error('last_name')
            <p class="text-red-500 text-xs p-1">
                {{$message}}
            </p>
            @enderror
            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label for="lastname" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Lastname</label>
                <input type="text" name="last_name"class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-400" value="{{$student->last_name}}">
            </div>
            @error('gender')
            <p class="text-red-500 text-xs p-1">
                {{$message}}
            </p>
            @enderror
            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label for="gender" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Gender</label>
                <select type="text" name="gender"class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-400">
                    <option value=""{{$student->gender==""}}></option>
                    <option value="Male"{{$student->gender == "Male"? 'selected' : '' }}>Male</option>
                    <option value="Female"{{$student->gender== "Female"? 'selected' : '' }}>Female</option>
                </select>
            </div>
            @error('age')
            <p class="text-red-500 text-xs p-1">
                {{$message}}
            </p>
            @enderror
            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label for="age" class="block text-gray-700 text-sm font-bold mb-2 ml-3">age</label>
                <input type="number" name="age"class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-400"value="{{$student->age}}">
            </div>
            @error('email')
            <p class="text-red-500 text-xs p-1">
                {{$message}}
            </p>
            @enderror
            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Email</label>
                <input type="email" name="email"class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-400" value="{{$student->email}}">
            </div>

            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label for="student_image" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Student Image</label>
                <input type="file" name="student_image"class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-400" value="{{$student->student_image}}">
            </div>

            <button class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200" type="submit">Update Record</button>

        </form>
        <form action="/student/{{$student->id}}" method="POST">
            @method('delete')
            @csrf
            <button class="w-full mt-2 bg-gray-600 hover:bg-gray-200 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200" type="submit">Delete</button>
        </form>

    </section>
</main>
@include('partials.__footer')
