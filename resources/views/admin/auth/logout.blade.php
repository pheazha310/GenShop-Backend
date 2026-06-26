@extends('layouts.admin')

@section('content')
<style>
    .logout-wrap {
        min-height: calc(100vh - 80px);
        display: grid;
        place-items: center;
        padding: 24px 0 40px;
    }

    .logout-card {
        width: min(720px, 100%);
        background: #fff;
        border: 1px solid #d1d7e5;
        border-radius: 0;
        padding: 36px;
        box-shadow: 0 1px 0 rgba(15, 23, 42, 0.03);
    }

    .logout-kicker {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #0c3a97;
    }

    .logout-title {
        margin: 18px 0 8px;
        font-size: 34px;
        line-height: 1.1;
        color: #0d1e3b;
        letter-spacing: -0.03em;
    }

    .logout-text {
        margin: 0;
        font-size: 16px;
        line-height: 1.6;
        color: #5f687e;
    }

    .logout-actions {
        display: flex;
        gap: 12px;
        margin-top: 28px;
        flex-wrap: wrap;
    }

    .logout-actions form,
    .logout-actions a {
        flex: 1 1 220px;
    }

    .logout-btn,
    .cancel-btn {
        width: 100%;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        padding: 14px 18px;
        border-radius: 0;
        font-size: 16px;
        font-weight: 700;
        border: 1px solid transparent;
        text-decoration: none;
        cursor: pointer;
    }

    .logout-btn {
        background: #0a3aa0;
        color: #fff;
    }

    .cancel-btn {
        background: #fff;
        color: #16233f;
        border-color: #d1d7e5;
    }

    @media (max-width: 700px) {
        .logout-card {
            padding: 24px;
        }

        .logout-title {
            font-size: 28px;
        }
    }
</style>

<div class="logout-wrap">
    <div class="logout-card">
        <div class="logout-kicker">
            <span style="width:10px;height:10px;border-radius:50%;background:#0a3aa0;display:inline-block;"></span>
            Logout Confirmation
        </div>
        <h2 class="logout-title">Sign out of GenShop Admin?</h2>
        <p class="logout-text">
            You are currently signed in as <strong>{{ auth()->user()->name }}</strong>.
            If you log out, you will be returned to the admin login page and need to sign in again to continue.
        </p>

        <div class="logout-actions">
            <a href="{{ route('admin.dashboard') }}" class="cancel-btn">Cancel</a>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Yes, log me out</button>
            </form>
        </div>
    </div>
</div>
@endsection
