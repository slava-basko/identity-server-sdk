<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 */

namespace Is\Sdk\Value;

use Is\Sdk\Auth\User;
use Is\Sdk\Exceptions\InvalidContext;
use Is\Sdk\Exceptions\PermissionException;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\ExpressionLanguage\SyntaxError;

class Answer implements \JsonSerializable
{
    /**
     * @var bool
     */
    private $answer;
    
    /**
     * @var array
     */
    private $rules;

    /**
     * @var User
     */
    private $user;

    /**
     * Answer constructor.
     * @param bool $answer
     * @param array $rules
     * @param User $user
     */
    public function __construct($answer, array $rules = [], User $user)
    {
        $this->answer = $answer;
        $this->rules = $rules;
        $this->user = $user;
    }

    /**
     * @return array
     */
    function jsonSerialize()
    {
        return [
            'answer' => $this->answer,
            'rules' => $this->rules,
            'user' => $this->user
        ];
    }

    /**
     * @return boolean
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param array $context
     * @return bool
     */
    public function applyRules(array $context = [])
    {
        $context = array_merge([
            'date' => new \DateTime(),
            'user' => $this->user
        ], $context);

        $expressionLanguage = new ExpressionLanguage();
        foreach ($this->rules as $rule) {
            try {
                $ruleResult = $expressionLanguage->evaluate($rule, $context);
                if (!is_bool($ruleResult) || $ruleResult == false) {
                    throw new PermissionException('Not passed rule: ' . $rule);
                }
            } catch (\RuntimeException $runtimeException) {
                throw new InvalidContext('Runtime error.', 0, $runtimeException);
            } catch (SyntaxError $syntaxError) {
                throw new InvalidContext('Invalid context.', 0, $syntaxError);
            }

        }

        return false;
    }
}
