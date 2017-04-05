@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management'))

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@endsection

@section('page-header')
    <h1>
         POSTS
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.access.users.active') }}</h3>

            <div class="box-tools pull-right">

            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->
        <!-- Posts Table for Admin dashboard -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="users-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>PostID</th>
                            <th>Post Body</th>
                            <th>Created At</th>
                            <th>Status</th>
                        </tr>
                             @foreach($posts as $post)
                        <tr>
                             <td>{{ $post->id }}</td>
                             <td>{{ $post->text }}</td>
                             <td>{{ $post->created_at }}</td>
                             @if($post->status == 0)
                             <td>Pendding
                                <form action="{{ route('update') }}">
                                 <input type="submit" name="action" value="Confirm" class="btn btn-primary btn-xs"/>
                                 <input type="hidden" name="id" value="<?php echo $post['id']; ?>"/>
                                </form>
                             </td>
                             @else
                             <td>Approved</td>
                             @endif
                        
                        </tr>
                             @endforeach
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {!! history()->renderType('User') !!}
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection

@section('after-scripts')
    {{ Html::script("js/backend/plugin/datatables/jquery.dataTables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables.bootstrap.min.js") }}

    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.access.user.get") }}',
                    type: 'post',
                    data: {status: 1, trashed: false}
                },
                columns: [
                    {data: 'id', name: '{{config('access.users_table')}}.id'},
                    {data: 'name', name: '{{config('access.users_table')}}.name'},
                    {data: 'email', name: '{{config('access.users_table')}}.email'},
                    {data: 'confirmed', name: '{{config('access.users_table')}}.confirmed'},
                    {data: 'roles', name: '{{config('access.roles_table')}}.name', sortable: false},
                    {data: 'created_at', name: '{{config('access.users_table')}}.created_at'},
                    {data: 'updated_at', name: '{{config('access.users_table')}}.updated_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@endsection
