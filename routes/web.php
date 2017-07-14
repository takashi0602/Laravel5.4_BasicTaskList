<?php

/** Show Task Dashboard **/
Route::get('/', function() {
	$tasks = \App\Task::orderBy('created_at', 'asc')->get();

	return view('task', [
		'tasks' => $tasks
	]);
});

Route::post('/task', function(\Illuminate\Http\Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:10',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

	$task = new \App\Task;
	$task->name = $request->name;
	$task->save();

	return redirect('/');
});

Route::delete('/task/{task}', function(\App\Task $task) {
	$task->delete();

	return redirect('/');
});
