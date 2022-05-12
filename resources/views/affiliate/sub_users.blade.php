@extends('layouts.app')

@section('content')
    <!-- Basic Data Tables -->
    <!--===================================================-->
    <div class="panel">
        <div class="panel-heading bord-btm clearfix pad-all h-100">
            <h3 class="panel-title pull-left pad-no">{{$affiliate_default_user}} {{__('Under Affiliate Users')}}</h3> 
        </div>
        <?php 
        $pendingAmt=0;
        function get_amount($commision_list,$user_id){
            $pendingAmt=0;
            foreach ($commision_list as $key => $value) {
                  if($value->to_user_id == $user_id){
                     $orederdate = date('m/d/Y',strtotime('+30 days',strtotime($value->created_at))) . PHP_EOL;
                     
                        if($orederdate > date('m/d/Y'))
                        {
                           $pendingAmt+=$value->amount;
                        }
                      }
                  }

            return $pendingAmt;
        }
        ?>
        <div class="panel-body">
            <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Phone')}}</th>
                    <th>{{__('Email Address')}}</th>
                    <th>{{__('Verification Info')}}</th>
                    <th>{{__('Approval')}}</th>
                    <th>{{ __('Due Amount') }}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($affiliate_users as $key => $affiliate_user)
                    @if($affiliate_user->user != null)
                     <?php
                            $pendmount=get_amount($commision_list,$affiliate_user->user_id);
                          ?>
                        <tr>
                            <td>{{ ($key+1) + ($affiliate_users->currentPage() - 1)*$affiliate_users->perPage() }}</td>
                            <td>{{$affiliate_user->user->name}}</td>
                            <td>{{$affiliate_user->user->phone}}</td>
                            <td>{{$affiliate_user->user->email}}</td>
                            <td>
                                @if ($affiliate_user->informations != null)
                                    <a href="{{ route('affiliate_users.show_verification_request', $affiliate_user->id) }}">
                                        <div class="label label-table label-info">
                                            {{__('Show')}}
                                        </div>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <label class="switch">
                                    <input onchange="update_approved(this)" value="{{ $affiliate_user->id }}" type="checkbox" <?php if($affiliate_user->status == 1) echo "checked";?> >
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                @if (($affiliate_user->balance - $pendmount) >= 0)
                                    {{ single_price($affiliate_user->balance - $pendmount) }}
                                @endif
                            </td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{__('Actions')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a onclick="show_payment_modal('{{$affiliate_user->id}}');">{{__('Pay Now')}}</a></li>
                                        <li><a href="{{route('affiliate_user.payment_history', encrypt($affiliate_user->id))}}">{{__('Payment History')}}</a></li>
                                        {{-- <li><a onclick="confirm_modal('{{route('sellers.destroy', $affiliate_user->id)}}');">{{__('Delete')}}</a></li> --}}
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                <div class="pull-right">
                    {{ $affiliate_users->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>

    <div class="modal fade" id="profile_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>


@endsection

@section('script')
    <script type="text/javascript">
        function show_payment_modal(id){
            $.post('{{ route('affiliate_user.payment_modal') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
                $('#payment_modal #modal-content').html(data);
                $('#payment_modal').modal('show', {backdrop: 'static'});
                $('.demo-select2-placeholder').select2();
            });
        }

        function update_approved(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('affiliate_user.approved') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Approved sellers updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        // function sort_sellers(el){
        //     $('#sort_sellers').submit();
        // }
    </script>
@endsection
