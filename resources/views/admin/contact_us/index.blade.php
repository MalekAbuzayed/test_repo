@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="aboutUs">
            <div class="col-md-12 align-self-center">
                <h3 class="page-title">Contact Us</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- ========================================================== --}}
    {{-- ==================== Page Body Section =================== --}}
    {{-- ========================================================== --}}
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table id="file_export_main_info_part_1" class="table table-striped table-bordered display">
                                <thead>
                                    {{--  Email: --}}
                                    <tr>
                                        <th style="background-color:aliceblue">Email:
                                        </th>
                                        <td> <strong>
                                                {{ isset($contactUs->email) ? $contactUs->email : '----' }}
                                            </strong>
                                        </td>
                                    </tr>

                                    {{-- phone --}}
                                    <tr>
                                        <th style="background-color:aliceblue">Phone:</th>
                                        <td>
                                            <strong>{{ isset($contactUs->phone) ? $contactUs->phone : '----' }}
                                            </strong>
                                        </td>
                                    </tr>

                                    {{-- whatsapp --}}
                                    <tr>
                                        <th style="background-color:aliceblue">Whatsapp:</th>
                                        <td>
                                            <strong>{{ isset($contactUs->whatsapp) ? $contactUs->whatsapp : '----' }}
                                            </strong>
                                        </td>
                                    </tr>

                                    {{-- facebook_url --}}
                                    <tr>
                                        <th style="background-color:aliceblue">Facebook URL:</th>
                                        <td>
                                            <strong> {!! isset($contactUs->facebook) ? $contactUs->facebook : '-------' !!} </strong>
                                        </td>
                                    </tr>

                                    {{-- youtube_url --}}
                                    <tr>
                                        <th style="background-color:aliceblue">Youtube URL:</th>
                                        <td>
                                            <strong> {!! isset($contactUs->youtube) ? $contactUs->youtube : '-------' !!} </strong>
                                        </td>
                                    </tr>

                                    {{-- tiktok --}}
                                    <tr>
                                        <th style="background-color:aliceblue">Tiktok URL:</th>
                                        <td>
                                            <strong> {!! isset($contactUs->tiktok) ? $contactUs->tiktok : '-------' !!} </strong>
                                        </td>
                                    </tr>

                                    {{-- telegram --}}
                                    <tr>
                                        <th style="background-color:aliceblue">Telegram URL:</th>
                                        <td>
                                            <strong> {!! isset($contactUs->telegram) ? $contactUs->telegram : '-------' !!} </strong>
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table id="file_export_status_team" class="table table-striped table-bordered display">
                                <thead>
                                    {{-- address_ar --}}
                                    <tr>
                                        <th style="background-color:aliceblue">Address AR :</th>
                                        <td>
                                            <strong> {!! isset($contactUs->address_ar) ? $contactUs->address_ar : '-------' !!} </strong>
                                        </td>
                                    </tr>

                                    {{-- address_en --}}
                                    <tr>
                                        <th style="background-color:aliceblue">Address EN :</th>
                                        <td>
                                            <strong> {!! isset($contactUs->address_en) ? $contactUs->address_en : '-------' !!} </strong>
                                        </td>
                                    </tr>

                                    {{-- instagram_url --}}
                                    <tr>
                                        <th style="background-color:aliceblue">Instagram URL:</th>
                                        <td>
                                            <strong> {!! isset($contactUs->instagram) ? $contactUs->instagram : '-------' !!} </strong>
                                        </td>
                                    </tr>

                                    {{-- twitter --}}
                                    <tr>
                                        <th style="background-color:aliceblue">Twitter URL:</th>
                                        <td>
                                            <strong> {!! isset($contactUs->twitter) ? $contactUs->twitter : '-------' !!} </strong>
                                        </td>
                                    </tr>

                                    {{-- linkedin --}}
                                    <tr>
                                        <th style="background-color:aliceblue">Linkedin URL:</th>
                                        <td>
                                            <strong> {!! isset($contactUs->linkedin) ? $contactUs->linkedin : '-------' !!} </strong>
                                        </td>
                                    </tr>

                                    {{-- snapchat --}}
                                    <tr>
                                        <th style="background-color:aliceblue">Snapchat URL:</th>
                                        <td>
                                            <strong> {!! isset($contactUs->snapchat) ? $contactUs->snapchat : '-------' !!} </strong>
                                        </td>
                                    </tr>

                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Edit --}}
            <div class="border-bottom title-part-padding">
                <div class="row justify-content-end">
                    <div class="col-auto">
                        <a href="{{ route('super_admin.contact_us-edit', isset($contactUs->id) ? $contactUs->id : -1) }}"
                            class="btn btn-dark">
                            <i data-feather="plus" class="fill-white feather-sm"></i> Edit
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('extra_js')
@endsection
