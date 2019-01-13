<?php
namespace Symfu\SimpleValidation;

class ValidationError implements \JsonSerializable {
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
        return $this->message ?: $this->messageKey;
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

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize() {
        $vars = get_object_vars($this);
        if(!$vars['message']) {
            $vars['message'] = $vars['messageKey'];
        }

        return $vars;
    }
}
