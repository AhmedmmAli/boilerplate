<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>InfyOm Generator</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.3/css/skins/_all-skins.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    @yield('css')
</head>
<body>
<section class="content-header">
     <form action="{{route('posts.store')}}" method="post">
     {{ csrf_field() }}
        <input type="text" name="text" class="form-control" placeholder="Enter Post">
        <br>
        <input type="submit" value="Save" class="btn btn-primary pull-right">
     </form>
</section>

<div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                   <table class="table table-responsive" id="posts-table">
    <thead>
        <th>Text</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
         @foreach($posts as $posts)
             <tr>
                 <td>{!! $posts->text !!}</td>
                 <td>
                     {!! Form::open(['route' => ['posts.destroy', $posts->id], 'method' => 'delete']) !!}
                     <div class='btn-group'>
                         <a href="{!! route('posts.show', [$posts->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                         <a href="{!! route('posts.edit', [$posts->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                         {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                     </div>
                     {!! Form::close() !!}
                 </td>
             </tr>
         @endforeach
    </tbody>
</table>
</div>
</div>
</div>
</body>
</html>

