<?php

namespace App\Http\Controllers;


use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image as Image;

class StudentController extends Controller
{
    public function index(){

        $data = array("students"=> DB::table('students')->orderBy
        ('created_at','desc')->simplepaginate(10));
        // $data = Students::where('age','>=', 19)->orderBy('first_name', 'asc')->limit(3)->get();
        // $data = Students::all();
        // $data = DB::table('students')
        //             ->select(DB::raw('count(*) as gender_count, gender'))->groupBy('gender')->get();
        // dd($data);

        // return view('students.index', ['students'=>$data]);
        return view('students.index',$data);
    }

    public function show($id){
          $data = Students::findOrFail($id);
          //dd($data);
          return view('students.edit', ['student'=>$data]);
    }

    public function create(){
        return view('students.create')->with('title','Add new');
    }

    public function store(Request $request){
        $validated = $request->validate([
            "first_name" => ['required', 'min:4'],
            "last_name" => ['required', 'min:4'],
            "gender"=>['required'],
            "age"=>['required'],
            "email" =>['required', 'email', Rule::unique('Students','email')],

        ]);

        if($request->hasFile('student_image')){

            $request->validate([
                "student_image" => 'mimes:jpeg,png,bmp,tiff,svg |max:4096'
            ]);

            $filenameWithExtension = $request->file("student_image");

            $filename = pathinfo($filenameWithExtension,PATHINFO_FILENAME);

            $extension = $request->file("student_image")->getClientOriginalExtension();
            $filenameToStore = $filename . '_' .time().'.'.$extension;
            $smallThumbnail = $filename .'_'.time().'.'.$extension;

            $request->file('student_image')->storeAs('public/student',$filenameToStore);
            $request->file('student_image')->storeAs('public/student/thumbnail',$smallThumbnail);

            $thumbNail = 'storage/student/thumbnail/' .$smallThumbnail;

            $this->createThumbnail($thumbNail,150,93);

            $validated['student_image'] = $filenameToStore;
        }


        Students::create($validated);
        return redirect('/')->with('message','New Student Added Successfully!');
    }

    public function update(Request $request, Students $student){

        $validated = $request->validate([
            "first_name" => ['required', 'min:4'],
            "last_name" => ['required', 'min:4'],
            "gender"=>['required'],
            "age"=>['required'],
            "email" =>['required', 'email'],
        ]);
       // dd($request);

        if($request->hasFile('student_image')){

            $request->validate([
                "student_image" => 'mimes:jpeg,png,bmp,tiff,svg |max:4096'
            ]);

            $filenameWithExtension = $request->file("student_image");

            $filename = pathinfo($filenameWithExtension,PATHINFO_FILENAME);

            $extension = $request->file("student_image")->getClientOriginalExtension();
            $filenameToStore = $filename . '_' .time().'.'.$extension;
            $smallThumbnail = $filename .'_'.time().'.'.$extension;

            $request->file('student_image')->storeAs('public/student',$filenameToStore);
            $request->file('student_image')->storeAs('public/student/thumbnail',$smallThumbnail);

            $thumbNail = 'storage/student/thumbnail/' .$smallThumbnail;

            $this->createThumbnail($thumbNail,150,93);

            $validated['student_image'] = $filenameToStore;
        }

         $student->update($validated);
         return redirect('/')->with('message','Data was successfully updated');
    }

    public function destroy(Students $student){
        $student->delete();

        return redirect('/')->with('message','Data was successfully deleted');
       //dd($request);
    }

    public function createThumbnail($path, $with, $height){
        $img = Image::make($path)->resize($with,$height, function($constraint){
            $constraint->aspectRatio();
        });
        $img->save($path);
    }
}


