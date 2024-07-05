@extends('admin.layout')
@section('content')
<main class="p-3">
    <h1>Product List</h1>
    <div class="float-end mb-4">
        <a href="{{url('/product/create')}}" class="btn btn-primary">Create New</a>
    </div>
    @if(count($products) > 0)
        <table class="table" style="table-layout: fixed;">
            <thead class="table-dark">
                <tr>
                    <th width="60px">ID</th>
                    <th>Name</th>
                    <th width="300px">Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>CategoryName</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $item)
                    <tr class="align-middle">
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->price}} $</td>
                        <td>
                            <div>{{ Html::image('img/'.$item->image, $item->name, array('width'=>'80')) }}</div>
                        </td>
                        <td>{{$item->catId}}</td>
                        <td>
                            <a href="{{url('/product/'.$item->id.'/edit')}}" class="btn btn-primary">Update</a>
                            {{ Form::open(array('url'=>'product/'. $item->id, 'method'=>'DELETE')) }}
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button class="btn btn-danger mt-2 delete">Delete</button>
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