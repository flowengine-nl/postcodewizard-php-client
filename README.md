# PostcodeWizard PHP Client

The official PHP client for the [PostcodeWizard API](https://api.postcodewizard.nl/docs/api).

---

## Installation

Use Composer to install the package:

```bash
composer require postcodewizard/postcodewizard-php-client
```

---

## Usage

```php
use PostcodeWizard\PostcodeWizard;

$client = new PostcodeWizard('YOUR_API_KEY');

// Lookup
$result = $client->lookup('7223LN', '1');

// Autocomplete
$result = $client->autocomplete('Toverstraat 1, Baak');


```
