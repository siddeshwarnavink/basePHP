<?php

class Validator {
      protected $items, $errorHandler;

      protected $rules = [], $message = [], $funcs = [];

      public function __construct(ErrorHandler $errorHandler) {
            $this->errorHandler = $errorHandler;

            $this->addDefaultChecks();
      }

      private function addDefaultChecks()
      {
            // Required Check
            $this->addCheck("required", "The :field is required", function($field, $value, $satisfier) {
                  return mb_strlen($value) >= $satisfier;
            });

            // Max length Check
            $this->addCheck("maxlength", "The :field must be maximum of :satisfier length", function($field, $value, $satisfier) {
                  return strlen($value) < $satisfier;
            });

            // Min length Check
            $this->addCheck("minlength", "The :field must be minimum of :satisfier length", function($field, $value, $satisfier) {
                  return strlen($value) > $satisfier;
            });

            // Valid Email Check
            $this->addCheck("email", "Email is invalid", function($field, $value, $satisfier) {
                  return filter_var($value, FILTER_VALIDATE_EMAIL);
            });

            // Alpha Numeric Check
            $this->addCheck("alnum", ":field must be alphanumeric", function($field, $value, $satisfier) {
                  return ctype_alnum($value);
            });

            // Field unique Check
            $this->addCheck("match", ":field must match :satisfier", function($field, $value, $satisfier) {
                  return $value === $this->items[$satisfier];
            });

            $this->addCheck("unique", ":field must be unique", function($field, $value, $satisfier) {
                  if(isset($satisfier['except']) && in_array($value, $satisfier['except'])) {
                        return true;
                  }

                  return !DB::query('SELECT * FROM ' . $satisfier['table'] . ' WHERE ' . $satisfier['col'] . ' = :value', [':value' => $value]);
            });

            $this->addCheck("ununique", ":field dosen`t exist", function($field, $value, $satisfier) {
                  if(isset($satisfier['except']) && in_array($value, $satisfier['except'])) {
                        return true;
                  }


                  return DB::query('SELECT * FROM ' . $satisfier['table'] . ' WHERE ' . $satisfier['col'] . ' = :value', [':value' => $value]);
            });
      }

      public function addCheck($name, $message, $function) 
      {
            $this->rules[] = $name;
            $this->message[$name] = $message;
            $this->funcs[$name] = $function;

            return $this;
      }

      public function check($items, $rules) {
            $this->items = $items;

            foreach ($items as $item => $value) {
                  if(in_array($item, array_keys($rules))){
                        $this->validate([
                              'field' => $item,
                              'value' => $value,
                              'rules' => $rules[$item]
                        ]);
                  }
            }

            return $this;
      }

      public function fails() {
            return $this->errorHandler->hasErrors();
      }

      public function errors() {
            return $this->errorHandler;
      }

      protected function validate($item) {
            $field = $item['field'];

            foreach ($item['rules'] as $rule => $satisfier) {
                  if(in_array($rule, $this->rules)) {
                        if(!$this->funcs[$rule]($field, $item['value'], $satisfier)) {
                              $this->errorHandler->addError(
                                    str_replace([':field', ':satisfier'], [$field, (is_array($satisfier) ? '' : $satisfier)], $this->message[$rule]), $field
                              );
                        }
                  }
            }
      }
}

?>