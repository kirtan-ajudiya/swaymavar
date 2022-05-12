@extends('layouts.app')

@section('content')

<!-- <div class="row">
    <div class="col-sm-12">
        <a href="{{ route('brands.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Brand')}}</a>
    </div>
</div>

<br> -->

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Contact Inquiry')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_brands" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder=" Type name & Enter">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('First Name')}}</th>
                    <th>{{__('Last Name')}}</th>
                    <th>{{__('Phone')}}</th>
                    <th>{{__('Email')}}</th>
                    <th>{{__('Message')}}</th>
                    <th>{{__('Status')}}</th>
                    <th width="10%">{{__('Action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $key => $contact)
                    <tr>
                        <td>{{ ($key+1) + ($contacts->currentPage() - 1)*$contacts->perPage() }}</td>
                        <td>{{$contact->first_name}}</td>
                        <td>{{$contact->last_name}}</td>
                        <td>{{$contact->phone}}</td>
                        <td>{{$contact->email}}</td>
                        <td>{{$contact->message}}</td>
                        <td><label class="switch">
                                <input onchange="update_published(this)" value="{{ $contact->id }}" type="checkbox" <?php if($contact->status == 1) echo "checked";?> >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <a class="btn btn-danger onclick="confirm_modal('{{route('contacts.destroy', $contact->id)}}');">{{__('Delete')}}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $contacts->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script type="text/javascript">
        function sort_brands(el){
            $('#sort_brands').submit();
        }
        function update_published(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('contacts.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Question status updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
