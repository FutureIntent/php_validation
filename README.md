# Plane php validator by scheme. 
## Analog of Yup in Node.js.

> Example: 
```
$validation_scheme = [
    'admin_id' => (new Rules())->setRequired(true)->setType('int'),
    'date_from' => (new Rules())->setDate('Y-m-d'),
    'date_to' => (new Rules())->setDate('Y-m-d'),
    'offset' => (new Rules())->setRequired(true)->setType('int'),
    'text' => (new Rules())->setRequired(true)->setType('string')->setPattern("/\w{1,}/")
];

$validator = new Validator($validation_scheme);
$validator_res = $validator->validate($data_object_for_validation);

var_dump($validator_res);
```