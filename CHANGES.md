This release fixes a bug in Checkbox/Radio helpers by adding a feature. Previously, the helpers used strict checking of values, which was an unintentional holdover from previous versions. They both now have a `strict()` method, just like the Select helper, that allows you to turn strict checking off and on. The default is "off."

It also includes a fix to the Escaper encoding lists: they were previously using "iso8859-*" and now use "iso-8859-*" (note the added dash, per the listing at <http://php.net/manual/en/mbstring.supported-encodings.php>).
