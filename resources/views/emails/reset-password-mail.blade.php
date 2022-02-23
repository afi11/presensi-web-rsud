@component('mail::message')
# Reset Password

<h3>Silahkan klik tombol dibawah ini untuk melakukan reset password untuk pegawai atas nama
    {{ $details['namaPegawai'] }} dengan kode {{ $details['pegawaiCode'] }} 
</h3>

@component('mail::button', ['url' => 'http://192.168.100.14/37b60eda89b5204fc5beda94005abe90d8cc6d25/'.$details['pegawaiCode']])
    Reset Password
@endcomponent

Thanks,<br>
Admin Presensi RSUD Gambiran Kota Kediri
@endcomponent
