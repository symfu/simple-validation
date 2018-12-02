Getting Started With SimpleValidation
==========================================

This is SimpleValidation, a easy-to-use validation library for PHP.

## Installation

### Install by composer

``` bash
$ composer require symfu/simple-validation
```

## Using SimpleValidation

``` php
<?php
namespace App\Controller;

use Symfu\SimpleValidation\ValidationManager;

class DemoController extends Controller
{
    public function indexAction()
    {
        $fieldDefs = [
            'username'   => ['required, alpha, min_length[5], max_length[20]'],
            'nickname'   => ['required, alpha, min_length[5], max_length[20]'],
            'first_name' => ['required, alpha, min_length[2], max_length[20]'],
            'last_name'  => ['required, alpha, min_length[2], max_length[20]'],
            'email'      => ['required, email'],
            'password1'  => ['required, min_length[6], max_length[100]'],
            'password2'  => ['required, min_length[6], max_length[100], matches[password1]'],
        ];

        $_POST = [
            'username'   => 'symfu',
            'nickname'   => 'Symfu',
            'first_name' => 'Yi',
            'last_name'  => 'Liang',
            'email'      => 'LY@edge.ac',
            'password1'  => 'abc123456',
            'password2'  => 'abc123456',
        ];

        list($valid, $errors) = $this->validationManager->validate($_POST, $fieldDefs);
        
        if(!$valid) {
            return ['status' => false, 'msg' => 'Invalid request', 'errors' => $errors];
        } else {
            return ['status' => true, 'msg' => 'OK'];
        }
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
