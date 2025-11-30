@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header bg-primary text-white text-center py-4">
                <h3 class="fw-light my-0"><i class="bi bi-ticket-fill me-2"></i>Buat Tiket Baru</h3>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data" id="ticket-form">
                    @csrf
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori Masalah<span class="text-danger">*</span></label>
                        <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <option value="AC Rusak" {{ old('kategori') == 'AC Rusak' ? 'selected' : '' }}>AC Rusak</option>
                            <option value="Proyektor Mati" {{ old('kategori') == 'Proyektor Mati' ? 'selected' : '' }}>Proyektor Mati</option>
                            <option value="Kursi Rusak" {{ old('kategori') == 'Kursi Rusak' ? 'selected' : '' }}>Kursi Rusak</option>
                            <option value="Lampu Mati" {{ old('kategori') == 'Lampu Mati' ? 'selected' : '' }}>Lampu Mati</option>
                            <option value="Jaringan Internet" {{ old('kategori') == 'Jaringan Internet' ? 'selected' : '' }}>Jaringan Internet</option>
                            <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="lokasi_select" class="form-label">Lokasi<span class="text-danger">*</span></label>
                        <select class="form-select @error('lokasi') is-invalid @enderror" id="lokasi_select">
                            <option value="">Pilih Lokasi</option>
                            <option value="Gedung D3">Gedung D3</option>
                            <option value="Gedung D4">Gedung D4</option>
                            <option value="Gedung Energi">Gedung Energi</option>
                            <option value="Gedung SAW">Gedung SAW</option>
                            <option value="Gedung Pasca Sarjana">Gedung Pasca Sarjana</option>
                            <option value="Perpustakaan">Perpustakaan</option>
                            <option value="Kantin Foodlab">Kantin Foodlab</option>
                            <option value="Gedung PUT">Gedung PUT</option>
                            <option value="Gedung Student Center">Gedung Student Center</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        <input type="hidden" name="lokasi" id="lokasi" value="{{ old('lokasi') }}">
                         @error('lokasi')
                            <div class="d-block invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3" id="ruangan_div" style="display: none;">
                        <label for="ruangan" class="form-label">Nama Ruangan<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="ruangan" placeholder="Contoh: D3-101">
                    </div>

                    <div class="mb-3" id="perpustakaan_div" style="display: none;">
                        <label for="perpustakaan_select" class="form-label">Pilih Perpustakaan<span class="text-danger">*</span></label>
                        <select class="form-select" id="perpustakaan_select">
                            <option value="">Pilih Jenis Perpustakaan</option>
                            <option value="Perpustakaan D3">Perpustakaan D3</option>
                            <option value="Perpustakaan D4">Perpustakaan D4</option>
                            <option value="Perpustakaan Pascasarjana">Perpustakaan Pascasarjana</option>
                        </select>
                    </div>

                    <div class="mb-3" id="lokasi_custom_div" style="display: none;">
                        <label for="lokasi_custom" class="form-label">Lokasi Lainnya<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="lokasi_custom">
                    </div>
                    
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Masalah<span class="text-danger">*</span></label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="foto" class="form-label">Upload Foto (Opsional)</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*">
                        @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-send-fill me-2"></i>Submit Tiket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lokasiSelect = document.getElementById('lokasi_select');
        const lokasiHiddenInput = document.getElementById('lokasi');

        const ruanganDiv = document.getElementById('ruangan_div');
        const ruanganInput = document.getElementById('ruangan');
        
        const perpustakaanDiv = document.getElementById('perpustakaan_div');
        const perpustakaanSelect = document.getElementById('perpustakaan_select');

        const lokasiCustomDiv = document.getElementById('lokasi_custom_div');
        const lokasiCustomInput = document.getElementById('lokasi_custom');

        function updateLokasi() {
            const selectedLokasi = lokasiSelect.value;
            let finalLokasi = selectedLokasi;

            if (selectedLokasi.startsWith('Gedung')) {
                finalLokasi = ruanganInput.value ? `${selectedLokasi} - ${ruanganInput.value}` : '';
            } else if (selectedLokasi === 'Perpustakaan') {
                finalLokasi = perpustakaanSelect.value;
            } else if (selectedLokasi === 'Lainnya') {
                finalLokasi = lokasiCustomInput.value;
            }

            lokasiHiddenInput.value = finalLokasi;
        }

        function toggleInputs() {
            const selectedLokasi = lokasiSelect.value;

            ruanganDiv.style.display = 'none';
            ruanganInput.removeAttribute('required');
            
            perpustakaanDiv.style.display = 'none';
            perpustakaanSelect.removeAttribute('required');

            lokasiCustomDiv.style.display = 'none';
            lokasiCustomInput.removeAttribute('required');

            if (selectedLokasi.startsWith('Gedung')) {
                ruanganDiv.style.display = 'block';
                ruanganInput.setAttribute('required', 'required');
            } else if (selectedLokasi === 'Perpustakaan') {
                perpustakaanDiv.style.display = 'block';
                perpustakaanSelect.setAttribute('required', 'required');
            } else if (selectedLokasi === 'Lainnya') {
                lokasiCustomDiv.style.display = 'block';
                lokasiCustomInput.setAttribute('required', 'required');
            }
            updateLokasi();
        }

        lokasiSelect.addEventListener('change', toggleInputs);
        ruanganInput.addEventListener('input', updateLokasi);
        perpustakaanSelect.addEventListener('change', updateLokasi);
        lokasiCustomInput.addEventListener('input', updateLokasi);

        // Handle form validation errors and re-populate fields
        const oldLokasi = '{{ old('lokasi') }}';
        if (oldLokasi) {
            const parts = oldLokasi.split(' - ');
            const mainLokasi = parts[0];
            const subLokasi = parts.length > 1 ? parts.slice(1).join(' - ') : '';

            if (mainLokasi.startsWith('Gedung') && [...lokasiSelect.options].some(o => o.value === mainLokasi)) {
                lokasiSelect.value = mainLokasi;
                ruanganInput.value = subLokasi;
            } else if (oldLokasi.startsWith('Perpustakaan')) {
                if ([...perpustakaanSelect.options].some(o => o.value === oldLokasi)) {
                    lokasiSelect.value = 'Perpustakaan';
                    perpustakaanSelect.value = oldLokasi;
                }
            } else if ([...lokasiSelect.options].some(o => o.value === oldLokasi)) {
                lokasiSelect.value = oldLokasi;
            } else {
                lokasiSelect.value = 'Lainnya';
                lokasiCustomInput.value = oldLokasi;
            }
        }
        
        toggleInputs();

        document.getElementById('ticket-form').addEventListener('submit', function(e) {
            //e.preventDefault(); // Uncomment for debugging
            updateLokasi();
            // console.log('Final lokasi value:', lokasiHiddenInput.value); // Uncomment for debugging
        });
    });
</script>
@endpush