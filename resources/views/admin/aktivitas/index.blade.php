@extends('layouts.admin')

@section('title', 'Aktivitas Terbaru - Admin Panel')
@section('page-title', 'Aktivitas')

@section('content')

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Semua Aktivitas</h1>
            <div class="admin-breadcrumb-inline">
                <a href="{{ route('admin.dashboard') }}">Admin</a> &rsaquo;
                <strong>Aktivitas</strong>
            </div>
        </div>
    </div>

    <div class="admin-activity-box">
        <div class="admin-activity-list">
            @forelse ($activities as $activity)
                <div class="admin-activity-row">
                    <div class="admin-activity-icon admin-activity-icon-{{ $activity['icon'] }}">
                        @include('admin.partials.icon-' . $activity['icon'])
                    </div>
                    <div class="admin-activity-row-body">
                        <h4>{{ $activity['title'] }}</h4>
                        <p>{{ $activity['desc'] }}</p>
                    </div>
                    <span class="admin-activity-row-time">{{ $activity['time'] }}</span>
                </div>
            @empty
                <p class="admin-table-empty">Belum ada aktivitas.</p>
            @endforelse
        </div>
    </div>

@endsection