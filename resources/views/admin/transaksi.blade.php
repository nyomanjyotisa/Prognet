@extends('layouts.adminApp')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Transaction</h4>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Jatuh Tempo Pembayaran</th>
                  <th>ID Transaksi</th>
                  <th>Alamat</th>
                  <th>Kota</th>
                  <th>Provinsi</th>
                  <th>Total Pembayaran</th>
                  <th>Status</th>
                  <th>Opsi</th>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection