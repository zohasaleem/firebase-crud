<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Contract\Database;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{


    public function __construct(Database $database){
        $this->firebase = $database;
        $this->tablename = 'users';
    }


    public function index(){
        $users = $this->firebase->getReference($this->tablename)->getValue();
        return view('firebase.index', compact('users'));    

    }

    //    yajra
    public function getList(Request $request)
    {
        if ($request->ajax()) {


            $users = $this->firebase->getReference($this->tablename)->getValue();
            if($users != null){
                $dataArray = [];
                foreach ($users as $key => $data) {
                    $data['key'] = $key;
                    $dataArray[] = $data;
                }
                return Datatables::of($dataArray)
                ->addIndexColumn()
    
                ->addColumn('action', function ($row) {
                    $btn = '  <a class="btn btn-sm btn-danger" href="'.url('delete-user/'.$row['key']).'" role="button"><i class="fa fa-trash"></i></a>';

                    $btn = $btn .  '<a class="btn btn-sm  btn-dark mx-2" href="'.url('edit-user/'.$row['key']).'" role="button"><i class="fa fa-edit"></i></button>';
                    return $btn;
                }) 
                ->rawColumns(['action'])
                ->make(true);
            }
            else{
                return Datatables::of([])
                ->make(true);
            }
        }
    }






    public function create(){
        return view('firebase.create');
    }


    public function store(Request $req){
        $data = $req->all();

        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $imagePath = $image->store('images', 'public');

            $factory = (new Factory())->withServiceAccount(__DIR__.'/uploadimage-6caaa-firebase-adminsdk-rpkac-d3e875388b.json');
            $storage = $factory->createStorage();
            $bucket = $storage->getBucket();

            $imageFile = fopen(storage_path('app/public/' . $imagePath), 'r');
            $object = $bucket->upload($imageFile, ['name' => 'newimages/' . $image->getClientOriginalName()]);

            $data['image_url'] = $object->signedUrl(now()->addMinutes(5));
        }

        $newPost = $this->firebase->getReference('users')->push($data);

        return redirect('firebase');

        
    }

    public function edit($id){
        
        $key = $id;
        $users = $this->firebase->getReference($this->tablename)->getChild($key)->getValue();
        return view('firebase.edit', compact('users', 'key'));
    }




    public function update(Request $req, $id){

        $key = $id;

        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $imagePath = $image->store('images', 'public');

            $factory = (new Factory())->withServiceAccount(__DIR__.'/uploadimage-6caaa-firebase-adminsdk-rpkac-d3e875388b.json');
            $storage = $factory->createStorage();
            $bucket = $storage->getBucket();

            $imageFile = fopen(storage_path('app/public/' . $imagePath), 'r');
            $object = $bucket->upload($imageFile, ['name' => 'newimages/' . $image->getClientOriginalName()]);

            $updateUser = [
                'name' => $req->name,
                'email' => $req->email,
                'image_url' => $updateUser['image_url'] = $object->signedUrl(now()->addMinutes(5))
            ];
            
        }
        else{
            $updateUser = [
                'name' => $req->name,
                'email' => $req->email,
                'image_url' => $req->existing_url
            ];
        }
        
        $res_updated = $this->firebase->getReference($this->tablename.'/'.$key)->update($updateUser);
        return redirect('firebase');
    }
    


    public function destroy($id){

        $key = $id;

        $del_data = $this->firebase->getReference($this->tablename.'/'.$key)->remove();
        return redirect('firebase');
    }

}
