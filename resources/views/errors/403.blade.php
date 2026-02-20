<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 – Access Denied</title>
    <style>
        :root { --coral:#FF7F50; --dark:#111; --muted:#666; }
        * { box-sizing: border-box; }
        body { margin:0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif; background:#fafafa; color:#222; }
        .wrap { min-height:100vh; display:flex; align-items:center; justify-content:center; padding:24px; }
        .card { width:100%; max-width:900px; background:#fff; border-radius:18px; box-shadow:0 14px 36px rgba(0,0,0,0.10); overflow:hidden; }
        .header { display:flex; align-items:center; gap:20px; padding:36px 36px 0 36px; }
        .badge { font-weight:800; font-size:96px; line-height:1; color:var(--coral); }
        .title { font-size:36px; font-weight:800; color:var(--dark); }
        .content { padding:14px 36px 28px 36px; font-size:20px; color:var(--muted); }
        .actions { display:flex; gap:14px; padding:0 36px 36px 36px; }
        .btn { appearance:none; border:none; cursor:pointer; font-weight:700; border-radius:12px; padding:14px 22px; font-size:16px; }
        .btn-primary { background:var(--coral); color:#000; }
        .btn-outline { background:#fff; color:var(--dark); border:1px solid #ddd; }
        .btn:hover { filter:brightness(0.95); }
        .small { font-size:14px; }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="card">
            <div class="header">
                {{-- <div class="badge">403</div> --}}
                <div class="badge">Access Denied</div>
            </div>
            <div class="content">
                <div>Sorry!You do not have permission to access this page.</div>
                {{-- <div class="small">If you believe this is a mistake, please contact your administrator.</div> --}}
            </div>
            <div class="actions">
                <button class="btn btn-outline" onclick="history.back()">Go Back</button>
                {{-- <a class="btn btn-primary" href="{{ url('/dashboard') }}">Go to Dashboard</a> --}}
            </div>
        </div>
    </div>
</body>
</html>
