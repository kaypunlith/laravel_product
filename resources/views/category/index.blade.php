@extends('admin.layout')
@section('content')
                <main class="p-3">
                    <h1>Category List</h1>
                    <a href="{{route('category.create')}}" class="mb-4 btn btn-primary float-end">Create New</a>
                    @if(Session::has('category_notExist'))
                        <p class="text-danger">{{session('category_notExist') }}</p>
                    @endif
                    @if(Session::has('category_delete'))
                        <p class="text-success">{{session('category_delete') }}</p>
                    @endif
                    @if(count($categories) > 0)
                        <table class="table" style="table-layout: fixed;">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->description}}</td>
                                        <td class="d-flex">
                                            <a href="{{url('/category/'.$item->id.'/edit')}}" class="btn btn-primary me-3">Update</a>
                                            <!-- <a href="" class="btn btn-danger">Delete</a> -->
                                            {{ Form::open(array('url'=>'category/'. $item->id, 'method'=>'DELETE')) }}
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <button class="btn btn-danger delete">Delete</button>
                                            {{Form::close()}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </main>
                <script>
                    $(".delete").click(function() {
                        var form = $(this).closest('form');
                        $('<div></div>').appendTo('body')
                            .html('<div><h6> Are you sure ?</h6></div>')
                            .dialog({
                                modal: true,
                                title: 'Delete message',
                                zIndex: 10000,
                                autoOpen: true,
                                width: 'auto',
                                resizable: false,
                                buttons: {
                                    Yes: function() {
                                        $(this).dialog('close');
                                        form.submit();
                                    },
                                    No: function() {

                                        $(this).dialog("close");
                                        return false;
                                    }
                                },
                                close: function(event, ui) {
                                    $(this).remove();
                                }
                            });
                        return false;
                    });
                </script>

@endsection
