<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="http://127.0.0.1:8000/assets/img/logos/logo.png'" class="logo" alt="RSUD GAMBIRAN KOTA KEDIRI">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
