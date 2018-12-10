<?php
namespace Symfu\SimpleValidation;

class ValidationError {
    protected $messageKey;
    protected $message;     // used for translation
    protected $argument;

    public function __construct($messageKey, $argument = '', $message = '') {
        $this->messageKey = $messageKey;
        $this->argument   = $argument;
        $this->message    = $message;
    }

    public function __toString() {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getMessageKey() {
        return $this->messageKey;
    }

    /**
     * @return mixed
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * @param mixed $messageKey
     * @return ValidationError
     */
    public function setMessageKey($messageKey) {
        $this->messageKey = $messageKey;

        return $this;
    }

    /**
     * @param mixed $message
     * @return ValidationError
     */
    public function setMessage($message) {
        $this->message = $message;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArgument() {
        return $this->argument;
    }

    /**
     * @param mixed $argument
     */
    public function setArgument($argument) {
        $this->argument = $argument;

        return $this;
    }
}
