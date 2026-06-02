# Bilingual Rejection Letter + Full World Country List

Date: 2026-06-02

## Goal

Two related admin/registration improvements:

1. When an admin rejects a volunteer or ministry-team application in the Filament
   admin, the rejection email should contain a polished bilingual (Hungarian +
   English) letter. The reject modal's reason field is pre-filled with that
   letter (name already substituted) and remains editable per case.
2. The country selects in the public registration forms should offer the full
   world country list instead of ~10 hardcoded European countries.

## Decisions (confirmed)

- The bilingual text lives in a config file; the email template renders it, and
  the reject modal's `reason` field is pre-filled with it (editable).
- The same rejection text is used for both volunteer and ministry applications.
- Country list: full ISO 3166 list, common/European countries first, rest
  alphabetical, `Other` last, read from one central source.
- Acceptance ("approved") emails are out of scope (no copy provided).

## Design

### 1. Rejection letter

**`config/rejection.php`** — returns the default bilingual letter as a single
string with a `:name` placeholder. Hungarian block first, then English block,
greeting and signature included (so the email template adds no extra greeting or
signature).

**Reject actions** — both
`app/Filament/Resources/Registrations/Tables/RegistrationsTable.php` and
`app/Filament/Widgets/PendingApprovalsWidget.php`:

- The `reason` Textarea gains `->default(fn (Registration $record) =>
  str_replace(':name', $record->first_name, config('rejection.default')))`.
- Larger field (`->rows(18)`).
- Behaviour otherwise unchanged: `$record->reject(Auth::id(), $data['reason'])`.

**Email templates** — `resources/views/emails/volunteer/rejected.blade.php` and
`resources/views/emails/ministry/rejected.blade.php`:

- Render the `$reason` text verbatim inside `<x-mail::message>`, preserving line
  breaks (`{!! nl2br(e($reason)) !!}`).
- Fallback to `config('rejection.default')` (with `:name` substituted) when the
  reason is empty.

**Mailables** — `VolunteerApplicationRejected` must pass `reason` to its view
(currently it does not); `MinistryApplicationRejected` already passes it.

### 2. Country list

**`app/Support/CountryList.php`** — `public static function options(): array`
returns `['Hungary' => 'Hungary', ...]`. Priority countries
(Hungary, Germany, Austria, Romania, Slovakia, Czech Republic, Poland, Ukraine,
Serbia, Croatia, United Kingdom, Ireland, Netherlands, Switzerland, United
States) first, the remaining ISO countries alphabetically, `Other` last.

Both `app/Livewire/RegistrationForm.php` and `app/Livewire/Pages/MinistryTeam.php`
replace their inline option arrays with `CountryList::options()`.

## Testing

- `CountryList::options()` returns ~195 entries, `Hungary` is the first key, a
  distant country (`Japan`) is present, `Other` is the last key.
- Rendered volunteer + ministry rejection emails contain Hungarian and English
  key phrases and the registrant's first name.
- The reject action's `reason` field default contains the bilingual text with the
  name substituted.

## Out of scope

- Acceptance email copy/bilingual treatment.
- Bulk reject (only bulk approve exists today).
