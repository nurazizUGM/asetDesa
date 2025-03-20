<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex">
<title>Export: app - db - Adminer</title>
<link rel="stylesheet" type="text/css" href="?file=default.css&amp;version=4.8.1">
<script src='?file=functions.js&amp;version=4.8.1' nonce="NWQyOWM2ZDU2ZDFlOGU1Yzk2NGQ4MGQ4MTdlMjQ4MTc="></script>
<link rel="shortcut icon" type="image/x-icon" href="?file=favicon.ico&amp;version=4.8.1">
<link rel="apple-touch-icon" href="?file=favicon.ico&amp;version=4.8.1">

<body class="ltr nojs">
<script nonce="NWQyOWM2ZDU2ZDFlOGU1Yzk2NGQ4MGQ4MTdlMjQ4MTc=">
mixin(document.body, {onkeydown: bodyKeydown, onclick: bodyClick});
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = 'You are offline.';
var thousandsSeparator = ',';
</script>

<div id="help" class="jush-sql jsonly hidden"></div>
<script nonce="NWQyOWM2ZDU2ZDFlOGU1Yzk2NGQ4MGQ4MTdlMjQ4MTc=">mixin(qs('#help'), {onmouseover: function () { helpOpen = 1; }, onmouseout: helpMouseout});</script>

<div id="content">
<p id="breadcrumb"><a href="?server=db">MySQL</a> &raquo; <a href='?server=db&amp;username=user' accesskey='1' title='Alt+Shift+1'>db</a> &raquo; <a href="?server=db&amp;username=user&amp;db=app">app</a> &raquo; Export
<h2>Export: app</h2>
<div id='ajaxstatus' class='jsonly hidden'></div>
<div class='error'>Too big POST data. Reduce the data or increase the 'post_max_size' configuration directive.</div>

<form action="" method="post">
<table cellspacing="0" class="layout">
<tr><th>Output<td><label><input type='radio' name='output' value='text' checked>open</label><label><input type='radio' name='output' value='file'>save</label><label><input type='radio' name='output' value='gz'>gzip</label>
<tr><th>Format<td><label><input type='radio' name='format' value='sql' checked>SQL</label><label><input type='radio' name='format' value='csv'>CSV,</label><label><input type='radio' name='format' value='csv;'>CSV;</label><label><input type='radio' name='format' value='tsv'>TSV</label>
<tr><th>Database<td><select name='db_style'><option selected><option>USE<option>DROP+CREATE<option>CREATE</select><label><input type='checkbox' name='routines' value='1'>Routines</label><label><input type='checkbox' name='events' value='1'>Events</label><tr><th>Tables<td><select name='table_style'><option><option>DROP+CREATE<option selected>CREATE</select><label><input type='checkbox' name='auto_increment' value='1'>Auto Increment</label><label><input type='checkbox' name='triggers' value='1'>Triggers</label><tr><th>Data<td><select name='data_style'><option selected><option>TRUNCATE+INSERT<option>INSERT<option>INSERT+UPDATE</select></table>
<p><input type="submit" value="Export">
<input type="hidden" name="token" value="231332:157129">

<table cellspacing="0">
<script nonce="NWQyOWM2ZDU2ZDFlOGU1Yzk2NGQ4MGQ4MTdlMjQ4MTc=">qsl('table').onclick = dumpClick;</script>
<thead><tr><th style='text-align: left;'><label class='block'><input type='checkbox' id='check-tables'>Tables</label><script nonce="NWQyOWM2ZDU2ZDFlOGU1Yzk2NGQ4MGQ4MTdlMjQ4MTc=">qs('#check-tables').onclick = partial(formCheck, /^tables\[/);</script><th style='text-align: right;'><label class='block'>Data<input type='checkbox' id='check-data'></label><script nonce="NWQyOWM2ZDU2ZDFlOGU1Yzk2NGQ4MGQ4MTdlMjQ4MTc=">qs('#check-data').onclick = partial(formCheck, /^data\[/);</script></thead>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='asets' checked>asets</label><td align='right'><label class='block'><span id='Rows-asets'></span><input type='checkbox' name='data[]' value='asets' checked></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='aset_gedung_bangunan'>aset_gedung_bangunan</label><td align='right'><label class='block'><span id='Rows-aset_gedung_bangunan'></span><input type='checkbox' name='data[]' value='aset_gedung_bangunan'></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='aset_peralatan_mesin'>aset_peralatan_mesin</label><td align='right'><label class='block'><span id='Rows-aset_peralatan_mesin'></span><input type='checkbox' name='data[]' value='aset_peralatan_mesin'></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='aset_tanah'>aset_tanah</label><td align='right'><label class='block'><span id='Rows-aset_tanah'></span><input type='checkbox' name='data[]' value='aset_tanah'></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='barang'>barang</label><td align='right'><label class='block'><span id='Rows-barang'></span><input type='checkbox' name='data[]' value='barang'></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='data_aset'>data_aset</label><td align='right'><label class='block'><span id='Rows-data_aset'></span><input type='checkbox' name='data[]' value='data_aset'></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='kategori_barang'>kategori_barang</label><td align='right'><label class='block'><span id='Rows-kategori_barang'></span><input type='checkbox' name='data[]' value='kategori_barang'></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='keputusan_pengadaan'>keputusan_pengadaan</label><td align='right'><label class='block'><span id='Rows-keputusan_pengadaan'></span><input type='checkbox' name='data[]' value='keputusan_pengadaan'></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='kriteria_kualitas'>kriteria_kualitas</label><td align='right'><label class='block'><span id='Rows-kriteria_kualitas'></span><input type='checkbox' name='data[]' value='kriteria_kualitas'></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='kriteria_spesifikasi'>kriteria_spesifikasi</label><td align='right'><label class='block'><span id='Rows-kriteria_spesifikasi'></span><input type='checkbox' name='data[]' value='kriteria_spesifikasi'></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='lokasi_aset'>lokasi_aset</label><td align='right'><label class='block'><span id='Rows-lokasi_aset'></span><input type='checkbox' name='data[]' value='lokasi_aset'></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='monitoring_aset'>monitoring_aset</label><td align='right'><label class='block'><span id='Rows-monitoring_aset'></span><input type='checkbox' name='data[]' value='monitoring_aset'></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='pengadaan'>pengadaan</label><td align='right'><label class='block'><span id='Rows-pengadaan'></span><input type='checkbox' name='data[]' value='pengadaan'></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='penghapusan'>penghapusan</label><td align='right'><label class='block'><span id='Rows-penghapusan'></span><input type='checkbox' name='data[]' value='penghapusan'></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='users'>users</label><td align='right'><label class='block'><span id='Rows-users'></span><input type='checkbox' name='data[]' value='users'></label>
<script nonce="NWQyOWM2ZDU2ZDFlOGU1Yzk2NGQ4MGQ4MTdlMjQ4MTc=">ajaxSetHtml('?server=db&username=user&db=app&script=db');</script>
</table>
</form>
<p><a href='?server=db&amp;username=user&amp;db=app&amp;dump=aset%25'>aset</a> <a href='?server=db&amp;username=user&amp;db=app&amp;dump=kriteria%25'>kriteria</a></div>

<form action='' method='post'>
<div id='lang'>Language: <select name='lang'><option value="en" selected>English<option value="ar">العربية<option value="bg">Български<option value="bn">বাংলা<option value="bs">Bosanski<option value="ca">Català<option value="cs">Čeština<option value="da">Dansk<option value="de">Deutsch<option value="el">Ελληνικά<option value="es">Español<option value="et">Eesti<option value="fa">فارسی<option value="fi">Suomi<option value="fr">Français<option value="gl">Galego<option value="he">עברית<option value="hu">Magyar<option value="id">Bahasa Indonesia<option value="it">Italiano<option value="ja">日本語<option value="ka">ქართული<option value="ko">한국어<option value="lt">Lietuvių<option value="ms">Bahasa Melayu<option value="nl">Nederlands<option value="no">Norsk<option value="pl">Polski<option value="pt">Português<option value="pt-br">Português (Brazil)<option value="ro">Limba Română<option value="ru">Русский<option value="sk">Slovenčina<option value="sl">Slovenski<option value="sr">Српски<option value="sv">Svenska<option value="ta">த‌மிழ்<option value="th">ภาษาไทย<option value="tr">Türkçe<option value="uk">Українська<option value="vi">Tiếng Việt<option value="zh">简体中文<option value="zh-tw">繁體中文</select><script nonce="NWQyOWM2ZDU2ZDFlOGU1Yzk2NGQ4MGQ4MTdlMjQ4MTc=">qsl('select').onchange = function () { this.form.submit(); };</script> <input type='submit' value='Use' class='hidden'>
<input type='hidden' name='token' value='780880:657469'>
</div>
</form>
<form action="" method="post">
<p class="logout">
<input type="submit" name="logout" value="Logout" id="logout">
<input type="hidden" name="token" value="231332:157129">
</p>
</form>
<div id="menu">
<h1>
<a href='https://www.adminer.org/' target="_blank" rel="noreferrer noopener" id='h1'>Adminer</a> <span class="version">4.8.1</span>
<a href="https://www.adminer.org/#download" target="_blank" rel="noreferrer noopener" id="version"></a>
</h1>
<script src='?file=jush.js&amp;version=4.8.1' nonce="NWQyOWM2ZDU2ZDFlOGU1Yzk2NGQ4MGQ4MTdlMjQ4MTc="></script>
<script nonce="NWQyOWM2ZDU2ZDFlOGU1Yzk2NGQ4MGQ4MTdlMjQ4MTc=">
var jushLinks = { sql: [ '?server=db&username=user&db=app&table=$&', /\b(asets|aset_gedung_bangunan|aset_peralatan_mesin|aset_tanah|barang|data_aset|kategori_barang|keputusan_pengadaan|kriteria_kualitas|kriteria_spesifikasi|lokasi_aset|monitoring_aset|pengadaan|penghapusan|users)\b/g ] };
jushLinks.bac = jushLinks.sql;
jushLinks.bra = jushLinks.sql;
jushLinks.sqlite_quo = jushLinks.sql;
jushLinks.mssql_bra = jushLinks.sql;
bodyLoad('11', true);
</script>
<form action="">
<p id="dbs">
<input type="hidden" name="server" value="db"><input type="hidden" name="username" value="user"><span title='database'>DB</span>: <select name='db'><option value=""><option selected>app<option>information_schema</select><script nonce="NWQyOWM2ZDU2ZDFlOGU1Yzk2NGQ4MGQ4MTdlMjQ4MTc=">mixin(qsl('select'), {onmousedown: dbMouseDown, onchange: dbChange});</script>
<input type='submit' value='Use' class='hidden'>
<input type='hidden' name='dump' value=''></p></form>
<p class='links'><a href='?server=db&amp;username=user&amp;db=app&amp;sql='>SQL command</a>
<a href='?server=db&amp;username=user&amp;db=app&amp;import='>Import</a>
<a href='?server=db&amp;username=user&amp;db=app&amp;dump=' id='dump' class='active '>Export</a>
<a href="?server=db&amp;username=user&amp;db=app&amp;create=">Create table</a>
<ul id='tables'><script nonce="NWQyOWM2ZDU2ZDFlOGU1Yzk2NGQ4MGQ4MTdlMjQ4MTc=">mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});</script>
<li><a href="?server=db&amp;username=user&amp;db=app&amp;select=asets" class='select' title='Select data'>select</a> <a href="?server=db&amp;username=user&amp;db=app&amp;table=asets" class='structure' title='Show structure'>asets</a>
<li><a href="?server=db&amp;username=user&amp;db=app&amp;select=aset_gedung_bangunan" class='select' title='Select data'>select</a> <a href="?server=db&amp;username=user&amp;db=app&amp;table=aset_gedung_bangunan" class='structure' title='Show structure'>aset_gedung_bangunan</a>
<li><a href="?server=db&amp;username=user&amp;db=app&amp;select=aset_peralatan_mesin" class='select' title='Select data'>select</a> <a href="?server=db&amp;username=user&amp;db=app&amp;table=aset_peralatan_mesin" class='structure' title='Show structure'>aset_peralatan_mesin</a>
<li><a href="?server=db&amp;username=user&amp;db=app&amp;select=aset_tanah" class='select' title='Select data'>select</a> <a href="?server=db&amp;username=user&amp;db=app&amp;table=aset_tanah" class='structure' title='Show structure'>aset_tanah</a>
<li><a href="?server=db&amp;username=user&amp;db=app&amp;select=barang" class='select' title='Select data'>select</a> <a href="?server=db&amp;username=user&amp;db=app&amp;table=barang" class='structure' title='Show structure'>barang</a>
<li><a href="?server=db&amp;username=user&amp;db=app&amp;select=data_aset" class='select' title='Select data'>select</a> <a href="?server=db&amp;username=user&amp;db=app&amp;table=data_aset" class='structure' title='Show structure'>data_aset</a>
<li><a href="?server=db&amp;username=user&amp;db=app&amp;select=kategori_barang" class='select' title='Select data'>select</a> <a href="?server=db&amp;username=user&amp;db=app&amp;table=kategori_barang" class='structure' title='Show structure'>kategori_barang</a>
<li><a href="?server=db&amp;username=user&amp;db=app&amp;select=keputusan_pengadaan" class='select' title='Select data'>select</a> <a href="?server=db&amp;username=user&amp;db=app&amp;table=keputusan_pengadaan" class='structure' title='Show structure'>keputusan_pengadaan</a>
<li><a href="?server=db&amp;username=user&amp;db=app&amp;select=kriteria_kualitas" class='select' title='Select data'>select</a> <a href="?server=db&amp;username=user&amp;db=app&amp;table=kriteria_kualitas" class='structure' title='Show structure'>kriteria_kualitas</a>
<li><a href="?server=db&amp;username=user&amp;db=app&amp;select=kriteria_spesifikasi" class='select' title='Select data'>select</a> <a href="?server=db&amp;username=user&amp;db=app&amp;table=kriteria_spesifikasi" class='structure' title='Show structure'>kriteria_spesifikasi</a>
<li><a href="?server=db&amp;username=user&amp;db=app&amp;select=lokasi_aset" class='select' title='Select data'>select</a> <a href="?server=db&amp;username=user&amp;db=app&amp;table=lokasi_aset" class='structure' title='Show structure'>lokasi_aset</a>
<li><a href="?server=db&amp;username=user&amp;db=app&amp;select=monitoring_aset" class='select' title='Select data'>select</a> <a href="?server=db&amp;username=user&amp;db=app&amp;table=monitoring_aset" class='structure' title='Show structure'>monitoring_aset</a>
<li><a href="?server=db&amp;username=user&amp;db=app&amp;select=pengadaan" class='select' title='Select data'>select</a> <a href="?server=db&amp;username=user&amp;db=app&amp;table=pengadaan" class='structure' title='Show structure'>pengadaan</a>
<li><a href="?server=db&amp;username=user&amp;db=app&amp;select=penghapusan" class='select' title='Select data'>select</a> <a href="?server=db&amp;username=user&amp;db=app&amp;table=penghapusan" class='structure' title='Show structure'>penghapusan</a>
<li><a href="?server=db&amp;username=user&amp;db=app&amp;select=users" class='select' title='Select data'>select</a> <a href="?server=db&amp;username=user&amp;db=app&amp;table=users" class='structure' title='Show structure'>users</a>
</ul>
</div>
<script nonce="NWQyOWM2ZDU2ZDFlOGU1Yzk2NGQ4MGQ4MTdlMjQ4MTc=">setupSubmitHighlight(document);</script>
