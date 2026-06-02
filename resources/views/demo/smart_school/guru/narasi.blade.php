@extends('layouts.smart_school')

@section('title', 'Generator Narasi Rapor - Smart School')
@section('page_header', 'Generator Narasi Rapor')
@section('page_subtitle', 'Buat narasi rapor otomatis berdasarkan nilai asesmen siswa.')
@section('breadcrumb', '<a href="/demo/smart-school/guru">Guru</a> / <a href="/demo/smart-school/guru/narasi">Administrasi</a> / <span>Generator Narasi</span>')

@section('styles')
<style>
    .select-student { max-width:400px; margin-bottom:1.5rem; }
    .select-student select { width:100%; padding:0.7rem 1rem; border:1px solid var(--border); border-radius:12px; font-size:0.85rem; background:var(--bg-card); color:var(--text-main); outline:none; }
    .narasi-box { width:100%; min-height:150px; padding:1rem; border:1px solid var(--border); border-radius:16px; font-size:0.85rem; font-family:'Inter',sans-serif; background:var(--bg-card); color:var(--text-main); outline:none; resize:vertical; line-height:1.7; margin-top:0.5rem; }
    .narasi-box:focus { border-color:var(--primary); }
    .score-label { font-size:0.75rem; color:var(--text-sub); margin-bottom:0.2rem; }
    .ket-card { padding:0.75rem 1rem; border-radius:12px; font-size:0.8rem; border:1px solid var(--border); }
</style>
@endsection

@section('content')
<div class="modern-card">
    <h4 style="font-size:1rem;font-weight:700;margin-bottom:1rem;"><i data-lucide="user" style="width:18px;color:var(--primary);"></i> Pilih Siswa</h4>
    <div class="select-student">
        <select id="studentSelect" onchange="updateNarasi()">
            <option value="">-- Pilih Siswa --</option>
            <option value="Ahmad Fauzi" data-topik="Barisan dan Deret, Trigonometri" data-rendah="Limit Fungsi">Ahmad Fauzi</option>
            <option value="Budi Santoso" data-topik="Vektor, Matriks" data-rendah="Peluang">Budi Santoso</option>
            <option value="Citra Dewi" data-topik="Semua topik" data-rendah="-">Citra Dewi</option>
            <option value="Dian Permata" data-topik="Dasar-dasar" data-rendah="Trigonometri, Limit">Dian Permata</option>
            <option value="Eko Prasetyo">Eko Prasetyo</option>
            <option value="Fitri Handayani">Fitri Handayani</option>
            <option value="Gilang Ramadhan">Gilang Ramadhan</option>
            <option value="Hesti Wulandari">Hesti Wulandari</option>
            <option value="Indra Lesmana">Indra Lesmana</option>
            <option value="Joko Susilo">Joko Susilo</option>
        </select>
    </div>
</div>

<div id="narasiResult" style="display:none;">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; margin-top:1.25rem;">
        <div class="modern-card">
            <h4 style="font-size:1rem;font-weight:700;margin-bottom:1rem;"><i data-lucide="bar-chart-3" style="width:18px;color:var(--primary);"></i> Nilai per Mapel</h4>
            <div class="table-wrapper">
                <table>
                    <thead><tr><th>Mapel</th><th>Nilai</th><th>Predikat</th></tr></thead>
                    <tbody>
                        <tr><td>Matematika Wajib</td><td><span class="score-high">82</span></td><td><span class="badge-green">Baik</span></td></tr>
                        <tr><td>Matematika Peminatan</td><td><span class="score-high">78</span></td><td><span class="badge-green">Baik</span></td></tr>
                        <tr><td>Fisika</td><td><span class="score-low">65</span></td><td><span class="badge-red">Kurang</span></td></tr>
                        <tr><td>Kimia</td><td><span class="score-high">88</span></td><td><span class="badge-green">Sangat Baik</span></td></tr>
                        <tr><td>Biologi</td><td><span class="score-high">75</span></td><td><span class="badge-green">Baik</span></td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modern-card">
            <h4 style="font-size:1rem;font-weight:700;margin-bottom:1rem;"><i data-lucide="file-text" style="width:18px;color:var(--primary);"></i> Narasi Rapor</h4>
            <textarea class="narasi-box" id="narasiText">Berdasarkan hasil asesmen, [Nama] menunjukkan pemahaman yang baik pada materi Barisan dan Deret, Trigonometri. Namun perlu ditingkatkan pada Limit Fungsi. Secara umum, [Nama] memiliki motivasi belajar yang tinggi dan aktif dalam diskusi kelas. Disarankan untuk mengikuti remedial pada topik yang masih kurang.</textarea>
            <div style="margin-top:0.75rem; display:flex; gap:0.75rem; justify-content:flex-end;">
                <button class="btn-outline-sm" onclick="alert('Demo: edit manual narasi');"><i data-lucide="edit" style="width:16px;"></i> Edit Manual</button>
                <button class="btn-indigo" onclick="alert('Demo: narasi disimpan');"><i data-lucide="save" style="width:16px;"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
function updateNarasi() {
    var sel = document.getElementById('studentSelect');
    var result = document.getElementById('narasiResult');
    if (sel.value) {
        result.style.display = 'block';
        var name = sel.value;
        var topik = sel.options[sel.selectedIndex].getAttribute('data-topik') || 'berbagai topik';
        var rendah = sel.options[sel.selectedIndex].getAttribute('data-rendah') || 'beberapa topik';
        if (rendah === '-') {
            document.getElementById('narasiText').value = 'Berdasarkan hasil asesmen, ' + name + ' menunjukkan pemahaman yang sangat baik pada semua topik yang diujikan. ' + name + ' aktif dalam pembelajaran dan mampu mengerjakan soal-soal dengan baik. Pertahankan prestasinya!';
        } else {
            document.getElementById('narasiText').value = 'Berdasarkan hasil asesmen, ' + name + ' menunjukkan pemahaman yang baik pada materi ' + topik + '. Namun perlu ditingkatkan pada ' + rendah + '. Disarankan untuk mengikuti program remedial dan bimbingan tambahan.';
        }
    } else {
        result.style.display = 'none';
    }
}
window.updateNarasi = updateNarasi;
</script>
@endsection
@endsection
