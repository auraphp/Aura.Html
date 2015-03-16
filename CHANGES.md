This release has SECURITY FIXES.  All users are encouraged to upgrade immediately.

- SEC: The AbstractChecked helper, which is the parent for Radio and Checkbox, now HTML-escapes the label. Previously, no escaping was applied.

- SEC: The Textarea helper now HTML-escapes the value. Previously, no escaping was applied.

- SEC: The Select helper now HTML-escapes each option label. Previously, no escaping was applied.

- FIX: The attributes for the Label helper now default to `array()` instead of `null`.
