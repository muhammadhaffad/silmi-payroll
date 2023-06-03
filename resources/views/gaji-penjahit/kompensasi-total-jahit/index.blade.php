@extends('gaji-penjahit.layout.app', ['title' => 'Kompensasi Total Jahit'])
@section('content')
    <h3>Kompensasi Total Jahit</h3>
    <div class="card">
        <div class="card-header d-flex">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="w-100">Nama Penjahit</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse (App\Models\Tailor\Employee::all() as $employee)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                {{$employee->nama}}
                            </td>
                            <td class="d-flex">
                                <a href="{{route('pengaturan.kompensasi-total-jahit.lihat', ['id' => $employee->id])}}" class="btn btn-primary btn-xs btn-action mr-1" title="Edit">
                                    <i class="fas fa-edit">
                                    </i>
                                </a>
                                {{-- <button class="btn btn-danger btn-xs delete-data mr-1" title="hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button> --}}
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="3">Data Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
