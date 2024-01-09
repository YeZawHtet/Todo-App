@extends('layouts.app')
@section('content')
    <div class="container-fluid bg-dark text-warning">
        <div class="row">
            <div class="col-3 shadow-sm p-3 rounded" style="border-right: 3px solid rgb(226, 242, 5);">
                @if (isset($editData))
                    <form action="{{ route('todo.update', $editData->id) }}" method="post">
                        @csrf
                        @method('put')
                        <label for="title" class="form-label text-warning mb-3 mt-3">Note Title <small
                                class="text-danger">*</small></label>
                        <input type="text" name="title" placeholder="Enter Title"
                            class="form-control @error('title') is-invalid
                    @enderror"
                            value="{{ $editData->title }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <label for="description" class="form-label text-warning mb-3 mt-3">Note Description <small
                                class="text-danger">*</small></label>
                        <textarea name="description" cols="20"
                            class="form-control @error('description') is-invalid
                    @enderror" rows="3"
                            placeholder="Enter Description">{{ $editData->description }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <label for="importantlv" class="form-label text-warning mb-3 mt-3">Important Level <small
                                class="text-danger">*</small></label>
                        <input type="number" name="importantlv" placeholder="Enter Emportant Level"
                            class="form-control @error('importantlv') is-invalid
                    @enderror"
                            value="{{ $editData->importantlv }}">
                        @error('importantlv')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <label for="category" class="form-label text-warning mb-3 mt-3">Note Category <small
                                class="text-danger">*</small></label>
                        <input list="browsers" placeholder="Enter Note Category"
                            class="form-control @error('category') is-invalid
                    @enderror""
                            name="category" value="{{ $editData->category }}" id="browser">
                        @error('category')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <datalist id="browsers">
                            <option value="Skill Up">
                            <option value="Leisure">
                            <option value="Work">
                            <option value="Life">
                            <option value="Knowledge">
                        </datalist>
                        <a href="{{ route('todo.index') }}" class="btn mt-3 btn-outline-primary">Back</a>
                        <button class="btn mt-3 btn-outline-success">Update</button>
                    </form>
                @endif
                @if (!isset($editData))
                    <form action="{{ route('todo.store') }}" method="post">
                        @csrf
                        <label for="title" class="form-label text-warning mb-3 mt-3">Note Title <small
                                class="text-danger">*</small></label>
                        <input type="text" name="title" placeholder="Enter Title"
                            class="form-control @error('title') is-invalid
                    @enderror"
                            value="{{ old('title') }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <label for="description" class="form-label text-warning mb-3 mt-3">Note Description <small
                                class="text-danger">*</small></label>
                        <textarea name="description" cols="20"
                            class="form-control @error('description') is-invalid
                    @enderror" rows="3"
                            placeholder="Enter Description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <label for="importantlv" class="form-label text-warning mb-3 mt-3">Important Level <small
                                class="text-danger">*</small></label>
                        <input type="number" name="importantlv" placeholder="Enter Important Level"
                            class="form-control @error('importantlv') is-invalid
                    @enderror"
                            value="{{ old('importantlv') }}">
                        @error('importantlv')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <label for="category" class="form-label text-warning mb-3 mt-3">Note Category <small
                                class="text-danger">*</small></label>
                        <input list="browsers" placeholder="Enter Note Category"
                            class="form-control @error('category') is-invalid
                        @enderror""
                            name="category" value="{{ old('category') }}" id="browser">
                        @error('category')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <datalist id="browsers">
                            <option value="Skill Up">
                            <option value="Leisure">
                            <option value="Work">
                            <option value="Life">
                            <option value="Knowledge">
                        </datalist>
                        <button class="btn mt-3 btn-outline-success">Submit</button>
                    </form>
                @endif

            </div>
            <div class="col-4 p-3 rounded" style="border-right: 3px solid rgb(226, 242, 5);">
                {{ $todos->links() }}
                @foreach ($todos as $todo)
                    <div class="card bg-dark text-warning mb-3" style="box-shadow: 3px 3px 5px rgb(228, 232, 7);">
                        <h3 class="card-title text-center">{{ $todo->title }}</h3>
                        <div class="button-group m-2 d-flex justify-content-center">
                            <a href="{{ route('todo.show', $todo->id) }}" class="btn btn-outline-primary"><i
                                    class="fa-solid fa-circle-info"></i> Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
            @if (isset($detailData))
                <div class="col-5 p-3">
                    <div class="card bg-dark text-warning">
                        <h1 class="card-title text-center">{{ $detailData->title }}</h1>
                        <hr>
                        <div class="card-body">
                            <span class="text-success h2 mb-5 d-block">
                                Note Category -> {{ $detailData->category }}
                            </span>
                            <div class="h3 mb-5">
                                Description -> {{ $detailData->description }}
                            </div>
                            <span class="text-danger h2 mb-5">Important Level -> {{ $detailData->importantlv }}</span>
                        </div>
                        <div class="button-group m-2 d-flex justify-content-between">
                            <a href="{{ route('todo.edit', $detailData->id) }}" class="btn btn-outline-warning"><i
                                    class="fa-regular fa-pen-to-square"></i> Edit</a>
                            <form action="{{ route('todo.destroy', $detailData->id) }}" method="post">
                                @method('delete')
                                @csrf
                                <button class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            @if (!isset($detailData))
                <div class="col-5 p-3 d-flex justify-content-center align-items-center">
                    <h1>Detail View</h1>
                </div>
            @endif
        </div>
    </div>
@stop
