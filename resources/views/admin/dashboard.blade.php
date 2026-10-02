@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')
@section('page-title', 'Dashboard')

@section('content')

    <h2 class="admin-welcome">Selamat Datang, Administrator &#128075;</h2>
    <p class="admin-subtitle">Berikut adalah ringkasan sistem hari ini.</p>

    <h3 class="admin-section-title">Statistik Ringkasan</h3>
    <div class="admin-stats-grid">
        @foreach ($stats as $stat)
            <div class="admin-stat-card">
                <div class="admin-stat-icon admin-stat-icon-{{ $stat['icon'] }}">
                    @include('admin.partials.icon-' . $stat['icon'])
                </div>
                <div class="admin-stat-body">
                    <span class="admin-stat-label">{{ strtoupper($stat['label']) }}</span>
                    <strong class="admin-stat-value">{{ $stat['value'] }}</strong>
                    <span class="admin-stat-note admin-stat-note-{{ $stat['trend'] }}">
                        @if ($stat['trend'] === 'up') &#8599; @endif
                        @if ($stat['trend'] === 'ok') &#10003; @endif
                        @if ($stat['trend'] === 'flat') &#8722; @endif
                        {{ $stat['note'] }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>

    <div class="admin-activity-box">
        <div class="admin-activity-header">
            <h3>Aktivitas Terbaru</h3>
            <a href="{{ route('admin.aktivitas.index') }}">Lihat Semua</a>
        </div>
        <div class="admin-activity-grid">
            @foreach ($activities as $activity)
                <div class="admin-activity-item">
                    <div class="admin-activity-icon admin-activity-icon-{{ $activity['icon'] }}">
                        @include('admin.partials.icon-' . $activity['icon'])
                    </div>
                    <h4>{{ $activity['title'] }}</h4>
                    <p>{{ $activity['desc'] }}</p>
                    <span>{{ $activity['time'] }}</span>
                </div>
            @endforeach
        </div>
    </div>

@endsection