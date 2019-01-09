@extends('bwo::layouts.email')

@section('content')
  <tr>
    <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
      <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
        <tr>
          <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
              <p>
                Vous recevez cet e-mail, car nous avons reçu une demande de réinitialisation du mot de passe pour votre compte.
              </p>

              <a href="{{ $url }}">Réinitialiser votre mot de passe</a>

              <p>Si vous n'avez pas demandé la réinitialisation de votre mot de passe, aucune autre action n'est nécessaire.</p>

              <p>Si vous rencontrez des difficultés pour cliquer sur le bouton "Réinitialiser votre mot de passe", copier et coller l'URL ci-dessous dans votre navigateur Web : </p>
              <p>
                  <a href="{{ $url }}">{{ $url }}</a>
              </p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
@endsection
