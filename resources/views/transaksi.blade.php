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
                @foreach ($transaksi ?? '' as $item)
                <tr> 
                  <td>
                    @if ($item->status == 'unverified' & $item->timeout > date('Y-m-d H:i:s'))
                    @php
                        date_default_timezone_set("Asia/Makassar");
                        $date1 = new DateTime($item->timeout);
                        $date2 = new DateTime(date('Y-m-d H:i:s'));
                        $tenggat = $date1->diff($date2);
                    @endphp
                          <span class="badge badge-danger">Sisa Waktu Pembayaran: {{$tenggat->h}} Jam, {{$tenggat->i}} Menit</span>
                     @endif
                  </td>               
                  <td>
                      <strong>{{$item->id}}</strong>
                  </td>
                  <td>
                      <strong>{{$item->address}}</strong>
                  </td>
                  <td>
                      <strong>{{$item->regency}}</strong>
                  </td>
                  <td>
                      <strong>{{$item->province}}</strong>
                  </td>
                  <td>
                      <strong>Rp.{{$item->total}}</strong>
                  </td>
                  <td>
                      <strong>{{$item->status}}</strong>
                  </td>
                  <td>
                    <a href="/transaksi/detail/{{$item->id}}"><strong>Lihat Detail</strong></a>
                  </td>
                </tr>
                @endforeach
                <!-- First row -->
              </tbody>
              <!-- Table body -->
            </table>
          </div>
          <!-- Shopping Cart table -->
        </section>
      </div>
      <!-- Main Container -->
</div>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection