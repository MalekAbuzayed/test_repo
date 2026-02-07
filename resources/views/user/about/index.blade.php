@extends('user.layouts.app')

@section('content')
    <!-- Who We Are Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    @if(isset($aboutUs->icon) && $aboutUs->icon)
                        <div class="icon-box">
                            <i class="bi bi-{{ $aboutUs->icon }}"></i>
                        </div>
                    @else
                        <div class="icon-box">
                            <i class="bi bi-rocket-takeoff"></i>
                        </div>
                    @endif

                    <h2 class="section-title display-5">
                        {{ app()->getLocale() == 'ar' ? 'من نحن' : 'Who We Are' }}
                    </h2>

                    @if(isset($aboutUs->subtitle_ar) || isset($aboutUs->subtitle_en))
                        <p class="section-subtitle fs-5">
                            {{ app()->getLocale() == 'ar' ? $aboutUs->subtitle_ar : $aboutUs->subtitle_en }}
                        </p>
                    @endif
                </div>

                <div class="col-lg-6">
                    @if(isset($aboutUs->bold_description_ar) || isset($aboutUs->bold_description_en))
                        <p class="lead mb-3 font-weight-bold">
                            {{ app()->getLocale() == 'ar' ? $aboutUs->bold_description_ar : $aboutUs->bold_description_en }}
                        </p>
                    @endif

                    @if(isset($aboutUs->description_ar) || isset($aboutUs->description_en))
                        <p class="mb-0">
                            {{ app()->getLocale() == 'ar' ? $aboutUs->description_ar : $aboutUs->description_en }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Our Vision Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="vision-box shadow-lg">
                        <div class="text-center position-relative">
                            @if(isset($ourVision->icon) && $ourVision->icon)
                                <i class="bi bi-{{ $ourVision->icon }} display-1 mb-3 opacity-75"></i>
                            @else
                                <i class="bi bi-lightbulb display-1 mb-3 opacity-75"></i>
                            @endif

                            <h2 class="display-5 fw-bold mb-4">
                                {{ app()->getLocale() == 'ar' ? ($ourVision->title_ar ?? 'رؤيتنا') : ($ourVision->title_en ?? 'Our Vision') }}
                            </h2>

                            @if(isset($ourVision->bold_description_ar) || isset($ourVision->bold_description_en))
                                <p class="lead mb-4 fs-4">
                                    {{ app()->getLocale() == 'ar' ? $ourVision->bold_description_ar : $ourVision->bold_description_en }}
                                </p>
                            @endif

                            @if(isset($ourVision->normal_description_ar) || isset($ourVision->normal_description_en))
                                <p class="fs-5 mb-0 opacity-90">
                                    {{ app()->getLocale() == 'ar' ? $ourVision->normal_description_ar : $ourVision->normal_description_en }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Goals Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title display-5">
                    {{ app()->getLocale() == 'ar' ? 'أهدافنا' : 'Our Goals' }}
                </h2>
                <p class="section-subtitle fs-5">
                    {{ app()->getLocale() == 'ar' ? 'ما نسعى لتحقيقه' : 'What We Strive to Achieve' }}
                </p>
            </div>

            @if(isset($ourGoals) && $ourGoals->count() > 0)
                <div class="row g-4">
                    @foreach($ourGoals as $goal)
                        <div class="col-md-6 col-lg-3">
                            <div class="card goal-card border-0 shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    @if($goal->icon)
                                        <div class="icon-box mb-3">
                                            <i class="bi bi-{{ $goal->icon }}"></i>
                                        </div>
                                    @endif

                                    <h5 class="card-title text-primary-custom fw-bold mb-3">
                                        {{ app()->getLocale() == 'ar' ? $goal->title_ar : $goal->title_en }}
                                    </h5>

                                    <p class="card-text">
                                        {{ app()->getLocale() == 'ar' ? $goal->description_ar : $goal->description_en }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Default content if no goals -->
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="card goal-card border-0 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <div class="icon-box mb-3">
                                    <i class="bi bi-trophy"></i>
                                </div>
                                <h5 class="card-title text-primary-custom fw-bold mb-3">
                                    {{ app()->getLocale() == 'ar' ? 'التميز' : 'Excellence' }}
                                </h5>
                                <p class="card-text">
                                    {{ app()->getLocale() == 'ar' ? 'تقديم أعلى الحلول جودة' : 'Deliver the highest quality solutions' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="card goal-card border-0 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <div class="icon-box mb-3">
                                    <i class="bi bi-people"></i>
                                </div>
                                <h5 class="card-title text-primary-custom fw-bold mb-3">
                                    {{ app()->getLocale() == 'ar' ? 'التعاون' : 'Collaboration' }}
                                </h5>
                                <p class="card-text">
                                    {{ app()->getLocale() == 'ar' ? 'بناء شراكات قوية' : 'Foster strong partnerships' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="card goal-card border-0 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <div class="icon-box mb-3">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                                <h5 class="card-title text-primary-custom fw-bold mb-3">
                                    {{ app()->getLocale() == 'ar' ? 'النمو' : 'Growth' }}
                                </h5>
                                <p class="card-text">
                                    {{ app()->getLocale() == 'ar' ? 'دفع الابتكار المستمر' : 'Drive continuous innovation' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="card goal-card border-0 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <div class="icon-box mb-3">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <h5 class="card-title text-primary-custom fw-bold mb-3">
                                    {{ app()->getLocale() == 'ar' ? 'النزاهة' : 'Integrity' }}
                                </h5>
                                <p class="card-text">
                                    {{ app()->getLocale() == 'ar' ? 'الحفاظ على الشفافية والأمانة' : 'Maintain transparency and honesty' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Meet Our Team Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title display-5">
                    {{ app()->getLocale() == 'ar' ? 'تعرف على فريقنا' : 'Meet Our Team' }}
                </h2>
                <p class="section-subtitle fs-5">
                    {{ app()->getLocale() == 'ar' ? 'العقول اللامعة وراء نجاحنا' : 'The Brilliant Minds Behind Our Success' }}
                </h2>
            </div>

            @if(isset($teamMembers) && $teamMembers->count() > 0)
                <div class="row g-4">
                    @foreach($teamMembers as $member)
                        <div class="col-sm-6 col-lg-3">
                            <div class="card team-card border-0 shadow h-100">
                                <div class="card-body text-center p-4">
                                    @if($member->image)
                                        <img src="{{ asset('storage/' . $member->image) }}"
                                                alt="{{ app()->getLocale() == 'ar' ? $member->name_ar : $member->name_en }}"
                                                class="team-img">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name_en) }}&size=150&background=c52c26&color=fff&bold=true"
                                                alt="{{ app()->getLocale() == 'ar' ? $member->name_ar : $member->name_en }}"
                                                class="team-img">
                                    @endif

                                    <h5 class="card-title fw-bold text-primary-custom mb-1">
                                        {{ app()->getLocale() == 'ar' ? $member->name_ar : $member->name_en }}
                                    </h5>

                                    <p class="text-muted mb-3 fw-semibold">
                                        {{ app()->getLocale() == 'ar' ? $member->position_ar : $member->position_en }}
                                    </p>

                                    <p class="card-text small">
                                        {{ app()->getLocale() == 'ar' ? $member->description_ar : $member->description_en }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Default team members -->
                <div class="row g-4">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card team-card border-0 shadow h-100">
                            <div class="card-body text-center p-4">
                                <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&size=150&background=c52c26&color=fff&bold=true"
                                     alt="Sarah Johnson" class="team-img">
                                <h5 class="card-title fw-bold text-primary-custom mb-1">Sarah Johnson</h5>
                                <p class="text-muted mb-3 fw-semibold">CEO & Founder</p>
                                <p class="card-text small">Visionary leader with 15+ years in tech innovation</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card team-card border-0 shadow h-100">
                            <div class="card-body text-center p-4">
                                <img src="https://ui-avatars.com/api/?name=Michael+Chen&size=150&background=c52c26&color=fff&bold=true"
                                        alt="Michael Chen" class="team-img">
                                <h5 class="card-title fw-bold text-primary-custom mb-1">Michael Chen</h5>
                                <p class="text-muted mb-3 fw-semibold">CTO</p>
                                <p class="card-text small">Technology expert leading our engineering team</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card team-card border-0 shadow h-100">
                            <div class="card-body text-center p-4">
                                <img src="https://ui-avatars.com/api/?name=Emily+Rodriguez&size=150&background=c52c26&color=fff&bold=true"
                                        alt="Emily Rodriguez" class="team-img">
                                <h5 class="card-title fw-bold text-primary-custom mb-1">Emily Rodriguez</h5>
                                <p class="text-muted mb-3 fw-semibold">Head of Design</p>
                                <p class="card-text small">Creative genius crafting beautiful user experiences</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card team-card border-0 shadow h-100">
                            <div class="card-body text-center p-4">
                                <img src="https://ui-avatars.com/api/?name=David+Kumar&size=150&background=c52c26&color=fff&bold=true"
                                        alt="David Kumar" class="team-img">
                                <h5 class="card-title fw-bold text-primary-custom mb-1">David Kumar</h5>
                                <p class="text-muted mb-3 fw-semibold">Operations Director</p>
                                <p class="card-text small">Operations mastermind ensuring seamless delivery</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('styles_about')
<style>
        :root {
            --primary-color: #c52c26;
            --secondary-color: #555555;
            --light-color: #fff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--secondary-color);
        }

        .section-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            color: var(--secondary-color);
            opacity: 0.8;
            margin-bottom: 2rem;
        }

        .bg-primary-custom {
            background-color: var(--primary-color);
        }

        .text-primary-custom {
            color: var(--primary-color);
        }

        .btn-primary-custom {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--light-color);
        }

        .btn-primary-custom:hover {
            background-color: #a32420;
            border-color: #a32420;
        }

        .icon-box {
            width: 80px;
            height: 80px;
            background-color: var(--primary-color);
            color: var(--light-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1.5rem;
        }

        .goal-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .goal-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(197, 44, 38, 0.15);
        }

        .team-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .team-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--primary-color);
            margin-bottom: 1rem;
        }

        .vision-box {
            background: linear-gradient(135deg, var(--primary-color) 0%, #a32420 100%);
            color: var(--light-color);
            border-radius: 15px;
            padding: 3rem;
            position: relative;
            overflow: hidden;
        }

        .vision-box::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            pointer-events: none;
        }
</style>
@endsection
