<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\UpdateTodoRequest;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    public function index()
    {
        $todos = Todo::latest()->paginate(4);
        return view("blablas.home", compact("todos"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("blablas.home");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTodoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodoRequest $request)
    {
        $todo = new Todo();
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->importantlv = $request->importantlv;
        $todo->category = $request->category;
        $todo->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        $detailData = $todo;
        $todos = Todo::latest()->paginate(4);
        return view('blablas.home', compact('todos', 'detailData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        $editData = $todo;
        $todos = Todo::latest()->paginate(4);
        return view('blablas.home', compact('todos', 'editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTodoRequest  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->importantlv = $request->importantlv;
        $todo->category = $request->category;
        $todo->update();
        return redirect()->route('todo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todos = Todo::latest()->paginate(4);
        $todo->delete();
        return redirect()->route('todo.index',compact('todos'));
    }
}
