@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Lokasi Mesin EDC</h2>

          @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('edc-machines.update', $edcMachine->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama Mesin</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $edcMachine->name ?? '') }}" required>
            </div>

            <div class="form-group">
    <label for="serial_number">Serial Number</label>
    <input type="text" class="form-control" id="serial_number" name="serial_number" value="{{ old('serial_number', $edcMachine->serial_number ?? '') }}"
        @if(old('status', $edcMachine->status ?? '') != 'already exist')
            disabled
        @endif>
</div>




            <div class="form-group">
                <label for="address">Alamat</label>
                <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address', $edcMachine->address ?? '') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="latitude">Latitude</label>
                        <input type="number" step="0.00000001" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $edcMachine->latitude ?? '') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="longitude">Longitude</label>
                        <input type="number" step="0.00000001" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $edcMachine->longitude ?? '') }}" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="already exist" {{ (old('status', $edcMachine->status ?? '') == 'already exist') ? 'selected' : '' }}>
                        Sudah Ada</option>
                    <option value="not exist" {{ (old('status', $edcMachine->status ?? '') == 'not exist') ? 'selected' : '' }}>
                        Belum Ada</option>
                </select>
            </div>
            <script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('status');
        const serialNumberInput = document.getElementById('serial_number');

        function updateSerialNumberField() {
            if (statusSelect.value === 'already exist') {
                serialNumberInput.disabled = false;
                serialNumberInput.required = true;
            } else {
                serialNumberInput.disabled = true;
                serialNumberInput.required = false;
                serialNumberInput.value = '';
            }
        }

        statusSelect.addEventListener('change', updateSerialNumberField);

        updateSerialNumberField(); 
    });
</script>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('edc-machines.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection