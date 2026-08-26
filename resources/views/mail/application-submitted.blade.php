<!DOCTYPE html>
<html lang="sq">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Aplikimi u dërgua me sukses</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f5f7; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f5f7; padding:32px 16px;">
<tr>
<td align="center">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:560px; background-color:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.08);">

<tr>
<td style="background-color:#2563eb; padding:28px 32px;">
<span style="color:#ffffff; font-size:20px; font-weight:700;">💼 SmartJob</span>
</td>
</tr>

<tr>
<td style="padding:32px;">
<p style="margin:0 0 8px; font-size:15px; color:#6b7280;">Përshëndetje {{ $candidateName }},</p>
<h1 style="margin:0 0 20px; font-size:22px; line-height:1.3; color:#111827;">
✅ Aplikimi juaj u dërgua me sukses përmes <strong>SmartJob</strong>.
</h1>

<p style="margin:0 0 24px; font-size:15px; line-height:1.6; color:#374151;">
Aplikimi juaj për pozitën <strong>{{ $jobTitle }}</strong> në <strong>{{ $companyName }}</strong> u dërgua me sukses.
CV-ja juaj i&nbsp;është përcjellë kompanisë.
</p>

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f9fafb; border:1px solid #e5e7eb; border-radius:8px; margin-bottom:24px;">
<tr>
<td style="padding:20px 24px;">
<p style="margin:0 0 14px; font-size:14px; font-weight:700; color:#111827;">📌 Detajet e aplikimit</p>
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:14px; color:#374151;">
<tr>
<td style="padding:4px 0; width:110px; color:#6b7280;">Pozita:</td>
<td style="padding:4px 0; font-weight:600;">{{ $jobTitle }}</td>
</tr>
<tr>
<td style="padding:4px 0; color:#6b7280;">Kompania:</td>
<td style="padding:4px 0; font-weight:600;">{{ $companyName }}</td>
</tr>
@if($location)
<tr>
<td style="padding:4px 0; color:#6b7280;">Lokacioni:</td>
<td style="padding:4px 0; font-weight:600;">{{ $location }}</td>
</tr>
@endif
<tr>
<td style="padding:4px 0; color:#6b7280;">Data e aplikimit:</td>
<td style="padding:4px 0; font-weight:600;">{{ $appliedAt }}</td>
</tr>
</table>
</td>
</tr>
</table>

<table role="presentation" cellpadding="0" cellspacing="0">
<tr>
<td style="border-radius:6px; background-color:#2563eb;">
<a href="{{ $jobUrl }}" style="display:inline-block; padding:12px 24px; font-size:14px; font-weight:600; color:#ffffff; text-decoration:none;">
Shiko shpalljen →
</a>
</td>
</tr>
</table>

<p style="margin:28px 0 0; font-size:14px; line-height:1.6; color:#6b7280;">
Punëdhënësi do ta shqyrtojë aplikimin tuaj dhe do t'ju kontaktojë nëse jeni i&nbsp;përshtatshëm për pozitën. Suksese!
</p>
</td>
</tr>

<tr>
<td style="padding:20px 32px; background-color:#f9fafb; border-top:1px solid #e5e7eb;">
<p style="margin:0; font-size:12px; color:#9ca3af; text-align:center;">
© {{ date('Y') }} SmartJob. Ky është një email automatik, ju lutem mos e ktheni përgjigje.
</p>
</td>
</tr>

</table>
</td>
</tr>
</table>
</body>
</html>
