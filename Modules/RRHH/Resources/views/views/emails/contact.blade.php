@extends('layouts.email')

@section('content')
  <tr>
    <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
      <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
        <tr>
          <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
            <p style="Margin-bottom: 15px;">Nom : {{$lastname}}</p>
            <p style="Margin-bottom: 15px;">Prénom : {{$name}}</p>
            <p style="Margin-bottom: 15px;">Sujet : {{$subject}}</p>
            <p style="Margin-bottom: 15px;">Message : {{$comment}}</p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
@endsection
