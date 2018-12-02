Getting Started With SimpleValidation
==========================================

This is SimpleValidation, a easy-to-use validation library for PHP.

## Installation

### Install by composer

``` bash
$ composer require symfu/simple-validation
```

## Using SimpleValidation: Getting Started

``` php
<?php
namespace App\Controller;

use Symfu\SimpleValidation\ValidatorManager;

class DemoController extends Controller
{
    public function indexAction()
    {
        $fieldDefs = [
            // Field definition: [<field_name> => [validators]]
            //   field_name:      field name
            //   validators:      validationManager info, can be a string, array or null. null is treated as empty array

            'username',   ['required, alpha_dash, min_length[5], max_length[20], regex[/[a-z0-9_-]/]'],
            'nickname',   ['required, alpha, min_length[5], max_length[20]'],
            'email',      ['required, email'],
            'password1',  ['required, min_length[6], max_length[100]'],
            'password2',  ['required, min_length[6], max_length[100], matches[password1]'],
            'age',        ['integer, min[18]'],
            'intro',      ['max_length[1000]'],
        );
        
        $
    }
}

```

## References

### Provided Validators

SimpleValidation has many build-in validators that help you validate your form easily.

Here is the list (In alphabetical order):

  * alpha_dash
  * alpha_numeric
  * alpha
  * decimal
  * extac_length[20]
  * greater_then[10]
  * integer
  * less_then[10]
  * matches[input_name_to_match]
  * max_length[50]
  * min_length[5]
  * numeric
  * regex[/[a-z]+/]
  * required
  * base64
  * email


## Unit Tests

```bash
$ phpunit --bootstrap=boostrap.php tests
```
