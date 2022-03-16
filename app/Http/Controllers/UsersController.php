<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Traits;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use App\Models\Users;
use File;


class UsersController extends Controller
{
    

    public function index(Request $request){

		 
		$filter = $request->query('filter');
        $users = Users::sortable()->paginate(5);
		//print $request->page;
		if(empty($_GET['page']))
		{
			$_GET['page'] = 1;
		}
		if(empty($_GET['uid']))
		{
			$_GET['uid'] = '';
		}

        if (!empty($filter)) {
			$users = Users::sortable()
				->where('name', 'like', '%'.$filter.'%')
				->paginate(5);
		} else {
			$users = Users::sortable()
				->paginate(5);
		}
	
		return view('users.index')->with('users', $users)->with('filter', $filter);

        //return view('users.index', compact('users'));
        }

    public function insertform(){  
        return view('users.insert');
    }
    public function insert(Request $request){
        $rules = [
			'name' => 'required|string|min:3|max:255',
			'email' => 'required|string|email|max:255',
			'gender' => 'required|string|min:2|max:255',
			'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('users/insert')
			->withInput()
			->withErrors($validator);
		}
		else{
			
			try{

			    $image = time().'.'.request()->image->getClientOriginalExtension();
				request()->image->move(public_path('uploads'), $image);

				$users = new Users([
					'name' => $request->get('name'),
					'email' => $request->get('email'),
					'gender' => $request->get('gender'),
					'image' => $image
					
				]);
				$users->save();
				return redirect('users/insert')->with('status',"Записа е добавен");
			}
			catch(Exception $e){
				return redirect('users/insert')->with('failed',"Възникна грешка");
			}
		}
    }
    

    public function edit($id)
    {
		$users = Users::find($id);
		return view('users.edit', compact('users'));  
    }

    public function update(Request $request, $id)
    {
        $rules = [
			'name' => 'required|string|min:3|max:255',
			'email' => 'required|string|email|max:255',
			'gender' => 'required|string|min:2|max:255'
			
		];
			$validator = Validator::make($request->all(),$rules);

			if ($validator->fails()) {
				return redirect('users/edit/'.$id)
				->withInput()
				->withErrors($validator);
			}
			else{
				
				try{

					$users = Users::find($id);
					$users->name =  $request->get('name');
					$users->gender = $request->get('gender');
					$users->email = $request->get('email');

					if(!empty(request()->image))
					{
						$image = time().'.'.request()->image->getClientOriginalExtension();
						request()->image->move(public_path('uploads'), $image);
						$users->image = $image;
					}

					$users->save();
					
					return redirect('users/index/'.$id.'?page='.$_GET['page'].'&uid='.$id)->with('success', 'Записа е променен!');
				}
					catch(Exception $e){
							return redirect('users/edit/'.$id.'?page='.$_GET['page'])->with('failed',"Възникна грешка");
					}
			
			}
	    
		
    }

    public function delete($id) {
		$users = Users::find($id);
		
        $destinationPath = 'uploads';
		File::delete($destinationPath.'/'.$users->image);
        $users->delete();
		return redirect('users/index?page='.$_GET['page'])->with('status',"Записа е изтрит");
		//return redirect()->route('users.index')->with('success','User deleted successfully');
		}

	public function deleteimage($id) {
		$users = Users::find($id);
		$destinationPath = 'uploads';
		File::delete($destinationPath.'/'.$users->image);
		$users->image = '';
		$users->save();
		
		return redirect('users/edit/'.$id.'?page='.$_GET['page'])->with('status',"Снимката е изтрита");
		
		}	

	public function indexFiltering(Request $request)
		{
			$filter = $request->query('filter');
		
			
		}	


}