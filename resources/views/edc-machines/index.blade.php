
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Lokasi Mesin EDC</h2>
    <a href="{{ route('edc-machines.create') }}" class="btn btn-primary mb-3">Create New</a>
    <a href="/maps" class="btn btn-success mb-3">Lihat Peta</a>
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari...">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Serial Number</th>
                <th>Address</th>
                
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="edcTableBody">
                @foreach($edcMachines as $edcMachine)
                <tr>
                    <td>{{ $edcMachine->name }}</td>
                    <td>{{ $edcMachine->serial_number }}</td>
                    <td>{{ $edcMachine->address }}</td>
                    
                    <td>
                        @if($edcMachine->status == 'already exist')
                        Sudah Ada
                        @else Belum Ada @endif
                    </td>
                    <td>
                        <a href="{{ route('edc-machines.edit', $edcMachine) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('edc-machines.destroy', $edcMachine) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
    </table>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('edcTableBody');
        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase();
            const rows = tableBody.querySelectorAll('tr');
            rows.forEach(row => {
                const rowData = row.textContent.toLowerCase();
                row.style.display = rowData.includes(searchTerm) ? '' : 'none';
            });
        });
    });
</script>
@endsection