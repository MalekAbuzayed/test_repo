@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12 align-self-center">
                <h3 class="page-title">Contact Us </h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a
                                    href="{{ route('super_admin.contact_us-index') }}">Contact US</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Contact Us Info</li>
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
        <div class="row">
            <div class="col-12">
                {{-- Form Section --}}
                <div class="card">
                    <div class="card-body">
                        <form
                            action="{{ route('super_admin.contact_us-update', isset($contactUs->id) ? $contactUs->id : -1) }}"
                            method="POST" enctype="multipart/form-data" id="contactUsForm">
                            @csrf
                            <div class="form">
                                <div class="row">
                                    {{--  email --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                            Email:
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text mdi mdi-format-title"
                                                    id="inputGroupPrepend2"></span>
                                            </div>
                                            <input type="text" name="email" data-validation="required" required
                                                value="{{ old('email', isset($contactUs->email) ? $contactUs->email : null) }}"
                                                class="form-control @error('email') is-invalid @enderror"
                                                id="validationServer01" placeholder="Email">
                                        </div>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- phone --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                            Phone:
                                            <strong class="text-danger">
                                                *
                                                @error('phone')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text mdi mdi-format-title"
                                                    id="inputGroupPrepend2"></span>
                                            </div>
                                            <input type="text" name="phone" data-validation="required" required
                                                value="{{ old('phone', isset($contactUs->phone) ? $contactUs->phone : null) }}"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                id="validationServer01" placeholder="Phone">
                                        </div>
                                    </div>

                                    {{-- whatsapp --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                            whatsapp:
                                            <strong class="text-danger">

                                                @error('whatsapp')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text mdi mdi-format-title"
                                                    id="inputGroupPrepend2"></span>
                                            </div>
                                            <input type="text" name="whatsapp" data-validation="required" required
                                                value="{{ old('whatsapp', isset($contactUs->whatsapp) ? $contactUs->whatsapp : null) }}"
                                                class="form-control @error('whatsapp') is-invalid @enderror"
                                                id="validationServer01" placeholder="whatsapp">
                                        </div>
                                    </div>

                                    {{-- facebook --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                            Facebook URL :
                                            <strong class="text-danger">  @error('facebook')
                                                    - {{ $message }}
                                                @enderror </strong>
                                        </label>

                                        <div class="input-group">
                                            <textarea style="width: 90% !important" maxlength="1600" class="form-control"required name="facebook"
                                                placeholder="Facebook URL " rows="1">{{ old('facebook', isset($contactUs->facebook) ? $contactUs->facebook : null) }}</textarea>

                                        </div>
                                    </div>

                                    {{-- instagram --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                            Instagram URL :
                                            <strong class="text-danger">  @error('instagram')
                                                    - {{ $message }}
                                                @enderror </strong>
                                        </label>

                                        <div class="input-group">
                                            <textarea style="width: 90% !important" maxlength="1600" class="form-control"required name="instagram"
                                                placeholder="Instagram URL" rows="1">{{ old('instagram', isset($contactUs->instagram) ? $contactUs->instagram : null) }}</textarea>

                                        </div>
                                    </div>

                                    {{-- youtube --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                            Youtube URL :
                                            <strong class="text-danger">  @error('youtube')
                                                    - {{ $message }}
                                                @enderror </strong>
                                        </label>

                                        <div class="input-group">
                                            <textarea style="width: 90% !important" maxlength="1600" class="form-control"required name="youtube"
                                                placeholder="Twitter URL" rows="1">{{ old('youtube', isset($contactUs->youtube) ? $contactUs->youtube : null) }}</textarea>

                                        </div>
                                    </div>

                                    {{-- linkedin --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                            linkedin URL :
                                            <strong class="text-danger">  @error('linkedin')
                                                    - {{ $message }}
                                                @enderror </strong>
                                        </label>

                                        <div class="input-group">
                                            <textarea style="width: 90% !important" maxlength="1600" class="form-control"required name="linkedin"
                                                placeholder="linkedin URL" rows="1">{{ old('linkedin', isset($contactUs->linkedin) ? $contactUs->linkedin : null) }}</textarea>
                                        </div>
                                    </div>

                                    {{-- snapchat --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                            snapchat URL :
                                            <strong class="text-danger">  @error('snapchat')
                                                    - {{ $message }}
                                                @enderror </strong>
                                        </label>

                                        <div class="input-group">
                                            <textarea style="width: 90% !important" maxlength="1600" class="form-control"required name="snapchat"
                                                placeholder="snapchat URL" rows="1">{{ old('snapchat', isset($contactUs->snapchat) ? $contactUs->snapchat : null) }}</textarea>

                                        </div>
                                    </div>

                                    {{-- twitter --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                            twitter URL :
                                            <strong class="text-danger">  @error('twitter')
                                                    - {{ $message }}
                                                @enderror </strong>
                                        </label>

                                        <div class="input-group">
                                            <textarea style="width: 90% !important" maxlength="1600" class="form-control"required name="twitter"
                                                placeholder="Twitter URL" rows="1">{{ old('twitter', isset($contactUs->twitter) ? $contactUs->twitter : null) }}</textarea>
                                        </div>
                                    </div>

                                    {{-- snapchat --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                            snapchat URL :
                                            <strong class="text-danger">  @error('snapchat')
                                                    - {{ $message }}
                                                @enderror </strong>
                                        </label>

                                        <div class="input-group">
                                            <textarea style="width: 90% !important" maxlength="1600" class="form-control"required name="snapchat"
                                                placeholder="snapchat URL" rows="1">{{ old('snapchat', isset($contactUs->snapchat) ? $contactUs->snapchat : null) }}</textarea>
                                        </div>
                                    </div>

                                    {{-- tiktok --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                            tiktok URL :
                                            <strong class="text-danger"> @error('tiktok')
                                                    - {{ $message }}
                                                @enderror </strong>
                                        </label>

                                        <div class="input-group">
                                            <textarea style="width: 90% !important" maxlength="1600" class="form-control"required name="tiktok"
                                                placeholder="tiktok URL" rows="1">{{ old('tiktok', isset($contactUs->tiktok) ? $contactUs->tiktok : null) }}</textarea>

                                        </div>
                                    </div>

                                    {{-- telegram --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                            telegram URL :
                                            <strong class="text-danger"> @error('telegram')
                                                    - {{ $message }}
                                                @enderror </strong>
                                        </label>

                                        <div class="input-group">
                                            <textarea style="width: 90% !important" maxlength="1600" class="form-control"required name="telegram"
                                                placeholder="telegram URL" rows="1">{{ old('telegram', isset($contactUs->telegram) ? $contactUs->telegram : null) }}</textarea>

                                        </div>
                                    </div>

                                    {{-- address_ar --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                            Address In Arabic : <strong class="text-danger">
                                                @error('address_ar')
                                                    - {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <div class="input-group">
                                            <textarea style="width: 90% !important" maxlength="1600" class="form-control ar" required name="address_ar"
                                                placeholder="Address In Arabic" rows="8">{{ old('address_ar', isset($contactUs->address_ar) ? $contactUs->address_ar : null) }}</textarea>
                                        </div>
                                    </div>

                                    {{-- address_en --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                            Address In English :
                                            <strong class="text-danger"> @error('address_en')
                                                    - {{ $message }}
                                                @enderror </strong>
                                        </label>

                                        <div class="input-group">
                                            <textarea style="width: 90% !important" maxlength="1600" class="form-control"required name="address_en"
                                                placeholder="Address In English" rows="8">{{ old('address_en', isset($contactUs->address_en) ? $contactUs->address_en : null) }}</textarea>

                                        </div>
                                    </div>


                                </div>

                                {{-- Button --}}
                                <div class="col-md-12">
                                    <button class="btn btn-primary" type="submit">Save Updates</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
@endsection
