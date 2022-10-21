# residency-validator
This package can be used to validate addresses.

### Installation

Require package in your composer.json:
```json
"repositories": [
  {
    "url": "https://github.com/mintellity/residency-validator.git",
    "type": "git"
  }
],

"require": {
  ...
  "mintellity/residency-validator": "dev-master"
}
```

### How to use it

Add the following code to your request classes, which validates an address:

```php
use Illuminate\Validation\Validator;
use Mintellity\ResidencyValidator;

...

public function withValidator(Validator $validator)
    {
        $zip = $validator->getData()['address']['zip'] ?? '';
        $city = $validator->getData()['address']['city'] ?? '';
        $street = $validator->getData()['address']['street'] ?? '';
        $validator->after(
            function ($validator) use ($zip, $city, $street) {
                if (!ResidencyValidator::checkAddress(['zip' => $zip, 'city' => $city])) {
                    $validator->errors()->add(
                        'zip',
                        'Zip does not matches with the city.'
                    );
                    $validator->errors()->add(
                        'city',
                        'City does not matches the with zip.'
                    );
                }else if (!ResidencyValidator::checkAddress(['zip' => $zip, 'city' => $city, 'street' => $street])) {
                    $validator->errors()->add(
                        'street',
                        'Street not found.'
                    );
                }
            }
        );
    }
```
