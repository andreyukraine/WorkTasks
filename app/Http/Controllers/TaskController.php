<?php

namespace App\Http\Controllers;

use App\Category;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {

        $user  = Auth::user()->name;
        $searchByStatus = $request->get('status');
        $searchBy = $request->get('search');
        $searchUser = $request->get('user');
        $tasks_mass = Task::with('tasks');
        $users = User::all();

        $categories = Category::where('parent_id', '=', 0)->get();


        //$allCategories = Category::pluck('name','id')->all();

        if (!empty($searchUser)) {
            $user = $searchUser;
        }
        if (!empty($searchByStatus)) {
                $tasks_mass = $tasks_mass->where('user_task', $user)->whereStatus($searchByStatus);
        }
        if (!empty($searchBy)) {
                $tasks_mass = $tasks_mass->where('user_task', $user)->where('title', 'like', '%' . $searchBy . '%');
        }
        if (!empty($request->id)){
           // $tasks_mass = $tasks_mass->where('user_task', $user)->where('category_id', $request->id);
        }

        $output ="";
        if($request->ajax()){
            if ($request->id) {
                $tasks_mass = Category::find($request->id)->tasks()->paginate(10);
                if (count($tasks_mass->all()) > 0) {
                    foreach ($tasks_mass as $task) {
                        $output .= '<tr>' .
                            '<td>' . $task->id . '</td>' .
                            '<td>' . $task->title . '</td>' .
                            '<td>' . $task->task_manager . '</td>' .
                            '<td>' . $task->descriptions . '</td>' .
                            '<td>' . $task->status . '</td>' .
                            '<td>' . $task->user_task . '</td>' .
                            '<td>' . $task->created_at->format('d-m-Y H:i') . '</td>' .
                            '<td>' .
                            '<a href="' . route('tasks.show', $task->id) . '"><span class="glyphicon glyphicon-eye-open"></span></a>' .
                            '<a href="' . route('tasks.edit', $task->id) . '"><span class="glyphicon glyphicon-pencil"></span></a>' .
                            '<a href="' . route('delete.task', $task->id) . '"><span class="glyphicon glyphicon-remove"></span></a>' .
                            '</td>' .
                            '</tr>';
                    }
                    return Response($output);
                }
            }
            $output .= '<tr><td>Not tasks</td></tr>';
            return Response($output);

        }

        //$tasks_mass = $tasks_mass->where('user_task', $user);

        return view('task.index', [
            'tasks' => $tasks_mass->paginate(10),
            'search' => $searchBy,
            'status' => $searchByStatus,
            'users'=> $users,
            'categories'=> $categories,
            //'ajax' => Response::json($out)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('task.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $task = new Task();

        $task->title = $request->title;
        $task->user_task = Auth::user()->name;
        $task->status = 'open';
        $task->task_manager = $request->task_manager;
        $task->descriptions = $request->task_description;
        $task->slug = $request->title;
        $task->save();

        foreach ($request->cat_id as $cat_item){
            $cat = Category::find($cat_item);
            $task->categories()->attach($cat);
        }



        Session::flash('message', 'Successfully create!');
        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        return view('task.view', ['task'=> $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $task = Task::find($id);
        $select_category = $categories->where('id', $task->category_id)->first();

        return view('task.edit', ['task'=> $task, 'categories'=> $categories, 'select_category' => $select_category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        $task->title = $request->title;
        $task->task_manager = $request->task_manager;
        $task->status = $request->status;
        $task->category_id = $request->cat_id;
        $task->descriptions = $request->task_description;

        $cat = Category::find($request->cat_id);

        $task->categories()->associate($cat)->save();

        Session::flash('message', 'Successfully update!');
        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->role == 1) {
            $task = Task::find($id);
            $task->delete();
            Session::flash('message', 'Successfully delete!');
            return redirect('/tasks');
        }

        return redirect('/tasks');
    }


}
