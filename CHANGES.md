First stable 2.0.0 release.

- DOC: Updated docblocks and README files.

- FIX #18

- FIX #17: Input helper now extends HelperLocator rather than composing it. This helps support easier DI configuration.

- CHG: Standardize all input helpers to return self.

- CHG: Allow Input::__invoke() to return the input locator object

- CHG: Allow Label::__invoke() to return the label object

- ADD: Class "Escaper" as a helper.

- FIX #6: In Select helper, add placeholder() and strict() methods, and no longer uses strict equality by default.
