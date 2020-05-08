@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    
    <script type="text/javascript">
    
        jQuery(document).ready(function(){

            $.ajax({

                url: " {{ route('permissions') }} ",
                dataType: 'json',
                type: 'POST',
                data: {

                    _token: '{{csrf_token()}}',

                },
                success: function(data){
                    
                    console.log(data);

                },

                complete: function(data){

                    console.log(data);

                }

            });

        });

    </script>

@endsection
