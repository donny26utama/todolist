<?php

namespace App\Http\Controllers;

use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;

class ToDoListController extends Controller
{
	public function index(){
		$model = Task::all();
		return view('welcome', ['tasks' => $model]);
	}

	public function store(Request $request){
		$task = $request->task;
		$model = new Task;
		$model->task_name = $task;

		if($model->save()){
			$data['status'] = true;
			$data['content'] = '<li class="list-group-item"><label><input type="checkbox" name="task" value="'.$model->id.'"> '.$model->task_name.'</label> <a class="btn-delete" id="'.$model->id.'"><i class="glyphicon glyphicon-remove-sign"></i></a></li>';
		} else {
			$data['status'] = false;
		}

		return response()->json($data);
	}

	public function destroy(Request $request){
		$id = $request->task_id;
		$model = Task::find($id);

		if($model->delete()){
			$data['status'] = true;
		} else {
			$data['status'] = false;
		}

		return response()->json($data);
	}

	public function destroySelected(Request $request){
		$list = $request->task_id;
		$model = Task::whereIn('id', $list);

		if($model->delete()){
			$data['status'] = true;
		} else {
			$data['status'] = false;
		}

		return response()->json($data);
	}
}