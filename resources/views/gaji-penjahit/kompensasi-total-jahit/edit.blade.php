@extends('gaji-penjahit.layout.app', ['title' => 'Kompensasi Total Jahit'])
@section('content')
    <h3>Kompensasi Total Jahit</h3>
    <div class="card mb-4">
        <div class="card-body">
            <div class="form-group w-100 pr-2 mb-0">
                <label class="mb-0" for="inputMin">Nama Penjahit :</label>
                <h4 class="mb-0 d-block font-weight-bold">AZIZAH</h4>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header py-3">
            <div class="d-flex">
                <div class="form-group mb-0 w-100 mr-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" min="0" class="form-control" placeholder="Masukan jumlah minimal">
                    </div>
                </div>
                <div class="form-group mb-0 pr-2">
                    <select id="inclusiveMin" class="form-control w-auto selectpicker">
                        <option>≤</option>
                        <option><</option>
                    </select>
                </div>
                <div class="form-group mb-0 pr-2">
                    <div class="form-control text-nowrap">[INPUT]</div>
                </div>
                <div class="form-group mb-0 pr-2">
                    <select id="inclusiveMin" class="form-control w-auto selectpicker">
                        <option>≤</option>
                        <option><</option>
                    </select>
                </div>
                <div class="form-group mb-0 w-100 mr-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" min="0" class="form-control" placeholder="Masukan jumlah maksimal">
                    </div>
                </div>
                <span class="mr-2 pt-2">=</span>
                <div class="form-group mb-0 w-100 mr-2">
                    <div class="input-group">
                        <input type="number" min="0" class="form-control" placeholder="Masukan nilai kompensasi">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                          </div>
                    </div>
                </div>
                <button type="button" class="ml-auto btn btn-primary text-nowrap">+ Tambah</button>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <div class="form-group w-100 mr-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" min="0" class="form-control" placeholder="Masukan jumlah minimal">
                    </div>
                </div>
                <div class="form-group pr-2">
                    <select id="inclusiveMin" class="form-control w-auto selectpicker">
                        <option>≤</option>
                        <option><</option>
                    </select>
                </div>
                <div class="form-group pr-2">
                    <div class="form-control text-nowrap">[INPUT]</div>
                </div>
                <div class="form-group pr-2">
                    <select id="inclusiveMin" class="form-control w-auto selectpicker">
                        <option>≤</option>
                        <option><</option>
                    </select>
                </div>
                <div class="form-group w-100 mr-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" min="0" class="form-control" placeholder="Masukan jumlah maksimal">
                    </div>
                </div>
                <span class="mr-2 pt-2">=</span>
                <div class="form-group w-100">
                    <div class="input-group">
                        <input type="number" min="0" class="form-control" placeholder="Masukan nilai kompensasi">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                          </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="form-group w-100 mr-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" min="0" class="form-control" placeholder="Masukan jumlah minimal">
                    </div>
                </div>
                <div class="form-group pr-2">
                    <select id="inclusiveMin" class="form-control w-auto selectpicker">
                        <option>≤</option>
                        <option><</option>
                    </select>
                </div>
                <div class="form-group pr-2">
                    <div class="form-control text-nowrap">[INPUT]</div>
                </div>
                <div class="form-group pr-2">
                    <select id="inclusiveMin" class="form-control w-auto selectpicker">
                        <option>≤</option>
                        <option><</option>
                    </select>
                </div>
                <div class="form-group w-100 mr-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" min="0" class="form-control" placeholder="Masukan jumlah maksimal">
                    </div>
                </div>
                <span class="mr-2 pt-2">=</span>
                <div class="form-group w-100">
                    <div class="input-group">
                        <input type="number" min="0" class="form-control" placeholder="Masukan nilai kompensasi">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                          </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="form-group w-100 mr-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" min="0" class="form-control" placeholder="Masukan jumlah minimal">
                    </div>
                </div>
                <div class="form-group pr-2">
                    <select id="inclusiveMin" class="form-control w-auto selectpicker">
                        <option>≤</option>
                        <option><</option>
                    </select>
                </div>
                <div class="form-group pr-2">
                    <div class="form-control text-nowrap">[INPUT]</div>
                </div>
                <div class="form-group pr-2">
                    <select id="inclusiveMin" class="form-control w-auto selectpicker">
                        <option>≤</option>
                        <option><</option>
                    </select>
                </div>
                <div class="form-group w-100 mr-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" min="0" class="form-control" placeholder="Masukan jumlah maksimal">
                    </div>
                </div>
                <span class="mr-2 pt-2">=</span>
                <div class="form-group w-100">
                    <div class="input-group">
                        <input type="number" min="0" class="form-control" placeholder="Masukan nilai kompensasi">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                          </div>
                    </div>
                </div>
            </div>
            <div class="form-group d-flex justify-content-end w-100">
                <button type="button" class="ml-auto btn btn-primary text-nowrap">Simpan</button>
            </div>
        </div>
    </div>
@endsection
