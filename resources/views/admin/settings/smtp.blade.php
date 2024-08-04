@extends('admin.layouts.master')


@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a>Add category</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">category</li>
                            <li class="breadcrumb-item active">Add category</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                
                <div class="col-md-12">
                 @include('admin.layouts.notification')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">




                    <div class="card">
                        <div class="header">

                        </div>
                        <div class="body">

                            <form action="{{ route('smtp.update') }}" method="post">
                                @csrf


                                <div class=" clearfix">

                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <input type="hidden" name="types[]" value="MAIL_MAILER">
                                                <div class="col-3">
                                                    <label for="">TYPE</label>
                                                </div>
                                                <div class="col-9">
                                                    <select name="MAIL_MAILER" id="" class="form-control"
                                                        onchange="checkMailDriver();">
                                                        <option value="sendmail"
                                                            @if (env('MAIL_DRIVER') == 'sendmail') selected @endif>SendMail
                                                        </option>
                                                        <option value="smtp"
                                                            @if (env('MAIL_DRIVER') == 'smtp') selected @endif>Smtp</option>
                                                        <option value="mailgun"
                                                            @if (env('MAIL_DRIVER') == 'mailgun') selected @endif>Mailgun
                                                        </option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="smtp">



                                        <div class="col-12">
                                            <div class="form-group row">
                                                <input type="hidden" name="types[]" value="MAIL_HOST">
                                                <div class="col-3">
                                                    <label for=""> Mail Host </label>
                                                </div>

                                                <div class="col-9">
                                                    <input type="text" class="form-control" name="MAIL_HOST"
                                                        value="{{ env('MAIL_HOST') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group row">
                                                <input type="hidden" name="types[]" value="MAIL_PORT">
                                                <div class="col-3">
                                                    <label for=""> Mail Port </label>
                                                </div>

                                                <div class="col-9">
                                                    <input type="text" class="form-control" name="MAIL_PORT"
                                                        value="{{ env('MAIL_PORT') }}">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-group row">
                                                <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                                                <div class="col-3">
                                                    <label for=""> Mail ENCRYPTION </label>
                                                </div>

                                                <div class="col-9">
                                                    <input type="text" class="form-control" name="MAIL_ENCRYPTION"
                                                        value="{{ env('MAIL_ENCRYPTION') }}">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-group row">
                                                <input type="hidden" name="types[]" value="MAIL_USERNAME">
                                                <div class="col-3">
                                                    <label for=""> Mail USERNAME </label>
                                                </div>

                                                <div class="col-9">
                                                    <input type="text" class="form-control" name="MAIL_USERNAME"
                                                        value="{{ env('MAIL_USERNAME') }}">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-group row">
                                                <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                                                <div class="col-3">
                                                    <label for=""> Mail PASSWORD </label>
                                                </div>

                                                <div class="col-9">
                                                    <input type="text" class="form-control" name="MAIL_PASSWORD"
                                                        value="{{ env('MAIL_PASSWORD') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group row">
                                                <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                                                <div class="col-3">
                                                    <label for=""> MAIL FROM ADDRESS </label>
                                                </div>

                                                <div class="col-9">
                                                    <input type="text" class="form-control" name="MAIL_FROM_ADDRESS"
                                                        value="{{ env('MAIL_FROM_ADDRESS') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="mailgun">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <input type="hidden" name="types[]" value="MAIL_MAILGUN_DOMAIN">
                                                <div class="col-3">
                                                    <label for=""> MAilgun DOMAIN </label>
                                                </div>

                                                <div class="col-9">
                                                    <input type="text" class="form-control" name="MAIL_MAILGUN_DOMAIN"
                                                        value="{{ env('MAIL_MAILGUN_DOMAIN') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group row">
                                                <input type="hidden" name="types[]" value="MAIL_MAILGUN_SECRET">
                                                <div class="col-3">
                                                    <label for=""> MAilgun SECRET </label>
                                                </div>

                                                <div class="col-9">
                                                    <input type="text" class="form-control" name="MAIL_MAILGUN_SECRET"
                                                        value="{{ env('MAIL_MAILGUN_SECRET') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                                    </div>


                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
@section('scripts')
    <script>
        /// this function original not affect on under function you can make it commit
        $(document).ready(function() {
            checkMailDriver();
        });

        function checkMailDriver() {


            if ($('select[name=MAIL_MAILER]').val() == 'mailgun') {
                $('#mailgun').show();
                $('#smtp').hide();
            } else {
                $('#mailgun').hide();
                $('#smtp').show();
            }
        }
    </script>
@endsection
