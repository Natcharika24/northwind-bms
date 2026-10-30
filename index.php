<!doctype html>
<html>
<head>
<meta charset="utf8">
<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
<title>Northwind BMS - Business Management System</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap">
<style>
/* ─── Corporate Design Tokens ───────────────────────────────── */
:root {
  --bg:        #F4F7F9;
  --surface:   #FFFFFF;
  --surface-2: #F8FAFC;
  --border:    #D1D9E0;
  --primary:   #0F4C81; 
  --primary-dk:#0A365C;
  --primary-lt:#E6F0FA;
  --ink:       #2C3E50;
  --ink-2:     #5C6D7E;
  --ink-3:     #95A5A6;
  --success:   #27AE60;
  --success-lt:#EAF8ED;
  --warn:      #F39C12;
  --warn-lt:   #FEF5E7;
  --danger:    #E74C3C;
  --danger-lt: #FDEDEC;
  --sidebar-w: 240px;
  --topbar-h:  56px;
}

/* ─── Reset & Base ───────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body {
  font-family: 'Sarabun', sans-serif;
  background: var(--bg);
  color: var(--ink);
  font-size: 14px;
  line-height: 1.6;
}
button { font-family: inherit; cursor: pointer; }

/* ─── App Shell ───────────────────────────────── */
.shell { display: flex; min-height: 100vh; }

/* ─── Sidebar ───────────────────────────────── */
.sidebar {
  width: var(--sidebar-w);
  background: var(--primary-dk);
  color: #fff;
  display: flex; flex-direction: column;
  position: fixed; top: 0; left: 0; height: 100%;
  z-index: 30;
}
.sidebar-logo {
  height: var(--topbar-h);
  display: flex; align-items: center;
  padding: 0 20px;
  border-bottom: 1px solid rgba(255,255,255,0.1);
  gap: 12px;
}
.logo-mark {
  width: 32px; height: 32px;
  background: #fff;
  border-radius: 4px;
  display: flex; align-items: center; justify-content: center;
  color: var(--primary-dk); font-weight: 700; font-size: 14px;
}
.logo-text { font-weight: 700; font-size: 15px; color: #fff; letter-spacing: 0.5px;}

.nav { flex: 1; overflow-y: auto; padding: 20px 12px; }
.nav-group { margin-bottom: 24px; }
.nav-label {
  font-size: 11px; font-weight: 600; letter-spacing: 0.1em;
  text-transform: uppercase; color: rgba(255,255,255,0.5);
  padding: 0 12px 8px;
}
.nav-item {
  display: flex; align-items: center; gap: 12px;
  padding: 10px 12px; border-radius: 6px;
  cursor: pointer; color: rgba(255,255,255,0.8);
  font-size: 14px; font-weight: 500;
  transition: all .2s;
  border: none; background: transparent; width: 100%; text-align: left;
}
.nav-item:hover { background: rgba(255,255,255,0.1); color: #fff; }
.nav-item.active { background: var(--primary); color: #fff; border-left: 4px solid #fff; }

.sidebar-footer {
  padding: 16px;
  border-top: 1px solid rgba(255,255,255,0.1);
  background: rgba(0,0,0,0.1);
}
.user-card { display: flex; align-items: center; gap: 12px; }
.avatar {
  width: 36px; height: 36px; border-radius: 50%;
  background: rgba(255,255,255,0.2); color: #fff;
  display: flex; align-items: center; justify-content: center;
  font-size: 13px; font-weight: 700;
}
.user-name  { font-size: 14px; font-weight: 600; color: #fff; }
.user-role  { font-size: 12px; color: rgba(255,255,255,0.6); }

/* ─── Main Content ───────────────────────────────── */
.main {
  margin-left: var(--sidebar-w);
  flex: 1; display: flex; flex-direction: column;
  min-height: 100vh;
}
.topbar {
  height: var(--topbar-h); background: var(--surface);
  border-bottom: 1px solid var(--border);
  display: flex; align-items: center; justify-content: space-between;
  padding: 0 24px; position: sticky; top: 0; z-index: 20;
  box-shadow: 0 2px 4px rgba(0,0,0,0.02);
}
.breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--ink-2); }
.breadcrumb span.sep { color: var(--border); }
.breadcrumb span.cur { color: var(--primary); font-weight: 600; }
.topbar-right { display: flex; align-items: center; gap: 12px; }
.page-content { flex: 1; padding: 32px; }

/* ─── UI Components ───────────────────────────────── */
.screen { display: none; }
.screen.active { display: block; }

.page-header {
  display: flex; align-items: flex-start;
  justify-content: space-between; margin-bottom: 24px;
  gap: 16px; flex-wrap: wrap;
  border-bottom: 2px solid var(--border);
  padding-bottom: 16px;
}
.page-title { font-size: 24px; font-weight: 700; color: var(--ink); letter-spacing: -0.5px; }
.page-desc  { font-size: 14px; color: var(--ink-2); margin-top: 4px; }
.btn-row    { display: flex; gap: 12px; flex-wrap: wrap; }

.btn {
  display: inline-flex; align-items: center; justify-content: center; gap: 8px;
  padding: 8px 16px; border-radius: 4px; border: 1px solid transparent;
  font-size: 14px; font-weight: 600; font-family: inherit;
  cursor: pointer; transition: all .2s;
}
.btn-primary { background: var(--primary); color: #fff; }
.btn-primary:hover { background: var(--primary-dk); }
.btn-outline { background: transparent; color: var(--ink); border-color: var(--border); }
.btn-outline:hover { background: var(--surface-2); border-color: var(--ink-3); }
.btn-sm { padding: 4px 12px; font-size: 12px; }

/* ─── Cards & Tables ───────────────────────────────── */
.card {
  background: var(--surface); border: 1px solid var(--border);
  border-radius: 8px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);
}
.card-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

.table-wrap { overflow-x: auto; border: 1px solid var(--border); border-radius: 8px; }
table { width: 100%; border-collapse: collapse; font-size: 14px; background: var(--surface); }
th {
  text-align: left; padding: 12px 16px;
  background: var(--surface-2); border-bottom: 2px solid var(--border);
  font-weight: 600; font-size: 13px; color: var(--ink-2);
}
td {
  padding: 12px 16px; border-bottom: 1px solid var(--border);
  color: var(--ink); vertical-align: middle;
}
tr:last-child td { border-bottom: none; }
tr:hover td { background: var(--bg); }

.badge {
  display: inline-flex; align-items: center;
  padding: 4px 10px; border-radius: 4px;
  font-size: 12px; font-weight: 600;
}
.badge-green  { background: var(--success-lt); color: var(--success); }
.badge-gray   { background: var(--surface-2);  color: var(--ink-2); border:1px solid var(--border); }

/* ─── Forms ───────────────────────────────── */
.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.form-group { display: flex; flex-direction: column; gap: 8px; }
.form-group.full { grid-column: 1 / -1; }
.form-label { font-size: 13px; font-weight: 600; color: var(--ink); }
.form-input, .form-select {
  padding: 10px 14px; border: 1px solid var(--border);
  border-radius: 4px; background: var(--surface);
  color: var(--ink); font-size: 14px; font-family: inherit;
}
.form-input:focus, .form-select:focus {
  outline: none; border-color: var(--primary);
  box-shadow: 0 0 0 3px var(--primary-lt);
}
.required::after { content: ' *'; color: var(--danger); }

/* ─── Layout Specifics ───────────────────────────────── */
.kpi-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 20px; }
.kpi-card { background: var(--surface); border: 1px solid var(--border); border-radius: 8px; padding: 18px 20px; }
.kpi-label { font-size: 12px; color: var(--ink-2); font-weight: 500; margin-bottom: 6px; }
.kpi-value { font-size: 24px; font-weight: 700; color: var(--ink); line-height: 1; }

/* Charts & Progress */
.bar-chart { display: flex; align-items: flex-end; gap: 8px; height: 140px; padding: 10px 0 0; border-bottom: 1px solid var(--border); margin-bottom: 8px; }
.bar-wrap  { display: flex; flex-direction: column; align-items: center; flex: 1; gap: 8px; }
.bar-col   { width: 100%; background: var(--primary-lt); border-radius: 4px 4px 0 0; min-height: 4px; transition: background 0.2s; cursor: pointer; }
.bar-col:hover { background: var(--primary); }
.bar-col.active { background: var(--primary-dk); }
.bar-lbl   { font-size: 12px; color: var(--ink-2); font-weight: 500; }
.prog-row  { margin-bottom: 16px; }
.prog-label { display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 6px; }
.prog-bar  { height: 8px; background: var(--surface-2); border-radius: 4px; overflow: hidden; border: 1px solid var(--border); }
.prog-fill { height: 100%; border-radius: 4px; background: var(--primary); }

/* ─── Login Screen ───────────────────────────────── */
.login-wrap {
  min-height: 100vh; display: flex;
  align-items: center; justify-content: center;
  background: var(--bg); padding: 24px;
}
.login-card {
  width: 100%; max-width: 420px;
  background: var(--surface); border: 1px solid var(--border);
  border-radius: 8px; padding: 40px;
  box-shadow: 0 10px 30px rgba(0,0,0,.05);
}
.login-title { font-size: 24px; font-weight: 700; color: var(--ink); margin-bottom: 8px; }

/* ─── Dev Nav Tabs ───────────────────────────────── */
#nav-tabs {
  display: flex; gap: 8px; flex-wrap: wrap;
  padding: 16px 24px; background: var(--primary-dk);
  position: sticky; top: 0; z-index: 100;
}
.nav-tab {
  padding: 6px 14px; border-radius: 4px; border: 1px solid rgba(255,255,255,0.2);
  font-size: 13px; font-weight: 500; cursor: pointer;
  background: transparent; color: #fff; transition: all .2s;
}
.nav-tab:hover, .nav-tab.active { background: #fff; color: var(--primary-dk); }
</style>
</head>
<body>

<!-- Dev Menu -->
<div id="nav-tabs">
  <button class="nav-tab active" onclick="show('login')">เข้าสู่ระบบ</button>
  <button class="nav-tab" onclick="show('dashboard')">แดชบอร์ด</button>
  <button class="nav-tab" onclick="show('products')">รายการสินค้า</button>
  <button class="nav-tab" onclick="show('product-form')">เพิ่ม/แก้ไขสินค้า</button>
  <button class="nav-tab" onclick="show('categories')">หมวดหมู่</button>
  <button class="nav-tab" onclick="show('orders')">คำสั่งซื้อ</button>
  <button class="nav-tab" onclick="show('order-detail')">รายละเอียดคำสั่งซื้อ</button>
  <button class="nav-tab" onclick="show('customers')">ลูกค้า</button>
  <button class="nav-tab" onclick="show('suppliers')">ผู้จัดจำหน่าย</button>
  <button class="nav-tab" onclick="show('employees')">พนักงาน</button>
  <button class="nav-tab" onclick="show('shippers')">บริษัทขนส่ง</button>
  <button class="nav-tab" onclick="show('reports')">รายงาน</button>
</div>

<!-- ══════════════════════════════════════════════════ -->
<!-- SCREEN 1: LOGIN                                   -->
<!-- ══════════════════════════════════════════════════ -->
<div id="login" class="screen active">
  <div class="login-wrap">
    <div class="login-card">
      <div style="margin-bottom: 32px; text-align: center;">
        <div class="logo-mark" style="width: 48px; height: 48px; font-size: 20px; margin: 0 auto 16px; background: var(--primary); color: #fff;">NW</div>
        <div class="login-title">Northwind BMS</div>
        <div style="color: var(--ink-2); font-size: 14px;">เข้าสู่ระบบการจัดการธุรกิจ</div>
      </div>
      <div class="form-group" style="margin-bottom:20px">
        <label class="form-label required">อีเมลผู้ใช้งาน</label>
        <input class="form-input" value="admin@northwind.co.th" placeholder="ระบุอีเมล">
      </div>
      <div class="form-group" style="margin-bottom:28px">
        <div style="display:flex;justify-content:space-between;align-items:center;">
          <label class="form-label required">รหัสผ่าน</label>
          <a style="font-size:13px;color:var(--primary);text-decoration:none">ลืมรหัสผ่าน?</a>
        </div>
        <input class="form-input" type="password" value="••••••••">
      </div>
      <button class="btn btn-primary" style="width:100%; padding: 12px; font-size: 15px;" onclick="show('dashboard')">
        เข้าสู่ระบบ
      </button>
      <div style="text-align: center; margin-top: 24px; font-size: 12px; color: var(--ink-3);">
        ระบบป้องกันข้อมูลด้วยมาตรฐาน JWT Token
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════ -->
<!-- SCREEN 2: DASHBOARD                               -->
<!-- ══════════════════════════════════════════════════ -->
<div id="dashboard" class="screen">
  <div class="shell">
    <nav class="sidebar">
      <div class="sidebar-logo">
        <div class="logo-mark">NW</div>
        <div><div class="logo-text">Northwind BMS</div></div>
      </div>
      <div class="nav">
        <div class="nav-group">
          <div class="nav-label">ภาพรวมระบบ</div>
          <button class="nav-item active" onclick="show('dashboard')">แดชบอร์ด</button>
        </div>
        <div class="nav-group">
          <div class="nav-label">การจัดการคลังสินค้า</div>
          <button class="nav-item" onclick="show('products')">รายการสินค้า</button>
          <button class="nav-item" onclick="show('categories')">หมวดหมู่สินค้า</button>
        </div>
        <div class="nav-group">
          <div class="nav-label">การขาย</div>
          <button class="nav-item" onclick="show('orders')">คำสั่งซื้อ</button>
          <button class="nav-item" onclick="show('customers')">ลูกค้า</button>
        </div>
      </div>
      <div class="sidebar-footer">
        <div class="user-card">
          <div class="avatar">AD</div>
          <div><div class="user-name">ผู้ดูแลระบบ</div><div class="user-role">Administrator</div></div>
        </div>
      </div>
    </nav>
    <div class="main">
      <div class="topbar">
        <div class="breadcrumb"><span>ระบบหลัก</span><span class="sep">/</span><span class="cur">แดชบอร์ด</span></div>
      </div>
      <div class="page-content">
        <div class="page-header">
          <div><div class="page-title">แดชบอร์ดผู้บริหาร</div><div class="page-desc">สรุปข้อมูลการดำเนินงานประจำเดือน (เชื่อมโยงฐานข้อมูลแบบ Real-time)</div></div>
        </div>
        
        <!-- KPI Metrics -->
        <div class="kpi-grid">
          <div class="kpi-card">
            <div class="kpi-label">ยอดขายรวม (เดือนนี้)</div>
            <div class="kpi-value" style="color: var(--primary);">฿245K</div>
          </div>
          <div class="kpi-card">
            <div class="kpi-label">คำสั่งซื้อทั้งหมด</div>
            <div class="kpi-value">196</div>
          </div>
          <div class="kpi-card">
            <div class="kpi-label">รายการสินค้าในระบบ</div>
            <div class="kpi-value" id="statTotalProducts">0</div>
          </div>
          <div class="kpi-card">
            <div class="kpi-label">หมวดหมู่สินค้า</div>
            <div class="kpi-value" id="statTotalCategories">0</div>
          </div>
        </div>

        <!-- Charts Section -->
        <div class="card-grid-2">
          <!-- Bar Chart -->
          <div class="card">
            <div style="font-size: 15px; font-weight: 700; color: var(--ink); margin-bottom: 20px;">สถิติคำสั่งซื้อรายเดือน</div>
            <div class="bar-chart">
              <div class="bar-wrap"><div class="bar-col" style="height:30%"></div><div class="bar-lbl">ม.ค.</div></div>
              <div class="bar-wrap"><div class="bar-col" style="height:45%"></div><div class="bar-lbl">ก.พ.</div></div>
              <div class="bar-wrap"><div class="bar-col" style="height:60%"></div><div class="bar-lbl">มี.ค.</div></div>
              <div class="bar-wrap"><div class="bar-col" style="height:40%"></div><div class="bar-lbl">เม.ย.</div></div>
              <div class="bar-wrap"><div class="bar-col" style="height:75%"></div><div class="bar-lbl">พ.ค.</div></div>
              <div class="bar-wrap"><div class="bar-col" style="height:50%"></div><div class="bar-lbl">มิ.ย.</div></div>
              <div class="bar-wrap"><div class="bar-col" style="height:85%"></div><div class="bar-lbl">ก.ค.</div></div>
              <div class="bar-wrap"><div class="bar-col active" style="height:100%"></div><div class="bar-lbl" style="color:var(--primary); font-weight:700;">ส.ค.</div></div>
            </div>
          </div>

          <!-- Progress Bars -->
          <div class="card">
            <div style="font-size: 15px; font-weight: 700; color: var(--ink); margin-bottom: 20px;">สถานะระบบคลังสินค้า</div>
            <div class="prog-row">
              <div class="prog-label"><span>ความจุฐานข้อมูลสินค้า</span><span style="font-weight:600;" id="progProductsCount">0 รายการ</span></div>
              <div class="prog-bar"><div class="prog-fill" style="width: 75%;"></div></div>
            </div>
            <div class="prog-row">
              <div class="prog-label"><span>ความเสถียรของ API Server</span><span style="font-weight:600; color:var(--success);">100% (ปกติ)</span></div>
              <div class="prog-bar"><div class="prog-fill" style="width: 100%; background:var(--success);"></div></div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════ -->
<!-- SCREEN 3: PRODUCTS LIST                           -->
<!-- ══════════════════════════════════════════════════ -->
<div id="products" class="screen">
  <div class="shell">
    <nav class="sidebar">
      <div class="sidebar-logo"><div class="logo-mark">NW</div><div><div class="logo-text">Northwind BMS</div></div></div>
      <div class="nav">
        <div class="nav-group">
          <div class="nav-label">การจัดการคลังสินค้า</div>
          <button class="nav-item active" onclick="show('products')">รายการสินค้า</button>
          <button class="nav-item" onclick="show('categories')">หมวดหมู่สินค้า</button>
        </div>
      </div>
      <div class="sidebar-footer"><div class="user-card"><div class="avatar">AD</div><div><div class="user-name">ผู้ดูแลระบบ</div></div></div></div>
    </nav>
    <div class="main">
      <div class="topbar">
        <div class="breadcrumb"><span>การจัดการคลังสินค้า</span><span class="sep">/</span><span class="cur">รายการสินค้า</span></div>
      </div>
      <div class="page-content">
        <div class="page-header">
          <div>
            <div class="page-title">ฐานข้อมูลสินค้า</div>
            <div class="page-desc">ข้อมูลแสดงผลและจัดการได้แบบ Real-time ผ่าน RESTful API</div>
          </div>
          <div class="btn-row">
            <button class="btn btn-outline" onclick="window.location.href='api/export_csv.php'">ดาวน์โหลดรายงาน (CSV)</button>
            <button class="btn btn-primary" onclick="resetFormToAdd(); show('product-form')">เพิ่มสินค้าใหม่</button>
          </div>
        </div>
        
        <div style="margin-bottom: 24px;">
          <div class="table-wrap" style="padding: 0;">
            <table>
              <thead>
                <tr>
                  <th>รหัสอ้างอิง</th>
                  <th>ชื่อผลิตภัณฑ์</th>
                  <th>หมวดหมู่</th>
                  <th>รหัสผู้จัดจำหน่าย</th>
                  <th>หน่วยบรรจุภัณฑ์</th>
                  <th>ราคา (บาท)</th>
                  <th>สถานะ</th>
                  <th>การจัดการ</th>
                </tr>
              </thead>
              <tbody id="productTableBody">
                 <!-- โหลดข้อมูลด้วย JavaScript -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════ -->
<!-- SCREEN 4: PRODUCT FORM (Create & Update)          -->
<!-- ══════════════════════════════════════════════════ -->
<div id="product-form" class="screen">
  <div class="shell">
    <nav class="sidebar">
      <div class="sidebar-logo"><div class="logo-mark">NW</div><div><div class="logo-text">Northwind BMS</div></div></div>
      <div class="nav">
        <div class="nav-group">
          <div class="nav-label">การจัดการคลังสินค้า</div>
          <button class="nav-item active" onclick="show('products')">รายการสินค้า</button>
          <button class="nav-item" onclick="show('categories')">หมวดหมู่สินค้า</button>
        </div>
      </div>
      <div class="sidebar-footer"><div class="user-card"><div class="avatar">AD</div><div><div class="user-name">ผู้ดูแลระบบ</div></div></div></div>
    </nav>
    <div class="main">
      <div class="topbar">
        <div class="breadcrumb"><span>การจัดการคลังสินค้า</span><span class="sep">/</span><span class="cur">ฟอร์มบันทึกสินค้า</span></div>
        <div class="topbar-right"><button class="btn btn-outline btn-sm" onclick="show('products')">กลับหน้ารายการ</button></div>
      </div>
      <div class="page-content">
        <div class="page-header">
          <div><div class="page-title" id="formTitle">บันทึกข้อมูลผลิตภัณฑ์</div><div class="page-desc">กรุณาระบุรายละเอียดให้ครบถ้วนในช่องที่มีสัญลักษณ์ *</div></div>
        </div>
        <div class="card">
          <form id="frmAddProduct" action="api/insert_product.php" method="POST">
            <div class="form-grid">
              <div class="form-group full">
                <label class="form-label required">ชื่อผลิตภัณฑ์</label>
                <input class="form-input" name="ProductName" required placeholder="ระบุชื่อผลิตภัณฑ์">
              </div>
              <div class="form-group">
                <label class="form-label required">หมวดหมู่ผลิตภัณฑ์</label>
                <select class="form-select" name="CatID" required>
                  <option value="" selected disabled>-- เลือกหมวดหมู่ --</option>
                  <option value="1">Beverages</option>
                  <option value="2">Condiments</option>
                  <option value="3">Confections</option>
                </select>
              </div>
              <div class="form-group">
                <label class="form-label required">รหัสผู้จัดจำหน่าย</label>
                <select class="form-select" name="SupplierID" required>
                  <option value="" selected disabled>-- เลือกผู้จัดจำหน่าย --</option>
                  <option value="1">Exotic Liquids</option>
                  <option value="2">New Orleans Cajun Delights</option>
                  <option value="3">Grandma Kelly's Homestead</option>
                </select>
              </div>
              <div class="form-group">
                <label class="form-label required">หน่วยบรรจุภัณฑ์</label>
                <input class="form-input" name="Unit" required placeholder="ระบุหน่วยนับ">
              </div>
              <div class="form-group">
                <label class="form-label required">ราคาต่อหน่วย (THB)</label>
                <input class="form-input" name="Price" type="number" step="0.01" required placeholder="0.00">
              </div>
            </div>
            <div style="display:flex;gap:12px;justify-content:flex-end;margin-top:32px;padding-top:24px;border-top:1px solid var(--border)">
              <button type="reset" class="btn btn-outline">ล้างข้อมูล</button>
              <button type="submit" class="btn btn-primary" id="submitBtnText">บันทึกข้อมูลเข้าสู่ระบบ</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════ -->
<!-- SCREEN 5: CATEGORIES                              -->
<!-- ══════════════════════════════════════════════════ -->
<div id="categories" class="screen">
  <div class="shell">
    <nav class="sidebar">
      <div class="sidebar-logo"><div class="logo-mark">NW</div><div><div class="logo-text">Northwind BMS</div></div></div>
      <div class="nav">
        <div class="nav-group">
          <div class="nav-label">การจัดการคลังสินค้า</div>
          <button class="nav-item" onclick="show('products')">รายการสินค้า</button>
          <button class="nav-item active" onclick="show('categories')">หมวดหมู่สินค้า</button>
        </div>
      </div>
      <div class="sidebar-footer"><div class="user-card"><div class="avatar">AD</div><div><div class="user-name">ผู้ดูแลระบบ</div></div></div></div>
    </nav>
    <div class="main">
      <div class="topbar">
        <div class="breadcrumb"><span>การจัดการคลังสินค้า</span><span class="sep">/</span><span class="cur">หมวดหมู่สินค้า</span></div>
      </div>
      <div class="page-content">
        <div class="page-header">
          <div><div class="page-title">ทะเบียนหมวดหมู่สินค้า</div><div class="page-desc">ข้อมูลดึงตรงจากฐานข้อมูลระบบ</div></div>
        </div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>รหัสหมวดหมู่</th>
                <th>ชื่อหมวดหมู่</th>
                <th>รายละเอียด</th>
              </tr>
            </thead>
            <tbody id="categoryTableBody">
              <!-- โหลดข้อมูลด้วย API -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════ -->
<!-- SCREEN 6: ORDERS                                  -->
<!-- ══════════════════════════════════════════════════ -->
<div id="orders" class="screen">
  <div class="shell">
    <nav class="sidebar">
      <div class="sidebar-logo"><div class="logo-mark">NW</div><div><div class="logo-text">Northwind BMS</div></div></div>
      <div class="nav"><div class="nav-group"><div class="nav-label">การขาย</div><button class="nav-item active" onclick="show('orders')">คำสั่งซื้อ</button></div></div>
    </nav>
    <div class="main">
      <div class="topbar"><div class="breadcrumb"><span>การขาย</span><span class="sep">/</span><span class="cur">คำสั่งซื้อ</span></div></div>
      <div class="page-content">
        <div class="page-header">
          <div><div class="page-title">รายการคำสั่งซื้อ</div><div class="page-desc">จัดการรายการคำสั่งซื้อทั้งหมดของลูกค้า</div></div>
          <button class="btn btn-primary" onclick="alert('ระบบสร้างคำสั่งซื้อกำลังเปิดให้บริการในเวอร์ชันถัดไป')">สร้างคำสั่งซื้อใหม่</button>
        </div>
        <div class="card">
          <div class="table-wrap">
            <table>
              <thead><tr><th>รหัสคำสั่งซื้อ</th><th>รหัสลูกค้า</th><th>พนักงานผู้ขาย</th><th>วันที่สั่งซื้อ</th><th>สถานะ</th></tr></thead>
              <tbody>
                <tr><td>10248</td><td>VINET</td><td>Steven Buchanan</td><td>2026-07-01</td><td><span class="badge badge-green">สำเร็จ</span></td></tr>
                <tr><td>10249</td><td>TOMSP</td><td>Nancy Davolio</td><td>2026-07-03</td><td><span class="badge badge-green">สำเร็จ</span></td></tr>
                <tr><td>10250</td><td>HANAR</td><td>Janet Leverling</td><td>2026-07-05</td><td><span class="badge badge-gray">รอดำเนินการ</span></td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════ -->
<!-- SCREEN 7: ORDER DETAIL                            -->
<!-- ══════════════════════════════════════════════════ -->
<div id="order-detail" class="screen">
  <div class="shell">
    <nav class="sidebar">
      <div class="sidebar-logo"><div class="logo-mark">NW</div><div><div class="logo-text">Northwind BMS</div></div></div>
      <div class="nav"><div class="nav-group"><div class="nav-label">การขาย</div><button class="nav-item active" onclick="show('order-detail')">รายละเอียดคำสั่งซื้อ</button></div></div>
    </nav>
    <div class="main">
      <div class="topbar"><div class="breadcrumb"><span>การขาย</span><span class="sep">/</span><span class="cur">รายละเอียดคำสั่งซื้อ</span></div></div>
      <div class="page-content">
        <div class="page-header">
          <div><div class="page-title">ข้อมูลอ้างอิงคำสั่งซื้อ #10248</div><div class="page-desc">รายการสินค้าภายในคำสั่งซื้อ</div></div>
        </div>
        <div class="card">
          <div class="table-wrap">
            <table>
              <thead><tr><th>รหัสสินค้า</th><th>ชื่อผลิตภัณฑ์</th><th>ราคาต่อหน่วย</th><th>จำนวน</th><th>ราคารวม</th></tr></thead>
              <tbody>
                <tr><td>11</td><td>Queso Cabrales</td><td>฿21.00</td><td>12</td><td>฿252.00</td></tr>
                <tr><td>42</td><td>Singaporean Hokkien Fried Mee</td><td>฿14.00</td><td>10</td><td>฿140.00</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════ -->
<!-- SCREEN 8: CUSTOMERS                               -->
<!-- ══════════════════════════════════════════════════ -->
<div id="customers" class="screen">
  <div class="shell">
    <nav class="sidebar">
      <div class="sidebar-logo"><div class="logo-mark">NW</div><div><div class="logo-text">Northwind BMS</div></div></div>
      <div class="nav"><div class="nav-group"><div class="nav-label">การขาย</div><button class="nav-item active" onclick="show('customers')">ลูกค้า</button></div></div>
    </nav>
    <div class="main">
      <div class="topbar"><div class="breadcrumb"><span>การขาย</span><span class="sep">/</span><span class="cur">ลูกค้า</span></div></div>
      <div class="page-content">
        <div class="page-header">
          <div><div class="page-title">ทะเบียนลูกค้า</div><div class="page-desc">ข้อมูลลูกค้าดึงตรงจากฐานข้อมูลระบบ</div></div>
        </div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>รหัสลูกค้า</th>
                <th>ชื่อบริษัท/ลูกค้า</th>
                <th>ชื่อผู้ติดต่อ</th>
                <th>เมือง / ประเทศ</th>
              </tr>
            </thead>
            <tbody id="customerTableBody">
              <!-- โหลดข้อมูลด้วย API -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════ -->
<!-- SCREEN 9: SUPPLIERS                               -->
<!-- ══════════════════════════════════════════════════ -->
<div id="suppliers" class="screen">
  <div class="shell">
    <nav class="sidebar">
      <div class="sidebar-logo"><div class="logo-mark">NW</div><div><div class="logo-text">Northwind BMS</div></div></div>
      <div class="nav"><div class="nav-group"><div class="nav-label">ห่วงโซ่อุปทาน</div><button class="nav-item active" onclick="show('suppliers')">ผู้จัดจำหน่าย</button></div></div>
    </nav>
    <div class="main">
      <div class="topbar"><div class="breadcrumb"><span>ห่วงโซ่อุปทาน</span><span class="sep">/</span><span class="cur">ผู้จัดจำหน่าย</span></div></div>
      <div class="page-content">
        <div class="page-header">
          <div><div class="page-title">ทะเบียนผู้จัดจำหน่าย</div><div class="page-desc">รายชื่อพาร์ทเนอร์และคู่ค้าทางธุรกิจ</div></div>
        </div>
        <div class="card">
          <div class="table-wrap">
            <table>
              <thead><tr><th>รหัส</th><th>ชื่อบริษัท</th><th>ผู้ติดต่อ</th><th>ประเทศ</th></tr></thead>
             <tbody id="supplierTableBody"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════ -->
<!-- SCREEN 10: EMPLOYEES                              -->
<!-- ══════════════════════════════════════════════════ -->
<div id="employees" class="screen">
  <div class="shell">
    <nav class="sidebar">
      <div class="sidebar-logo"><div class="logo-mark">NW</div><div><div class="logo-text">Northwind BMS</div></div></div>
      <div class="nav"><div class="nav-group"><div class="nav-label">บุคลากร</div><button class="nav-item active" onclick="show('employees')">พนักงาน</button></div></div>
    </nav>
    <div class="main">
      <div class="topbar"><div class="breadcrumb"><span>บุคลากร</span><span class="sep">/</span><span class="cur">พนักงาน</span></div></div>
      <div class="page-content">
        <div class="page-header">
          <div><div class="page-title">รายชื่อพนักงาน</div><div class="page-desc">ทำเนียบพนักงานและทีมงานองค์กร</div></div>
        </div>
        <div class="card">
          <div class="table-wrap">
            <table>
              <thead><tr><th>รหัสพนักงาน</th><th>ชื่อ - นามสกุล</th><th>ตำแหน่งงาน</th><th>เบอร์โทรศัพท์</th></tr></thead>
              <tbody>
                <tr><td>1</td><td>Davolio, Nancy</td><td>Sales Representative</td><td>(206) 555-9857</td></tr>
                <tr><td>2</td><td>Fuller, Andrew</td><td>Vice President, Sales</td><td>(206) 555-9482</td></tr>
                <tr><td>3</td><td>Leverling, Janet</td><td>Sales Representative</td><td>(206) 555-3412</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════ -->
<!-- SCREEN 11: SHIPPERS                               -->
<!-- ══════════════════════════════════════════════════ -->
<div id="shippers" class="screen">
  <div class="shell">
    <nav class="sidebar">
      <div class="sidebar-logo"><div class="logo-mark">NW</div><div><div class="logo-text">Northwind BMS</div></div></div>
      <div class="nav"><div class="nav-group"><div class="nav-label">ห่วงโซ่อุปทาน</div><button class="nav-item active" onclick="show('shippers')">บริษัทขนส่ง</button></div></div>
    </nav>
    <div class="main">
      <div class="topbar"><div class="breadcrumb"><span>ห่วงโซ่อุปทาน</span><span class="sep">/</span><span class="cur">บริษัทขนส่ง</span></div></div>
      <div class="page-content">
        <div class="page-header">
          <div><div class="page-title">บริษัทขนส่งสินค้า</div><div class="page-desc">ผู้ให้บริการโลจิสติกส์ภายนอก</div></div>
        </div>
        <div class="card">
          <div class="table-wrap">
            <table>
              <thead><tr><th>รหัส</th><th>ชื่อบริษัทขนส่ง</th><th>เบอร์โทรศัพท์ติดต่อ</th></tr></thead>
              <tbody>
                <tr><td>1</td><td>Speedy Express</td><td>(503) 555-9831</td></tr>
                <tr><td>2</td><td>United Package</td><td>(503) 555-3199</td></tr>
                <tr><td>3</td><td>Federal Shipping</td><td>(503) 555-9931</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════ -->
<!-- SCREEN 12: REPORTS                                -->
<!-- ══════════════════════════════════════════════════ -->
<div id="reports" class="screen">
  <div class="shell">
    <nav class="sidebar">
      <div class="sidebar-logo"><div class="logo-mark">NW</div><div><div class="logo-text">Northwind BMS</div></div></div>
      <div class="nav"><div class="nav-group"><div class="nav-label">วิเคราะห์</div><button class="nav-item active" onclick="show('reports')">รายงาน</button></div></div>
    </nav>
    <div class="main">
      <div class="topbar"><div class="breadcrumb"><span>วิเคราะห์</span><span class="sep">/</span><span class="cur">รายงาน</span></div></div>
      <div class="page-content">
        <div class="page-header">
          <div><div class="page-title">รายงานและวิเคราะห์ข้อมูล</div><div class="page-desc">สรุปยอดจำหน่ายและประสิทธิภาพคลังสินค้า</div></div>
          <button class="btn btn-primary" onclick="window.location.href='api/export_csv.php'">ดาวน์โหลดรายงานสินค้า (CSV)</button>
        </div>
        <div class="card">
          <p style="color: var(--ink-2); padding: 12px 0;">ระบบรายงานพร้อมส่งออกข้อมูลเป็นไฟล์มาตรฐานสำหรับประกอบการตัดสินใจของผู้บริหาร</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// ฟังก์ชันสลับหน้าจอ (SPA Navigation)
function show(id) {
  document.querySelectorAll('.screen').forEach(s => s.classList.remove('active'));
  document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
  
  const target = document.getElementById(id);
  if (target) target.classList.add('active');
  
  const clickedBtn = [...document.querySelectorAll('.nav-tab')]
    .find(b => b.getAttribute('onclick') === `show('${id}')`);
  if (clickedBtn) clickedBtn.classList.add('active');
  
  window.scrollTo(0, 0);

  // โหลดข้อมูลตามหน้าจอที่เลือก
  if(id === 'dashboard') loadDashboardStats();
  if(id === 'products') loadProducts();
  if(id === 'categories') loadCategories();
  if(id === 'customers') loadCustomers();
  if(id === 'suppliers') loadSuppliers();
}

// 1. โหลดข้อมูลสินค้า (Products)
async function loadProducts() {
    const tbody = document.getElementById('productTableBody');
    if(!tbody) return;

    tbody.innerHTML = '<tr><td colspan="8" style="text-align:center; padding: 24px;">กำลังดำเนินการโหลดข้อมูล...</td></tr>';

    try {
        const response = await fetch('api/products.php'); 
        const result = await response.json();

        if (result.status === 'success') {
            tbody.innerHTML = ''; 
            
            result.data.forEach(item => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td style="font-family:'IBM Plex Mono'">${item.i_ProductID}</td>
                    <td style="font-weight:600">${item.c_ProductName}</td>
                    <td><span class="badge badge-gray">ID: ${item.i_CategoryID}</span></td>
                    <td>SUP-${item.i_SupplierID}</td>
                    <td>${item.c_Unit}</td>
                    <td style="font-weight:700;font-family:'IBM Plex Mono'">฿${parseFloat(item.i_Price).toFixed(2)}</td>
                    <td><span class="badge badge-green">ปกติ</span></td>
                    <td>
                        <button class="btn btn-outline btn-sm" onclick="editProduct(${item.i_ProductID})">แก้ไข</button>
                        <button class="btn btn-outline btn-sm" style="color: var(--danger); border-color: var(--danger);" onclick="deleteProduct(${item.i_ProductID})">ลบ</button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
            
            // อัปเดตสถิติตัวเลขหน้าแดชบอร์ดทันที
            updateDashboardCounters(result.data.length);
        }
    } catch (error) {
        console.error('Error:', error);
        tbody.innerHTML = '<tr><td colspan="8" style="text-align:center;color:red; padding: 24px;">ระบบไม่สามารถเชื่อมต่อฐานข้อมูลได้</td></tr>';
    }
}

// 2. ฟังก์ชันลบสินค้า
async function deleteProduct(id) {
    if(!confirm('คุณต้องการลบข้อมูลผลิตภัณฑ์รหัส ' + id + ' ออกจากระบบใช่หรือไม่?')) return;
    
    const formData = new FormData();
    formData.append('ProductID', id);

    try {
        const response = await fetch('api/delete_product.php', { method: 'POST', body: formData });
        const result = await response.json();
        
        if(result.status === 'success') {
            alert(result.message);
            loadProducts(); 
        } else {
            alert('ข้อผิดพลาด: ' + result.message);
        }
    } catch(error) {
        console.error('Error:', error);
        alert('เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์');
    }
}

// 3. ฟังก์ชันดึงข้อมูลมาแก้ไข
async function editProduct(id) {
    try {
        const response = await fetch('api/get_product.php?id=' + id);
        const result = await response.json();

        if (result.status === 'success') {
            const data = result.data;
            const form = document.getElementById('frmAddProduct');
            
            let idInput = document.getElementById('edit_ProductID');
            if(!idInput) {
                idInput = document.createElement('input');
                idInput.type = 'hidden';
                idInput.id = 'edit_ProductID';
                idInput.name = 'ProductID';
                form.appendChild(idInput);
            }
            idInput.value = data.i_ProductID;

            form.querySelector('[name="ProductName"]').value = data.c_ProductName;
            form.querySelector('[name="CatID"]').value = data.i_CategoryID;
            form.querySelector('[name="SupplierID"]').value = data.i_SupplierID;
            form.querySelector('[name="Unit"]').value = data.c_Unit;
            form.querySelector('[name="Price"]').value = data.i_Price;

            form.action = 'api/update_product.php';
            document.getElementById('formTitle').innerHTML = 'แก้ไขข้อมูลผลิตภัณฑ์ (ID: ' + data.i_ProductID + ')';
            document.getElementById('submitBtnText').innerHTML = 'อัปเดตข้อมูลผลิตภัณฑ์';

            show('product-form');
        } else {
            alert('ไม่สามารถดึงข้อมูลได้: ' + result.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('เกิดข้อผิดพลาดในการเชื่อมต่อเซิร์ฟเวอร์');
    }
}

// 4. รีเซ็ตฟอร์มกลับเป็นโหมดเพิ่มข้อมูล
function resetFormToAdd() {
    const form = document.getElementById('frmAddProduct');
    form.reset();
    form.action = 'api/insert_product.php';
    document.getElementById('formTitle').innerHTML = 'บันทึกข้อมูลผลิตภัณฑ์';
    document.getElementById('submitBtnText').innerHTML = 'บันทึกข้อมูลเข้าสู่ระบบ';
    const idInput = document.getElementById('edit_ProductID');
    if(idInput) idInput.value = '';
}

// จัดการ Submit ฟอร์ม (เพิ่ม/แก้ไข)
document.getElementById('frmAddProduct').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = this;
    const formData = new FormData(form);
    const submitBtn = document.getElementById('submitBtnText');
    const originalText = submitBtn.innerHTML;

    submitBtn.innerHTML = 'กำลังดำเนินการ...';
    submitBtn.disabled = true;

    try {
        const response = await fetch(form.action, { method: 'POST', body: formData });
        const result = await response.json();

        if (result.status === 'success') {
            alert(result.message);
            resetFormToAdd();
            loadProducts();
            show('products');
        } else {
            alert('ข้อผิดพลาด: ' + result.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์');
    } finally {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }
});

// 5. โหลดข้อมูลหมวดหมู่ (Categories)
async function loadCategories() {
    const tbody = document.getElementById('categoryTableBody');
    if(!tbody) return;
    tbody.innerHTML = '<tr><td colspan="3" style="text-align:center; padding:20px;">กำลังโหลดข้อมูล...</td></tr>';
    try {
        const res = await fetch('api/categories.php');
        const json = await res.json();
        if(json.status === 'success') {
            tbody.innerHTML = '';
            json.data.forEach(item => {
                tbody.innerHTML += `
                    <tr>
                        <td style="font-family:'IBM Plex Mono'">${item.i_CategoryID}</td>
                        <td style="font-weight:600">${item.c_CategoryName}</td>
                        <td>${item.c_Description || 'หมวดหมู่สินค้าในระบบ Northwind'}</td>
                    </tr>`;
            });
            document.getElementById('statTotalCategories').innerHTML = json.data.length;
        }
    } catch (err) {
        tbody.innerHTML = '<tr><td colspan="3" style="text-align:center; color:red;">ไม่สามารถเชื่อมต่อฐานข้อมูลได้</td></tr>';
    }
}
// 6. โหลดข้อมูลลูกค้า (Customers)
async function loadCustomers() {
    const tbody = document.getElementById('customerTableBody');
    if(!tbody) return;
    tbody.innerHTML = '<tr><td colspan="4" style="text-align:center; padding:20px;">กำลังโหลดข้อมูล...</td></tr>';
    try {
        const res = await fetch('api/customers_list.php');
        const json = await res.json();
        if(json.status === 'success') {
            tbody.innerHTML = '';
            json.data.forEach(item => {
                // ดึงค่าตามชื่อคอลัมน์ที่เป็นตัวพิมพ์เล็กตามฐานข้อมูลจริง
                const custId = item.i_customerid || '-';
                const compName = item.c_customername || '-';
                const contact = item.c_contactname || '-';
                const city = item.c_city || '';
                const country = item.c_country || '';

                tbody.innerHTML += `
                    <tr>
                        <td style="font-family:'IBM Plex Mono'">${custId}</td>
                        <td style="font-weight:600">${compName}</td>
                        <td>${contact}</td>
                        <td>${city}, ${country}</td>
                    </tr>`;
            });
        }
    } catch (err) {
        tbody.innerHTML = '<tr><td colspan="4" style="text-align:center; color:red;">ไม่สามารถเชื่อมต่อฐานข้อมูลได้</td></tr>';
    }
}
// 7. โหลดข้อมูลผู้จัดจำหน่าย (Suppliers)
async function loadSuppliers() {
    const tbody = document.getElementById('supplierTableBody');
    if(!tbody) return;
    tbody.innerHTML = '<tr><td colspan="4" style="text-align:center; padding:20px;">กำลังโหลดข้อมูล...</td></tr>';
    try {
        const res = await fetch('api/suppliers_list.php');
        const json = await res.json();
        if(json.status === 'success') {
            tbody.innerHTML = '';
            json.data.forEach(item => {
                // ดึงค่าตามชื่อคอลัมน์จริงจากฐานข้อมูลเป๊ะๆ
                const supId = item.i_SupplierID || '-';
                const compName = item.c_SupplierName || '-';
                const contact = item.c_ContactName || '-';
                const country = item.c_Country || '-';
                
                tbody.innerHTML += `
                    <tr>
                        <td style="font-family:'IBM Plex Mono'">${supId}</td>
                        <td style="font-weight:600">${compName}</td>
                        <td>${contact}</td>
                        <td>${country}</td>
                    </tr>`;
            });
        }
    } catch (err) {
        tbody.innerHTML = '<tr><td colspan="4" style="text-align:center; color:red;">ข้อผิดพลาดฐานข้อมูล</td></tr>';
    }
}
// 8. อัปเดตตัวเลขสถิติหน้าแดชบอร์ดแบบ Real-time
function updateDashboardCounters(count) {
    const prodCountEl = document.getElementById('statTotalProducts');
    const progCountEl = document.getElementById('progProductsCount');
    if(prodCountEl) prodCountEl.innerHTML = count;
    if(progCountEl) progCountEl.innerHTML = count + ' รายการ';
}

async function loadDashboardStats() {
    // โหลดข้อมูลเบื้องต้นเพื่ออัปเดตสถิติตัวเลขหน้าแดชบอร์ด
    loadProducts();
    loadCategories();
}

// โหลดข้อมูลเริ่มต้นเมื่อเปิดหน้าเว็บ
document.addEventListener('DOMContentLoaded', () => {
    loadProducts();
    loadCategories();
    loadCustomers();
});
</script>

</body>
</html>