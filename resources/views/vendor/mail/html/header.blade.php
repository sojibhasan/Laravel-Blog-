<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img style="width: 120px;" src="{{ url('header-logo.png') }}" class="logo" alt="Brand Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
