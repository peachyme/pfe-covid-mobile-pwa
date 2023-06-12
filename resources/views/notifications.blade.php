@extends('layouts.app')
@include('partials.nav')

@section('content')

<div class="container-fluid px-0 notification-container">
    <h3> Notifications <i class="fa-solid fa-bell text-muted"></i></h3>
    @if ($user->notifications->count() == 0)
    <style>
        body {
            background-color: white;
        }
    </style>
    <div class="text-center icon">
        <h1><i class="fa-solid fa-bell-slash fa-4x"></i></h1>
        <h2 class="text-center">Aucune notification.</h2>
    </div>
    @else
    <!-- notifications -->
    <div class="notification-ui_dd-content pt-2">

        <!-- unread notifications -->
        @foreach ($user->unreadNotifications as $notification)

        <!-- unread cases notifications  -->
        @if ($notification->type == 'App\Notifications\CovidCaseNotification')
        @if ($notification->data['cases'] > 0)
        <div class="notification-list notification-list--unread">
            <div class="notification-list_content">

                <div class="notification-list_img">
                    <img src="\images\red.jpg" alt="alert">
                </div>

                <div class="notification-list_detail">
                    <p class="pb-1"><b class="text-danger">Alerte sanitaire !</b><span class="float-end">{{ date('d M Y', strtotime($notification->created_at)) }}</span></p>

                    @if($notification->data['cases'] == 1)
                    <p class="text-muted">
                        @if ($notification->data['type'] == 'organique')
                        {{$notification->data['cases']}} nouveau cas confirmé positif de COVID-19 dans votre structure. Restez prudent, faites la difference.
                        @else
                        {{$notification->data['cases']}} nouveau cas confirmé positif de COVID-19 dans votre catégorie. Restez prudent, faites la difference.
                        @endif
                    </p>
                    @else
                    <p class="text-muted">
                        @if ($notification->data['type'] == 'organique')
                        {{$notification->data['cases']}} nouveaux cas confirmés positif de COVID-19 dans votre structure. Restez prudent, faites la difference.
                        @else
                        {{$notification->data['cases']}} nouveaux cas confirmés positif de COVID-19 dans votre catégorie. Restez prudent, faites la difference.
                        @endif
                    </p>
                    @endif

                    <!-- mark as read button -->
                    <a href="{{ route('notifications.edit', $notification->id) }}">
                        Marquer comme lu
                    </a>
                </div>

            </div>
        </div>
        @endif
        @endif

        <!-- unread protocole notifications  -->
        @if ($notification->type == 'App\Notifications\ProtocoleNotification')

        <div class="notification-list notification-list--unread">
            <div class="notification-list_content">

                <div class="notification-list_img">
                    <img src="\images\green.jpg" alt="alert">
                </div>

                <div class="notification-list_detail">
                    <p class="pb-1"><b style="color:#24ad66">Protocole sanitaire !</b><span class="float-end">{{ date('d M Y', strtotime($notification->created_at)) }}</span></p>
                    <p class="text-muted">
                        Le nouveau protocole sanitaire proposé et validé par le comité Ad-hoc est disponible! Vous pouvez le 
                        <a class="fw-bold consulter" href="{{ Storage::url($notification->data['pdf'] ) }}" target="_blank">consulter ici.</a>
                    </p>

                    <!-- mark as read button -->
                    <a href="{{ route('notifications.edit', $notification->id) }}">
                        Marquer comme lu
                    </a>
                </div>
            </div>
        </div>
        @endif

        @endforeach

        <!-- read notifications -->
        @foreach ($user->readNotifications as $notification)

        <!-- read cases notifications  -->
        @if ($notification->type == 'App\Notifications\CovidCaseNotification')
        @if ($notification->data['cases'] > 0)

        <div class="notification-list notification-list--read">
            <div class="notification-list_content">

                <div class="notification-list_img">
                    <img src="\images\red.jpg" alt="alert">
                </div>

                <div class="notification-list_detail">
                    <p class="pb-1"><b class="text-danger">Alerte sanitaire !</b><span class="float-end">{{ date('d M Y', strtotime($notification->created_at)) }}</span></p>
                    @if($notification->data['cases'] == 1)
                    <p class="text-muted">
                        @if ($notification->data['type'] == 'organique')
                        {{$notification->data['cases']}} nouveau cas confirmé positif de COVID-19 dans votre structure. Restez prudent, faites la difference.
                        @else
                        {{$notification->data['cases']}} nouveau cas confirmé positif de COVID-19 dans votre catégorie. Restez prudent, faites la difference.
                        @endif
                    </p>
                    @else
                    <p class="text-muted">
                        @if ($notification->data['type'] == 'organique')
                        {{$notification->data['cases']}} nouveaux cas confirmés positif de COVID-19 dans votre structure. Restez prudent, faites la difference.
                        @else
                        {{$notification->data['cases']}} nouveaux cas confirmés positif de COVID-19 dans votre catégorie. Restez prudent, faites la difference.
                        @endif
                    </p>
                    @endif
                </div>

            </div>
        </div>
        @endif
        @endif

        <!-- read protocole notifications  -->
        @if ($notification->type == 'App\Notifications\ProtocoleNotification')

        <div class="notification-list notification-list--read">
            <div class="notification-list_content">

                <div class="notification-list_img">
                    <img src="\images\green.jpg" alt="alert">
                </div>

                <div class="notification-list_detail">
                    <p class="pb-1"><b style="color:#24ad66">Protocole sanitaire !</b><span class="float-end">{{ date('d M Y', strtotime($notification->created_at)) }}</span></p>
                    <p class="text-muted">
                        Le nouveau protocole sanitaire proposé et validé par le comité Ad-hoc est disponible! Vous pouvez le 
                        <a class="fw-bold consulter" href="{{ Storage::url($notification->data['pdf'] ) }}" target="_blank">consulter ici.</a>
                    </p>

                </div>

            </div>
        </div>
        @endif

        @endforeach
    </div>
    @endif
    @if (auth()->user()->unreadNotifications->count() != 0)
    <div class="markAllAsRead text-center px-2">
        <a href="{{ route('notifications.markallread') }}">Marquer tous comme lus</a>
    </div>
    @endif
</div>



@endsection